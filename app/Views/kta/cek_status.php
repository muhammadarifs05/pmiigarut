<?php

/**
 * @var string $title
 * @var array $site
 * @var array $pengajuan
 */
?>
<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<style>
    /* Styling Pratinjau Kartu KTA (Rasio CR80 Landscape) */
    .kta-preview-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .kta-card-box {
        width: 340px;
        height: 214px;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        font-family: 'Helvetica', 'Arial', sans-serif;
        text-align: left;
    }

    /* Muka Depan */
    .kta-front {
        background: linear-gradient(135deg, #0d47a1 0%, #1565c0 100%);
        color: #fff;
    }

    .kta-front-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 24px;
        background-color: #1976d2;
    }

    .kta-f-header {
        padding: 10px 14px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        text-align: right;
    }

    .kta-f-header h6 {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        letter-spacing: 0.5px;
    }

    .kta-f-header small {
        font-size: 8px;
        display: block;
        opacity: 0.9;
    }

    .kta-f-foto {
        position: absolute;
        top: 52px;
        left: 14px;
        width: 74px;
        height: 94px;
        border: 2px solid #fff;
        border-radius: 5px;
        object-fit: cover;
        background: #e9ecef;
    }

    .kta-f-data {
        position: absolute;
        top: 52px;
        left: 100px;
        right: 12px;
    }

    .kta-f-nama {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 2px;
        line-height: 1.2;
    }

    .kta-f-nia {
        font-size: 10px;
        color: #ffd700;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .kta-f-table {
        width: 100%;
        font-size: 9px;
        color: #fff;
    }

    .kta-f-table td {
        padding: 1.5px 0;
        vertical-align: top;
    }

    .kta-f-footer {
        position: absolute;
        bottom: 5px;
        width: 100%;
        text-align: center;
        font-size: 7.5px;
        font-style: italic;
        color: #fff;
    }

    /* Muka Belakang */
    .kta-back {
        background: #ffffff;
        color: #212529;
        border: 1px solid #dee2e6;
    }

    .kta-b-header {
        background: #0d47a1;
        color: #fff;
        text-align: center;
        padding: 6px;
        font-size: 11px;
        font-weight: 700;
    }

    .kta-b-tujuan {
        padding: 8px 12px;
        text-align: center;
        font-size: 8px;
        line-height: 1.3;
    }

    .kta-b-ttd {
        display: flex;
        justify-content: space-around;
        text-align: center;
        font-size: 8px;
        margin-top: 2px;
    }

    .kta-b-bottom {
        position: absolute;
        bottom: 8px;
        left: 12px;
        right: 12px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .kta-b-aturan {
        font-size: 7px;
        line-height: 1.3;
        width: 72%;
    }

    .kta-b-aturan ol {
        margin: 0;
        padding-left: 12px;
    }

    .kta-b-qr img {
        width: 48px;
        height: 48px;
    }
</style>

<main id="main" data-aos="fade-up">

    <!-- Header / Breadcrumbs -->
    <section class="breadcrumbs" style="margin-top: 80px; background-color: #f1f6fe; padding: 20px 0;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Cek Status & Unduh KTA</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Cek Status KTA</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <span class="about-badge">Lacak Pengajuan</span>
                <h3>Cek Status & Unduh <span>KTA Digital</span></h3>
                <p>Masukkan <strong>NIK</strong> dan <strong>Tanggal Lahir</strong> Anda untuk memantau progres verifikasi atau mengunduh KTA Digital.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <div style="width: 100%; background: #fff; padding: 35px 30px; box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12); border-top: 3px solid #106eea; border-bottom: 3px solid #106eea;">

                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <i class="bx bx-error-circle"></i> <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif ?>

                        <!-- Form Pencarian Mudah (NIK + Tanggal Lahir) -->
                        <form action="<?= base_url('kta/cek-status') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row g-3 align-items-end">
                                <div class="col-md-5">
                                    <label for="nik" class="form-label fw-bold">NIK (16 Digit)</label>
                                    <input type="text" name="nik" id="nik" class="form-control" maxlength="16" placeholder="Contoh: 3205xxxxxxxxxxxx" value="<?= esc($nik_input ?? old('nik')) ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= esc($tgl_input ?? old('tanggal_lahir')) ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary w-100" type="submit" style="background: #106eea; border-color: #106eea; height: 38px;">
                                        <i class="bx bx-search"></i> Cek Status
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Hasil Pencarian -->
                        <?php if (isset($pengajuan)) : ?>
                            <hr class="my-4">
                            <h5 class="mb-3" style="color: #37517e; font-weight: bold;">Informasi Pengajuan KTA</h5>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%" class="bg-light">Nama Pemohon</th>
                                        <td><strong><?= esc($pengajuan['nama_lengkap']) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">NIK</th>
                                        <td><?= esc($pengajuan['nik']) ?></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Komisariat</th>
                                        <td><?= esc($pengajuan['nama_komisariat'] ?? '-') ?></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Tanggal Pengajuan</th>
                                        <td><?= date('d M Y H:i', strtotime($pengajuan['created_at'])) ?> WIB</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light align-middle">Status Saat Ini</th>
                                        <td>
                                            <?php if ($pengajuan['status'] === 'pending') : ?>
                                                <span class="badge bg-warning text-dark py-2 px-3"><i class="bx bx-time-five"></i> Menunggu Verifikasi Admin</span>
                                            <?php elseif ($pengajuan['status'] === 'approved') : ?>
                                                <span class="badge bg-success py-2 px-3"><i class="bx bx-check-circle"></i> Diterima & Terverifikasi</span>
                                                <div class="mt-2 text-success">Nomor Anggota (NIA): <strong><?= esc($pengajuan['nomor_kta']) ?></strong></div>
                                            <?php elseif ($pengajuan['status'] === 'rejected') : ?>
                                                <span class="badge bg-danger py-2 px-3"><i class="bx bx-x-circle"></i> Pengajuan Ditolak</span>
                                                <?php if (! empty($pengajuan['catatan_admin'])): ?>
                                                    <div class="alert alert-warning mt-2 mb-0 small">
                                                        <strong>Catatan Admin:</strong> <?= esc($pengajuan['catatan_admin']) ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Jika Diterima: Tampilkan Pratinjau Kartu + Tombol Unduh PDF & JPG -->
                            <?php if ($pengajuan['status'] === 'approved') : ?>
                                <div class="mt-4 text-center">
                                    <h5 class="mb-3" style="color: #37517e; font-weight: bold;">Pratinjau KTA Digital Anda</h5>

                                    <!-- Area yang akan di-capture menjadi JPG -->
                                    <div id="kta-capture-area" class="kta-preview-wrapper mb-4">

                                        <!-- KARTU DEPAN -->
                                        <div class="kta-card-box kta-front">
                                            <div class="kta-front-wave"></div>
                                            <div class="kta-f-header">
                                                <h6>KARTU TANDA ANGGOTA</h6>
                                                <small>PERGERAKAN MAHASISWA ISLAM INDONESIA</small>
                                            </div>
                                            <?php if (! empty($fotoBase64)) : ?>
                                                <img src="<?= $fotoBase64 ?>" class="kta-f-foto" alt="Foto Kader">
                                            <?php else : ?>
                                                <div class="kta-f-foto d-flex align-items-center justify-content-center text-dark small">NO PHOTO</div>
                                            <?php endif; ?>

                                            <div class="kta-f-data">
                                                <div class="kta-f-nama"><?= esc($pengajuan['nama_lengkap']) ?></div>
                                                <div class="kta-f-nia">NIA. <?= esc($pengajuan['nomor_kta']) ?></div>
                                                <table class="kta-f-table">
                                                    <tr>
                                                        <td width="38%">TTL</td>
                                                        <td>: <?= esc($pengajuan['tempat_lahir']) ?>, <?= date('d M Y', strtotime($pengajuan['tanggal_lahir'])) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Komisariat</td>
                                                        <td>: <?= esc($pengajuan['nama_komisariat']) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rayon</td>
                                                        <td>: <?= esc($pengajuan['rayon'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mapaba</td>
                                                        <td>: <?= esc($pengajuan['tahun_mapaba']) ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="kta-f-footer">Berlaku selama menjadi kader PMII &nbsp;|&nbsp; Taqwa, Intelektual, dan Profesional</div>
                                        </div>

                                        <!-- KARTU BELAKANG -->
                                        <div class="kta-card-box kta-back">
                                            <div class="kta-b-header">Tujuan PMII</div>
                                            <div class="kta-b-tujuan">
                                                "Terbentuknya Pribadi Muslim Indonesia yang Bertaqwa Kepada Allah SWT, Berbudi Luhur, Berilmu, Cakap dan Bertanggungjawab dalam Mengamalkan Ilmunya serta Komitmen Memperjuangkan Cita-Cita Kemerdekaan Indonesia"
                                            </div>
                                            <div class="kta-b-ttd">
                                                <div>Ketua Cabang<br><br><br><strong>Nama Ketua PC</strong><br>NIA. 3205xxxxxxxx</div>
                                                <div>Sekretaris Cabang<br><br><br><strong>Nama Sekretaris PC</strong><br>NIA. 3205xxxxxxxx</div>
                                            </div>
                                            <div class="kta-b-bottom">
                                                <div class="kta-b-aturan">
                                                    <ol>
                                                        <li>Kartu ini adalah identitas keanggotaan resmi kader PMII.</li>
                                                        <li>Dapat digunakan dalam acara resmi organisasi.</li>
                                                        <li>Jika hilang, harap menghubungi PC PMII Garut.</li>
                                                    </ol>
                                                </div>
                                                <div class="kta-b-qr">
                                                    <?php if (! empty($qrBase64)) : ?>
                                                        <img src="<?= $qrBase64 ?>" alt="QR Verifikasi">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Tombol Unduh PDF & JPG -->
                                    <div class="d-flex flex-wrap justify-content-center gap-3">
                                        <a href="<?= base_url('kta/download-pdf/' . $pengajuan['uuid_token']) ?>" class="btn btn-danger px-4 py-2 fw-bold">
                                            <i class="bx bxs-file-pdf me-1"></i> Unduh KTA (PDF)
                                        </a>
                                        <button type="button" id="btn-download-jpg" class="btn btn-success px-4 py-2 fw-bold" style="background-color: #20c997; border-color: #20c997;">
                                            <i class="bx bx-image me-1"></i> Unduh KTA (JPG)
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>
    </section>

</main>

<!-- Script html2canvas untuk konversi pratinjau KTA menjadi file JPG -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnJpg = document.getElementById('btn-download-jpg');
        if (btnJpg) {
            btnJpg.addEventListener('click', function() {
                const target = document.getElementById('kta-capture-area');
                btnJpg.disabled = true;
                btnJpg.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i> Memproses JPG...';

                html2canvas(target, {
                    scale: 3, // Resolusi tinggi agar teks & QR code tajam saat dicetak/dilihat di HP
                    backgroundColor: '#ffffff',
                    useCORS: true
                }).then(function(canvas) {
                    const link = document.createElement('a');
                    link.download = 'KTA_PMII_<?= esc(str_replace('.', '', $pengajuan['nomor_kta'] ?? 'Digital')) ?>.jpg';
                    link.href = canvas.toDataURL('image/jpeg', 0.95);
                    link.click();

                    btnJpg.disabled = false;
                    btnJpg.innerHTML = '<i class="bx bx-image me-1"></i> Unduh KTA (JPG)';
                });
            });
        }
    });
</script>

<?= $this->endSection(); ?>