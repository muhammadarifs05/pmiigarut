<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$aboutData    = $about ?? [];
$siteData     = $site ?? [];

$aboutName    = $aboutData['about_name'] ?? 'PC PMII Kab. Garut';
$aboutAddress = $aboutData['about_alamat'] ?? 'Jl. Pamoyanan, Sukagalih, Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151';
$siteMail     = $siteData['site_mail'] ?? 'pcpmiigarut@gmail.com';
$siteWa       = (string) ($siteData['site_wa'] ?? '0881023263652');
$siteWaLink   = (string) preg_replace('/[^0-9]/', '', $siteWa);
if (str_starts_with($siteWaLink, '0')) {
    $siteWaLink = '62' . substr($siteWaLink, 1);
}
$mapsUrl      = 'https://maps.app.goo.gl/nLqzYzQTJHEYnTAb9';
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full relative overflow-hidden">

        <!-- Dynamic Ambient Backing Gradients -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 bg-gradient-to-b from-primary-fixed/40 via-surface-container-low/20 to-transparent pointer-events-none rounded-b-[4rem]"></div>
        <div class="absolute -top-32 right-10 w-96 h-96 bg-primary-container/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-48 -left-20 w-80 h-80 bg-secondary-container/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Main Container -->
        <div class="w-full max-w-7xl mx-auto px-gutter py-space-xl relative z-10 flex flex-col gap-space-xl">

            <!-- Hero / Title Presentation Section -->
            <div class="flex flex-col items-center text-center max-w-3xl mx-auto pt-space-md" data-aos="fade-up">
                <!-- Badge -->
                <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-surface-container-high text-primary font-label-xs text-label-xs uppercase tracking-widest shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span>HUBUNGI KAMI</span>
                </div>

                <!-- Main Headline -->
                <h1 class="mt-space-md font-headline-xl text-3xl sm:text-headline-xl text-primary tracking-tight font-extrabold">
                    <?= esc($aboutName); ?>
                </h1>

                <!-- Elegant Brand Indicator Line -->
                <div class="w-16 h-1.5 bg-gradient-to-r from-primary to-secondary-container rounded-full my-space-sm"></div>

                <!-- Lead Narrative Text -->
                <p class="font-body-lg text-base sm:text-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                    Halaman ini berisi narahubung dan profil organisasi untuk menjalin komunikasi, kolaborasi, maupun kebutuhan informasi lainnya.
                </p>
            </div>

            <!-- Quick Info Cards (3 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg" data-aos="fade-up" data-aos-delay="80">

                <!-- Card 1: Sekretariat -->
                <a href="<?= esc($mapsUrl); ?>" target="_blank" rel="noopener noreferrer"
                    class="group relative bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between text-left">
                    <div class="absolute top-0 inset-x-8 h-1 bg-gradient-to-r from-primary to-primary-container rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div>
                        <div class="flex items-center justify-between mb-space-md">
                            <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[24px]">location_on</span>
                            </div>
                            <span class="px-space-sm py-space-xs rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs uppercase tracking-wider">
                                SEKRETARIAT
                            </span>
                        </div>
                        <h2 class="font-title-md text-title-md text-on-surface font-bold tracking-tight mb-space-xs">
                            Alamat
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed m-0">
                            <?= esc($aboutAddress); ?>
                        </p>
                    </div>
                    <div class="mt-space-lg pt-space-sm flex items-center text-primary font-label-sm text-label-sm group-hover:translate-x-1 transition-transform">
                        <span class="mr-1">Lihat di peta</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </div>
                </a>

                <!-- Card 2: Email -->
                <a href="mailto:<?= esc($siteMail); ?>"
                    class="group relative bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between text-left">
                    <div class="absolute top-0 inset-x-8 h-1 bg-gradient-to-r from-primary to-primary-container rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div>
                        <div class="flex items-center justify-between mb-space-md">
                            <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[24px]">mail</span>
                            </div>
                            <span class="px-space-sm py-space-xs rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs uppercase tracking-wider">
                                EMAIL
                            </span>
                        </div>
                        <h2 class="font-title-md text-title-md text-on-surface font-bold tracking-tight mb-space-xs">
                            Hubungi Email
                        </h2>
                        <span class="font-body-md text-body-md text-primary font-medium group-hover:underline block break-all">
                            <?= esc($siteMail); ?>
                        </span>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs m-0">
                            Surat resmi, undangan kelembagaan, dan rilis pers.
                        </p>
                    </div>
                    <div class="mt-space-lg pt-space-sm flex items-center text-primary font-label-sm text-label-sm group-hover:translate-x-1 transition-transform">
                        <span class="mr-1">Kirim email</span>
                        <span class="material-symbols-outlined text-[16px]">send</span>
                    </div>
                </a>

                <!-- Card 3: WhatsApp (Tanpa Menampilkan Nomor) -->
                <a href="https://wa.me/<?= esc($siteWaLink); ?>" target="_blank" rel="noopener noreferrer"
                    class="group relative bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between text-left">
                    <div class="absolute top-0 inset-x-8 h-1 bg-gradient-to-r from-secondary-container to-secondary-fixed rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div>
                        <div class="flex items-center justify-between mb-space-md">
                            <div class="w-12 h-12 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[24px]">forum</span>
                            </div>
                            <span class="px-space-sm py-space-xs rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-xs text-label-xs uppercase tracking-wider">
                                WHATSAPP
                            </span>
                        </div>
                        <h2 class="font-title-md text-title-md text-on-surface font-bold tracking-tight mb-space-xs">
                            Kontak Cepat
                        </h2>
                        <span class="font-body-md text-body-md text-primary font-semibold group-hover:underline block">
                            PC PMII Garut
                        </span>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs m-0">
                            Pelayanan cepat narahubung internal kader dan publik melalui WhatsApp resmi.
                        </p>
                    </div>
                    <div class="mt-space-lg pt-space-sm flex items-center text-secondary font-label-sm text-label-sm group-hover:translate-x-1 transition-transform">
                        <span class="mr-1">Buka percakapan</span>
                        <span class="material-symbols-outlined text-[16px]">chat</span>
                    </div>
                </a>

            </div>

            <!-- Lower Section: Form & Location Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start pb-space-lg" data-aos="fade-up" data-aos-delay="140">

                <!-- Left Column: Message Box (7 Cols) -->
                <div id="message-box" class="lg:col-span-7 bg-surface-container-lowest rounded-2xl p-space-lg md:p-space-xl shadow-sm flex flex-col justify-between">
                    <div>
                        <!-- Sub-badge -->
                        <div class="inline-flex items-center gap-space-xs px-space-sm py-space-xs rounded-full bg-surface-container-high text-primary font-label-xs text-label-xs uppercase tracking-wider mb-space-sm">
                            <span class="material-symbols-outlined text-[14px]">edit_note</span>
                            <span>MESSAGE BOX</span>
                        </div>

                        <h2 class="font-headline-md text-headline-md text-on-surface font-bold tracking-tight m-0">
                            Kirim Pesan ke PMII Garut
                        </h2>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-space-xs mb-space-lg">
                            Sampaikan pertanyaan, informasi, atau pesan kolaborasi melalui formulir di bawah ini.
                        </p>

                        <!-- Flashdata Feedback -->
                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="mb-space-md p-space-md rounded-xl bg-primary-fixed text-on-primary-fixed font-body-sm text-body-sm flex items-center gap-space-sm">
                                <span class="material-symbols-outlined text-primary text-[20px]">check_circle</span>
                                <span><?= esc(session()->getFlashdata('success')); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('danger')) : ?>
                            <div class="mb-space-md p-space-md rounded-xl bg-error-container text-on-error-container font-body-sm text-body-sm flex items-center gap-space-sm">
                                <span class="material-symbols-outlined text-error text-[20px]">warning</span>
                                <span><?= esc(session()->getFlashdata('danger')); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Contact Form -->
                        <form id="contactForm" action="<?= base_url('/contact'); ?>" method="post" class="flex flex-col gap-space-md">
                            <?= csrf_field(); ?>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                                <!-- Nama Lengkap -->
                                <div class="flex flex-col gap-space-xs">
                                    <label for="inbox_name" class="font-label-sm text-label-sm text-on-surface-variant">
                                        Nama Lengkap <span class="text-error">*</span>
                                    </label>
                                    <input type="text" id="inbox_name" name="inbox_name" required
                                        placeholder="Masukkan nama lengkap"
                                        class="w-full h-11 px-space-md bg-surface-container-low rounded-lg text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition-all border-0" />
                                </div>

                                <!-- Email -->
                                <div class="flex flex-col gap-space-xs">
                                    <label for="inbox_email" class="font-label-sm text-label-sm text-on-surface-variant">
                                        Email <span class="text-error">*</span>
                                    </label>
                                    <input type="email" id="inbox_email" name="inbox_email" required
                                        placeholder="nama@email.com"
                                        class="w-full h-11 px-space-md bg-surface-container-low rounded-lg text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition-all border-0" />
                                </div>
                            </div>

                            <!-- Subjek Pesan -->
                            <div class="flex flex-col gap-space-xs">
                                <label for="inbox_subject" class="font-label-sm text-label-sm text-on-surface-variant">
                                    Subjek Pesan <span class="text-error">*</span>
                                </label>
                                <input type="text" id="inbox_subject" name="inbox_subject" required
                                    placeholder="Contoh: Permohonan Audiensi / Kolaborasi Kegiatan"
                                    class="w-full h-11 px-space-md bg-surface-container-low rounded-lg text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition-all border-0" />
                            </div>

                            <!-- Pesan -->
                            <div class="flex flex-col gap-space-xs">
                                <label for="inbox_message" class="font-label-sm text-label-sm text-on-surface-variant">
                                    Pesan <span class="text-error">*</span>
                                </label>
                                <textarea id="inbox_message" name="inbox_message" rows="4" required
                                    placeholder="Tuliskan uraian pesan atau pertanyaan Anda di sini..."
                                    class="w-full p-space-md bg-surface-container-low rounded-lg text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition-all resize-none border-0"></textarea>
                            </div>

                            <!-- Submit Button & Feedback -->
                            <div class="pt-space-xs flex flex-col sm:flex-row items-center justify-between gap-space-md">
                                <button type="submit" id="submitBtn"
                                    class="w-full sm:w-auto px-space-lg py-3 rounded-xl bg-primary-container text-on-primary font-label-md text-label-md flex items-center justify-center gap-space-xs hover:bg-primary transition-all shadow-md hover:shadow-lg active:scale-95 border-0 cursor-pointer">
                                    <span>Kirim Pesan Sekarang</span>
                                    <span class="material-symbols-outlined text-[18px]">send</span>
                                </button>
                                <span class="text-on-surface-variant font-label-xs text-label-xs text-center sm:text-right">
                                    Pesan terenkripsi &amp; diteruskan langsung ke sekretariat.
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Location & Map Showcase (5 Cols) -->
                <div class="lg:col-span-5 bg-surface-container-lowest rounded-2xl p-space-lg md:p-space-xl shadow-sm flex flex-col justify-between h-full">
                    <div>
                        <!-- Sub-badge -->
                        <div class="inline-flex items-center gap-space-xs px-space-sm py-space-xs rounded-full bg-surface-container-high text-primary font-label-xs text-label-xs uppercase tracking-wider mb-space-sm">
                            <span class="material-symbols-outlined text-[14px]">pin_drop</span>
                            <span>LOKASI</span>
                        </div>

                        <h2 class="font-headline-md text-headline-md text-on-surface font-bold tracking-tight m-0">
                            Sekretariat PMII Garut
                        </h2>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-space-xs mb-space-lg">
                            Temukan lokasi sekretariat kami untuk kebutuhan koordinasi, silaturahmi, dan kegiatan organisasi.
                        </p>

                        <!-- Interactive Google Maps Card -->
                        <div class="relative w-full rounded-2xl overflow-hidden shadow-inner bg-surface-container">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d498.0090737095298!2d107.88122266923538!3d-7.206301296397533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b1004687ddc1%3A0x134e0e301aa65980!2ssekre%20Cabang%20PMII%20Garut!5e1!3m2!1sid!2sid!4v1776007761547!5m2!1sid!2sid"
                                class="w-full h-72 border-0 block"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Lokasi Sekretariat PC PMII Garut">
                            </iframe>

                            <!-- Top Floating Overlay Badges -->
                            <div class="absolute top-3 inset-x-3 flex justify-between items-start pointer-events-none">
                                <a href="<?= esc($mapsUrl); ?>" target="_blank" rel="noopener noreferrer"
                                    class="pointer-events-auto px-space-md py-space-xs bg-surface-container-lowest/95 backdrop-blur-md rounded-full shadow-lg text-primary font-label-sm text-label-sm font-semibold flex items-center gap-space-xs hover:bg-surface-container-lowest transition-all">
                                    <span>Buka di Maps</span>
                                    <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                </a>
                                <span class="px-space-sm py-space-xs rounded-full bg-primary-container text-on-primary font-label-xs text-label-xs shadow-md">
                                    Pusat Cabang
                                </span>
                            </div>
                        </div>

                        <!-- Working Hours & Office Schedule -->
                        <!-- <div class="mt-space-lg flex flex-col gap-space-xs bg-surface-container-low p-space-md rounded-xl">
                            <div class="flex items-center justify-between">
                                <span class="font-label-sm text-label-sm text-on-surface font-semibold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
                                    Jam Pelayanan Sekretariat
                                </span>
                                <span class="px-space-sm py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-xs text-label-xs">
                                    Terbuka
                                </span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant m-0">
                                Senin – Sabtu: 09.00 - 21.00 WIB<br />
                                Ahad / Tanggal Merah: Koordinasi Terjadwal
                            </p>
                        </div> -->
                    </div>

                    <div class="mt-space-md pt-space-sm flex items-center justify-between text-on-surface-variant font-label-xs text-label-xs">
                        <span>Koordinat GPS: -7.2063, 107.8812</span>
                        <span class="text-primary font-medium">Zona Waktu: GMT+7 (WIB)</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>