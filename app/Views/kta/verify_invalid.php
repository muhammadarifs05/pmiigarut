<?php

/**
 * @var string $title
 * @var array $site
 */
?>
<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <!-- Header / Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Verifikasi Keanggotaan</h2>
                <ol>
                    <li><a href="<?= base_url('/') ?>">Home</a></li>
                    <li>Verifikasi KTA</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <span class="about-badge">Validasi KTA Digital</span>
                <h3>Verifikasi <span>Keabsahan Anggota</span></h3>
                <p>Hasil pemindaian QR Code resmi sistem informasi keanggotaan PC PMII Kabupaten Garut.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">

                    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; border-top: 4px solid #0c44a6 !important;">
                        <!-- Header Kartu Biru PMII -->
                        <div class="text-center text-white py-4 px-3" style="background: linear-gradient(135deg, #0a3682 0%, #1565c0 100%); border-bottom: 3px solid #f3c430;">
                            <img src="<?= base_url('assets/frontend/img/apple-touch-icon2.png') ?>" alt="Logo PMII Garut" style="width: 58px; height: 58px; border-radius: 50%; border: 2px solid #ffffff; background: #082963; margin-bottom: 10px;">
                            <div style="color: #ffffff; font-size: 16px; font-weight: 700; letter-spacing: 0.6px;">
                                <i class="bx bx-error-circle text-warning me-1"></i> DATA KTA TIDAK DITEMUKAN
                            </div>
                            <small style="color: #f3c430; font-weight: 600; letter-spacing: 1px;">PC PMII KABUPATEN GARUT</small>
                        </div>

                        <!-- Body Informasi -->
                        <div class="card-body p-4 bg-white">
                            <div class="text-center mb-4">
                                <span class="badge px-4 py-2" style="background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; font-size: 13px; font-weight: 700; border-radius: 6px;">
                                    STATUS: TIDAK TERDAFTAR / BELUM TERVERIFIKASI
                                </span>
                            </div>

                            <p class="text-center text-muted mb-3" style="font-size: 14.5px; line-height: 1.6;">
                                Kode verifikasi QR Code yang dipindai tidak ditemukan dalam database resmi <strong>PC PMII Kabupaten Garut</strong> atau pengajuan KTA belum disetujui.
                            </p>

                            <div class="text-center mt-4">
                                <a href="<?= base_url('kta/cek-status') ?>" class="btn btn-primary px-4 py-2 me-1" style="background: #106eea; border-color: #106eea; font-weight: 600;">
                                    <i class="bx bx-search me-1"></i> Cek Status KTA
                                </a>
                                <a href="<?= base_url('kta/pengajuan') ?>" class="btn btn-outline-primary px-4 py-2" style="font-weight: 600;">
                                    Ajukan KTA
                                </a>
                            </div>
                        </div>

                        <!-- Footer Kartu -->
                        <div class="card-footer bg-light text-center py-3 px-4 border-top">
                            <small class="text-muted d-block">
                                Data ini diperiksa secara resmi dan sistemik melalui Portal Web <strong>PC PMII Kabupaten Garut</strong>.
                            </small>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</main>

<?= $this->endSection(); ?>