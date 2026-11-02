<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?php
    $siteData = $site ?? [];
    $postData = $post ?? [];

    $siteName = $siteData['site_name'] ?? 'PMII Garut';
    $siteDescription = $siteData['site_description'] ?? '';
    $siteMail = $siteData['site_mail'] ?? '';
    $siteWa = $siteData['site_wa'] ?? '';
    $siteInstagram = $siteData['site_instagram'] ?? '#';
    $siteFacebook = $siteData['site_facebook'] ?? '#';
    $siteTwitter = $siteData['site_twitter'] ?? '#';
    $siteLinkedin = $siteData['site_linkedin'] ?? '#';
    $siteFavicon = $siteData['site_favicon'] ?? 'favicon.png';
    $activeMenu = $active ?? '';
    ?>

    <title><?= esc($siteName); ?></title>
    <meta content="<?= esc($postData['post_description'] ?? $siteDescription); ?>" name="description">
    <meta content="PMII, PR, PK, PC, PKC, PB, Pergerakan Mahasiswa Islam Indonesia" name="keywords">

    <!-- Awal Kode Optimasi WhatsApp / Sosial Media -->
    <meta property="og:type" content="<?= isset($postData['post_title']) ? 'article' : 'website'; ?>" />
    <meta property="og:title" content="<?= esc($postData['post_title'] ?? $siteName); ?>" />
    <meta property="og:description" content="<?= esc($postData['post_description'] ?? $siteDescription); ?>" />
    <meta property="og:url" content="<?= current_url(); ?>" />

    <?php if (isset($postData['post_image']) && !empty($postData['post_image'])): ?>
        <!-- Jalur yang benar mengarah ke folder assets/backend/images/post -->
        <meta property="og:image" content="<?= base_url('/assets/backend/images/post/' . $postData['post_image']); ?>" />
    <?php else: ?>
        <!-- Jika membuka beranda, gunakan logo default PMII -->
        <meta property="og:image" content="<?= base_url('/assets/frontend/images/' . $siteFavicon); ?>" />
    <?php endif; ?>

    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <!-- Akhir Kode Optimasi WhatsApp / Sosial Media -->


    <!--<link href="/assets/frontend/img/favicon.png" rel="icon">-->
    <link href="/assets/frontend/img/apple-touch-icon2.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="/assets/frontend/plugins/aos/aos.css" rel="stylesheet">
    <link href="/assets/frontend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/frontend/plugins/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/frontend/plugins/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/frontend/plugins/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/frontend/plugins/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="/assets/frontend/css/style.css" rel="stylesheet">
</head>

<body>

    <?php

    use App\Models\CategoryModel;

    $categoryModel = new CategoryModel();
    $categories = $categoryModel->findAll();
    ?>

    <header id="header" class="d-flex align-items-center">
        <div class="container header-shell">

            <div class="header-brand-wrap">
                <h1 class="logo">
                    <a href="/">
                        <span class="logo-mark">
                            <img src="/assets/frontend/images/<?= esc($siteFavicon); ?>" alt="<?= esc($siteName); ?>">
                        </span>
                        <span class="logo-text">
                            <strong><?= esc($siteName); ?></strong>
                            <small>Pergerakan Mahasiswa Islam Indonesia</small>
                        </span>
                    </a>
                </h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto <?= ($activeMenu == 'Home') ? 'active' : '' ?>" href="/">Home</a></li>
                    <li><a class="nav-link scrollto" href="/#about">About</a></li>
                    <li><a class="nav-link scrollto <?= ($activeMenu == 'Gallery') ? 'active' : '' ?>" href="/gallery">Gallery</a></li>
                    <li><a class="nav-link scrollto <?= ($activeMenu == 'Team') ? 'active' : '' ?>" href="/team">Pengurus</a></li>

                    <li class="dropdown news-dropdown">
                        <a class="<?= ($activeMenu == 'Post') ? 'active' : '' ?>" href="/post">
                            <span>News</span>
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="news-submenu">
                            <?php foreach ($categories as $category) : ?>
                                <?php if ($category['category_slug'] === 'opinion') : ?>
                                    <li>
                                        <a href="/category/<?= esc($category['category_slug']); ?>">
                                            <?= esc($category['category_name']); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <li><a class="nav-link scrollto <?= ($activeMenu == 'Document') ? 'active' : '' ?>" href="/document">Document</a></li>
                    <li><a class="nav-link scrollto <?= ($activeMenu == 'Contact') ? 'active' : '' ?>" href="/contact">Contact</a></li>
                </ul>

                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        </div>
    </header>