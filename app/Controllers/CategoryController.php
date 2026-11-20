<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\CategoryModel;
use App\Models\HomeModel;
use App\Models\PostModel;
use App\Models\SiteModel;
use App\Models\TagModel;

class CategoryController extends BaseController
{
    public function __construct()
    {
        $this->homeModel     = new HomeModel();
        $this->siteModel     = new SiteModel();
        $this->aboutModel    = new AboutModel();
        $this->postModel     = new PostModel();
        $this->categoryModel = new CategoryModel();
        $this->tagModel      = new TagModel();
    }

    public function index($slug = null)
    {
        if ($slug == null) {
            return redirect()->to('/post');
        }

        $postsQuery = $this->categoryModel->get_post_by_category($slug);
        $posts      = $postsQuery->getResultArray();

        $db         = \Config\Database::connect();
        $categories = $db->table('tbl_category')
            ->select('tbl_category.*, COUNT(tbl_post.post_id) as post_count')
            ->join('tbl_post', 'tbl_post.post_category_id = tbl_category.category_id AND tbl_post.post_status = 1', 'left')
            ->groupBy('tbl_category.category_id')
            ->orderBy('tbl_category.category_name', 'ASC')
            ->get()
            ->getResultArray();

        $recentPosts = $db->table('tbl_post')
            ->where('post_status', 1)
            ->orderBy('post_date', 'DESC')
            ->orderBy('post_id', 'DESC')
            ->limit(4)
            ->get()
            ->getResultArray();

        $totalPosts = $db->table('tbl_post')
            ->where('post_status', 1)
            ->countAllResults();

        $activeCat = $db->table('tbl_category')->where('category_slug', $slug)->get()->getRowArray();
        $catName   = $activeCat['category_name'] ?? ucwords(str_replace('-', ' ', $slug));

        $data = [
            'site'          => $this->siteModel->find(1),
            'home'          => $this->homeModel->find(1),
            'about'         => $this->aboutModel->find(1),
            'title'         => 'Category - ' . $catName,
            'keyword'       => $catName,
            'category_slug' => $slug,
            'posts'         => $posts,
            'categories'    => $categories,
            'recent_posts'  => $recentPosts,
            'total_posts'   => $totalPosts,
            'tags'          => $this->tagModel->findAll(),
            'active'        => 'Post'
        ];
        return view('post_category', $data);
    }
}
