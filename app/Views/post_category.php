<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$aboutData    = $about ?? [];
$postsData    = $posts ?? [];
$categories   = array_values(array_filter($categories ?? [], static function ($cat) {
    $slug = strtolower(trim($cat['category_slug'] ?? $cat['category_name'] ?? ''));
    return in_array($slug, ['news', 'opinion'], true);
}));
$recentPosts  = $recent_posts ?? [];
$tagsData     = $tags ?? [];
$totalPosts   = $total_posts ?? 0;
$cleanKeyword = ucwords(str_replace(['category:', '-'], ['', ' '], trim($keyword ?? 'Kategori')));
$activeSlug   = $category_slug ?? '';
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">
        <div class="relative w-full overflow-hidden">
            <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[850px] h-[340px] bg-gradient-to-b from-primary-container/10 via-surface-container/60 to-transparent blur-3xl pointer-events-none -z-10"></div>

            <!-- Top Breadcrumb -->
            <div class="max-w-7xl mx-auto px-gutter pt-space-lg pb-space-xs">
                <div class="flex items-center justify-between flex-wrap gap-space-sm">
                    <nav aria-label="Breadcrumb" class="flex items-center gap-space-xs">
                        <a href="<?= base_url('/'); ?>" class="flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[16px]">home</span>
                            <span>Home</span>
                        </a>
                        <span class="text-outline-variant font-label-sm text-label-sm">/</span>
                        <a href="<?= base_url('/post'); ?>" class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors">News</a>
                        <span class="text-outline-variant font-label-sm text-label-sm">/</span>
                        <span class="font-label-sm text-label-sm text-primary font-bold"><?= esc($cleanKeyword); ?></span>
                    </nav>
                    <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container-high text-primary font-label-xs text-label-xs shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-secondary-container animate-pulse"></span>
                        <span>Kanal Kategori Aktif</span>
                    </div>
                </div>
            </div>

            <!-- Page Header Section -->
            <section class="max-w-7xl mx-auto px-gutter pt-space-md pb-space-xl text-center" data-aos="fade-up">
                <div class="flex flex-col items-center">
                    <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container-highest text-primary font-label-sm text-label-sm tracking-widest uppercase mb-space-sm shadow-sm">
                        <span class="material-symbols-outlined text-[16px]">folder_open</span>
                        <span>KATEGORI BERITA</span>
                    </div>

                    <h1 class="font-headline-xl text-3xl sm:text-headline-xl text-primary tracking-tight font-extrabold mb-space-xs">
                        <?= esc($cleanKeyword); ?>
                    </h1>

                    <div class="flex items-center gap-1.5 my-space-xs">
                        <span class="h-1.5 w-12 rounded-full bg-primary-container"></span>
                        <span class="h-1.5 w-6 rounded-full bg-secondary-container"></span>
                    </div>

                    <p class="font-body-lg text-base sm:text-body-lg text-on-surface-variant max-w-2xl mx-auto mt-space-xs">
                        Kumpulan arsip berita dan publikasi <?= esc($aboutData['about_name'] ?? 'PC PMII Kab. Garut'); ?> dalam kategori <strong><?= esc($cleanKeyword); ?></strong>.
                    </p>
                </div>
            </section>

            <!-- Content Workspace -->
            <section class="max-w-7xl mx-auto px-gutter pb-space-xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">

                    <!-- Main Column (8 cols) -->
                    <div class="lg:col-span-8 flex flex-col gap-space-lg">
                        <!-- Filter Ribbon -->
                        <div class="bg-surface-container-lowest rounded-xl p-space-sm flex items-center justify-between flex-wrap gap-space-sm shadow-sm">
                            <div class="flex items-center gap-space-xs flex-wrap">
                                <a href="<?= base_url('/post'); ?>"
                                    class="px-space-md py-space-xs rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-all flex items-center gap-space-xs">
                                    <span class="material-symbols-outlined text-[16px]">apps</span>
                                    <span>Semua Publikasi</span>
                                </a>
                                <?php foreach ($categories as $cat) : ?>
                                    <?php $isAct = ($cat['category_slug'] === $activeSlug); ?>
                                    <a href="<?= base_url('/category/' . esc($cat['category_slug'])); ?>"
                                        class="px-space-md py-space-xs rounded-full font-label-md text-label-md transition-all flex items-center gap-space-xs <?= $isAct ? 'bg-primary-container text-on-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container'; ?>">
                                        <span class="material-symbols-outlined text-[16px]">feed</span>
                                        <span><?= esc($cat['category_name']); ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm">
                                <span>Ditemukan:</span>
                                <span class="font-bold text-primary"><?= count($postsData); ?> Publikasi</span>
                            </div>
                        </div>

                        <?php if (! empty($postsData)) : ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-md">
                                <?php foreach ($postsData as $index => $row) : ?>
                                    <?php
                                    $postUrl = base_url('/post/' . esc($row['post_slug']));
                                    $postImg = base_url('assets/backend/images/post/' . esc($row['post_image']));
                                    $rawBody = strip_tags($row['post_contents'] ?? '');
                                    $excerpt = mb_strlen($rawBody) > 105 ? mb_substr($rawBody, 0, 105) . '...' : ($rawBody ?: 'Dokumentasi publikasi kategori ' . $cleanKeyword . '.');
                                    ?>
                                    <article class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group"
                                        data-aos="fade-up" data-aos-delay="<?= 60 + (($index % 6) * 40); ?>">
                                        <div class="relative w-full h-48 overflow-hidden bg-surface-container">
                                            <img src="<?= $postImg; ?>" alt="<?= esc($row['post_title']); ?>"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            <div class="absolute inset-0 bg-gradient-to-t from-on-surface/60 via-transparent to-black/20 pointer-events-none"></div>
                                            <div class="absolute top-space-sm left-space-sm">
                                                <span class="px-space-sm py-space-xs rounded-full bg-surface-container-lowest/90 backdrop-blur-md text-primary font-label-xs text-label-xs shadow-sm font-bold flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-[13px] text-secondary-container">folder</span>
                                                    <?= esc($cleanKeyword); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-space-md flex-1 flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center gap-space-sm text-on-surface-variant font-label-xs text-label-xs mb-space-sm">
                                                    <span class="flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-[15px] text-primary">calendar_month</span>
                                                        <?= date('d M Y', strtotime($row['post_date'])); ?>
                                                    </span>
                                                    <span class="text-outline-variant">•</span>
                                                    <span class="flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-[15px] text-primary">visibility</span>
                                                        <?= (int) ($row['post_views'] ?? 0); ?> views
                                                    </span>
                                                </div>

                                                <h3 class="font-title-sm text-title-sm text-on-surface group-hover:text-primary transition-colors line-clamp-3 leading-snug mb-space-sm font-bold">
                                                    <a href="<?= $postUrl; ?>" class="text-inherit hover:text-primary"><?= esc($row['post_title']); ?></a>
                                                </h3>

                                                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 mb-space-md"><?= esc($excerpt); ?></p>
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
                        <?php else : ?>
                            <div class="bg-surface-container-lowest rounded-2xl p-12 text-center shadow-sm">
                                <div class="w-16 h-16 rounded-2xl bg-surface-container-high text-primary flex items-center justify-center mx-auto mb-space-md">
                                    <span class="material-symbols-outlined text-[32px]">folder_off</span>
                                </div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold mb-space-xs">Belum Ada Postingan</h3>
                                <p class="font-body-md text-body-md text-on-surface-variant m-0">
                                    Belum ada berita yang tersedia dalam kategori <strong><?= esc($cleanKeyword); ?></strong>.
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sidebar (4 cols) -->
                    <aside class="lg:col-span-4 flex flex-col gap-space-lg">
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
                                    class="flex items-center justify-between p-space-sm rounded-xl hover:bg-surface-container transition-colors group">
                                    <div class="flex items-center gap-space-sm text-on-surface">
                                        <span class="material-symbols-outlined text-[18px] text-on-surface-variant group-hover:text-primary">apps</span>
                                        <span class="group-hover:text-primary font-medium">All Post (Semua Berita)</span>
                                    </div>
                                    <span class="text-xs px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface font-semibold"><?= $totalPosts; ?></span>
                                </a>
                                <?php foreach ($categories as $cat) : ?>
                                    <?php $isAct = ($cat['category_slug'] === $activeSlug); ?>
                                    <a href="<?= base_url('/category/' . esc($cat['category_slug'])); ?>"
                                        class="flex items-center justify-between p-space-sm rounded-xl transition-colors group <?= $isAct ? 'bg-primary/10 text-primary font-semibold' : 'hover:bg-surface-container'; ?>">
                                        <div class="flex items-center gap-space-sm <?= $isAct ? 'text-primary' : 'text-on-surface'; ?>">
                                            <span class="material-symbols-outlined text-[18px] <?= $isAct ? 'text-primary' : 'text-on-surface-variant group-hover:text-primary'; ?>">feed</span>
                                            <span class="group-hover:text-primary"><?= esc($cat['category_name']); ?></span>
                                        </div>
                                        <span class="text-xs px-2 py-0.5 rounded-full font-semibold <?= $isAct ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface'; ?>">
                                            <?= (int) ($cat['post_count'] ?? 0); ?>
                                        </span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

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
                    </aside>

                </div>
            </section>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>