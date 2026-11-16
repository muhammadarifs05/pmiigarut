<?php

/**
 * @var string $title
 * @var array $site
 * @var array $pengajuan
 */

$toBase64 = static function (array $paths): string {
    foreach ($paths as $path) {
        if (is_file($path)) {
            $mime = mime_content_type($path) ?: 'image/png';
            return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));
        }
    }
    return '';
};

$imgDir      = FCPATH . 'assets/frontend/images/';
$ttdKetuaB64 = $toBase64([$imgDir . 'ttdadrian.png', $imgDir . 'ttdadrian.PNG']);
$ttdSekreB64 = $toBase64([$imgDir . 'ttdrizkizidan.png', $imgDir . 'ttdrizkizidan.PNG']);
$stempelB64  = $toBase64([$imgDir . 'stempel.png', $imgDir . 'stempel.PNG']);

// Cek jika ada file logo resolusi lebih tinggi di folder images/img, fallback ke $logoBase64
$highResLogo = $toBase64([
    $imgDir . 'logo-pmii.png',
    $imgDir . 'logo.png',
    FCPATH . 'assets/frontend/img/logo.png',
]);
$finalLogoB64 = $highResLogo !== '' ? $highResLogo : ($logoBase64 ?? '');

// Hitung dimensi crop proporsional untuk bingkai standar 3:4 (81px x 108px)
$fotoImgStyle = 'width: 100%; height: 100%; max-width: none !important; display: block;';
if (! empty($fotoBase64) && strpos($fotoBase64, 'base64,') !== false) {
    $rawImg = base64_decode(explode('base64,', $fotoBase64, 2)[1]);
    $size   = @getimagesizefromstring($rawImg);
    if ($size && $size[0] > 0 && $size[1] > 0) {
        $boxW   = 78.0;  // 81px - 3px border
        $boxH   = 105.0; // 108px - 3px border
        $ratio  = $size[0] / $size[1];
        $target = 0.75;  // Rasio standar 3:4

        if (abs($ratio - $target) < 0.02) {
            // Jika sudah rasio 3:4, isi penuh bingkai secara presisi
            $fotoImgStyle = 'width: 100%; height: 100%; max-width: none !important; display: block;';
        } elseif ($ratio > $target) {
            $newW = $boxH * $ratio;
            $offX = - ($newW - $boxW) / 2;
            $fotoImgStyle = sprintf('width: %.2fpx; height: %.2fpx; max-width: none !important; margin-left: %.2fpx; display: block;', $newW, $boxH, $offX);
        } else {
            $newH = $boxW / $ratio;
            $offY = - ($newH - $boxH) / 4;
            $fotoImgStyle = sprintf('width: %.2fpx; height: %.2fpx; max-width: none !important; margin-top: %.2fpx; display: block;', $boxW, $newH, $offY);
        }
    }
}

?>
<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<style>
    .kta-preview-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        justify-content: center;
        padding: 24px;
        background: #f1f5f9;
        border-radius: 10px;
    }

    .kta-card-box {
        width: 380px;
        height: 240px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 22px rgba(11, 44, 107, 0.16);
        background: #ffffff;
        font-family: Arial, Helvetica, sans-serif;
        text-align: left;
        flex-shrink: 0;
        box-sizing: border-box;
    }

    .kta-card-box * {
        box-sizing: border-box;
    }

    /* ================= KARTU DEPAN ================= */
    /* ================= KARTU DEPAN ================= */
    .kta-f-header {
        position: absolute;
        top: 0;
        left: 0;
        width: 380px;
        height: 74px;
        background: linear-gradient(135deg, #0a3682 0%, #1565c0 100%);
    }

    .kta-f-logo {
        position: absolute;
        top: 12px;
        left: 18px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 2px solid #ffffff;
        background-color: #082963;
        overflow: hidden;
    }

    .kta-f-logo img {
        width: 100%;
        height: 100%;
        display: block;
    }

    .kta-f-title-group {
        position: absolute;
        top: 0;
        left: 80px;
        width: 284px;
        height: 74px;
    }

    .kta-f-kicker {
        position: absolute;
        top: 10px;
        left: 0;
        font-family: Georgia, 'Times New Roman', serif;
        font-style: italic;
        font-weight: 700;
        font-size: 12.5px;
        color: #f3c430;
        line-height: 1;
        margin: 0;
        padding: 0;
    }

    .kta-f-title {
        position: absolute;
        top: 24px;
        left: 0;
        font-size: 20px;
        font-weight: 800;
        letter-spacing: 1.4px;
        color: #ffffff;
        line-height: 1;
        margin: 0;
        padding: 0;
    }

    .kta-f-sub {
        position: absolute;
        top: 47px;
        left: 0;
        font-size: 7.3px;
        font-weight: 700;
        letter-spacing: 0.65px;
        color: #ffffff;
        line-height: 1;
        margin: 0;
        padding: 0;
    }

    .kta-f-cabang {
        position: absolute;
        top: 57px;
        left: 0;
        font-size: 8.3px;
        font-weight: 700;
        letter-spacing: 2px;
        color: #f3c430;
        line-height: 1;
        margin: 0;
        padding: 0;
    }

    .kta-f-cabang-line {
        display: inline-block;
        width: 18px;
        height: 1px;
        background: #f3c430;
        vertical-align: middle;
    }

    .kta-f-cabang-text {
        display: inline-block;
        margin: 0 5px;
        vertical-align: middle;
    }

    /* Foto & Blok Biodata dibuat sejajar presisi (top: 86px, tinggi: 108px) */
    .kta-f-foto {
        position: absolute;
        top: 86px;
        left: 18px;
        width: 81px;
        height: 108px;
        border: 1.5px solid #1565c0;
        border-radius: 6px;
        background-color: #eaf1fb;
        overflow: hidden;
        text-align: center;
        font-size: 8.5px;
        font-weight: 700;
        color: #0c44a6;
    }

    .kta-f-foto-empty {
        padding-top: 43px;
        line-height: 1.3;
    }

    .kta-f-bio {
        position: absolute;
        top: 85px;
        left: 112px;
        right: 16px;
    }

    .kta-f-nama {
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 15.5px;
        font-weight: 700;
        color: #0b2c6b;
        line-height: 1.1;
    }

    .kta-f-nia {
        font-size: 9.8px;
        font-weight: 700;
        color: #1565c0;
        margin-top: 2px;
        letter-spacing: 0.5px;
        line-height: 1.15;
    }

    .kta-f-nia span {
        color: #c59b27;
        margin-right: 4px;
    }

    .kta-f-divider {
        height: 1px;
        background: #d4af37;
        margin: 5px 0;
    }

    .kta-f-table {
        width: 100%;
        font-size: 8.4px;
        border-collapse: collapse;
    }

    .kta-f-table td {
        padding: 1.8px 0;
        vertical-align: top;
    }

    .kta-f-lbl {
        width: 68px;
        font-size: 7.1px;
        font-weight: 700;
        color: #6c7a9c;
        letter-spacing: 0.5px;
    }

    .kta-f-val {
        color: #1e293b;
        line-height: 1.2;
    }

    .kta-f-val-bold {
        font-weight: 700;
        color: #0b2c6b;
    }

    .kta-f-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 380px;
        height: 22px;
        background: linear-gradient(90deg, #0a3682 0%, #1565c0 100%);
        border-top: 2px solid #f3c430;
    }

    .kta-f-footer-l {
        position: absolute;
        top: 6px;
        left: 18px;
        font-size: 6.8px;
        color: #ffffff;
        font-weight: 600;
        letter-spacing: 0.2px;
        line-height: 1;
    }

    .kta-f-footer-r {
        position: absolute;
        top: 5px;
        right: 18px;
        font-family: Georgia, 'Times New Roman', serif;
        font-style: italic;
        font-weight: 700;
        font-size: 8px;
        color: #f3c430;
        line-height: 1;
    }

    /* ================= KARTU BELAKANG ================= */
    .kta-b-header {
        position: absolute;
        top: 0;
        left: 0;
        width: 380px;
        height: 30px;
        background: linear-gradient(90deg, #0a3682 0%, #1565c0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .kta-b-header-logo {
        width: 19px;
        height: 19px;
        border-radius: 50%;
        border: 1px solid #ffffff;
        overflow: hidden;
        margin-right: 8px;
        flex-shrink: 0;
    }

    .kta-b-header-logo img {
        width: 100%;
        height: 100%;
        display: block;
    }

    .kta-b-header-text {
        color: #ffffff;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.2px;
        line-height: 1;
    }

    .kta-b-tujuan-box {
        position: absolute;
        top: 37px;
        left: 18px;
        right: 18px;
        text-align: center;
    }

    .kta-b-title {
        font-family: Georgia, 'Times New Roman', serif;
        font-style: italic;
        font-weight: 700;
        font-size: 14px;
        color: #0b2c6b;
        line-height: 1.1;
    }

    .kta-b-line {
        width: 34px;
        height: 1.5px;
        background: #f3c430;
        margin: 3px auto 5px auto;
    }

    .kta-b-tujuan {
        font-size: 7.7px;
        color: #334155;
        line-height: 1.36;
    }

    .kta-b-tujuan strong {
        color: #0b2c6b;
    }

    .kta-b-ttd-area {
        position: absolute;
        top: 99px;
        left: 24px;
        right: 24px;
    }

    .kta-b-ttd-table {
        width: 100%;
        border-collapse: collapse;
    }

    .kta-b-ttd-table td {
        width: 33.33%;
        text-align: center;
        vertical-align: bottom;
    }

    .kta-b-sign-space {
        height: 30px;
        margin-bottom: -4px;
        text-align: center;
    }

    .kta-b-sign-space img {
        height: 30px;
        width: auto;
    }

    .kta-b-sign-name {
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 9px;
        font-weight: 700;
        color: #0b2c6b;
        text-decoration: underline;
    }

    .kta-b-sign-role {
        font-size: 6px;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 1.1px;
        margin-top: 1px;
    }

    .kta-b-stamp-img {
        height: 38px;
        width: auto;
        vertical-align: middle;
    }

    .kta-b-ketentuan {
        position: absolute;
        bottom: 15px;
        left: 16px;
        width: 280px;
        text-align: left;
    }

    .kta-b-ketentuan-title {
        font-size: 7px;
        font-weight: 700;
        color: #c59b27;
        letter-spacing: 0.8px;
        margin-bottom: 1.5px;
    }

    .kta-b-ketentuan-list {
        font-size: 6.3px;
        color: #334155;
        line-height: 1.34;
    }

    .kta-b-qr {
        position: absolute;
        bottom: 15px;
        right: 16px;
        width: 42px;
        height: 42px;
        border: 1.5px solid #0c44a6;
        border-radius: 6px;
        padding: 2px;
        background: #ffffff;
    }

    .kta-b-qr img {
        width: 35px;
        height: 35px;
        display: block;
    }

    .kta-b-footer {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 380px;
        height: 12px;
        background: linear-gradient(90deg, #0a3682 0%, #1565c0 100%);
    }
</style>

<main id="main">

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
        <div class="container">

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
                                        <th class="bg-light">Komisariat</th>
                                        <td><?= esc($pengajuan['kampus_fakultas'] ?? '-') ?></td>
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
                                <?php
                                $kampusOnly = ! empty($pengajuan['kampus_fakultas']) ? esc($pengajuan['kampus_fakultas']) : esc($pengajuan['nama_komisariat'] ?? '-');
                                $alamatText = ! empty($pengajuan['alamat']) ? esc($pengajuan['alamat']) : 'Kab. Garut';
                                ?>
                                <div class="mt-4 text-center">
                                    <h5 class="mb-3" style="color: #37517e; font-weight: bold;">Pratinjau KTA Digital Anda</h5>

                                    <div id="kta-capture-area" class="kta-preview-wrapper mb-4">

                                        <!-- KARTU DEPAN -->
                                        <div id="kta-card-front" class="kta-card-box">
                                            <div class="kta-f-header">
                                                <?php if ($finalLogoB64 !== '') : ?>
                                                    <div class="kta-f-logo">
                                                        <img src="<?= $finalLogoB64 ?>" alt="Logo PMII">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="kta-f-title-group">
                                                    <div class="kta-f-kicker">Kartu Tanda</div>
                                                    <div class="kta-f-title">ANGGOTA</div>
                                                    <div class="kta-f-sub">PERGERAKAN MAHASISWA ISLAM INDONESIA</div>
                                                    <div class="kta-f-cabang">
                                                        <span class="kta-f-cabang-line"></span><span class="kta-f-cabang-text">KABUPATEN GARUT</span><span class="kta-f-cabang-line"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="kta-f-foto">
                                                <?php if (! empty($fotoBase64)) : ?>
                                                    <img src="<?= $fotoBase64 ?>" style="<?= $fotoImgStyle ?>" alt="Foto Kader">
                                                <?php else : ?>
                                                    <div class="kta-f-foto-empty">FOTO 3x4<br>Jas PMII</div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="kta-f-bio">
                                                <div class="kta-f-nama"><?= esc($pengajuan['nama_lengkap']) ?></div>
                                                <div class="kta-f-nia"><span>NIA</span> <?= esc($pengajuan['nomor_kta']) ?></div>
                                                <div class="kta-f-divider"></div>
                                                <table class="kta-f-table">
                                                    <tr>
                                                        <td class="kta-f-lbl">TTL</td>
                                                        <td class="kta-f-val"><?= esc($pengajuan['tempat_lahir']) ?>, <?= date('d F Y', strtotime($pengajuan['tanggal_lahir'])) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="kta-f-lbl">ALAMAT</td>
                                                        <td class="kta-f-val"><?= $alamatText ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="kta-f-lbl">KOMISARIAT</td>
                                                        <td class="kta-f-val kta-f-val-bold"><?= $kampusOnly ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="kta-f-lbl">RAYON</td>
                                                        <td class="kta-f-val"><?= esc(! empty($pengajuan['rayon']) ? $pengajuan['rayon'] : '-') ?></td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="kta-f-footer">
                                                <span class="kta-f-footer-l">Berlaku selama menjadi kader PMII</span>
                                                <span class="kta-f-footer-r">Dzikir, Fikir dan Amal Sholeh</span>
                                            </div>
                                        </div>

                                        <!-- KARTU BELAKANG -->
                                        <div id="kta-card-back" class="kta-card-box">
                                            <div class="kta-b-header">
                                                <?php if ($finalLogoB64 !== '') : ?>
                                                    <div class="kta-b-header-logo">
                                                        <img src="<?= $finalLogoB64 ?>" alt="Logo">
                                                    </div>
                                                <?php endif; ?>
                                                <span class="kta-b-header-text">PMII CABANG KABUPATEN GARUT</span>
                                            </div>

                                            <div class="kta-b-tujuan-box">
                                                <div class="kta-b-title">Tujuan PMII</div>
                                                <div class="kta-b-line"></div>
                                                <div class="kta-b-tujuan">
                                                    Terbentuknya Pribadi Muslim Indonesia yang <strong>Bertaqwa</strong> Kepada Allah SWT,
                                                    <strong>Berbudi Luhur</strong>, <strong>Berilmu</strong>, <strong>Cakap</strong> dan
                                                    <strong>Bertanggungjawab</strong> dalam Mengamalkan Ilmunya serta Komitmen
                                                    Memperjuangkan Cita-Cita Kemerdekaan Indonesia
                                                </div>
                                            </div>

                                            <div class="kta-b-ttd-area">
                                                <table class="kta-b-ttd-table">
                                                    <tr>
                                                        <td>
                                                            <div class="kta-b-sign-space">
                                                                <?php if ($ttdKetuaB64 !== '') : ?>
                                                                    <img src="<?= $ttdKetuaB64 ?>" alt="TTD Ketua">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="kta-b-sign-name">Adrian Hidayat</div>
                                                            <div class="kta-b-sign-role">KETUA</div>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <?php if ($stempelB64 !== '') : ?>
                                                                <img src="<?= $stempelB64 ?>" class="kta-b-stamp-img" alt="Stempel PC">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="kta-b-sign-space">
                                                                <?php if ($ttdSekreB64 !== '') : ?>
                                                                    <img src="<?= $ttdSekreB64 ?>" alt="TTD Sekretaris">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="kta-b-sign-name">Rizky Zidan</div>
                                                            <div class="kta-b-sign-role">SEKRETARIS</div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="kta-b-ketentuan">
                                                <div class="kta-b-ketentuan-title">KETENTUAN</div>
                                                <div class="kta-b-ketentuan-list">
                                                    1. Kartu ini adalah identitas keanggotaan resmi kader PMII Kabupaten Garut<br>
                                                    2. Kartu ini dapat digunakan dalam acara-acara resmi organisasi<br>
                                                    3. Jika kartu ini hilang, harap menghubungi sekretaris PC PMII Kabupaten Garut<br>
                                                    4. Apabila menyalahgunakan kartu ini, akan dikenakan sanksi organisasi
                                                </div>
                                            </div>

                                            <div class="kta-b-qr">
                                                <?php if (! empty($qrBase64)) : ?>
                                                    <img src="<?= $qrBase64 ?>" alt="QR Verifikasi">
                                                <?php endif; ?>
                                            </div>

                                            <div class="kta-b-footer"></div>
                                        </div>

                                    </div>

                                    <!-- Tombol Unduh PDF & JPG -->
                                    <div class="d-flex flex-wrap justify-content-center gap-3">
                                        <button type="button" id="btn-download-pdf" class="btn btn-danger px-4 py-2 fw-bold">
                                            <i class="bx bxs-file-pdf me-1"></i> Unduh KTA (PDF)
                                        </button>
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

<!-- Library html2canvas & jsPDF -->
<!-- Library html2canvas & jsPDF -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnJpg = document.getElementById('btn-download-jpg');
        const btnPdf = document.getElementById('btn-download-pdf');
        const fileBaseName = 'KTA_PMII_<?= esc(str_replace('.', '', $pengajuan['nomor_kta'] ?? 'Digital')) ?>';

        // Penyesuaian jarak antarbaris header khusus pada hasil render unduhan (JPG & PDF)
        function tuneExportHeader(clonedDoc) {
            const kicker = clonedDoc.querySelector('.kta-f-kicker');
            const title = clonedDoc.querySelector('.kta-f-title');
            const sub = clonedDoc.querySelector('.kta-f-sub');
            const cabang = clonedDoc.querySelector('.kta-f-cabang');

            if (kicker) kicker.style.top = '10px';
            if (title) title.style.top = '25.5px';
            if (sub) sub.style.top = '44.5px';
            if (cabang) cabang.style.top = '55px';
        }

        if (btnJpg) {
            btnJpg.addEventListener('click', function() {
                const target = document.getElementById('kta-capture-area');
                const defaultLabel = '<i class="bx bx-image me-1"></i> Unduh KTA (JPG)';

                btnJpg.disabled = true;
                btnJpg.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i> Memproses JPG...';

                html2canvas(target, {
                    scale: 4,
                    backgroundColor: '#f1f5f9',
                    scrollX: 0,
                    scrollY: -window.scrollY,
                    logging: false,
                    onclone: function(clonedDoc) {
                        const clonedArea = clonedDoc.getElementById('kta-capture-area');
                        if (clonedArea) {
                            clonedArea.style.width = '832px';
                            clonedArea.style.flexWrap = 'nowrap';
                            clonedArea.style.padding = '24px';
                            clonedArea.style.margin = '0';
                        }
                        tuneExportHeader(clonedDoc);
                    }
                }).then(function(canvas) {
                    const link = document.createElement('a');
                    link.download = fileBaseName + '.jpg';
                    link.href = canvas.toDataURL('image/jpeg', 0.98);
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }).finally(function() {
                    btnJpg.disabled = false;
                    btnJpg.innerHTML = defaultLabel;
                });
            });
        }

        if (btnPdf) {
            btnPdf.addEventListener('click', async function() {
                const cardFront = document.getElementById('kta-card-front');
                const cardBack = document.getElementById('kta-card-back');
                const defaultLabel = '<i class="bx bxs-file-pdf me-1"></i> Unduh KTA (PDF)';

                btnPdf.disabled = true;
                btnPdf.innerHTML = '<i class="bx bxs-file-pdf me-1"></i> Memproses PDF...';

                try {
                    const opts = {
                        scale: 4,
                        backgroundColor: '#ffffff',
                        scrollX: 0,
                        scrollY: -window.scrollY,
                        logging: false,
                        onclone: function(clonedDoc) {
                            tuneExportHeader(clonedDoc);
                        }
                    };

                    const canvasFront = await html2canvas(cardFront, opts);
                    const canvasBack = await html2canvas(cardBack, opts);

                    const {
                        jsPDF
                    } = window.jspdf;
                    const pdf = new jsPDF({
                        orientation: 'landscape',
                        unit: 'mm',
                        format: [85.6, 53.98]
                    });

                    pdf.addImage(canvasFront.toDataURL('image/png'), 'PNG', 0, 0, 85.6, 53.98);
                    pdf.addPage([85.6, 53.98], 'landscape');
                    pdf.addImage(canvasBack.toDataURL('image/png'), 'PNG', 0, 0, 85.6, 53.98);

                    pdf.save(fileBaseName + '.pdf');
                } catch (e) {
                    window.location.href = '<?= base_url('kta/download-pdf/' . ($pengajuan['uuid_token'] ?? '')) ?>';
                } finally {
                    btnPdf.disabled = false;
                    btnPdf.innerHTML = defaultLabel;
                }
            });
        }
    });
</script>

<?= $this->endSection(); ?>