<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\HomeModel;
use App\Models\PostModel;
use App\Models\SiteModel;
use App\Models\TagModel;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->homeModel     = new HomeModel();
        $this->siteModel     = new SiteModel();
        $this->aboutModel    = new AboutModel();
        $this->postModel     = new PostModel();
        $this->categoryModel = new CategoryModel();
        $this->tagModel      = new TagModel();
        $this->commentModel  = new CommentModel();
    }

    private function getSidebarData(): array
    {
        $db = \Config\Database::connect();

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

        return [
            'categories'   => $categories,
            'recent_posts' => $recentPosts,
            'total_posts'  => $totalPosts,
            'tags'         => $this->tagModel->findAll(),
        ];
    }

    public function index($slug = null)
    {
        if ($slug == null) {
            $posts = $this->postModel
                ->select('tbl_post.*, tbl_category.category_name, tbl_category.category_slug')
                ->join('tbl_category', 'tbl_category.category_id = tbl_post.post_category_id', 'left')
                ->where('post_status', 1)
                ->orderBy('post_date', 'DESC')
                ->orderBy('post_id', 'DESC')
                ->paginate(9, 'posts');

            $data = array_merge([
                'site'   => $this->siteModel->find(1),
                'home'   => $this->homeModel->find(1),
                'about'  => $this->aboutModel->find(1),
                'posts'  => $posts,
                'pager'  => $this->postModel->pager,
                'title'  => 'News',
                'active' => 'Post'
            ], $this->getSidebarData());

            return view('post_view', $data);
        }

        if (!$this->postModel->get_post_by_slug($slug)->getRowArray()) {
            return redirect()->to('post');
        }

        $post        = $this->postModel->get_post_by_slug($slug)->getRowArray();
        $post_tags   = array_filter(array_map('trim', explode(',', $post['post_tags'] ?? '')));
        $post_id     = $post['post_id'];
        $category_id = $post['category_id'];

        $user_ip = $_SERVER['REMOTE_ADDR'];
        $cek_ip  = $this->postModel->query("SELECT * FROM tbl_post_views WHERE view_ip='$user_ip' AND view_post_id='$post_id' AND DATE(view_date)=CURDATE()")->getNumRows();
        if ($cek_ip < 1) {
            $this->postModel->count_views($user_ip, $post_id);
        }

        $db       = \Config\Database::connect();
        $prevPost = $db->table('tbl_post')
            ->select('post_title, post_slug')
            ->where('post_status', 1)
            ->where('post_id <', $post_id)
            ->orderBy('post_id', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray();

        $nextPost = $db->table('tbl_post')
            ->select('post_title, post_slug')
            ->where('post_status', 1)
            ->where('post_id >', $post_id)
            ->orderBy('post_id', 'ASC')
            ->limit(1)
            ->get()
            ->getRowArray();

        $data = [
            'site'         => $this->siteModel->find(1),
            'home'         => $this->homeModel->find(1),
            'about'        => $this->aboutModel->find(1),
            'post'         => $post,
            'post_tags'    => $post_tags,
            'prev_post'    => $prevPost,
            'next_post'    => $nextPost,
            'related_post' => $this->postModel->get_related_post($category_id, $post_id)->getResultArray(),
            'tags'         => $this->tagModel->findAll(),
            'comments'     => $this->commentModel->show_comments($post_id)->getResultArray(),
            'title'        => $post['post_title'],
            'active'       => 'Post'
        ];
        return view('post_detail', $data);
    }

    public function search()
    {
        $query = $this->request->getGet('search_query');
        if (!$query) {
            return redirect()->to('/post');
        }
        $result = $this->postModel->search_post($query);
        if ($result->getNumRows() < 1) {
            $posts   = $result->getResultArray();
            $keyword = $query;
        } else {
            $posts   = $result->getResultArray();
            $keyword = $query;
        }
        $data = array_merge([
            'site'         => $this->siteModel->find(1),
            'home'         => $this->homeModel->find(1),
            'about'        => $this->aboutModel->find(1),
            'title'        => 'Search: ' . $query,
            'keyword'      => $keyword,
            'search_query' => $query,
            'posts'        => $posts,
            'active'       => 'Post'
        ], $this->getSidebarData());

        return view('post_search', $data);
    }

    public function send_comment()
    {
        $data = [
            'post_id' => htmlspecialchars($this->request->getPost('post_id')),
            'name'    => htmlspecialchars($this->request->getPost('name')),
            'email'   => htmlspecialchars($this->request->getPost('email')),
            'message' => htmlspecialchars($this->request->getPost('message')),
        ];
        $rules = [
            'post_id' => [
                'rules'  => 'required|is_natural_no_zero|numeric',
                'errors' => [
                    'required'           => 'Kolom {field} harus diisi!',
                    'is_natural_no_zero' => 'Inputan {field} harus angka dan tidak boleh nol atau negatif',
                    'numeric'            => 'Inputan {field} harus angka!'
                ]
            ],
            'name' => [
                'rules'  => 'required|alpha_space|min_length[3]',
                'errors' => [
                    'required'    => 'Kolom {field} harus diisi!',
                    'alpha_space' => 'Inputan {field} harus huruf!',
                    'min_length[3]' => 'Panjang karakter minimal 3 digit'
                ]
            ],
            'email' => [
                'rules'  => 'required|valid_email|min_length[3]',
                'errors' => [
                    'required'    => 'Kolom {field} harus diisi!',
                    'valid_email' => 'Inputan {field} harus email!',
                    'min_length[3]' => 'Panjang karakter minimal 3 digit'
                ]
            ],
            'message' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'    => 'Kolom {field} harus diisi!',
                    'min_length[3]' => 'Panjang karakter minimal 3 digit'
                ]
            ]
        ];
        if (!$this->validateData($data, $rules)) {
            session()->setFlashdata('msg', '<div class="p-4 rounded-xl bg-error-container text-on-error-container font-body-sm text-body-sm mb-4">Mohon masukkan nama, email valid, dan isi tanggapan minimal 3 karakter!</div>');
            return redirect()->back();
        }

        $validData = $this->validator->getValidated();
        $this->commentModel->save([
            'comment_name'    => $validData['name'],
            'comment_email'   => $validData['email'],
            'comment_message' => $validData['message'],
            'comment_post_id' => $validData['post_id'],
            'comment_image'   => 'user_blank.png'
        ]);
        session()->setFlashdata('msg', '<div class="p-4 rounded-xl bg-primary-fixed text-on-primary-fixed font-body-sm text-body-sm mb-4">Terima kasih atas respon Anda, tanggapan Anda akan tampil setelah moderasi redaksi.</div>');
        return redirect()->back();
    }

    public function tag($tag)
    {
        $posts = $this->tagModel->get_post_by_tags($tag);
        $posts = $posts->getResultArray();
        $data = array_merge([
            'site'    => $this->siteModel->find(1),
            'home'    => $this->homeModel->find(1),
            'about'   => $this->aboutModel->find(1),
            'title'   => 'Tags: ' . $tag,
            'keyword' => 'Tag: #' . $tag,
            'posts'   => $posts,
            'active'  => 'Post'
        ], $this->getSidebarData());

        return view('post_tag', $data);
    }

    public function author($user_id)
    {
        $posts = $this->postModel->where('post_user_id', $user_id)->get()->getResultArray();
        $data = array_merge([
            'site'    => $this->siteModel->find(1),
            'home'    => $this->homeModel->find(1),
            'about'   => $this->aboutModel->find(1),
            'title'   => "Author $user_id",
            'keyword' => "Author: $user_id",
            'posts'   => $posts,
            'active'  => 'Post'
        ], $this->getSidebarData());

        return view('post_author', $data);
    }
}
