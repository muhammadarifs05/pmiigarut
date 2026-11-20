<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$homeData  = $home ?? [];
$aboutData = $about ?? [];
$postsData = $posts ?? [];

$heroBgFile = ! empty($homeData['home_bg_heading']) ? $homeData['home_bg_heading'] : 'hero-bg.jpg';
$heroBgUrl  = base_url('assets/frontend/img/' . $heroBgFile);
$videoUrl   = ! empty($homeData['home_video']) ? $homeData['home_video'] : '#';
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">

        <!-- ======= Hero Section (Full Layar Pertama) ======= -->
        <section class="relative w-full min-h-screen flex flex-col items-center justify-between overflow-hidden bg-primary -mt-20 pt-24 sm:pt-28 pb-6 text-on-primary">
            <!-- Ambient Background Image -->
            <div class="absolute inset-0 bg-cover bg-center opacity-55 pointer-events-none transition-transform duration-1000 ease-out"
                style="background-image: url('<?= esc($heroBgUrl); ?>');">
            </div>

            <!-- Multi-layered Scrim -->
            <div class="absolute inset-0 bg-gradient-to-b from-primary/80 via-primary/60 to-primary/95 pointer-events-none"></div>
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[800px] h-[450px] bg-secondary-container/20 rounded-full blur-[140px] pointer-events-none"></div>

            <!-- Main Hero Content (Auto Centered) -->
            <div class="relative z-10 my-auto max-w-5xl mx-auto px-gutter py-4 flex flex-col items-center text-center" data-aos="zoom-out" data-aos-delay="100">
                <!-- Eyebrow Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/60 border border-secondary-container/40 backdrop-blur-md mb-6 shadow-[0_4px_20px_rgba(0,0,0,0.2)]">
                    <!-- <span class="w-2 h-2 rounded-full bg-secondary-container animate-ping"></span> -->
                    <span class="font-label-xs text-label-xs text-secondary-fixed uppercase tracking-[0.2em] font-bold">
                        Official Portal &bull; Dzikir, Fikir &amp; Amal Sholeh
                    </span>
                </div>

                <!-- Main Headline (Dual-Tone Typography) -->
                <h1 class="font-headline-xl text-3xl sm:text-5xl lg:text-[62px] leading-[1.12] tracking-tight drop-shadow-[0_4px_16px_rgba(0,15,45,0.45)] font-extrabold">
                    <span class="block text-surface-container-lowest">PERGERAKAN MAHASISWA</span>
                    <span class="block mt-1 bg-gradient-to-r from-[#ffddb8] via-[#fea619] to-[#ffb95f] bg-clip-text text-transparent">
                        ISLAM INDONESIA
                    </span>
                </h1>

                <!-- Ornamental Subheading Lockup -->
                <div class="flex items-center justify-center gap-3 sm:gap-4 mt-5">
                    <span class="h-[1.5px] w-10 sm:w-20 bg-gradient-to-r from-transparent to-secondary-container"></span>
                    <p class="font-headline-md text-lg sm:text-2xl text-surface-container-lowest font-bold tracking-wide m-0 uppercase">
                        Pengurus Cabang Kabupaten Garut
                    </p>
                    <span class="h-[1.5px] w-10 sm:w-20 bg-gradient-to-l from-transparent to-secondary-container"></span>
                </div>

                <!-- Glassmorphic Tagline Box -->
                <div class="max-w-2xl mt-6 px-6 py-3.5 rounded-2xl bg-primary/45 border border-white/15 backdrop-blur-md shadow-[0_8px_32px_rgba(0,15,45,0.25)]">
                    <p class="font-title-sm text-sm sm:text-base italic text-tertiary-fixed font-medium m-0 leading-relaxed">
                        <span class="text-secondary-container font-serif text-xl not-italic mr-1">“</span>
                        Akselerasi PMII Garut sebagai
                        <span class="text-secondary-fixed font-semibold not-italic underline decoration-secondary-container/70 decoration-2 underline-offset-4">
                            Aktor Perubahan dan Peradaban
                        </span>
                        <span class="text-secondary-container font-serif text-xl not-italic ml-1">”</span>
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-4 mt-6 sm:mt-8">
                    <a href="#layanan-publik"
                        class="group inline-flex items-center justify-center gap-1.5 sm:gap-2 px-4 py-2 sm:px-7 sm:py-3 rounded-full bg-gradient-to-r from-secondary-container to-[#ffb95f] text-on-secondary-fixed font-label-md text-xs sm:text-label-md font-extrabold shadow-[0_8px_20px_rgba(254,166,25,0.35)] hover:brightness-105 transition-all hover:-translate-y-0.5 active:translate-y-0">
                        <span>Jelajahi Layanan</span>
                        <span class="material-symbols-outlined text-[16px] sm:text-[19px] transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </a>
                    <a href="<?= esc($videoUrl); ?>"
                        class="glightbox inline-flex items-center justify-center gap-1.5 sm:gap-2.5 px-4 py-2 sm:px-7 sm:py-3 rounded-full bg-white/10 border border-white/25 text-surface-container-lowest font-label-md text-xs sm:text-label-md font-semibold backdrop-blur-md hover:bg-white/20 transition-all hover:-translate-y-0.5 active:translate-y-0">
                        <span class="material-symbols-outlined text-[18px] sm:text-[22px] text-secondary-container" style="font-variation-settings: 'FILL' 1;">play_circle</span>
                        <span>Profil Video</span>
                    </a>
                </div>
            </div>

            <!-- Subtle Bottom Scroll Cue (Langsung tampil instan tanpa FOUT) -->
            <a href="#layanan-publik" aria-label="Gulir ke bawah"
                class="relative z-10 mt-6 flex flex-col items-center gap-1 text-primary-fixed/85 hover:text-secondary-fixed transition-colors no-underline">
                <span class="font-label-xs text-[10px] uppercase tracking-[0.2em]">Gulir</span>
                <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7l5 5 5-5M7 13l5 5 5-5" />
                </svg>
            </a>
        </section>

        <!-- ======= Layanan Publik Section ======= -->
        <section id="layanan-publik" class="scroll-mt-20 w-full py-16 bg-surface relative z-10">
            <div class="max-w-7xl mx-auto px-gutter" data-aos="fade-up">

                <!-- Section Header -->
                <div class="flex flex-col items-center text-center max-w-2xl mx-auto mb-space-xl">
                    <span class="inline-flex items-center px-space-md py-1 rounded-full bg-surface-container-highest text-primary-container font-label-xs text-label-xs uppercase tracking-wider mb-space-sm font-bold shadow-sm">
                        LAYANAN PUBLIK
                    </span>
                    <p class="font-body-md text-body-md text-on-surface-variant text-center mt-space-xs">
                        Temukan daftar komisariat aktif dan layanan permohonan administrasi kader secara mudah dan terstruktur.
                    </p>
                </div>

                <!-- 3 Service Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">

                    <!-- Card 1: Daftar Komisariat -->
                    <div class="group relative flex flex-col justify-between bg-surface-container-lowest rounded-2xl p-space-lg shadow-[0_4px_24px_rgba(19,27,46,0.06)] hover:shadow-[0_16px_36px_rgba(13,71,161,0.12)] transition-all duration-300 hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex flex-col">
                            <div class="flex items-center justify-between gap-space-sm mb-space-md">
                                <div class="w-12 h-12 rounded-xl bg-surface-container-high text-primary flex items-center justify-center transition-colors group-hover:bg-primary-container group-hover:text-on-primary">
                                    <span class="material-symbols-outlined text-[26px]">apartment</span>
                                </div>
                                <span class="inline-flex items-center px-space-sm py-1 rounded-full bg-surface-container text-primary-container font-label-xs text-label-xs font-semibold">
                                    Informasi Publik
                                </span>
                            </div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-space-xs font-bold group-hover:text-primary transition-colors">
                                Daftar Komisariat
                            </h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                Lihat daftar komisariat aktif PMII Garut beserta kampus atau fakultas dan nama ketuanya sebagai informasi publik.
                            </p>
                        </div>
                        <div class="pt-space-lg mt-space-sm">
                            <a class="inline-flex items-center gap-space-xs font-label-md text-label-md text-primary font-bold hover:text-primary-container transition-colors group-hover:translate-x-1" href="<?= base_url('/komisariat'); ?>">
                                <span>Lihat Daftar</span>
                                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                    <!-- Card 2: Permohonan SK -->
                    <div class="group relative flex flex-col justify-between bg-surface-container-lowest rounded-2xl p-space-lg shadow-[0_4px_24px_rgba(19,27,46,0.06)] hover:shadow-[0_16px_36px_rgba(13,71,161,0.12)] transition-all duration-300 hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex flex-col">
                            <div class="flex items-center justify-between gap-space-sm mb-space-md">
                                <div class="w-12 h-12 rounded-xl bg-surface-container-high text-primary flex items-center justify-center transition-colors group-hover:bg-primary-container group-hover:text-on-primary">
                                    <span class="material-symbols-outlined text-[26px]">assignment_turned_in</span>
                                </div>
                                <span class="inline-flex items-center px-space-sm py-1 rounded-full bg-secondary-fixed/50 text-on-secondary-container font-label-xs text-label-xs font-semibold">
                                    Layanan Pengajuan
                                </span>
                            </div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-space-xs font-bold group-hover:text-primary transition-colors">
                                Permohonan SK Pengurus Komisariat
                            </h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                Ajukan permohonan SK Pengurus Komisariat secara online dengan melengkapi seluruh dokumen persyaratan yang dibutuhkan.
                            </p>
                        </div>
                        <div class="pt-space-lg mt-space-sm">
                            <a class="inline-flex items-center gap-space-xs font-label-md text-label-md text-primary font-bold hover:text-primary-container transition-colors group-hover:translate-x-1" href="<?= base_url('/permohonan-sk'); ?>">
                                <span>Ajukan Sekarang</span>
                                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                    <!-- Card 3: Pengajuan KTA Digital -->
                    <div class="group relative flex flex-col justify-between bg-surface-container-lowest rounded-2xl p-space-lg shadow-[0_4px_24px_rgba(19,27,46,0.06)] hover:shadow-[0_16px_36px_rgba(13,71,161,0.12)] transition-all duration-300 hover:-translate-y-1" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex flex-col">
                            <div class="flex items-center justify-between gap-space-sm mb-space-md">
                                <div class="w-12 h-12 rounded-xl bg-surface-container-high text-primary flex items-center justify-center transition-colors group-hover:bg-primary-container group-hover:text-on-primary">
                                    <span class="material-symbols-outlined text-[26px]">badge</span>
                                </div>
                                <span class="inline-flex items-center px-space-sm py-1 rounded-full bg-secondary-fixed/50 text-on-secondary-container font-label-xs text-label-xs font-semibold">
                                    Layanan Pengajuan
                                </span>
                            </div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-space-xs font-bold group-hover:text-primary transition-colors">
                                Pengajuan KTA Digital
                            </h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                Ajukan pembuatan Kartu Tanda Anggota (KTA) PMII Cabang Garut secara online dengan melengkapi data diri yang valid.
                            </p>
                        </div>
                        <div class="pt-space-lg mt-space-sm">
                            <a class="inline-flex items-center gap-space-xs font-label-md text-label-md text-primary font-bold hover:text-primary-container transition-colors group-hover:translate-x-1" href="<?= base_url('/kta/pengajuan'); ?>">
                                <span>Ajukan Sekarang</span>
                                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ======= Tentang Kami (Organization Highlight Feature) ======= -->
        <section id="about" class="scroll-mt-24 relative w-full py-space-xl overflow-hidden bg-surface">
            <div class="relative w-full max-w-7xl mx-auto px-gutter" data-aos="fade-up">
                <div class="absolute -top-24 -left-20 w-96 h-96 rounded-full bg-primary-fixed/30 blur-3xl pointer-events-none"></div>
                <div class="absolute top-1/3 -right-24 w-80 h-80 rounded-full bg-secondary-fixed/40 blur-3xl pointer-events-none"></div>

                <!-- Header Section: Badge, Title & Dual Accent -->
                <div class="flex flex-col items-center text-center space-y-space-sm mb-space-xl relative z-10">
                    <div class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-primary-container/10 text-primary">
                        <span class="w-2 h-2 rounded-full bg-secondary-container animate-pulse"></span>
                        <span class="font-label-sm text-label-sm tracking-wider uppercase font-semibold">TENTANG KAMI</span>
                    </div>
                    <h2 class="font-headline-xl text-3xl sm:text-headline-xl text-primary tracking-tight font-extrabold">
                        <?= esc($aboutData['about_name'] ?? 'PC PMII Kab. Garut'); ?>
                    </h2>
                    <!-- Dual-Tone Decorative Indicator -->
                    <div class="flex items-center justify-center gap-1.5 pt-space-xs">
                        <div class="h-1.5 w-16 rounded-full bg-primary"></div>
                        <div class="h-1.5 w-6 rounded-full bg-secondary-container"></div>
                        <div class="h-1.5 w-2 rounded-full bg-secondary-fixed-dim"></div>
                    </div>
                    <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl pt-space-xs">
                        Manifesto ideologi, arah juang, dan peta transformasi gerakan intelektual mahasiswa Kabupaten Garut.
                    </p>
                </div>

                <!-- Main 12-Column Responsive Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start relative z-10">

                    <!-- LEFT COLUMN (5 Cols): Branding Emblem & Grand Design Card -->
                    <div class="lg:col-span-5 flex flex-col gap-space-lg" data-aos="fade-right" data-aos-delay="100">

                        <!-- Akselerasi PMII Graphic Identity Card -->
                        <div class="group relative rounded-2xl bg-surface-container-lowest p-space-xl shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden flex flex-col items-center justify-center min-h-[380px] text-center">
                            <div class="absolute inset-0 bg-gradient-to-br from-primary-fixed/20 via-transparent to-secondary-fixed/15 opacity-80 pointer-events-none"></div>
                            <div class="absolute -right-6 -bottom-6 w-36 h-36 rounded-full bg-surface-container-low flex items-center justify-center opacity-60 text-primary-fixed">
                                <span class="material-symbols-outlined text-[96px] select-none">bolt</span>
                            </div>

                            <div class="relative z-10 flex flex-col items-center w-full transform group-hover:scale-[1.02] transition-transform duration-300">
                                <?php if (! empty($aboutData['about_image']) && is_file(FCPATH . 'assets/frontend/img/' . $aboutData['about_image'])) : ?>
                                    <img src="<?= base_url('assets/frontend/img/' . esc($aboutData['about_image'])); ?>"
                                        alt="<?= esc($aboutData['about_name'] ?? 'Akselerasi PMII'); ?>"
                                        class="max-h-56 w-auto object-contain drop-shadow-md">
                                <?php else : ?>
                                    <div class="relative w-64 h-48 flex items-center justify-center">
                                        <svg class="w-full h-auto drop-shadow-md" fill="none" viewBox="0 0 340 240" xmlns="http://www.w3.org/2000/svg">
                                            <path class="transition-all duration-300 group-hover:opacity-95" d="M190 20L100 135H180L130 220L280 95H195L250 20H190Z" fill="url(#yellowGlowHome)"></path>
                                            <defs>
                                                <linearGradient gradientUnits="userSpaceOnUse" id="yellowGlowHome" x1="100" x2="280" y1="20" y2="220">
                                                    <stop stop-color="#FFC107"></stop>
                                                    <stop offset="0.6" stop-color="#FEA619"></stop>
                                                    <stop offset="1" stop-color="#F57C00"></stop>
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                        <div class="absolute inset-0 flex flex-col items-center justify-center pt-2">
                                            <span class="font-headline-lg text-headline-lg font-black tracking-tight text-primary drop-shadow-[0_2px_4px_rgba(255,255,255,0.8)]">AKSELERASI</span>
                                            <span class="font-headline-md text-headline-md font-extrabold tracking-widest text-secondary-container -mt-1 drop-shadow-sm">PMII</span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="mt-space-md inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-surface-container-high text-on-surface">
                                    <span class="material-symbols-outlined text-primary text-[18px]">workspace_premium</span>
                                    <span class="font-label-xs text-label-xs uppercase tracking-wider font-bold">Masa Khidmat 2025–2026</span>
                                </div>
                            </div>
                        </div>

                        <!-- Grand Design PMII Garut 2025-2026 Card -->
                        <article class="rounded-2xl bg-surface-container-lowest p-space-xl shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                            <div class="space-y-space-md">
                                <div class="flex items-center justify-between">
                                    <span class="font-label-xs text-label-xs text-primary uppercase font-bold tracking-widest px-space-sm py-1 bg-surface-container rounded-md">Grand Design</span>
                                    <span class="material-symbols-outlined text-secondary-container">auto_graph</span>
                                </div>
                                <h3 class="font-headline-sm text-headline-sm text-primary tracking-tight font-bold">Grand Design PMII Garut 2025–2026</h3>
                                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed text-justify">
                                    Akselerasi Rumah Perjuangan Mahasiswa. Akselerasi PMII Garut sebagai rumah perjuangan mahasiswa untuk mencetak aktor perubahan dan peradaban berlandaskan Tujuan dan Usaha PMII serta mewujudkan <em class="italic text-on-surface font-medium">Role Based Activist Movement</em> untuk menghasilkan karya kebermanfaatan.
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2 pt-space-lg">
                                <span class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-primary-fixed text-primary font-label-xs text-label-xs font-semibold hover:bg-primary hover:text-on-primary transition-colors cursor-default">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>Aktor Perubahan Dan Peradaban
                                </span>
                                <span class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-surface-container-high text-on-surface font-label-xs text-label-xs font-semibold hover:bg-primary-container hover:text-on-primary transition-colors cursor-default">
                                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>Tujuan &amp; Usaha PMII
                                </span>
                                <span class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-xs text-label-xs font-semibold hover:bg-secondary-container transition-colors cursor-default">
                                    <span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span>Role Based Activist Movement
                                </span>
                                <span class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-surface-container-highest text-primary-container font-label-xs text-label-xs font-semibold hover:bg-primary-container hover:text-on-primary transition-colors cursor-default">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary-container"></span>Karya Kebermanfaatan
                                </span>
                            </div>
                        </article>

                        <!-- Dynamic Organizational Metric -->
                        <a href="<?= base_url('/komisariat'); ?>" class="rounded-2xl bg-gradient-to-r from-primary to-primary-container text-on-primary p-space-lg shadow-md flex items-center justify-between hover:opacity-95 transition-opacity">
                            <div class="flex items-center gap-space-md">
                                <div class="w-12 h-12 rounded-xl bg-surface-container-lowest/15 flex items-center justify-center backdrop-blur-md">
                                    <span class="material-symbols-outlined text-[26px]">groups</span>
                                </div>
                                <div>
                                    <p class="font-label-xs text-label-xs text-on-primary-container uppercase tracking-wider m-0">Distribusi Kader Garut</p>
                                    <h4 class="font-headline-sm text-headline-sm font-bold text-on-primary m-0">7 Komisariat Aktif</h4>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-secondary-container text-[28px]">verified</span>
                        </a>

                    </div>

                    <!-- RIGHT COLUMN (7 Cols): VISI & MISI Showcase -->
                    <div class="lg:col-span-7 flex flex-col gap-space-lg" data-aos="fade-left" data-aos-delay="150">

                        <!-- VISI Section -->
                        <div class="rounded-2xl bg-surface-container-lowest p-space-xl shadow-sm relative overflow-hidden group">
                            <div class="absolute top-0 left-0 w-2 h-full bg-primary"></div>
                            <div class="flex items-center gap-space-xs mb-space-sm">
                                <span class="font-label-xs text-label-xs uppercase font-extrabold text-primary tracking-widest bg-primary-fixed/40 px-space-sm py-0.5 rounded">VISI</span>
                                <span class="h-px flex-1 bg-surface-container-high"></span>
                            </div>
                            <h3 class="font-headline-lg text-2xl sm:text-headline-lg text-primary tracking-tight font-extrabold leading-snug m-0">
                                Akselerasi PMII Garut sebagai Aktor Perubahan dan Peradaban
                            </h3>
                        </div>

                        <!-- MISI Section -->
                        <div class="rounded-2xl bg-surface-container-lowest p-space-xl shadow-sm flex flex-col gap-space-md">
                            <div class="flex items-center justify-between pb-space-xs">
                                <div class="flex items-center gap-space-xs">
                                    <span class="font-label-xs text-label-xs uppercase font-extrabold text-primary tracking-widest bg-primary-fixed/40 px-space-sm py-0.5 rounded">MISI</span>
                                    <span class="font-title-sm text-title-sm font-bold text-on-surface">5 Pijakan Transformasi</span>
                                </div>
                                <span class="font-label-xs text-label-xs text-on-surface-variant font-medium">Strategis &amp; Terukur</span>
                            </div>

                            <!-- Misi Cards Stack -->
                            <div class="flex flex-col gap-space-md">
                                <!-- Item 1 -->
                                <div class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all duration-200 flex items-start gap-space-md group">
                                    <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex-shrink-0 flex items-center justify-center shadow-sm group-hover:scale-105 group-hover:bg-primary transition-all">
                                        <span class="material-symbols-outlined text-[24px]">shield</span>
                                    </div>
                                    <div class="flex flex-col space-y-1">
                                        <div class="flex items-center gap-space-xs">
                                            <span class="font-label-xs text-label-xs font-bold text-secondary-container">01</span>
                                            <h4 class="font-title-sm text-title-sm text-primary font-bold m-0">Revitalisasi Manajemen Organisasi</h4>
                                        </div>
                                        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed m-0">
                                            Revitalisasi manajemen organisasi yang partisipatif, agile, modern, dan sesuai dengan landasan dan konstitusi PMII.
                                        </p>
                                    </div>
                                </div>

                                <!-- Item 2 -->
                                <div class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all duration-200 flex items-start gap-space-md group">
                                    <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex-shrink-0 flex items-center justify-center shadow-sm group-hover:scale-105 group-hover:bg-primary transition-all">
                                        <span class="material-symbols-outlined text-[24px]">key</span>
                                    </div>
                                    <div class="flex flex-col space-y-1">
                                        <div class="flex items-center gap-space-xs">
                                            <span class="font-label-xs text-label-xs font-bold text-secondary-container">02</span>
                                            <h4 class="font-title-sm text-title-sm text-primary font-bold m-0">Re-Design Kaderisasi</h4>
                                        </div>
                                        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed m-0">
                                            Menciptakan gaya baru kaderisasi sebagai upaya terbentuknya corak kader PMII Garut yang mampu berdaya saing.
                                        </p>
                                    </div>
                                </div>

                                <!-- Item 3 -->
                                <div class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all duration-200 flex items-start gap-space-md group">
                                    <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex-shrink-0 flex items-center justify-center shadow-sm group-hover:scale-105 group-hover:bg-primary transition-all">
                                        <span class="material-symbols-outlined text-[24px]">devices</span>
                                    </div>
                                    <div class="flex flex-col space-y-1">
                                        <div class="flex items-center gap-space-xs">
                                            <span class="font-label-xs text-label-xs font-bold text-secondary-container">03</span>
                                            <h4 class="font-title-sm text-title-sm text-primary font-bold m-0">Optimalisasi Student Need and Interest Kader</h4>
                                        </div>
                                        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed m-0">
                                            Meningkatkan dan merawat karakter kader yang berbudi luhur, berilmu, cakap, dan bertanggung jawab terhadap ilmunya melalui penguatan akademis dan organisatoris.
                                        </p>
                                    </div>
                                </div>

                                <!-- Item 4 -->
                                <div class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all duration-200 flex items-start gap-space-md group">
                                    <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex-shrink-0 flex items-center justify-center shadow-sm group-hover:scale-105 group-hover:bg-primary transition-all">
                                        <span class="material-symbols-outlined text-[24px]">person_add</span>
                                    </div>
                                    <div class="flex flex-col space-y-1">
                                        <div class="flex items-center gap-space-xs">
                                            <span class="font-label-xs text-label-xs font-bold text-secondary-container">04</span>
                                            <h4 class="font-title-sm text-title-sm text-primary font-bold m-0">Role-Based Activist Movement</h4>
                                        </div>
                                        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed m-0">
                                            Menjadikan PMII Cabang Garut sebagai gerakan aktivis berbasis peran yang menghasilkan karya dan pergerakan untuk kebermanfaatan masyarakat.
                                        </p>
                                    </div>
                                </div>

                                <!-- Item 5 -->
                                <div class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-all duration-200 flex items-start gap-space-md group">
                                    <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex-shrink-0 flex items-center justify-center shadow-sm group-hover:scale-105 group-hover:bg-primary transition-all">
                                        <span class="material-symbols-outlined text-[24px]">account_balance</span>
                                    </div>
                                    <div class="flex flex-col space-y-1">
                                        <div class="flex items-center gap-space-xs">
                                            <span class="font-label-xs text-label-xs font-bold text-secondary-container">05</span>
                                            <h4 class="font-title-sm text-title-sm text-primary font-bold m-0">Episentrum Intelektual Organisatoris</h4>
                                        </div>
                                        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed m-0">
                                            Memastikan kiprah PMII Garut sebagai episentrum intelektual organisatoris yang berlandaskan Keislaman dan Keindonesiaan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- ======= Berita Terbaru Section ======= -->
        <section id="news" class="w-full py-space-xl bg-surface">
            <div class="max-w-7xl mx-auto px-gutter" data-aos="fade-up">

                <!-- Section Header -->
                <div class="flex flex-col items-center text-center max-w-xl mx-auto mb-space-xl">
                    <span class="inline-flex items-center px-space-md py-1 rounded-full bg-surface-container-highest text-primary-container font-label-xs text-label-xs uppercase tracking-wider mb-space-sm font-bold shadow-sm">
                        BERITA TERBARU
                    </span>
                </div>

                <!-- 3 News Cards Grid (Dinamis dari $posts) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg mb-space-xl">
                    <?php foreach (array_slice($postsData, 0, 3) as $post) : ?>
                        <article class="flex flex-col bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(19,27,46,0.06)] hover:shadow-[0_16px_36px_rgba(13,71,161,0.1)] transition-all duration-300 hover:-translate-y-1">
                            <div class="relative w-full h-52 overflow-hidden bg-surface-container-high">
                                <a href="<?= base_url('/post/' . esc($post['post_slug'])); ?>">
                                    <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                        src="<?= base_url('assets/backend/images/post/' . esc($post['post_image'])); ?>"
                                        alt="<?= esc($post['post_title']); ?>">
                                </a>
                                <?php if (! empty($post['category_name'])) : ?>
                                    <div class="absolute top-space-sm left-space-sm">
                                        <span class="px-space-sm py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-md text-primary font-label-xs text-label-xs font-bold">
                                            <?= esc($post['category_name']); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="flex flex-col flex-1 p-space-md justify-between">
                                <div>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-xs">
                                        <?= date('d M Y', strtotime($post['post_date'])); ?> | <?= (int) ($post['post_views'] ?? 0); ?> views
                                    </p>
                                    <h3 class="font-title-md text-title-md text-on-surface font-bold line-clamp-2 hover:text-primary transition-colors">
                                        <a href="<?= base_url('/post/' . esc($post['post_slug'])); ?>" class="text-inherit hover:text-primary">
                                            <?= esc($post['post_title']); ?>
                                        </a>
                                    </h3>
                                </div>

                                <div class="pt-space-md mt-space-sm">
                                    <a class="inline-flex items-center gap-space-xs font-label-sm text-label-sm text-primary font-bold hover:text-primary-container transition-colors"
                                        href="<?= base_url('/post/' . esc($post['post_slug'])); ?>">
                                        <span>Baca Selengkapnya</span>
                                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- Center Action Button -->
                <div class="flex justify-center pb-space-lg">
                    <a class="inline-flex items-center gap-space-xs px-space-xl py-space-sm rounded-full bg-primary-container text-on-primary font-label-md text-label-md font-bold shadow-[0_4px_16px_rgba(13,71,161,0.25)] hover:bg-primary hover:shadow-[0_8px_24px_rgba(13,71,161,0.35)] transition-all hover:-translate-y-0.5 active:translate-y-0"
                        href="<?= base_url('/post'); ?>">
                        <span>Lihat Semua Berita</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>

            </div>
        </section>

        <!-- ======= Kanal Aspirasi & Konsultasi Callout Ribbon ======= -->
        <section class="w-full pb-space-xl">
            <div class="max-w-7xl mx-auto px-gutter" data-aos="fade-up">
                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-primary via-primary-container to-tertiary-container p-space-lg md:p-space-xl text-on-primary shadow-xl">
                    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-secondary-container/20 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-space-lg">
                        <div class="flex flex-col max-w-xl md:text-left">
                            <span class="font-label-xs text-label-xs text-secondary-fixed uppercase tracking-widest font-bold mb-1">
                                Kanal Aspirasi &amp; Konsultasi Organisasi
                            </span>
                            <h3 class="font-headline-sm text-headline-sm text-surface-container-lowest font-extrabold">
                                Ada Agenda Advokasi atau Kebutuhan Komisariat?
                            </h3>
                            <p class="font-body-sm text-body-sm text-primary-fixed mt-space-xs m-0">
                                Sampaikan aspirasi gerakan, konfirmasi kaderisasi tingkat komisariat, atau jalin sinergi bersama PC PMII Kab. Garut sekarang.
                            </p>
                        </div>
                        <div class="flex items-center gap-space-sm flex-shrink-0">
                            <a class="inline-flex items-center gap-space-xs px-space-lg py-space-sm rounded-full bg-surface-container-lowest text-primary font-label-md text-label-md font-bold shadow hover:bg-surface-container-high transition-all"
                                href="<?= base_url('/contact'); ?>">
                                <span class="material-symbols-outlined text-[18px]">mail</span>
                                <span>Hubungi Pengurus</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</main>

<?= $this->endSection(); ?>