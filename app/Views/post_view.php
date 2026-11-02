<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <section id="recent-blog-posts" class="recent-blog-posts">
        <div class="container" data-aos="fade-up">
            <div class="section-title news-title-wrap">
                <span class="news-badge-heading">Berita & Publikasi</span>
                <h3><span><?= $about['about_name']; ?></span></h3>
                <p>
                    Informasi terbaru, agenda organisasi, opini, dan publikasi kegiatan
                    PMII Garut yang terdokumentasi secara terstruktur.
                </p>
            </div>

            <?php if (!empty($posts)) : ?>
                <div class="row news-grid">
                    <?php foreach ($posts as $index => $post) : ?>
                        <div class="col-lg-4 col-md-6 d-flex mb-4" data-aos="fade-up" data-aos-delay="<?= 80 + (($index % 6) * 40); ?>">
                            <article class="post-box">
                                <div class="post-img">
                                    <img src="/assets/backend/images/post/<?= $post['post_image']; ?>" class="img-fluid" alt="<?= $post['post_title']; ?>">
                                    <!-- <span class="post-badge">News Update</span> -->
                                    <div class="post-image-overlay"></div>
                                </div>

                                <div class="post-content">
                                    <div class="post-meta">
                                        <span>
                                            <i class="bi bi-calendar-event"></i>
                                            <?= date('d M Y', strtotime($post['post_date'])); ?>
                                        </span>
                                        <span>
                                            <i class="bi bi-eye"></i>
                                            <?= $post['post_views']; ?> views
                                        </span>
                                    </div>

                                    <h3 class="post-title">
                                        <a href="/post/<?= $post['post_slug']; ?>"><?= $post['post_title']; ?></a>
                                    </h3>

                                    <div class="post-footer">
                                        <a href="/post/<?= $post['post_slug']; ?>" class="readmore">
                                            <span>Baca Selengkapnya</span>
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="news-empty" data-aos="fade-up">
                    <div class="news-empty-icon">
                        <i class="bx bx-news"></i>
                    </div>
                    <h4>Belum Ada Berita</h4>
                    <p>Publikasi berita dan informasi terbaru PMII Garut akan ditampilkan di sini.</p>
                </div>
            <?php endif; ?>

            <div class="news-pagination-wrap">
                <?= $pager->links('posts', 'post_pagination') ?>
            </div>
        </div>
    </section>

</main>

<?= $this->endSection(); ?>