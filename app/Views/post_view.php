<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$aboutData   = $about ?? [];
$postsData   = $posts ?? [];
$recentPosts = $recent_posts ?? [];
$tagsData    = $tags ?? [];
$totalPosts  = $total_posts ?? count($postsData);

// Hanya tampilkan kategori News dan Opinion
$categories = array_values(array_filter($categories ?? [], static function ($cat) {
    $slug = strtolower(trim($cat['category_slug'] ?? $cat['category_name'] ?? ''));
    return in_array($slug, ['news', 'opinion'], true);
}));

$currentPage = isset($pager) ? $pager->getCurrentPage('posts') : 1;
$pageCount   = isset($pager) ? $pager->getPageCount('posts') : 1;
$totalItems  = isset($pager) ? $pager->getTotal('posts') : count($postsData);
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">

        <div class="relative w-full overflow-hidden">
            <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[850px] h-[340px] bg-gradient-to-b from-primary-container/10 via-surface-container/60 to-transparent blur-3xl pointer-events-none -z-10"></div>
            <div class="absolute top-40 right-10 w-96 h-96 bg-secondary-container/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

            <!-- Top Breadcrumb & Quick Route Indicator -->
            <div class="max-w-7xl mx-auto px-gutter pt-space-lg pb-space-xs">
                <div class="flex items-center justify-between flex-wrap gap-space-sm">
                    <nav aria-label="Breadcrumb" class="flex items-center gap-space-xs">
                        <a href="<?= base_url('/'); ?>" class="flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[16px]">home</span>
                            <span>Home</span>
                        </a>
                        <span class="text-outline-variant font-label-sm text-label-sm">/</span>
                        <span class="font-label-sm text-label-sm text-on-surface-variant">Category</span>
                        <span class="text-outline-variant font-label-sm text-label-sm">/</span>
                        <span class="font-label-sm text-label-sm text-primary font-bold">Semua Publikasi</span>
                    </nav>
                    <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container-high text-primary font-label-xs text-label-xs shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-secondary-container animate-pulse"></span>
                        <span>Arsip Lengkap &amp; Narasi Gerakan</span>
                    </div>
                </div>
            </div>

            <!-- Page Header Section -->
            <section class="max-w-7xl mx-auto px-gutter pt-space-md pb-space-xl text-center" data-aos="fade-up">
                <div class="flex flex-col items-center">
                    <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container-highest text-primary font-label-sm text-label-sm tracking-widest uppercase mb-space-sm shadow-sm">
                        <span class="material-symbols-outlined text-[16px]">newspaper</span>
                        <span>BERITA &amp; PUBLIKASI</span>
                    </div>

                    <h1 class="font-headline-xl text-3xl sm:text-headline-xl text-primary tracking-tight font-extrabold mb-space-xs">
                        <?= esc($aboutData['about_name'] ?? 'PC PMII Kab. Garut'); ?>
                    </h1>

                    <div class="flex items-center gap-1.5 my-space-xs">
                        <span class="h-1.5 w-12 rounded-full bg-primary-container"></span>
                        <span class="h-1.5 w-6 rounded-full bg-secondary-container"></span>
                    </div>

                    <p class="font-body-lg text-base sm:text-body-lg text-on-surface-variant max-w-3xl mx-auto mt-space-xs">
                        Informasi terbaru, agenda organisasi, opini, dan publikasi kegiatan PMII Garut yang terdokumentasi secara terstruktur.
                    </p>

                    <!-- Category Banner Indicator Box -->
                    <div class="mt-space-lg w-full max-w-2xl bg-surface-container-lowest rounded-2xl p-space-md shadow-sm flex flex-col sm:flex-row items-center justify-between gap-space-md text-left">
                        <div class="flex items-center gap-space-md">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                <span class="material-symbols-outlined text-[24px]">apps</span>
                            </div>
                            <div>
                                <span class="font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wider block">Kategori Berita</span>
                                <h2 class="font-headline-sm text-headline-sm text-primary font-bold m-0">Semua Publikasi &amp; Berita</h2>
                            </div>
                        </div>
                        <span class="text-right font-label-xs text-label-xs px-space-md py-space-xs rounded-full bg-surface-container text-on-surface-variant font-semibold">
                            Semua Kategori Aktif
                        </span>
                    </div>

                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs italic">
                        Kumpulan arsip berita, pernyataan sikap, opini kader, dan dokumentasi kegiatan PC PMII Garut terlengkap.
                    </p>
                </div>
            </section>

            <!-- Content Workspace: 12-Column Responsive Layout -->
            <section class="max-w-7xl mx-auto px-gutter pb-space-xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">

                    <!-- Main Column: News & Editorial Stream (8 cols) -->
                    <div class="lg:col-span-8 flex flex-col gap-space-lg">

                        <!-- Filter & View Bar Ribbon -->
                        <div class="bg-surface-container-lowest rounded-xl p-space-sm flex items-center justify-between flex-wrap gap-space-sm shadow-sm">
                            <div class="flex items-center gap-space-xs flex-wrap">
                                <a href="<?= base_url('/post'); ?>"
                                    class="px-space-md py-space-xs rounded-full font-label-md text-label-md bg-primary-container text-on-primary shadow-sm flex items-center gap-space-xs">
                                    <span class="material-symbols-outlined text-[16px]">apps</span>
                                    <span>Semua Publikasi</span>
                                </a>
                                <?php foreach ($categories as $cat) : ?>
                                    <a href="<?= base_url('/category/' . esc($cat['category_slug'])); ?>"
                                        class="px-space-md py-space-xs rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-all flex items-center gap-space-xs">
                                        <span class="material-symbols-outlined text-[16px]">feed</span>
                                        <span><?= esc($cat['category_name']); ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm">
                                <span>Menampilkan:</span>
                                <span class="font-bold text-primary"><?= count($postsData); ?> Publikasi</span>
                            </div>
                        </div>

                        <!-- Article Cards Grid -->
                        <?php if (! empty($postsData)) : ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-md">
                                <?php foreach ($postsData as $index => $post) : ?>
                                    <?php
                                    $postUrl   = base_url('/post/' . esc($post['post_slug']));
                                    $postImg   = base_url('assets/backend/images/post/' . esc($post['post_image']));
                                    $catLabel  = ! empty($post['category_name']) ? $post['category_name'] : 'Warta Berita';
                                    $rawBody   = strip_tags($post['post_contents'] ?? '');
                                    $excerpt   = mb_strlen($rawBody) > 105 ? mb_substr($rawBody, 0, 105) . '...' : ($rawBody ?: 'Dokumentasi berita dan publikasi resmi PC PMII Kabupaten Garut.');
                                    ?>
                                    <article class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group"
                                        data-aos="fade-up"
                                        data-aos-delay="<?= 60 + (($index % 6) * 40); ?>">
                                        <div class="relative w-full h-48 overflow-hidden bg-surface-container">
                                            <img src="<?= $postImg; ?>"
                                                alt="<?= esc($post['post_title']); ?>"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            <div class="absolute inset-0 bg-gradient-to-t from-on-surface/60 via-transparent to-black/20 pointer-events-none"></div>
                                            <div class="absolute top-space-sm left-space-sm">
                                                <span class="px-space-sm py-space-xs rounded-full bg-surface-container-lowest/90 backdrop-blur-md text-primary font-label-xs text-label-xs shadow-sm font-bold flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-[13px] text-secondary-container">article</span>
                                                    <?= esc($catLabel); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-space-md flex-1 flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center gap-space-sm text-on-surface-variant font-label-xs text-label-xs mb-space-sm">
                                                    <span class="flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-[15px] text-primary">calendar_month</span>
                                                        <?= date('d M Y', strtotime($post['post_date'])); ?>
                                                    </span>
                                                    <span class="text-outline-variant">•</span>
                                                    <span class="flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-[15px] text-primary">visibility</span>
                                                        <?= (int) ($post['post_views'] ?? 0); ?> views
                                                    </span>
                                                </div>

                                                <h3 class="font-title-sm text-title-sm text-on-surface group-hover:text-primary transition-colors line-clamp-3 leading-snug mb-space-sm font-bold">
                                                    <a href="<?= $postUrl; ?>" class="text-inherit hover:text-primary">
                                                        <?= esc($post['post_title']); ?>
                                                    </a>
                                                </h3>

                                                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 mb-space-md">
                                                    <?= esc($excerpt); ?>
                                                </p>
                                            </div>

                                            <div class="pt-space-xs">
                                                <a href="<?= $postUrl; ?>"
                                                    class="inline-flex items-center justify-between w-full px-space-md py-space-xs rounded-xl bg-surface-container-low text-primary hover:bg-primary hover:text-on-primary font-label-sm text-label-sm transition-all group/btn">
                                                    <span>Baca Selengkapnya</span>
                                                    <span class="material-symbols-outlined text-[16px] group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>

                            <!-- Pagination Indicator Bar -->
                            <div class="bg-surface-container-lowest rounded-2xl p-space-md flex flex-col sm:flex-row items-center justify-between gap-space-md shadow-sm">
                                <p class="font-body-sm text-body-sm text-on-surface-variant m-0">
                                    Halaman <?= $currentPage; ?> dari <?= max(1, $pageCount); ?> (Menampilkan <?= count($postsData); ?> dari total <?= $totalItems; ?> publikasi)
                                </p>
                                <?php if (isset($pager) && $pageCount > 1) : ?>
                                    <div class="flex items-center gap-space-xs">
                                        <?php if ($currentPage > 1) : ?>
                                            <a href="<?= $pager->getPageURI($currentPage - 1, 'posts'); ?>"
                                                class="w-9 h-9 rounded-lg bg-surface-container-low hover:bg-surface-container text-primary flex items-center justify-center transition-colors">
                                                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                                            </a>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                            <a href="<?= $pager->getPageURI($i, 'posts'); ?>"
                                                class="w-9 h-9 rounded-lg font-label-sm text-label-sm flex items-center justify-center transition-colors <?= $i === $currentPage ? 'bg-primary text-on-primary shadow-sm font-bold' : 'bg-surface-container-low text-on-surface hover:bg-surface-container'; ?>">
                                                <?= $i; ?>
                                            </a>
                                        <?php endfor; ?>

                                        <?php if ($currentPage < $pageCount) : ?>
                                            <a href="<?= $pager->getPageURI($currentPage + 1, 'posts'); ?>"
                                                class="w-9 h-9 rounded-lg bg-surface-container-low hover:bg-surface-container text-primary flex items-center justify-center transition-colors">
                                                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <div class="bg-surface-container-lowest rounded-2xl p-12 text-center shadow-sm">
                                <div class="w-16 h-16 rounded-2xl bg-surface-container-high text-primary flex items-center justify-center mx-auto mb-space-md">
                                    <span class="material-symbols-outlined text-[32px]">newspaper</span>
                                </div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold mb-space-xs">Belum Ada Berita</h3>
                                <p class="font-body-md text-body-md text-on-surface-variant m-0">
                                    Publikasi berita dan informasi terbaru PMII Garut akan ditampilkan di sini.
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sidebar / Widget Area (4 cols) -->
                    <aside class="lg:col-span-4 flex flex-col gap-space-lg">
                        <!-- Search Box -->
                        <div class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm">
                            <h3 class="font-title-sm text-title-sm text-primary mb-space-sm flex items-center gap-space-xs font-bold">
                                <span class="material-symbols-outlined text-[20px]">search</span>
                                <span>Cari Publikasi</span>
                            </h3>
                            <form action="<?= base_url('/search'); ?>" method="get" class="flex items-center rounded-xl overflow-hidden bg-surface-container-low">
                                <input type="text" name="search_query" required placeholder="Ketik judul atau topik berita..."
                                    class="w-full px-space-md py-2.5 bg-transparent font-body-sm text-body-sm text-on-surface placeholder:text-outline focus:outline-none border-0">
                                <button type="submit" aria-label="Cari"
                                    class="px-space-md py-2.5 bg-primary-container hover:bg-primary text-on-primary transition-colors flex items-center justify-center border-0 cursor-pointer">
                                    <span class="material-symbols-outlined text-[20px]">search</span>
                                </button>
                            </form>
                        </div>

                        <!-- Widget: Category Quick-Switch Navigator -->
                        <div class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm">
                            <div class="flex items-center justify-between mb-space-md">
                                <h3 class="font-title-sm text-title-sm text-primary flex items-center gap-space-xs font-bold m-0">
                                    <span class="material-symbols-outlined text-[20px] text-primary">tune</span>
                                    <span>Kanal Kategori</span>
                                </h3>
                                <span class="px-space-xs py-0.5 rounded-full bg-surface-container font-label-xs text-label-xs text-on-surface-variant">Navigasi Cepat</span>
                            </div>
                            <div class="flex flex-col gap-space-xs font-body-sm text-body-sm">
                                <a href="<?= base_url('/post'); ?>"
                                    class="flex items-center justify-between p-space-sm rounded-xl bg-primary/10 text-primary transition-colors group font-semibold">
                                    <div class="flex items-center gap-space-sm">
                                        <span class="material-symbols-outlined text-[18px] text-primary">apps</span>
                                        <span>All Post (Semua Berita)</span>
                                    </div>
                                    <span class="text-xs px-2 py-0.5 rounded-full bg-primary text-on-primary font-semibold"><?= $totalPosts; ?></span>
                                </a>
                                <?php foreach ($categories as $cat) : ?>
                                    <a href="<?= base_url('/category/' . esc($cat['category_slug'])); ?>"
                                        class="flex items-center justify-between p-space-sm rounded-xl hover:bg-surface-container transition-colors group">
                                        <div class="flex items-center gap-space-sm text-on-surface">
                                            <span class="material-symbols-outlined text-[18px] text-on-surface-variant group-hover:text-primary transition-colors">feed</span>
                                            <span class="group-hover:text-primary font-medium"><?= esc($cat['category_name']); ?></span>
                                        </div>
                                        <span class="text-xs px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface font-semibold"><?= (int) ($cat['post_count'] ?? 0); ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Widget: Recent & Trending Posts -->
                        <?php if (! empty($recentPosts)) : ?>
                            <div class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm">
                                <h3 class="font-title-sm text-title-sm text-primary mb-space-md flex items-center gap-space-xs font-bold">
                                    <span class="material-symbols-outlined text-[20px] text-secondary-container">local_fire_department</span>
                                    <span>Publikasi Terbaru</span>
                                </h3>
                                <div class="flex flex-col gap-space-md">
                                    <?php foreach ($recentPosts as $rec) : ?>
                                        <a href="<?= base_url('/post/' . esc($rec['post_slug'])); ?>" class="flex gap-space-sm group">
                                            <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 bg-surface-container">
                                                <img src="<?= base_url('assets/backend/images/post/' . esc($rec['post_image'])); ?>"
                                                    alt="<?= esc($rec['post_title']); ?>"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            </div>
                                            <div class="flex flex-col justify-center">
                                                <span class="font-label-xs text-label-xs text-on-surface-variant">
                                                    <?= date('d M Y', strtotime($rec['post_date'])); ?> • <?= (int) ($rec['post_views'] ?? 0); ?> views
                                                </span>
                                                <h4 class="font-title-sm text-title-sm text-on-surface group-hover:text-primary transition-colors line-clamp-2 leading-snug font-semibold m-0">
                                                    <?= esc($rec['post_title']); ?>
                                                </h4>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Widget: Popular Topics & Tags -->
                        <?php if (! empty($tagsData)) : ?>
                            <div class="bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm">
                                <h3 class="font-title-sm text-title-sm text-primary mb-space-md flex items-center gap-space-xs font-bold">
                                    <span class="material-symbols-outlined text-[20px] text-primary">sell</span>
                                    <span>Topik Populer</span>
                                </h3>
                                <div class="flex flex-wrap gap-space-xs">
                                    <?php foreach ($tagsData as $tg) : ?>
                                        <a href="<?= base_url('/tag/' . esc($tg['tag_name'])); ?>"
                                            class="px-space-sm py-1 rounded-full bg-surface-container text-primary hover:bg-primary hover:text-on-primary font-label-xs text-label-xs transition-colors">
                                            #<?= esc($tg['tag_name']); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Widget: Interactive Cadre Contribution Banner -->
                        <div class="rounded-2xl p-space-lg bg-primary text-on-primary shadow-md flex flex-col gap-space-sm relative overflow-hidden">
                            <div class="w-28 h-28 rounded-full bg-secondary-container/20 absolute -right-6 -bottom-6 blur-xl pointer-events-none"></div>
                            <span class="inline-flex items-center gap-1.5 text-secondary-fixed font-label-xs text-label-xs uppercase font-bold tracking-wider">
                                <span class="material-symbols-outlined text-[16px]">verified</span>
                                Sistem Informasi Kaderisasi
                            </span>
                            <h4 class="font-headline-sm text-headline-sm text-on-primary leading-snug font-bold m-0">
                                Ingin Mengirimkan Tulisan Opini atau Warta Komisariat?
                            </h4>
                            <p class="font-body-sm text-body-sm text-primary-fixed leading-relaxed m-0">
                                Redaksi Media PC PMII Kabupaten Garut menerima tulisan kader dari seluruh komisariat dan rayon se-Garut.
                            </p>
                            <div class="pt-space-xs">
                                <a href="<?= base_url('/contact'); ?>"
                                    class="inline-flex items-center gap-2 px-space-md py-2 bg-secondary-container hover:bg-secondary-fixed text-on-secondary-container font-label-sm text-label-sm rounded-full transition-all shadow-sm font-bold">
                                    <span>Kirim Tulisan</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </aside>

                </div>
            </section>
        </div>

    </div>
</main>

<?= $this->endSection(); ?>