<?php

/**
 * @var string $title
 * @var array $site
 */
?>
<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main class="w-full pt-20 bg-background min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">

        <!-- Main Content Stage -->
        <section class="relative w-full py-space-xl px-margin overflow-hidden">
            <!-- Ambient institutional background glow -->
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[720px] h-[340px] bg-gradient-to-b from-primary-fixed/40 via-surface-container-high/20 to-transparent blur-3xl pointer-events-none -z-10 rounded-full"></div>

            <div class="max-w-4xl mx-auto flex flex-col items-center text-center" data-aos="fade-up">

                <!-- Top Pill Tag -->
                <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-primary-fixed text-primary font-label-xs text-label-xs tracking-wider uppercase mb-space-md shadow-sm font-bold">
                    <span class="material-symbols-outlined text-[15px]">verified_user</span>
                    <span>Validasi KTA Digital</span>
                </div>

                <!-- Main Headline -->
                <h1 class="font-headline-xl text-3xl sm:text-4xl lg:text-headline-xl text-on-surface font-extrabold tracking-tight m-0">
                    Verifikasi <span class="text-primary relative inline-block">
                        Keabsahan Anggota
                        <span class="absolute -bottom-2 left-0 right-0 h-1.5 bg-gradient-to-r from-primary via-primary to-secondary-container rounded-full"></span>
                    </span>
                </h1>

                <!-- Descriptive Subtext -->
                <p class="mt-space-lg font-body-lg text-base sm:text-body-lg text-on-surface-variant max-w-2xl mb-0">
                    Hasil pemindaian QR Code resmi sistem informasi keanggotaan PC PMII Kabupaten Garut.
                </p>

                <!-- Main Verification Result Card -->
                <div class="w-full max-w-3xl mt-space-xl bg-surface-container-lowest rounded-2xl shadow-[0_4px_24px_rgba(13,71,161,0.08)] overflow-hidden border border-outline-variant/25">

                    <!-- Card Header Banner: Deep Royal Blue with Logo -->
                    <div class="w-full bg-gradient-to-b from-primary to-tertiary text-on-primary py-space-xl px-space-lg flex flex-col items-center justify-center relative border-b-4 border-secondary-container">
                        <div class="w-20 h-20 rounded-full bg-surface-container-lowest/15 backdrop-blur-sm p-1 mb-space-md shadow-inner flex items-center justify-center ring-4 ring-on-primary/15">
                            <img src="<?= base_url('assets/frontend/img/apple-touch-icon2.png'); ?>"
                                alt="Logo PMII Garut"
                                class="w-full h-full rounded-full object-cover bg-[#082963]" />
                        </div>

                        <div class="inline-flex items-center gap-space-xs text-secondary-fixed text-title-md font-title-md font-bold tracking-wide">
                            <span class="material-symbols-outlined text-[22px]">warning</span>
                            <span>DATA KTA TIDAK DITEMUKAN</span>
                        </div>

                        <span class="font-label-sm text-label-sm tracking-widest text-primary-fixed uppercase mt-space-xs">
                            PC PMII KABUPATEN GARUT
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-space-lg sm:p-space-xl flex flex-col items-center text-center">

                        <!-- Status Pill Badge -->
                        <div class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-error-container text-error font-label-sm text-label-sm uppercase font-bold tracking-wide mb-space-md">
                            <span class="w-2 h-2 rounded-full bg-error animate-ping"></span>
                            <span>Status: Tidak Terdaftar / Belum Terverifikasi</span>
                        </div>

                        <!-- Explanation Text -->
                        <p class="font-body-md text-body-md text-on-surface-variant max-w-xl leading-relaxed m-0">
                            Kode verifikasi QR Code yang dipindai tidak ditemukan dalam database resmi <span class="text-on-surface font-semibold">PC PMII Kabupaten Garut</span> atau pengajuan KTA belum disetujui.
                        </p>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-space-md mt-space-lg w-full sm:w-auto">
                            <a href="<?= base_url('kta/cek-status'); ?>"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-space-xs px-space-lg py-2.5 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-semibold shadow-md hover:bg-tertiary transition-all duration-200 no-underline">
                                <span class="material-symbols-outlined text-[18px]">search</span>
                                <span>Cek Status KTA</span>
                            </a>

                            <a href="<?= base_url('kta/pengajuan'); ?>"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-space-xs px-space-lg py-2.5 rounded-xl bg-surface-container-low text-primary font-label-md text-label-md font-semibold hover:bg-surface-container-high transition-colors no-underline">
                                <span class="material-symbols-outlined text-[18px]">assignment_turned_in</span>
                                <span>Ajukan KTA</span>
                            </a>
                        </div>

                        <!-- Subtle Divider -->
                        <div class="w-full h-px bg-surface-variant mt-space-xl mb-space-md"></div>

                        <!-- Footer Note -->
                        <div class="flex items-center justify-center gap-space-xs font-body-sm text-body-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-outline text-[16px]">info</span>
                            <span>Data ini diperiksa secara resmi dan sistemik melalui Portal Web <span class="font-medium text-on-surface">PC PMII Kabupaten Garut</span>.</span>
                        </div>

                    </div>
                </div>

                <!-- 3-Column Guidance Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md w-full max-w-3xl mt-space-xl">
                    <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm text-left flex items-start gap-space-md border border-outline-variant/25">
                        <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary flex-shrink-0">
                            <span class="material-symbols-outlined text-[20px]">qr_code_scanner</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-title-sm text-title-sm text-on-surface font-semibold">Pindai Ulang</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5 mb-0">Pastikan QR Code bersih dan terpindai dengan sempurna.</p>
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm text-left flex items-start gap-space-md border border-outline-variant/25">
                        <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary flex-shrink-0">
                            <span class="material-symbols-outlined text-[20px]">domain</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-title-sm text-title-sm text-on-surface font-semibold">Hubungi Komisariat</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5 mb-0">Konfirmasi berkas kaderisasi ke pengurus komisariat asal.</p>
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm text-left flex items-start gap-space-md border border-outline-variant/25">
                        <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary flex-shrink-0">
                            <span class="material-symbols-outlined text-[20px]">headset_mic</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-title-sm text-title-sm text-on-surface font-semibold">Layanan Bantuan</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5 mb-0">Akses tim IT Cabang untuk validasi berkas manual.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>
</main>

<?= $this->endSection(); ?>