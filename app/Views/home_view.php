<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$homeData = $home ?? [];
$aboutData = $about ?? [];
$postsData = $posts ?? [];
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center"
    style="background-image: url('/assets/frontend/img/<?= esc($homeData['home_bg_heading'] ?? ''); ?>');">

    <div class="container" data-aos="zoom-out" data-aos-delay="100">

        <p class="hero-badge" data-aos="fade-up">OFFICIAL WEBSITE</p>

        <h1 class="hero-title" data-aos="fade-up">
            PERGERAKAN MAHASISWA ISLAM INDONESIA
        </h1>

        <h2 class="hero-subtitle" data-aos="fade-up">
            <b>Pengurus Cabang Kabupaten Garut</b>
        </h2>

        <div class="hero-divider" data-aos="fade-up"></div>

        <p class="hero-tagline" data-aos="fade-up">
            <i>"Akselerasi PMII Garut sebagai Aktor Perubahan dan Peradaban"</i>
        </p>

        <div class="hero-buttons d-flex">
            <a href="#featured-services" class="btn-get-started scrollto">
                Get Started
            </a>

            <a href="<?= esc($homeData['home_video'] ?? '#'); ?>" class="glightbox btn-watch-video">
                <i class="bi bi-play-circle"></i>
                <span>Watch Video</span>
            </a>
        </div>

    </div>
</section>

<main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services public-featured-services">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <span class="about-badge">Layanan Publik</span>
                <p>Temukan daftar komisariat aktif dan layanan permohonan SK Pengurus Komisariat secara mudah dan terstruktur.</p>
            </div>

            <div class="row public-service-grid justify-content-center">
                <div class="col-lg-6 col-md-6 d-flex align-items-stretch">
                    <div class="icon-box public-service-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="public-service-top">
                            <div class="icon"><i class="bx bx-building-house"></i></div>
                            <span class="service-kind">Informasi Publik</span>
                        </div>

                        <h4 class="title">Daftar Komisariat</h4>
                        <p class="description">
                            Lihat daftar komisariat aktif PMII Garut beserta kampus atau fakultas dan nama ketuanya sebagai informasi publik.
                        </p>

                        <div class="service-actions">
                            <a href="/komisariat" class="service-link">
                                Lihat Daftar
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 d-flex align-items-stretch">
                    <div class="icon-box public-service-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="public-service-top">
                            <div class="icon"><i class="bx bx-file-find"></i></div>
                            <span class="service-kind">Layanan Pengajuan</span>
                        </div>

                        <h4 class="title">Permohonan SK Pengurus Komisariat</h4>
                        <p class="description">
                            Ajukan permohonan SK Pengurus Komisariat secara online dengan melengkapi seluruh dokumen persyaratan yang dibutuhkan.
                        </p>

                        <div class="service-actions">
                            <a href="/permohonan-sk" class="service-link">
                                Ajukan Sekarang
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Featured Services Section -->

    <!-- ======= About Section ======= -->
    <section id="featured-services" class="featured-services">
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <span class="about-badge">Tentang Kami</span>
                    <!-- <h2>About</h2> -->
                    <h3><span><?= esc($aboutData['about_name'] ?? ''); ?></span></h3>
                </div>

                <div class="row align-items-center about-wrapper">
                    <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
                        <div class="about-side-stack">
                            <div class="about-media">
                                <img src="/assets/frontend/img/<?= esc($aboutData['about_image'] ?? ''); ?>" class="img-fluid" alt="<?= esc($aboutData['about_name'] ?? ''); ?>">
                            </div>

                            <div class="grand-design-card" data-aos="fade-up" data-aos-delay="180">
                                <span class="section-kicker">Grand Design</span>
                                <h4>Grand Design PMII Garut 2025-2026</h4>
                                <p>
                                    Akselerasi Rumah Perjuangan Mahasiswa. Akselerasi PMII Garut sebagai rumah perjuangan mahasiswa
                                    untuk mencetak aktor perubahan dan peradaban berlandaskan Tujuan dan Usaha PMII serta mewujudkan
                                    <i>Role Based Activist Movement</i> untuk menghasilkan karya kebermanfaatan.
                                </p>

                                <div class="grand-design-tags">
                                    <span>Aktor Perubahan Dan Peradaban</span>
                                    <span>Tujuan &amp; Usaha PMII</span>
                                    <span>Role Based Activist Movement</span>
                                    <span>Karya Kebermanfaatan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="150">
                        <div class="vision-box">
                            <span class="section-kicker">VISI</span>
                            <p>
                                <b>Akselerasi PMII Garut sebagai Aktor Perubahan dan Peradaban</b>
                            </p>
                        </div>

                        <div class="mission-box">
                            <span class="section-kicker">MISI</span>
                            <ul class="mission-list">
                                <li>
                                    <i class="bx bx-shield"></i>
                                    <div>
                                        <h5>Revitalisasi Manajemen Organisasi</h5>
                                        <p>Revitalisasi manajemen organisasi yang partisipatif, agile, modern, dan sesuai dengan landasan dan konstitusi PMII.</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bx bx-key"></i>
                                    <div>
                                        <h5>Re-Design Kaderisasi</h5>
                                        <p>Menciptakan gaya baru kaderisasi sebagai upaya terbentuknya corak kader PMII Garut yang mampu berdaya saing.</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bx bx-laptop"></i>
                                    <div>
                                        <h5>Optimalisasi Student Need and Interest Kader</h5>
                                        <p>Meningkatkan dan merawat karakter kader yang berbudi luhur, berilmu, cakap, dan bertanggung jawab terhadap ilmunya melalui penguatan akademis dan organisatoris.</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bx bx-user-plus"></i>
                                    <div>
                                        <h5>Role-Based Activist Movement</h5>
                                        <p>Menjadikan PMII Cabang Garut sebagai gerakan aktivis berbasis peran yang menghasilkan karya dan pergerakan untuk kebermanfaatan masyarakat.</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bx bx-abacus"></i>
                                    <div>
                                        <h5>Episentrum Intelektual Organisatoris</h5>
                                        <p>Memastikan kiprah PMII Garut sebagai episentrum intelektual organisatoris yang berlandaskan Keislaman dan Keindonesiaan.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- End About Section -->

    <!-- ======= News Section (From Post) ======= -->
    <section id="news" class="news-section">
        <div class="container" data-aos="fade-up">

            <div class="section-title news-section-title">
                <span class="about-badge">Berita Terbaru</span>
            </div>

            <div class="news-wrapper">
                <?php foreach (array_slice($postsData, 0, 3) as $post) : ?>
                    <div class="news-card">

                        <div class="news-img">
                            <img src="/assets/backend/images/post/<?= $post['post_image']; ?>"
                                alt="<?= esc($post['post_title']); ?>">
                        </div>

                        <div class="news-content">
                            <span class="news-date">
                                <?= date('d M Y', strtotime($post['post_date'])); ?>
                                | <?= $post['post_views']; ?> views
                            </span>

                            <h3>
                                <a href="/post/<?= $post['post_slug']; ?>">
                                    <?= esc($post['post_title']); ?>
                                </a>
                            </h3>

                            <a href="/post/<?= $post['post_slug']; ?>" class="read-more">
                                Baca Selengkapnya →
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

            <div class="news-action text-center">
                <a href="/post" class="btn-all-news">Lihat Semua Berita</a>
            </div>

        </div>
    </section>

</main><!-- End #main -->

<?= $this->endSection(); ?>