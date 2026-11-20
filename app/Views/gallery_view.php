<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$aboutData = $about ?? [];
$postsData = $posts ?? [];
$totalDocs = count($postsData);

// Kumpulkan kategori unik secara dinamis jika tersedia di data post
$categories = [];
foreach ($postsData as $item) {
    if (! empty($item['category_name'])) {
        $slugCat = url_title($item['category_name'], '-', true);
        $categories[$slugCat] = $item['category_name'];
    }
}
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">

        <!-- ======= Dynamic Gradient Ambient Header Canvas ======= -->
        <section class="relative w-full overflow-hidden bg-gradient-to-b from-surface-container-high/40 via-surface to-surface pt-space-xl pb-space-lg">
            <!-- Fluid background glow accents -->
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[820px] h-[340px] bg-primary/10 rounded-full blur-[100px] pointer-events-none -z-10"></div>
            <div class="absolute top-16 right-10 w-72 h-72 bg-secondary-container/15 rounded-full blur-[80px] pointer-events-none -z-10"></div>

            <div class="max-w-7xl mx-auto px-gutter text-center flex flex-col items-center" data-aos="fade-up">
                <!-- Section Pill Tag -->
                <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-primary-fixed/60 text-primary mb-space-md shadow-sm">
                    <span class="material-symbols-outlined text-[16px]">collections_bookmark</span>
                    <span class="font-label-sm text-label-sm uppercase tracking-wider font-semibold">GALERI PMII GARUT</span>
                </div>

                <!-- Main Headline -->
                <h1 class="font-headline-xl text-3xl sm:text-headline-xl text-primary tracking-tight font-extrabold max-w-3xl">
                    <?= esc($aboutData['about_name'] ?? 'PC PMII Kab. Garut'); ?>
                </h1>
                <div class="w-20 h-1.5 bg-secondary-container rounded-full mt-space-sm mb-space-md"></div>

                <!-- Subtitle Description -->
                <p class="font-body-lg text-base sm:text-body-lg text-on-surface-variant max-w-2xl text-center leading-relaxed">
                    Dokumentasi visual kegiatan, agenda kaderisasi, dan berbagai momen pergerakan PMII Garut yang menjadi arsip perjalanan organisasi.
                </p>

                <!-- Metadata Badges / Info Ribbon -->
                <div class="mt-space-lg flex flex-wrap items-center justify-center gap-space-sm">
                    <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container-lowest text-on-surface shadow-sm">
                        <span class="material-symbols-outlined text-primary text-[18px]">photo_library</span>
                        <span class="font-label-md text-label-md font-semibold"><?= $totalDocs; ?> Dokumentasi</span>
                    </div>
                    <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container-lowest text-on-surface shadow-sm">
                        <span class="material-symbols-outlined text-secondary text-[18px]">calendar_month</span>
                        <span class="font-label-md text-label-md font-semibold">Arsip Kegiatan &amp; Publikasi</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= Gallery Grid Section ======= -->
        <section class="max-w-7xl w-full mx-auto px-gutter pb-space-xl pt-space-sm">
            <?php if (! empty($postsData)) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-lg" id="galleryGrid">
                    <?php foreach ($postsData as $index => $post) : ?>
                        <?php
                        $imgUrl     = base_url('assets/backend/images/post/' . esc($post['post_image']));
                        $detailUrl  = base_url('/post/' . esc($post['post_slug']));
                        $dateText   = date('d M Y', strtotime($post['post_date']));
                        $catName    = ! empty($post['category_name']) ? $post['category_name'] : 'Dokumentasi';
                        $catSlug    = ! empty($post['category_name']) ? url_title($post['category_name'], '-', true) : 'dokumentasi';
                        $rawContent = strip_tags($post['post_contents'] ?? '');
                        $excerpt    = mb_strlen($rawContent) > 220 ? mb_substr($rawContent, 0, 220) . '...' : ($rawContent ?: 'Dokumentasi visual kegiatan resmi PC PMII Kabupaten Garut.');
                        ?>

                        <article class="gallery-item group flex flex-col bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300"
                            data-category="<?= esc($catSlug); ?>"
                            data-aos="zoom-in"
                            data-aos-delay="<?= 60 + (($index % 6) * 40); ?>">

                            <!-- Visual Container with Badge -->
                            <div class="relative w-full h-64 overflow-hidden bg-surface-container">
                                <img src="<?= $imgUrl; ?>"
                                    alt="<?= esc($post['post_title']); ?>"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                                <div class="absolute inset-0 bg-gradient-to-t from-primary-container/40 via-transparent to-transparent opacity-60 pointer-events-none"></div>

                                <!-- Badge overlay -->
                                <div class="absolute top-4 left-4 z-10">
                                    <span class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md text-primary font-label-xs text-label-xs shadow-sm">
                                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                        <?= esc($catName); ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Content Body -->
                            <div class="p-space-lg flex flex-col flex-1 justify-between bg-surface-container-lowest">
                                <div class="flex flex-col gap-space-xs">
                                    <!-- Date marker -->
                                    <div class="flex items-center gap-space-xs text-on-surface-variant">
                                        <span class="material-symbols-outlined text-[18px] text-primary">calendar_today</span>
                                        <span class="font-body-sm text-body-sm font-medium"><?= esc($dateText); ?></span>
                                    </div>

                                    <!-- Title -->
                                    <h2 class="font-title-md text-title-md text-on-surface font-bold line-clamp-2 mt-space-xs group-hover:text-primary transition-colors">
                                        <a href="<?= $detailUrl; ?>" class="text-inherit hover:text-primary">
                                            <?= esc($post['post_title']); ?>
                                        </a>
                                    </h2>
                                </div>

                                <!-- Dual Action Buttons -->
                                <div class="pt-space-md mt-space-md flex flex-col gap-space-xs">
                                    <button type="button"
                                        class="btn-preview-gallery w-full py-2.5 px-space-md rounded-xl bg-surface-container-low hover:bg-surface-container-high text-primary font-label-md text-label-md flex items-center justify-center gap-space-xs transition-colors shadow-sm border-0 cursor-pointer"
                                        data-title="<?= esc($post['post_title'], 'attr'); ?>"
                                        data-date="<?= esc($dateText, 'attr'); ?>"
                                        data-img="<?= esc($imgUrl, 'attr'); ?>"
                                        data-url="<?= esc($detailUrl, 'attr'); ?>"
                                        data-desc="<?= esc($excerpt, 'attr'); ?>">
                                        <span class="material-symbols-outlined text-[18px]">add</span>
                                        <span>Preview</span>
                                    </button>

                                    <a href="<?= $detailUrl; ?>"
                                        class="w-full py-2.5 px-space-md rounded-xl bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md flex items-center justify-center gap-space-xs transition-all shadow-sm">
                                        <span class="material-symbols-outlined text-[18px]">link</span>
                                        <span>Detail</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <!-- Empty State -->
                <div class="bg-surface-container-lowest rounded-2xl p-12 text-center shadow-sm max-w-lg mx-auto" data-aos="fade-up">
                    <div class="w-16 h-16 rounded-2xl bg-surface-container-high text-primary flex items-center justify-center mx-auto mb-space-md">
                        <span class="material-symbols-outlined text-[32px]">image_not_supported</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold mb-space-xs">Galeri Belum Tersedia</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant m-0">
                        Dokumentasi kegiatan akan ditampilkan di sini setelah konten dipublikasikan.
                    </p>
                </div>
            <?php endif; ?>

            <!-- Editorial Archive Footnote Card -->
            <div class="mt-space-xl p-space-lg rounded-2xl bg-surface-container flex flex-col sm:flex-row items-center justify-between gap-space-md" data-aos="fade-up">
                <div class="flex items-center gap-space-md">
                    <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">folder_special</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="font-title-sm text-title-sm text-on-surface font-bold m-0">Pusat Dokumentasi &amp; Kearsipan Cabang</h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant m-0">
                            Membutuhkan file resolusi tinggi untuk publikasi media atau pers kampus? Hubungi Biro Media PC PMII Garut.
                        </p>
                    </div>
                </div>
                <a href="<?= base_url('/contact'); ?>"
                    class="shrink-0 px-space-md py-2.5 bg-surface-container-lowest text-primary hover:bg-primary hover:text-on-primary rounded-full font-label-md text-label-md transition-all duration-200 shadow-sm flex items-center gap-space-xs">
                    <span class="material-symbols-outlined text-[18px]">mail</span>
                    <span>Hubungi Biro Media</span>
                </a>
            </div>
        </section>

        <!-- ======= Interactive Quick Preview Modal Window ======= -->
        <div id="previewModal"
            class="fixed inset-0 z-50 hidden items-center justify-center p-gutter bg-inverse-surface/60 backdrop-blur-sm transition-opacity duration-300">
            <div id="modalCard"
                class="bg-surface-container-lowest rounded-2xl max-w-2xl w-full overflow-hidden shadow-2xl transform transition-all duration-300 scale-95">

                <!-- Modal Header -->
                <div class="flex items-center justify-between px-space-lg py-space-md bg-surface-container-low">
                    <div class="flex items-center gap-space-xs">
                        <span class="material-symbols-outlined text-primary text-[20px]">visibility</span>
                        <span class="font-title-sm text-title-sm text-primary font-bold">Preview Arsip Visual</span>
                    </div>
                    <button type="button" onclick="closeModal()" aria-label="Tutup preview"
                        class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors border-0 cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-space-lg flex flex-col gap-space-md">
                    <div class="w-full h-64 sm:h-72 rounded-xl overflow-hidden relative bg-surface-container">
                        <img id="modalImg" src="" alt="Modal Preview" class="w-full h-full object-cover">
                    </div>

                    <div class="flex flex-col gap-space-xs">
                        <div class="flex items-center gap-space-md text-on-surface-variant">
                            <span class="inline-flex items-center gap-1 font-body-sm text-body-sm text-primary font-medium">
                                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                <span id="modalDate">-</span>
                            </span>
                            <span class="inline-flex items-center gap-1 font-body-sm text-body-sm">
                                <span class="material-symbols-outlined text-[16px]">pin_drop</span>
                                <span>PC PMII Kabupaten Garut</span>
                            </span>
                        </div>

                        <h3 id="modalTitle" class="font-headline-sm text-headline-sm text-on-surface font-bold mt-space-xs m-0">
                            Dokumentasi Kegiatan PC PMII Garut
                        </h3>

                        <p id="modalDesc" class="font-body-md text-body-md text-on-surface-variant mt-space-xs leading-relaxed m-0">
                            Dokumentasi visual kegiatan resmi PC PMII Kab. Garut.
                        </p>
                    </div>

                    <div class="flex items-center justify-end gap-space-sm pt-space-sm">
                        <button type="button" onclick="closeModal()"
                            class="px-space-md py-2 rounded-xl bg-surface-container text-on-surface font-label-md text-label-md hover:bg-surface-container-high transition-colors border-0 cursor-pointer">
                            Tutup
                        </button>
                        <a id="modalDetailLink" href="#"
                            class="px-space-md py-2 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-all shadow-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                            <span>Buka Berita Lengkap</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    function filterGallery(category, clickedBtn) {
        const buttons = document.querySelectorAll('.gallery-filter-btn');
        buttons.forEach(btn => {
            btn.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-sm');
            btn.classList.add('text-on-surface-variant', 'bg-transparent');
        });

        clickedBtn.classList.remove('text-on-surface-variant', 'bg-transparent');
        clickedBtn.classList.add('bg-primary-container', 'text-on-primary', 'shadow-sm');

        const items = document.querySelectorAll('.gallery-item');
        items.forEach(item => {
            if (category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function openPreviewModal(btn) {
        document.getElementById('modalTitle').textContent = btn.getAttribute('data-title');
        document.getElementById('modalDate').textContent = btn.getAttribute('data-date');
        document.getElementById('modalDesc').textContent = btn.getAttribute('data-desc');
        document.getElementById('modalImg').src = btn.getAttribute('data-img');
        document.getElementById('modalDetailLink').href = btn.getAttribute('data-url');

        const modal = document.getElementById('previewModal');
        const modalCard = document.getElementById('modalCard');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modalCard.classList.remove('scale-95');
            modalCard.classList.add('scale-100');
        }, 20);
    }

    function closeModal() {
        const modal = document.getElementById('previewModal');
        const modalCard = document.getElementById('modalCard');
        modalCard.classList.remove('scale-100');
        modalCard.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 150);
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-preview-gallery').forEach(btn => {
            btn.addEventListener('click', function() {
                openPreviewModal(this);
            });
        });

        const modal = document.getElementById('previewModal');
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    });
</script>

<?= $this->endSection(); ?>