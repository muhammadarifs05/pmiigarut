<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\HomeModel;
use App\Models\SiteModel;
use App\Models\PostModel;
// use App\Models\CategoryModel;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->siteModel = new SiteModel();
        $this->aboutModel = new AboutModel();
        $this->postModel = new PostModel();
        // $this->categoryModel = new CategoryModel();

    }
    public function index()
    {
        $data = [
            'site' => $this->siteModel->find(1),
            'home' => $this->homeModel->find(1),
            'about' => $this->aboutModel->find(1),
            'posts' => $this->postModel
                ->where('post_status', 1)
                ->orderBy('post_date', 'DESC')
                ->limit(3)
                ->findAll(),
            'validation' => \Config\Services::validation(),
            // 'categories' => $this->categoryModel->findAll(),
            'title' => 'Home',
            'active' => 'Home'
        ];
        return view('home_view', $data);
    }
}
