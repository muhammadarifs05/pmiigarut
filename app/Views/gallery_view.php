<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title portfolio-title-wrap">
                <span class="portfolio-badge-heading">Galeri PMII Garut</span>
                <h3><span><?= $about['about_name']; ?></span></h3>
                <p class="portfolio-lead">
                    Dokumentasi visual kegiatan, agenda kaderisasi, dan berbagai momen pergerakan
                    PMII Garut yang menjadi arsip perjalanan organisasi.
                </p>

                <div class="portfolio-summary">
                    <span><i class="bx bx-image-alt"></i><?= count($posts); ?> Dokumentasi</span>
                    <span><i class="bx bx-calendar-event"></i>Arsip Kegiatan & Publikasi</span>
                </div>
            </div>

            <?php if (!empty($posts)) : ?>
                <div class="row portfolio-grid">
                    <?php foreach ($posts as $index => $post) : ?>
                        <div class="col-lg-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="<?= 80 + (($index % 6) * 40); ?>">
                            <article class="portfolio-item filter-web">
                                <div class="portfolio-thumb">
                                    <img src="/assets/backend/images/post/<?= $post['post_image']; ?>" alt="<?= $post['post_title']; ?>">
                                    <span class="portfolio-tag">Dokumentasi</span>
                                    <div class="portfolio-overlay"></div>
                                </div>

                                <div class="portfolio-content">
                                    <div class="portfolio-meta">
                                        <span><i class="bx bx-calendar"></i><?= date('d M Y', strtotime($post['post_date'])); ?></span>
                                    </div>

                                    <h4><?= $post['post_title']; ?></h4>

                                    <div class="portfolio-actions">
                                        <a href="/assets/backend/images/post/<?= $post['post_image']; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?= $post['post_title']; ?>">
                                            <i class="bx bx-plus"></i>
                                            <span>Preview</span>
                                        </a>
                                        <a href="/post/<?= $post['post_slug']; ?>" class="details-link" title="More Details">
                                            <i class="bx bx-link-alt"></i>
                                            <span>Detail</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="portfolio-empty" data-aos="fade-up">
                    <div class="portfolio-empty-icon">
                        <i class="bx bx-image"></i>
                    </div>
                    <h4>Galeri Belum Tersedia</h4>
                    <p>Dokumentasi kegiatan akan ditampilkan di sini setelah konten dipublikasikan.</p>
                </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<?= $this->endSection(); ?>