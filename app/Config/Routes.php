<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// HomeController
$routes->get('/', 'HomeController::index', ['filter' => 'logedin']);

// Komisariat dan Pengajuan SK
$routes->get('/komisariat', 'KomisariatController::index');
$routes->get('/permohonan-sk', 'PermohonanSkController::index');
$routes->post('/permohonan-sk/store', 'PermohonanSkController::store');
$routes->get('/permohonan-sk/sukses/(:segment)', 'PermohonanSkController::sukses/$1');

$routes->get('/cek-status-pengajuan', 'PermohonanSkController::cekStatus');
$routes->post('/cek-status-pengajuan/hasil', 'PermohonanSkController::hasilStatus');

$routes->get('/permohonan-sk/upload-ulang/(:segment)', 'PermohonanSkController::formUploadUlang/$1');
$routes->post('/permohonan-sk/upload-ulang/(:segment)', 'PermohonanSkController::submitUploadUlang/$1');

// SubscribeController
$routes->get('subscribe', static function () {
    return redirect()->to('/#footer');
});
$routes->post('subscribe', 'SubscribeController::index');

// GalleryController
$routes->get('gallery', 'GalleryController::index');

// TeamController
$routes->get('team', 'TeamController::index');

// PostController
$routes->get('search', 'PostController::search');
$routes->get('post', 'PostController::index');
$routes->get('post/(:segment)', 'PostController::index/$1');
$routes->get('author/(:num)', 'PostController::author/$1');
$routes->get('tag/(:segment)', 'PostController::tag/$1');
$routes->post('post/send_comment', 'PostController::send_comment');

// CategoryController
$routes->get('category/(:segment)', 'CategoryController::index/$1');

// DocumentController
$routes->get('document', 'DocumentController::index');

// ContactController
$routes->get('contact', 'ContactController::index');
$routes->post('contact', 'ContactController::inbox');

// LoginController & Logout
$routes->group('', ['filter' => 'logedin'], static function ($routes) {
    $routes->get('login', 'LoginController::index');
    $routes->post('login/validasi', 'LoginController::validasi');
});
$routes->get('logout', 'LoginController::logout');

// Admin Routes
$routes->group('admin', ['filter' => 'authadmin'], static function ($routes) {
    $routes->get('', 'Admin\AdminController::index');
    // Post Route
    $routes->group('post', static function ($routes) {
        $routes->get('', 'Admin\PostAdminController::index');
        $routes->post('', 'Admin\PostAdminController::publish');
        $routes->delete('', 'Admin\PostAdminController::delete');
        $routes->put('', 'Admin\PostAdminController::update');
        $routes->get('add_new', 'Admin\PostAdminController::add_new');
        $routes->get('(:num)/edit', 'Admin\PostAdminController::edit/$1');
    });
    // Category Route
    $routes->group('category', static function ($routes) {
        $routes->get('', 'Admin\CategoryAdminController::index');
        $routes->post('', 'Admin\CategoryAdminController::save');
        $routes->put('', 'Admin\CategoryAdminController::edit');
        $routes->delete('', 'Admin\CategoryAdminController::delete');
    });
    // Tag Route
    $routes->group('tag', static function ($routes) {
        $routes->get('', 'Admin\TagAdminController::index');
        $routes->post('', 'Admin\TagAdminController::save');
        $routes->put('', 'Admin\TagAdminController::edit');
        $routes->delete('', 'Admin\TagAdminController::delete');
    });
    // Komisariat
    $routes->group('komisariat', static function ($routes) {
        $routes->get('', 'Admin\KomisariatController::index');
        $routes->get('add', 'Admin\KomisariatController::add');
        $routes->post('save', 'Admin\KomisariatController::save');
        $routes->get('(:num)/edit', 'Admin\KomisariatController::edit/$1');
        $routes->post('(:num)/update', 'Admin\KomisariatController::update/$1');
        $routes->get('(:num)/toggle-status', 'Admin\KomisariatController::toggleStatus/$1');
        $routes->delete('', 'Admin\KomisariatController::delete');
    });
    // Pengajuan SK
    $routes->group('pengajuan-sk', static function ($routes) {
        $routes->get('', 'Admin\PengajuanSkController::index');
        $routes->get('(:num)/detail', 'Admin\PengajuanSkController::detail/$1');
        $routes->post('(:num)/update-status', 'Admin\PengajuanSkController::updateStatus/$1');
        $routes->get('(:num)/preview/(:segment)', 'Admin\PengajuanSkController::previewFile/$1/$2');
        $routes->get('(:num)/download/(:segment)', 'Admin\PengajuanSkController::downloadFile/$1/$2');
        $routes->delete('', 'Admin\PengajuanSkController::delete');
    });
    // Inbox Route
    $routes->group('inbox', static function ($routes) {
        $routes->get('', 'Admin\InboxAdminController::index');
        $routes->get('(:num)', 'Admin\InboxAdminController::read/$1');
        $routes->delete('', 'Admin\InboxAdminController::delete');
    });
    // Comment Route
    $routes->group('comment', static function ($routes) {
        $routes->get('', 'Admin\CommentAdminController::index');
        $routes->post('', 'Admin\CommentAdminController::reply');
        $routes->post('publish', 'Admin\CommentAdminController::publish');
        $routes->put('', 'Admin\CommentAdminController::edit');
        $routes->delete('', 'Admin\CommentAdminController::delete');
        $routes->get('unpublish', 'Admin\CommentAdminController::unpublish');
    });
    // Subscriber Route
    $routes->group('subscriber', static function ($routes) {
        $routes->get('', 'Admin\SubscriberAdminController::index');
        $routes->delete('', 'Admin\SubscriberAdminController::delete');
        $routes->get('increase/(:num)', 'Admin\SubscriberAdminController::increase/$1');
        $routes->get('decrease/(:num)', 'Admin\SubscriberAdminController::decrease/$1');
        $routes->get('activate/(:num)', 'Admin\SubscriberAdminController::activate/$1');
        $routes->get('deactivate/(:num)', 'Admin\SubscriberAdminController::deactivate/$1');
    });
    // Member Route
    $routes->group('member', static function ($routes) {
        $routes->get('', 'Admin\MemberAdminController::index');
        $routes->post('', 'Admin\MemberAdminController::insert');
        $routes->put('', 'Admin\MemberAdminController::update');
        $routes->delete('', 'Admin\MemberAdminController::delete');
    });
    // Testimonial Route
    $routes->group('testimonial', static function ($routes) {
        $routes->get('', 'Admin\TestimonialAdminController::index');
        $routes->post('', 'Admin\TestimonialAdminController::insert');
        $routes->put('', 'Admin\TestimonialAdminController::update');
        $routes->delete('', 'Admin\TestimonialAdminController::delete');
    });
    // Team Route
    $routes->group('team', static function ($routes) {
        $routes->get('', 'Admin\TeamAdminController::index');
        $routes->post('', 'Admin\TeamAdminController::insert');
        $routes->put('', 'Admin\TeamAdminController::update');
        $routes->delete('', 'Admin\TeamAdminController::delete');
    });
    // Users Route
    $routes->group('users', static function ($routes) {
        $routes->get('', 'Admin\UsersAdminController::index');
        $routes->post('', 'Admin\UsersAdminController::insert');
        $routes->put('', 'Admin\UsersAdminController::update');
        $routes->delete('', 'Admin\UsersAdminController::delete');
        $routes->get('deactivate/(:num)', 'Admin\UsersAdminController::deactivate/$1');
        $routes->get('activate/(:num)', 'Admin\UsersAdminController::activate/$1');
    });
    // Setting Route
    $routes->group('setting', static function ($routes) {
        $routes->get('', static function () {
            return redirect()->to('admin/setting/profile');
        });
        // Setting My Profile
        $routes->get('profile', 'Admin\SettingAdminController::profile');
        $routes->post('profile', 'Admin\SettingAdminController::profile_update');
        $routes->put('profile', 'Admin\SettingAdminController::profile_password');
        // Setting Web
        $routes->get('web', 'Admin\SettingAdminController::web');
        $routes->put('web', 'Admin\SettingAdminController::web_update');

        // Setting Home
        $routes->get('home', 'Admin\SettingAdminController::home');
        $routes->put('home', 'Admin\SettingAdminController::home_update');

        // Setting About
        $routes->get('about', 'Admin\SettingAdminController::about');
        $routes->put('about', 'Admin\SettingAdminController::about_update');
    });
});

// Author Routes
$routes->group('author', ['filter' => 'authauthor'], static function ($routes) {
    $routes->get('', 'Author\AuthorController::index');
    // Post Route
    $routes->group('post', static function ($routes) {
        $routes->get('', 'Author\PostAuthorController::index');
        $routes->post('', 'Author\PostAuthorController::publish');
        $routes->delete('', 'Author\PostAuthorController::delete');
        $routes->put('', 'Author\PostAuthorController::update');
        $routes->get('add_new', 'Author\PostAuthorController::add_new');
        $routes->get('(:num)/edit', 'Author\PostAuthorController::edit/$1');
    });
    // Category Route
    $routes->group('category', static function ($routes) {
        $routes->get('', 'Author\CategoryAuthorController::index');
        $routes->post('', 'Author\CategoryAuthorController::save');
        $routes->put('', 'Author\CategoryAuthorController::edit');
        $routes->delete('', 'Author\CategoryAuthorController::delete');
    });
    // Tag Route
    $routes->group('tag', static function ($routes) {
        $routes->get('', 'Author\TagAuthorController::index');
        $routes->post('', 'Author\TagAuthorController::save');
        $routes->put('', 'Author\TagAuthorController::edit');
        $routes->delete('', 'Author\TagAuthorController::delete');
    });
    // Comment Route
    $routes->group('comment', static function ($routes) {
        $routes->get('', 'Author\CommentAuthorController::index');
        $routes->post('', 'Author\CommentAuthorController::reply');
        $routes->post('publish', 'Author\CommentAuthorController::publish');
        $routes->put('', 'Author\CommentAuthorController::edit');
        $routes->delete('', 'Author\CommentAuthorController::delete');
        $routes->get('unpublish', 'Author\CommentAuthorController::unpublish');
    });
    // Setting Route
    $routes->group('setting', static function ($routes) {
        $routes->get('', static function () {
            return redirect()->to('author/setting/profile');
        });
        // Setting My Profile
        $routes->get('profile', 'Author\SettingAuthorController::profile');
        $routes->post('profile', 'Author\SettingAuthorController::profile_update');
        $routes->put('profile', 'Author\SettingAuthorController::profile_password');
    });
});
