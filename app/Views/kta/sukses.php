<?php

/**
 * @var string $title
 * @var array $kader
 * @var array $site
 */
?>
<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <!-- Hero Section / Breadcrumbs -->
    <section class="breadcrumbs" style="margin-top: 80px; background-color: #f1f6fe; padding: 20px 0;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Status Pengajuan</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Status KTA</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-8 mt-4 d-flex align-items-stretch text-center">

                    <div style="width: 100%; background: #fff; padding: 50px 30px; box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12); border-top: 4px solid #28a745; border-bottom: 4px solid #28a745;">
                        <div class="mb-4" style="color: #28a745;">
                            <!-- Menggunakan icon boxicons bawaan template -->
                            <i class="bx bx-check-circle" style="font-size: 80px;"></i>
                        </div>

                        <h3 style="font-weight: 700; color: #37517e; margin-bottom: 15px;">Pengajuan KTA Berhasil Dikirim!</h3>

                        <p style="font-size: 16px; color: #444; margin-bottom: 25px;">
                            Terima kasih <strong><?= esc($kader['nama_lengkap'] ?? '') ?></strong>.<br>
                            Data pengajuan KTA Anda saat ini sedang dalam proses verifikasi oleh Admin PC PMII Garut.
                        </p>

                        <div style="background: #e8f4fd; color: #0c5460; padding: 15px 20px; border-left: 5px solid #106eea; text-align: left; border-radius: 4px; margin-bottom: 30px;">
                            <div class="mb-2"><strong>Status:</strong> <span class="badge bg-warning text-dark" style="font-size: 13px;">Menunggu Verifikasi (Pending)</span></div>
                            <div><strong>Cara Cek Progres & Unduh KTA:</strong> Gunakan <strong>NIK (<?= esc($kader['nik'] ?? '') ?>)</strong> dan <strong>Tanggal Lahir</strong> Anda pada menu <em>Cek Status Pengajuan</em>.</div>
                        </div>

                        <div>
                            <a href="<?= base_url() ?>" class="btn btn-primary" style="background: #106eea; border: 0; padding: 10px 30px; border-radius: 50px; font-weight: 600;">
                                <i class="bx bx-home-alt me-2"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

<?= $this->endSection(); ?>