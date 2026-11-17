<?php

/**
 * @var string $title
 * @var array $site
 * @var array $kader
 */
?>
<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main">

    <!-- Header / Breadcrumbs -->
    <section class="breadcrumbs" style="margin-top: 80px; background-color: #f1f6fe; padding: 20px 0;">
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
    <section class="contact" style="background-color: #f8fafd; padding: 60px 0;">
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
                            <h5 class="mb-1 fw-bold" style="letter-spacing: 0.6px;">
                                <i class="bx bxs-badge-check text-warning me-1"></i> KARTU TANDA ANGGOTA SAH
                            </h5>
                            <small style="color: #f3c430; font-weight: 600; letter-spacing: 1px;">PC PMII KABUPATEN GARUT</small>
                        </div>

                        <!-- Body Data Kader -->
                        <div class="card-body p-4 bg-white">
                            <div class="text-center mb-4">
                                <span class="badge px-4 py-2" style="background-color: #eef4ff; color: #0c44a6; border: 1px solid #bfd7ff; font-size: 14px; font-weight: 700; border-radius: 6px;">
                                    NIA: <?= esc($kader['nomor_kta'] ?? '-') ?>
                                </span>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0" style="font-size: 15px;">
                                    <tr style="border-bottom: 1px solid #f1f5f9;">
                                        <th width="38%" class="text-muted fw-semibold py-2">Nama Lengkap</th>
                                        <td width="4%" class="py-2">:</td>
                                        <td class="fw-bold text-dark py-2"><?= esc($kader['nama_lengkap'] ?? '-') ?></td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #f1f5f9;">
                                        <th class="text-muted fw-semibold py-2">Komisariat</th>
                                        <td class="py-2">:</td>
                                        <td class="text-dark py-2"><?= esc($kader['nama_komisariat'] ?? '-') ?></td>
                                    </tr>
                                    <?php if (! empty($kader['rayon'])) : ?>
                                        <tr style="border-bottom: 1px solid #f1f5f9;">
                                            <th class="text-muted fw-semibold py-2">Rayon</th>
                                            <td class="py-2">:</td>
                                            <td class="text-dark py-2"><?= esc($kader['rayon']) ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr style="border-bottom: 1px solid #f1f5f9;">
                                        <th class="text-muted fw-semibold py-2">Angkatan Mapaba</th>
                                        <td class="py-2">:</td>
                                        <td class="text-dark py-2"><?= esc($kader['tahun_mapaba'] ?? '-') ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted fw-semibold py-2">Status Keaktifan</th>
                                        <td class="py-2">:</td>
                                        <td class="py-2">
                                            <span class="badge bg-success px-3 py-2" style="font-size: 12px; letter-spacing: 0.4px;">
                                                <i class="bx bx-check-circle me-1"></i> AKTIF / TERVERIFIKASI
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Footer Kartu -->
                        <div class="card-footer bg-light text-center py-3 px-4 border-top">
                            <small class="text-muted d-block">
                                Data ini diverifikasi secara resmi dan sistemik melalui Portal Web <strong>PC PMII Kabupaten Garut</strong>.
                            </small>
                            <div class="mt-3">
                                <a href="<?= base_url('kta/cek-status') ?>" class="btn btn-sm btn-outline-primary px-3">
                                    <i class="bx bx-search me-1"></i> Cek Status / Layanan KTA
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</main>

<?= $this->endSection(); ?>