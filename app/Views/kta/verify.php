<?php

/**
 * @var string $title
 * @var array $site
 * @var array $kader
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

                <!-- Main Verification Result Card (Ukuran & Proporsi Identik dengan verify_invalid) -->
                <div class="w-full max-w-3xl mt-space-xl bg-surface-container-lowest rounded-2xl shadow-[0_4px_24px_rgba(13,71,161,0.08)] overflow-hidden border border-outline-variant/25">

                    <!-- Card Header Banner -->
                    <div class="w-full bg-gradient-to-b from-primary to-tertiary text-on-primary py-space-xl px-space-lg flex flex-col items-center justify-center relative border-b-4 border-secondary-container">
                        <div class="w-20 h-20 rounded-full bg-surface-container-lowest/15 backdrop-blur-sm p-1 mb-space-md shadow-inner flex items-center justify-center ring-4 ring-on-primary/15">
                            <img src="<?= base_url('assets/frontend/img/apple-touch-icon2.png'); ?>"
                                alt="Logo PMII Garut"
                                class="w-full h-full rounded-full object-cover bg-[#082963]" />
                        </div>

                        <div class="inline-flex items-center gap-space-xs text-secondary-container text-title-md font-title-md font-bold tracking-wide uppercase">
                            <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            <span>KARTU TANDA ANGGOTA SAH</span>
                        </div>

                        <span class="font-label-sm text-label-sm tracking-widest text-primary-fixed uppercase mt-space-xs">
                            PC PMII KABUPATEN GARUT
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-space-lg sm:p-space-xl flex flex-col items-center text-left">

                        <!-- NIA Pill Badge -->
                        <div class="px-space-lg py-1.5 rounded-lg bg-surface-container text-primary font-title-sm text-title-sm tracking-wider font-bold mb-space-lg border border-primary/15 text-center">
                            NIA: <?= esc($kader['nomor_kta'] ?? '-'); ?>
                        </div>

                        <!-- Key-Value Credential List -->
                        <div class="w-full flex flex-col gap-space-xs max-w-xl">

                            <!-- Row: Nama Lengkap -->
                            <div class="flex items-center justify-between py-2.5 px-space-md bg-surface-container-low rounded-xl">
                                <span class="font-label-md text-label-md text-on-surface-variant w-1/3">Nama Lengkap</span>
                                <span class="text-on-surface-variant font-bold text-label-md w-6 text-center">:</span>
                                <span class="font-title-sm text-title-sm text-on-surface font-bold w-3/5 break-words"><?= esc($kader['nama_lengkap'] ?? '-'); ?></span>
                            </div>

                            <!-- Row: Komisariat -->
                            <div class="flex items-center justify-between py-2.5 px-space-md bg-surface-container-low/60 rounded-xl">
                                <span class="font-label-md text-label-md text-on-surface-variant w-1/3">Komisariat</span>
                                <span class="text-on-surface-variant font-bold text-label-md w-6 text-center">:</span>
                                <span class="font-body-md text-body-md text-on-surface font-medium w-3/5 break-words"><?= esc($kader['nama_komisariat'] ?? '-'); ?></span>
                            </div>

                            <!-- Row: Rayon (tampil jika terisi) -->
                            <?php if (! empty($kader['rayon'])) : ?>
                                <div class="flex items-center justify-between py-2.5 px-space-md bg-surface-container-low rounded-xl">
                                    <span class="font-label-md text-label-md text-on-surface-variant w-1/3">Rayon</span>
                                    <span class="text-on-surface-variant font-bold text-label-md w-6 text-center">:</span>
                                    <span class="font-body-md text-body-md text-on-surface font-medium w-3/5 break-words"><?= esc($kader['rayon']); ?></span>
                                </div>
                            <?php endif; ?>

                            <!-- Row: Angkatan Mapaba -->
                            <div class="flex items-center justify-between py-2.5 px-space-md bg-surface-container-low/60 rounded-xl">
                                <span class="font-label-md text-label-md text-on-surface-variant w-1/3">Angkatan Mapaba</span>
                                <span class="text-on-surface-variant font-bold text-label-md w-6 text-center">:</span>
                                <span class="font-body-md text-body-md text-on-surface font-semibold w-3/5"><?= esc($kader['tahun_mapaba'] ?? '-'); ?></span>
                            </div>

                            <!-- Row: Status Keaktifan -->
                            <div class="flex items-center justify-between py-2.5 px-space-md bg-surface-container-low rounded-xl">
                                <span class="font-label-md text-label-md text-on-surface-variant w-1/3">Status Keaktifan</span>
                                <span class="text-on-surface-variant font-bold text-label-md w-6 text-center">:</span>
                                <div class="w-3/5 flex items-center">
                                    <span class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-emerald-700 text-on-primary font-label-xs text-label-xs font-bold tracking-wide shadow-sm">
                                        <span class="material-symbols-outlined text-[15px]">check</span>
                                        <span>AKTIF / TERVERIFIKASI</span>
                                    </span>
                                </div>
                            </div>

                        </div>

                        <!-- Action Button -->
                        <div class="mt-space-lg flex justify-center w-full">
                            <a href="<?= base_url('kta/cek-status'); ?>"
                                class="inline-flex items-center justify-center gap-space-xs px-space-lg py-2.5 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-semibold shadow-md hover:bg-tertiary transition-all duration-200 no-underline">
                                <span class="material-symbols-outlined text-[18px]">manage_search</span>
                                <span>Cek Status / Layanan KTA</span>
                            </a>
                        </div>

                        <!-- Subtle Divider -->
                        <div class="w-full h-px bg-surface-variant mt-space-xl mb-space-md"></div>

                        <!-- Footer Note -->
                        <div class="flex items-center justify-center gap-space-xs font-body-sm text-body-sm text-on-surface-variant text-center">
                            <span class="material-symbols-outlined text-outline text-[16px]">info</span>
                            <span>Data ini diverifikasi secara resmi dan sistemik melalui Portal Web <span class="font-medium text-on-surface">PC PMII Kabupaten Garut</span>.</span>
                        </div>

                    </div>
                </div>

                <!-- Additional Institutional Authentication Footprint -->
                <div class="mt-space-xl flex flex-col sm:flex-row items-center justify-center gap-space-md text-on-surface-variant font-label-xs text-label-xs">
                    <div class="flex items-center gap-space-xs">
                        <span class="material-symbols-outlined text-primary text-[18px]">verified_user</span>
                        <span>Sistem Basis Data Kader Digital Terintegrasi</span>
                    </div>
                    <span class="hidden sm:inline text-outline-variant">•</span>
                    <div class="flex items-center gap-space-xs">
                        <span class="material-symbols-outlined text-secondary text-[18px]">security</span>
                        <span>Enkripsi Kunci Publik Garut V.2.4</span>
                    </div>
                </div>

            </div>
        </section>

    </div>
</main>

<?= $this->endSection(); ?>