<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <?= $this->include('layout/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            <img src="/assets/backend/images/post/<?= $post['post_image']; ?>" alt="" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <a href="#"><?= $post['post_title']; ?></a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><a href="/author/<?= $post['post_user_id']; ?>" class="text-primary"><i class="bi bi-person"></i> <?= $post['user_name']; ?></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="2020-01-01"><?= date('d M Y', strtotime($post['post_date'])); ?></time>
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-eye"></i><?= $post['post_views']; ?> views</li>
                                <li class="d-flex align-items-center"><a href="#footerblog" class="text-primary"><i class="bi bi-chat-dots"></i> <?= $post['comment_total']; ?> comment</a></li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <?= $post['post_contents']; ?>
                        </div>

                        <div class="entry-footer" id="footerblog">
                            <i class="bi bi-folder"></i>
                            <ul class="cats">
                                <li><a href="/category/<?= $post['category_slug']; ?>">
                                        <?= $post['category_slug']; ?>
                                    </a>
                                </li>
                            </ul>

                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <?php
                                foreach ($post_tags as $tag) : ?>
                                    <a href="/tag/<?= $tag; ?>"><?= $tag; ?></a> &vert;
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </article><!-- End blog entry -->

                    <!-- Commentar -->
                    <!-- -->
                    <!-- End Commentar -->

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <!-- ======= Sidebar ======= -->
                    <?= $this->include('layout/sidebar'); ?>
                    <!-- End Sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>