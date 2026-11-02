<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$keywordValue = $keyword ?? '';
$postsData = $posts ?? [];
$cleanKeyword = trim($keywordValue);
?>


<main id="main" data-aos="fade-up">

    <?= $this->include('layout/breadcrumbs'); ?>

    <section id="recent-blog-posts" class="recent-blog-posts">
        <div class="container" data-aos="fade-up">

            <div class="section-title news-title-wrap">
                <span class="news-kicker">Hasil Pencarian</span>
                <h3><span><?= esc($cleanKeyword); ?></span></h3>
                <p>
                    Hasil pencarian berita dan publikasi PMII Garut untuk kata kunci
                    <strong>"<?= esc($cleanKeyword); ?>"</strong>.
                </p>
            </div>

            <?php if (!empty($posts)) : ?>
                <div class="row news-grid">
                    <?php foreach ($posts as $index => $row) : ?>
                        <div class="col-lg-4 col-md-6 d-flex mb-4" data-aos="fade-up" data-aos-delay="<?= 80 + (($index % 6) * 40); ?>">
                            <article class="post-box">
                                <div class="post-img">
                                    <img src="/assets/backend/images/post/<?= $row['post_image']; ?>" class="img-fluid" alt="<?= esc($row['post_title']); ?>">
                                    <span class="post-badge">Search</span>
                                    <div class="post-image-overlay"></div>
                                </div>

                                <div class="post-content">
                                    <div class="post-meta">
                                        <span><i class="bi bi-calendar-event"></i><?= date('d M Y', strtotime($row['post_date'])); ?></span>
                                        <span><i class="bi bi-eye"></i><?= $row['post_views']; ?> views</span>
                                    </div>

                                    <h3 class="post-title">
                                        <a href="/post/<?= $row['post_slug']; ?>"><?= esc($row['post_title']); ?></a>
                                    </h3>

                                    <div class="post-footer">
                                        <a href="/post/<?= $row['post_slug']; ?>" class="readmore">
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
                <div class="news-empty">
                    <div class="news-empty-icon">
                        <i class="bx bx-search-alt"></i>
                    </div>
                    <h4>Hasil Tidak Ditemukan</h4>
                    <p>Tidak ada berita yang cocok dengan kata kunci <strong>"<?= esc($cleanKeyword); ?>"</strong>.</p>
                </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<?= $this->endSection(); ?>