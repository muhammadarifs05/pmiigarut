<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$aboutData = $about ?? [];
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">

        <!-- Subtle Ambient Top Gradient for Architectural Layering -->
        <div class="relative w-full overflow-hidden bg-gradient-to-b from-surface-container-high/40 via-surface to-surface pb-space-xl">
            <!-- Decorative Ambient Glows -->
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[720px] h-[340px] bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-20 right-10 w-72 h-72 bg-secondary-container/15 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative max-w-7xl mx-auto px-gutter pt-space-xl">
                <!-- Title & Introductory Hero Block -->
                <div class="flex flex-col items-center text-center max-w-3xl mx-auto" data-aos="fade-up">
                    <!-- Pill Badge -->
                    <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs uppercase tracking-widest shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                        <span>DOKUMEN</span>
                    </div>

                    <!-- Main Title -->
                    <h1 class="mt-space-md font-headline-xl text-3xl sm:text-headline-xl text-primary tracking-tight font-extrabold">
                        <?= esc($aboutData['about_name'] ?? 'PC PMII Kab. Garut'); ?>
                    </h1>

                    <!-- Subtle Underline Accent Indicator -->
                    <div class="w-16 h-1 bg-secondary-container rounded-full mt-space-sm mb-space-md"></div>

                    <!-- Subtitle -->
                    <p class="font-body-lg text-base sm:text-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                        Halaman ini berisi dokumen-dokumen organisasi, materi, dan dokumen lain untuk menunjang kebutuhan administrasi, kaderisasi, dan penguatan keorganisasian.
                    </p>

                    <!-- Dynamic Quick Counter / Metric Bar -->
                    <div class="mt-space-xl grid grid-cols-3 gap-space-md w-full max-w-xl bg-surface-container-lowest/80 backdrop-blur-md p-space-sm rounded-xl shadow-sm">
                        <div class="flex flex-col items-center py-space-xs">
                            <span class="font-headline-md text-headline-md text-primary font-bold">6</span>
                            <span class="font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wider">Kategori Berkas</span>
                        </div>
                        <div class="flex flex-col items-center py-space-xs bg-surface-container-low/50 rounded-lg">
                            <span class="font-headline-md text-headline-md text-secondary font-bold">2025-2026</span>
                            <span class="font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wider">Masa Khidmat</span>
                        </div>
                        <div class="flex flex-col items-center py-space-xs">
                            <span class="font-headline-md text-headline-md text-primary font-bold">100%</span>
                            <span class="font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wider">Akses Terbuka</span>
                        </div>
                    </div>
                </div>

                <!-- Search & Quick Filter Bar -->
                <div class="mt-space-xl max-w-4xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-space-sm bg-surface-container-lowest p-space-xs rounded-xl shadow-md" data-aos="fade-up" data-aos-delay="80">
                    <div class="flex items-center gap-space-sm px-space-md w-full sm:w-auto flex-1">
                        <span class="material-symbols-outlined text-outline">search</span>
                        <input id="docSearch" type="text" placeholder="Cari arsip dokumen, peraturan, atau SK..."
                            class="w-full bg-transparent py-space-xs font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none border-0" />
                    </div>
                    <div class="flex items-center gap-space-xs w-full sm:w-auto justify-end px-space-xs pb-space-xs sm:pb-0 overflow-x-auto">
                        <button type="button" data-filter="all"
                            class="filter-btn px-space-md py-space-xs rounded-full font-label-sm text-label-sm bg-primary text-on-primary shadow-sm transition-all border-0 cursor-pointer">
                            Semua
                        </button>
                        <button type="button" data-filter="legal"
                            class="filter-btn px-space-md py-space-xs rounded-full font-label-sm text-label-sm bg-surface-container text-on-surface-variant hover:bg-surface-container-high transition-all border-0 cursor-pointer">
                            Legalitas
                        </button>
                        <button type="button" data-filter="konstitusi"
                            class="filter-btn px-space-md py-space-xs rounded-full font-label-sm text-label-sm bg-surface-container text-on-surface-variant hover:bg-surface-container-high transition-all border-0 cursor-pointer">
                            Konstitusi
                        </button>
                        <button type="button" data-filter="panduan"
                            class="filter-btn px-space-md py-space-xs rounded-full font-label-sm text-label-sm bg-surface-container text-on-surface-variant hover:bg-surface-container-high transition-all border-0 cursor-pointer">
                            Pedoman
                        </button>
                    </div>
                </div>

                <!-- Documents Bento Grid -->
                <div id="documentGrid" class="mt-space-xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-lg">

                    <!-- Card 1: Akta dan SK PMII -->
                    <article class="doc-card group relative flex flex-col justify-between bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden"
                        data-category="legal" data-aos="zoom-in" data-aos-delay="100">
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-primary to-primary-container"></div>
                        <div>
                            <div class="flex items-start justify-between gap-space-sm mb-space-md">
                                <div class="w-14 h-14 rounded-2xl bg-primary flex items-center justify-center text-on-primary shadow-md group-hover:scale-105 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                                </div>
                                <span class="inline-flex items-center px-space-md py-space-xs rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs uppercase tracking-wider">
                                    Legalitas
                                </span>
                            </div>
                            <h2 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-primary transition-colors font-bold m-0">
                                <a href="https://drive.google.com/file/d/19bcBLN-r4F7Ri_cWO2Htqdm_Z8hL6z_6/view?usp=sharing" target="_blank" rel="noopener noreferrer" class="text-inherit hover:text-primary">
                                    Akta dan SK PMII
                                </a>
                            </h2>
                            <p class="mt-space-sm font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                Dokumen resmi berupa akta dan SK Kemenkumham sebagai dasar hukum dalam pelaksanaan kegiatan PMII.
                            </p>
                        </div>
                        <div class="mt-space-lg pt-space-md flex items-center justify-between">
                            <span class="font-body-sm text-body-sm text-outline flex items-center gap-space-xs">
                                <span class="material-symbols-outlined text-[16px]">picture_as_pdf</span>
                                PDF • Kemenkumham
                            </span>
                            <a href="https://drive.google.com/file/d/19bcBLN-r4F7Ri_cWO2Htqdm_Z8hL6z_6/view?usp=sharing" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container text-primary font-label-md text-label-md hover:bg-primary hover:text-on-primary shadow-sm hover:shadow-md transition-all group-hover:bg-primary group-hover:text-on-primary">
                                <span>Buka Dokumen</span>
                                <span class="material-symbols-outlined text-[18px]">north_east</span>
                            </a>
                        </div>
                    </article>

                    <!-- Card 2: Hasil Musmpimnas PMII -->
                    <article class="doc-card group relative flex flex-col justify-between bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden"
                        data-category="konstitusi" data-aos="zoom-in" data-aos-delay="160">
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-secondary-container to-secondary-fixed"></div>
                        <div>
                            <div class="flex items-start justify-between gap-space-sm mb-space-md">
                                <div class="w-14 h-14 rounded-2xl bg-secondary-container flex items-center justify-center text-on-secondary-container shadow-md group-hover:scale-105 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">description</span>
                                </div>
                                <span class="inline-flex items-center px-space-md py-space-xs rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-xs text-label-xs uppercase tracking-wider">
                                    Kebijakan
                                </span>
                            </div>
                            <h2 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-secondary transition-colors font-bold m-0">
                                <a href="https://drive.google.com/file/d/1xUD3X9veew-Tc9Nv-6O7X_SzObrUp5Y2/view?usp=sharing" target="_blank" rel="noopener noreferrer" class="text-inherit hover:text-secondary">
                                    Hasil Musmpimnas PMII
                                </a>
                            </h2>
                            <p class="mt-space-sm font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                Dokumen resmi berupa keputusan dan rekomendasi Musyawarah Pimpinan Nasional PMII sebagai arah kebijakan organisasi.
                            </p>
                        </div>
                        <div class="mt-space-lg pt-space-md flex items-center justify-between">
                            <span class="font-body-sm text-body-sm text-outline flex items-center gap-space-xs">
                                <span class="material-symbols-outlined text-[16px]">picture_as_pdf</span>
                                PDF • Produk Nasional
                            </span>
                            <a href="https://drive.google.com/file/d/1xUD3X9veew-Tc9Nv-6O7X_SzObrUp5Y2/view?usp=sharing" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container text-primary font-label-md text-label-md hover:bg-secondary-container hover:text-on-secondary-container shadow-sm hover:shadow-md transition-all group-hover:bg-secondary-container group-hover:text-on-secondary-container">
                                <span>Buka Dokumen</span>
                                <span class="material-symbols-outlined text-[18px]">north_east</span>
                            </a>
                        </div>
                    </article>

                    <!-- Card 3: AD/ART PMII -->
                    <article class="doc-card group relative flex flex-col justify-between bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden"
                        data-category="konstitusi" data-aos="zoom-in" data-aos-delay="220">
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-tertiary to-tertiary-container"></div>
                        <div>
                            <div class="flex items-start justify-between gap-space-sm mb-space-md">
                                <div class="w-14 h-14 rounded-2xl bg-tertiary flex items-center justify-center text-on-tertiary shadow-md group-hover:scale-105 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                                </div>
                                <span class="inline-flex items-center px-space-md py-space-xs rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-xs text-label-xs uppercase tracking-wider">
                                    Konstitusi
                                </span>
                            </div>
                            <h2 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-primary transition-colors font-bold m-0">
                                <a href="https://drive.google.com/file/d/1o7fw_QV1JOTZZ0xY0fuUe3uj-lH_cbky/view?usp=sharing" target="_blank" rel="noopener noreferrer" class="text-inherit hover:text-primary">
                                    AD/ART PMII
                                </a>
                            </h2>
                            <p class="mt-space-sm font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                Dokumen resmi berupa produk hukum sebagai pedoman utama organisasi dalam menjalankan struktur dan mekanisme kaderisasi.
                            </p>
                        </div>
                        <div class="mt-space-lg pt-space-md flex items-center justify-between">
                            <span class="font-body-sm text-body-sm text-outline flex items-center gap-space-xs">
                                <span class="material-symbols-outlined text-[16px]">menu_book</span>
                                Konstitusi Resmi
                            </span>
                            <a href="https://drive.google.com/file/d/1o7fw_QV1JOTZZ0xY0fuUe3uj-lH_cbky/view?usp=sharing" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container text-primary font-label-md text-label-md hover:bg-tertiary hover:text-on-tertiary shadow-sm hover:shadow-md transition-all group-hover:bg-tertiary group-hover:text-on-tertiary">
                                <span>Buka Dokumen</span>
                                <span class="material-symbols-outlined text-[18px]">north_east</span>
                            </a>
                        </div>
                    </article>

                    <!-- Card 4: Grand Design PMII Garut -->
                    <article class="doc-card group relative flex flex-col justify-between bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden"
                        data-category="panduan" data-aos="zoom-in" data-aos-delay="100">
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-primary to-secondary-container"></div>
                        <div>
                            <div class="flex items-start justify-between gap-space-sm mb-space-md">
                                <div class="w-14 h-14 rounded-2xl bg-primary-container flex items-center justify-center text-on-primary shadow-md group-hover:scale-105 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">account_tree</span>
                                </div>
                                <span class="inline-flex items-center px-space-md py-space-xs rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs uppercase tracking-wider">
                                    Strategi
                                </span>
                            </div>
                            <h2 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-primary transition-colors font-bold m-0">
                                <a href="https://drive.google.com/file/d/1bTmTMXtSQKJHKEdMBmr-sT2W66yqT_F3/view?usp=sharing" target="_blank" rel="noopener noreferrer" class="text-inherit hover:text-primary">
                                    Grand Design PMII Garut
                                </a>
                            </h2>
                            <p class="mt-space-sm font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                Dokumen perencanaan strategis PMII Cabang Garut 2025-2026 sebagai arah pengembangan organisasi dan akselerasi PMII ke depan.
                            </p>
                        </div>
                        <div class="mt-space-lg pt-space-md flex items-center justify-between">
                            <span class="font-body-sm text-body-sm text-outline flex items-center gap-space-xs">
                                <span class="material-symbols-outlined text-[16px]">folder_zip</span>
                                Renstra • 2025–2026
                            </span>
                            <a href="https://drive.google.com/file/d/1bTmTMXtSQKJHKEdMBmr-sT2W66yqT_F3/view?usp=sharing" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container text-primary font-label-md text-label-md hover:bg-primary-container hover:text-on-primary shadow-sm hover:shadow-md transition-all group-hover:bg-primary-container group-hover:text-on-primary">
                                <span>Buka Dokumen</span>
                                <span class="material-symbols-outlined text-[18px]">north_east</span>
                            </a>
                        </div>
                    </article>

                    <!-- Card 5: Lagu Organisasi -->
                    <article class="doc-card group relative flex flex-col justify-between bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden"
                        data-category="panduan" data-aos="zoom-in" data-aos-delay="160">
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-secondary to-secondary-container"></div>
                        <div>
                            <div class="flex items-start justify-between gap-space-sm mb-space-md">
                                <div class="w-14 h-14 rounded-2xl bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">music_note</span>
                                </div>
                                <span class="inline-flex items-center px-space-md py-space-xs rounded-full bg-secondary-fixed-dim/40 text-on-secondary-fixed font-label-xs text-label-xs uppercase tracking-wider">
                                    Media Organisasi
                                </span>
                            </div>
                            <h2 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-secondary transition-colors font-bold m-0">
                                <a href="https://drive.google.com/drive/folders/1R3W5-n6w3170tU_AzjW87QAi523JFBiB" target="_blank" rel="noopener noreferrer" class="text-inherit hover:text-secondary">
                                    Lagu Organisasi
                                </a>
                            </h2>
                            <p class="mt-space-sm font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                Kumpulan file audio dan referensi lagu PMII sebagai identitas dan media penguatan nilai-nilai organisasi.
                            </p>
                        </div>
                        <div class="mt-space-lg pt-space-md flex items-center justify-between">
                            <span class="font-body-sm text-body-sm text-outline flex items-center gap-space-xs">
                                <span class="material-symbols-outlined text-[16px]">audio_file</span>
                                Audio • Mars &amp; Hymne
                            </span>
                            <a href="https://drive.google.com/drive/folders/1R3W5-n6w3170tU_AzjW87QAi523JFBiB" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container text-primary font-label-md text-label-md hover:bg-secondary hover:text-on-secondary shadow-sm hover:shadow-md transition-all group-hover:bg-secondary hover:text-on-secondary">
                                <span>Buka Dokumen</span>
                                <span class="material-symbols-outlined text-[18px]">north_east</span>
                            </a>
                        </div>
                    </article>

                    <!-- Card 6: Database Kader -->
                    <article class="doc-card group relative flex flex-col justify-between bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden"
                        data-category="legal" data-aos="zoom-in" data-aos-delay="220">
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-tertiary-container to-primary"></div>
                        <div>
                            <div class="flex items-start justify-between gap-space-sm mb-space-md">
                                <div class="w-14 h-14 rounded-2xl bg-surface-container-high text-primary flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">database</span>
                                </div>
                                <span class="inline-flex items-center px-space-md py-space-xs rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs uppercase tracking-wider">
                                    Basis Data
                                </span>
                            </div>
                            <h2 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-primary transition-colors font-bold m-0">
                                <a href="https://forms.gle/cuKerNKLNzAdLE3H6" target="_blank" rel="noopener noreferrer" class="text-inherit hover:text-primary">
                                    Database Kader
                                </a>
                            </h2>
                            <p class="mt-space-sm font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                Basis data kader PMII yang berisi informasi keanggotaan sebagai referensi pengelolaan dan pengembangan kader.
                            </p>
                        </div>
                        <div class="mt-space-lg pt-space-md flex items-center justify-between">
                            <span class="font-body-sm text-body-sm text-outline flex items-center gap-space-xs">
                                <span class="material-symbols-outlined text-[16px]">analytics</span>
                                Pusat Data Cabang
                            </span>
                            <a href="https://forms.gle/cuKerNKLNzAdLE3H6" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container text-primary font-label-md text-label-md hover:bg-primary hover:text-on-primary shadow-sm hover:shadow-md transition-all group-hover:bg-primary group-hover:text-on-primary">
                                <span>Buka Dokumen</span>
                                <span class="material-symbols-outlined text-[18px]">north_east</span>
                            </a>
                        </div>
                    </article>

                </div>

                <!-- Empty State Saat Hasil Filter/Pencarian Kosong -->
                <div id="docEmptyState" class="hidden mt-space-xl bg-surface-container-lowest rounded-2xl p-10 text-center shadow-sm">
                    <div class="w-14 h-14 rounded-2xl bg-surface-container-high text-primary flex items-center justify-center mx-auto mb-space-sm">
                        <span class="material-symbols-outlined text-[28px]">folder_off</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold mb-1">Dokumen Tidak Ditemukan</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant m-0">Tidak ada arsip dokumen yang sesuai dengan kata kunci atau kategori yang dipilih.</p>
                </div>

                <!-- Institutional Verification / Archive Assistance Callout Section -->
                <div class="mt-space-xl bg-surface-container-low rounded-2xl p-space-lg lg:p-space-xl flex flex-col md:flex-row items-center justify-between gap-space-lg shadow-sm" data-aos="fade-up">
                    <div class="flex items-center gap-space-md">
                        <div class="w-16 h-16 rounded-2xl bg-primary-container text-on-primary flex items-center justify-center shrink-0 shadow-md">
                            <span class="material-symbols-outlined text-[32px]">contact_support</span>
                        </div>
                        <div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold m-0">Butuh Salinan Khusus atau Validasi Berkas?</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant mt-1 m-0">
                                Biro Administrasi &amp; Kesekretariatan PC PMII Kab. Garut siap melayani permohonan surat pengesahan dan arsip historis.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-space-sm shrink-0 w-full md:w-auto">
                        <a href="<?= base_url('/contact'); ?>"
                            class="w-full md:w-auto inline-flex items-center justify-center gap-space-xs px-space-lg py-space-sm bg-primary text-on-primary rounded-full font-label-md text-label-md hover:bg-primary-container transition-all shadow-md">
                            <span class="material-symbols-outlined text-[20px]">mail</span>
                            <span>Hubungi Sekretariat</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('docSearch');
        const cards = document.querySelectorAll('.doc-card');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const emptyState = document.getElementById('docEmptyState');
        let currentFilter = 'all';

        function applyFilters() {
            const query = (searchInput?.value || '').toLowerCase().trim();
            let visibleCount = 0;

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                const category = card.getAttribute('data-category');
                const matchesQuery = text.includes(query);
                const matchesCategory = currentFilter === 'all' || category === currentFilter;

                if (matchesQuery && matchesCategory) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            if (emptyState) {
                emptyState.classList.toggle('hidden', visibleCount > 0);
            }
        }

        searchInput?.addEventListener('input', applyFilters);

        filterButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                filterButtons.forEach(b => {
                    b.classList.remove('bg-primary', 'text-on-primary', 'shadow-sm');
                    b.classList.add('bg-surface-container', 'text-on-surface-variant');
                });

                const target = e.currentTarget;
                target.classList.remove('bg-surface-container', 'text-on-surface-variant');
                target.classList.add('bg-primary', 'text-on-primary', 'shadow-sm');

                currentFilter = target.getAttribute('data-filter') || 'all';
                applyFilters();
            });
        });
    });
</script>

<?= $this->endSection(); ?>