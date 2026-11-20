<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<style>
    .article-body-content p {
        margin-top: 0;
        margin-bottom: 0.9rem;
        line-height: 1.75;
    }

    .article-body-content p:last-child {
        margin-bottom: 0;
    }

    .article-body-content p:empty {
        display: none;
    }
</style>

<?php
$postData    = $post ?? [];
$postTags    = $post_tags ?? [];
$relatedPost = $related_post ?? [];
$allTags     = $tags ?? [];
$comments    = $comments ?? [];
$prevPost    = $prev_post ?? null;
$nextPost    = $next_post ?? null;
$postImg     = base_url('assets/backend/images/post/' . esc($postData['post_image'] ?? ''));
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">

        <!-- Title & Breadcrumb Sub-Header Bar -->
        <section class="w-full bg-surface-container-low shadow-sm">
            <div class="max-w-7xl mx-auto px-gutter py-space-md flex flex-row items-center justify-between gap-space-sm">
                <div class="flex items-center gap-space-sm">
                    <div class="w-2 h-7 bg-primary rounded-full hidden sm:block"></div>
                    <h1 class="font-headline-md text-headline-md text-on-surface tracking-tight font-bold m-0">Post</h1>
                </div>
                <nav aria-label="Breadcrumb" class="flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface-variant">
                    <a href="<?= base_url('/'); ?>" class="hover:text-primary transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">home</span>
                        <span>Home</span>
                    </a>
                    <span class="text-outline-variant">/</span>
                    <a href="<?= base_url('/post'); ?>" class="hover:text-primary transition-colors">News</a>
                    <span class="text-outline-variant">/</span>
                    <span class="text-primary font-semibold">Detail</span>
                </nav>
            </div>
        </section>

        <!-- Main Content Layout (2-Column Grid) -->
        <section class="max-w-7xl mx-auto px-gutter py-space-xl w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">

                <!-- LEFT COLUMN: Main Post Content (8 Columns) -->
                <article class="lg:col-span-8 flex flex-col gap-space-lg">
                    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-md sm:p-space-xl flex flex-col gap-space-lg overflow-hidden">

                        <!-- Post Hero Featured Image -->
                        <div class="relative w-full rounded-xl overflow-hidden bg-surface-container-high group">
                            <img src="<?= $postImg; ?>"
                                alt="<?= esc($postData['post_title'] ?? ''); ?>"
                                class="w-full h-auto object-cover max-h-[580px] rounded-xl transform group-hover:scale-[1.01] transition-transform duration-500 ease-out">
                            <?php if (! empty($postData['category_name'])) : ?>
                                <div class="absolute top-4 left-4">
                                    <a href="<?= base_url('/category/' . esc($postData['category_slug'] ?? '')); ?>"
                                        class="inline-flex items-center gap-1 px-space-md py-space-xs rounded-full bg-primary-container/95 text-on-primary font-label-xs text-label-xs shadow-md backdrop-blur-md uppercase tracking-wide">
                                        <span class="material-symbols-outlined text-[14px]">stars</span>
                                        <?= esc($postData['category_name']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Article Title & Metadata -->
                        <div class="flex flex-col gap-space-sm">
                            <h2 class="font-headline-lg text-2xl sm:text-headline-lg text-primary leading-tight tracking-tight font-bold m-0">
                                <?= esc($postData['post_title'] ?? ''); ?>
                            </h2>

                            <!-- Metadata Info Bar -->
                            <div class="flex flex-wrap items-center gap-y-2 gap-x-space-md pt-space-xs text-on-surface-variant font-label-sm text-label-sm pb-space-sm bg-surface-container-low/60 p-space-sm rounded-xl">
                                <a href="<?= base_url('/author/' . esc($postData['post_user_id'] ?? '1')); ?>"
                                    class="flex items-center gap-1.5 text-primary hover:underline">
                                    <span class="material-symbols-outlined text-[18px]">person</span>
                                    <span class="font-medium"><?= esc($postData['user_name'] ?? 'Admin Redaksi'); ?></span>
                                </a>
                                <span class="text-outline-variant hidden sm:inline">•</span>
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                    <span><?= date('d M Y', strtotime($postData['post_date'] ?? 'now')); ?></span>
                                </div>
                                <span class="text-outline-variant hidden sm:inline">•</span>
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    <span><?= (int) ($postData['post_views'] ?? 0); ?> views</span>
                                </div>
                                <span class="text-outline-variant hidden sm:inline">•</span>
                                <a href="#commentSection" class="flex items-center gap-1.5 text-on-surface-variant hover:text-primary">
                                    <span class="material-symbols-outlined text-[18px]">chat_bubble_outline</span>
                                    <span><?= count($comments); ?> comment</span>
                                </a>
                            </div>
                        </div>

                        <!-- Article Body HTML from Database -->
                        <div class="article-body-content prose max-w-none text-on-surface font-body-md text-body-md text-justify">
                            <?= $postData['post_contents'] ?? ''; ?>
                        </div>

                        <!-- Post Footer: Category & Tags -->
                        <div class="pt-space-md flex flex-col sm:flex-row items-start sm:items-center justify-between gap-space-md bg-surface-container-low/50 p-space-md rounded-xl">
                            <div class="flex flex-wrap items-center gap-space-xs">
                                <a href="<?= base_url('/category/' . esc($postData['category_slug'] ?? '')); ?>"
                                    class="inline-flex items-center gap-1 px-space-sm py-1 rounded-full bg-primary text-on-primary font-label-xs text-label-xs uppercase font-bold tracking-wider">
                                    <span class="material-symbols-outlined text-[14px]">folder</span>
                                    <?= esc($postData['category_slug'] ?? 'news'); ?>
                                </a>

                                <?php if (! empty($postTags)) : ?>
                                    <div class="flex flex-wrap items-center gap-1.5 pl-1 text-on-surface-variant font-label-sm text-label-sm">
                                        <span class="material-symbols-outlined text-[16px] text-primary">sell</span>
                                        <?php foreach ($postTags as $idx => $tag) : ?>
                                            <a href="<?= base_url('/tag/' . esc($tag)); ?>" class="hover:text-primary transition-colors">
                                                <?= esc($tag); ?>
                                            </a>
                                            <?php if ($idx < count($postTags) - 1) : ?>
                                                <span class="text-outline-variant">|</span>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Social Share Buttons -->
                            <div class="flex items-center gap-space-xs">
                                <span class="font-label-xs text-label-xs text-on-surface-variant font-semibold uppercase mr-1">Bagikan:</span>
                                <a href="https://api.whatsapp.com/send?text=<?= urlencode(($postData['post_title'] ?? '') . ' - ' . current_url()); ?>"
                                    target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke WhatsApp"
                                    class="w-9 h-9 rounded-full bg-surface-container-highest text-primary flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-[18px]">share</span>
                                </a>
                                <button type="button" aria-label="Salin Tautan"
                                    onclick="navigator.clipboard?.writeText(window.location.href); alert('Tautan berita berhasil disalin!');"
                                    class="w-9 h-9 rounded-full bg-surface-container-highest text-primary flex items-center justify-center hover:bg-secondary-container hover:text-on-secondary-container transition-all shadow-sm border-0 cursor-pointer">
                                    <span class="material-symbols-outlined text-[18px]">link</span>
                                </button>
                            </div>
                        </div>

                        <!-- Previous & Next Article Navigation -->
                        <?php if ($prevPost || $nextPost) : ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md pt-space-xs">
                                <?php if ($prevPost) : ?>
                                    <a href="<?= base_url('/post/' . esc($prevPost['post_slug'])); ?>"
                                        class="group p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all flex flex-col gap-1">
                                        <span class="flex items-center gap-1 font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wider group-hover:text-primary">
                                            <span class="material-symbols-outlined text-[16px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                                            Berita Sebelumnya
                                        </span>
                                        <span class="font-title-sm text-title-sm text-on-surface line-clamp-1 group-hover:text-primary transition-colors font-semibold">
                                            <?= esc($prevPost['post_title']); ?>
                                        </span>
                                    </a>
                                <?php else : ?>
                                    <div></div>
                                <?php endif; ?>

                                <?php if ($nextPost) : ?>
                                    <a href="<?= base_url('/post/' . esc($nextPost['post_slug'])); ?>"
                                        class="group p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all flex flex-col gap-1 sm:text-right">
                                        <span class="flex items-center sm:justify-end gap-1 font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wider group-hover:text-primary">
                                            Berita Selanjutnya
                                            <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                        </span>
                                        <span class="font-title-sm text-title-sm text-on-surface line-clamp-1 group-hover:text-primary transition-colors font-semibold">
                                            <?= esc($nextPost['post_title']); ?>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Comment & Discussion Section -->
                        <div id="commentSection" class="mt-space-md p-space-lg rounded-2xl bg-surface-container-low/40 flex flex-col gap-space-md">
                            <div class="flex items-center justify-between">
                                <h3 class="font-title-md text-title-md text-primary flex items-center gap-2 font-bold m-0">
                                    <span class="material-symbols-outlined text-secondary">mode_comment</span>
                                    <span>Tanggapan &amp; Diskusi Kader (<?= count($comments); ?>)</span>
                                </h3>
                            </div>

                            <?= session()->getFlashdata('msg'); ?>

                            <?php if (! empty($comments)) : ?>
                                <div class="flex flex-col gap-space-sm">
                                    <?php foreach ($comments as $com) : ?>
                                        <div class="p-space-md rounded-xl bg-surface-container-lowest shadow-xs flex flex-col gap-1">
                                            <div class="flex items-center justify-between">
                                                <span class="font-title-sm text-title-sm text-primary font-bold"><?= esc($com['comment_name']); ?></span>
                                                <span class="font-label-xs text-label-xs text-outline">
                                                    <?= isset($com['comment_date']) ? date('d M Y', strtotime($com['comment_date'])) : ''; ?>
                                                </span>
                                            </div>
                                            <p class="font-body-sm text-body-sm text-on-surface m-0"><?= esc($com['comment_message']); ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <p class="font-body-sm text-body-sm text-on-surface-variant m-0">
                                Kanal komentar terbuka untuk seluruh kader dan warga pergerakan. Sampaikan pandangan dan ucapan secara santun dan konstruktif.
                            </p>

                            <form action="<?= base_url('/post/send_comment'); ?>" method="post" class="flex flex-col gap-space-sm pt-space-xs">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="post_id" value="<?= esc($postData['post_id'] ?? ''); ?>">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm">
                                    <input type="text" name="name" required placeholder="Nama lengkap Anda..."
                                        class="px-space-md py-2.5 rounded-lg bg-surface-container-lowest text-on-surface font-body-sm text-body-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-container border-0">
                                    <input type="email" name="email" required placeholder="Alamat email aktif..."
                                        class="px-space-md py-2.5 rounded-lg bg-surface-container-lowest text-on-surface font-body-sm text-body-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-container border-0">
                                </div>
                                <div class="flex flex-col sm:flex-row gap-space-sm">
                                    <input type="text" name="message" required placeholder="Tuliskan apresiasi atau tanggapan pergerakan Anda..."
                                        class="flex-1 px-space-md py-2.5 rounded-lg bg-surface-container-lowest text-on-surface font-body-sm text-body-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-container border-0">
                                    <button type="submit"
                                        class="px-space-lg py-2.5 bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md rounded-lg shadow-sm transition-all flex items-center justify-center gap-2 border-0 cursor-pointer">
                                        <span>Kirim</span>
                                        <span class="material-symbols-outlined text-[18px]">send</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </article>

                <!-- RIGHT COLUMN: Sidebar (4 Columns) -->
                <aside class="lg:col-span-4 flex flex-col gap-space-lg sticky top-24">

                    <!-- Widget 1: Search Form -->
                    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[22px]">search</span>
                            <h3 class="font-title-md text-title-md text-on-surface tracking-tight font-bold m-0">Search</h3>
                        </div>
                        <form action="<?= base_url('/search'); ?>" method="get" class="flex items-center rounded-lg overflow-hidden shadow-sm bg-surface-container-low">
                            <input type="text" name="search_query" required placeholder="Search..."
                                class="w-full px-space-md py-2.5 bg-transparent font-body-sm text-body-sm text-on-surface placeholder:text-outline focus:outline-none border-0">
                            <button type="submit" aria-label="Cari Konten"
                                class="px-space-md py-2.5 bg-primary-container hover:bg-primary text-on-primary transition-colors flex items-center justify-center border-0 cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">search</span>
                            </button>
                        </form>
                    </div>

                    <!-- Widget 2: Related Posts -->
                    <?php if (! empty($relatedPost)) : ?>
                        <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                            <div class="flex items-center justify-between pb-space-xs">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-[22px]">dynamic_feed</span>
                                    <h3 class="font-title-md text-title-md text-on-surface tracking-tight font-bold m-0">Related Posts</h3>
                                </div>
                                <span class="w-8 h-1 bg-secondary-container rounded-full"></span>
                            </div>

                            <div class="flex flex-col gap-space-md">
                                <?php foreach ($relatedPost as $rel) : ?>
                                    <a href="<?= base_url('/post/' . esc($rel['post_slug'])); ?>"
                                        class="group flex items-start gap-space-sm p-space-xs rounded-xl hover:bg-surface-container-low transition-colors">
                                        <div class="w-20 h-16 rounded-lg overflow-hidden shrink-0 bg-surface-container-high shadow-xs">
                                            <img src="<?= base_url('assets/backend/images/post/' . esc($rel['post_image'])); ?>"
                                                alt="<?= esc($rel['post_title']); ?>"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                        <div class="flex flex-col gap-1 min-w-0">
                                            <h4 class="font-title-sm text-[14px] leading-snug text-primary group-hover:text-primary-container font-semibold line-clamp-2 transition-colors m-0">
                                                <?= esc($rel['post_title']); ?>
                                            </h4>
                                            <div class="flex items-center gap-1 font-body-sm text-body-sm text-outline">
                                                <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                                <span><?= date('d M Y', strtotime($rel['post_date'])); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Widget 3: Tags -->
                    <?php if (! empty($allTags)) : ?>
                        <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                            <div class="flex items-center justify-between pb-space-xs">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-[22px]">label</span>
                                    <h3 class="font-title-md text-title-md text-on-surface tracking-tight font-bold m-0">Tags</h3>
                                </div>
                                <span class="w-8 h-1 bg-secondary-container rounded-full"></span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($allTags as $tg) : ?>
                                    <a href="<?= base_url('/tag/' . esc($tg['tag_name'])); ?>"
                                        class="px-space-md py-1.5 rounded-lg bg-surface-container-low hover:bg-primary hover:text-on-primary text-primary font-label-sm text-label-sm transition-all duration-200 shadow-xs">
                                        <?= esc($tg['tag_name']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Extra Info Banner: Call to Action / Kaderisasi -->
                    <div class="rounded-2xl p-space-lg bg-gradient-to-br from-primary via-primary-container to-tertiary text-on-primary shadow-md flex flex-col gap-space-sm relative overflow-hidden">
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
</main>

<?= $this->endSection(); ?>