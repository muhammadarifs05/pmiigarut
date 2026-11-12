<?php

/**
 * @var array $kader
 */
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        /* Ukuran CR80 presisi: 85.6mm x 53.98mm (Landscape) */
        @page {
            margin: 0px;
            size: 242.64pt 153.00pt landscape;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Halaman KTA (Bisa dicetak 2 muka) */
        .card-page {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
            page-break-after: always;
        }

        .card-page:last-child {
            page-break-after: avoid;
        }

        /* --- DESAIN BAGIAN DEPAN --- */
        .front-bg {
            background-color: #0d47a1;
            color: #fff;
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: -1;
        }

        /* Garis lengkung/aksen (opsional jika tidak pakai background gambar) */
        .accent-wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 20px;
            background-color: #1976d2;
        }

        /* Layout Depan */
        .f-header {
            padding: 8px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .f-header-title {
            font-size: 11px;
            font-weight: bold;
            text-align: right;
            color: #fff;
            margin-top: 4px;
        }

        .f-body {
            padding: 10px;
        }

        .f-foto {
            position: absolute;
            top: 35px;
            left: 10px;
            width: 55px;
            height: 70px;
            border: 1px solid #fff;
            border-radius: 4px;
            object-fit: cover;
            background: #fff;
        }

        .f-data {
            position: absolute;
            top: 35px;
            left: 75px;
            right: 10px;
        }

        .f-nama {
            font-size: 10px;
            font-weight: bold;
            color: #fff;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .f-nia {
            font-size: 8px;
            color: #ffd700;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .f-table {
            width: 100%;
            font-size: 7px;
            color: #fff;
            border-collapse: collapse;
        }

        .f-table td {
            padding: 1px 0;
            vertical-align: top;
        }

        .f-label {
            width: 35%;
        }

        .f-footer {
            position: absolute;
            bottom: 4px;
            left: 0;
            width: 100%;
            font-size: 5px;
            text-align: center;
            color: #fff;
            font-style: italic;
        }

        /* --- DESAIN BAGIAN BELAKANG --- */
        .back-bg {
            background-color: #ffffff;
            color: #000;
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: -1;
        }

        .back-header {
            background-color: #0d47a1;
            color: #fff;
            padding: 5px;
            text-align: center;
            font-size: 9px;
            font-weight: bold;
        }

        .b-tujuan {
            padding: 8px;
            text-align: center;
            font-size: 6px;
            line-height: 1.2;
        }

        /* Tanda Tangan */
        .b-ttd-container {
            width: 100%;
            margin-top: 2px;
        }

        .b-ttd-box {
            width: 50%;
            float: left;
            text-align: center;
            font-size: 6px;
        }

        .b-ttd-box strong {
            font-size: 6.5px;
            text-decoration: underline;
        }

        /* Aturan & QR */
        .b-bottom {
            position: absolute;
            bottom: 8px;
            left: 8px;
            right: 8px;
        }

        .b-aturan {
            width: 70%;
            float: left;
            font-size: 5px;
            line-height: 1.3;
        }

        .b-aturan ol {
            margin: 0;
            padding-left: 10px;
        }

        .b-qr {
            width: 30%;
            float: right;
            text-align: right;
        }

        .b-qr img {
            width: 35px;
            height: 35px;
        }
    </style>
</head>

<body>

    <!-- HALAMAN DEPAN -->
    <div class="card-page">
        <div class="front-bg"></div>
        <div class="accent-wave"></div>

        <div class="f-header">
            <div class="f-header-title">KARTU TANDA ANGGOTA<br><span style="font-size: 6px; font-weight: normal;">PERGERAKAN MAHASISWA ISLAM INDONESIA</span></div>
        </div>

        <div class="f-body">
            <!-- FOTO KADER -->
            <?php if (!empty($fotoBase64)): ?>
                <img src="<?= $fotoBase64 ?>" class="f-foto">
            <?php else: ?>
                <div class="f-foto" style="background: #ccc; text-align: center; line-height: 70px; font-size: 6px; color:#000;">NO PHOTO</div>
            <?php endif; ?>

            <!-- DATA KADER -->
            <div class="f-data">
                <div class="f-nama"><?= esc($kader['nama_lengkap']) ?></div>
                <div class="f-nia">NIA. <?= esc($kader['nomor_kta']) ?></div>

                <table class="f-table">
                    <tr>
                        <td class="f-label">TTL</td>
                        <td>: <?= esc($kader['tempat_lahir']) ?>, <?= date('d M Y', strtotime($kader['tanggal_lahir'])) ?></td>
                    </tr>
                    <tr>
                        <td class="f-label">Komisariat</td>
                        <td>: <?= esc($kader['nama_komisariat']) ?></td>
                    </tr>
                    <tr>
                        <td class="f-label">Rayon</td>
                        <td>: <?= esc($kader['rayon'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td class="f-label">Tahun Mapaba</td>
                        <td>: <?= esc($kader['tahun_mapaba']) ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="f-footer">
            Berlaku selama menjadi kader PMII &nbsp;&nbsp;|&nbsp;&nbsp; Taqwa, Intelektual, dan Profesional
        </div>
    </div>

    <!-- HALAMAN BELAKANG -->
    <div class="card-page">
        <div class="back-bg"></div>

        <div class="back-header">Tujuan PMII</div>

        <div class="b-tujuan">
            "Terbentuknya Pribadi Muslim Indonesia yang Bertaqwa Kepada Allah SWT,<br>
            Berbudi Luhur, Berilmu, Cakap dan Bertanggungjawab dalam Mengamalkan Ilmunya<br>
            serta Komitmen Memperjuangkan Cita-Cita Kemerdekaan Indonesia"
        </div>

        <div class="b-ttd-container">
            <div class="b-ttd-box">
                Ketua Cabang<br><br><br>
                <strong>Nama Ketua PC</strong><br>
                NIA. xxxxxxxx
            </div>
            <div class="b-ttd-box">
                Sekretaris Cabang<br><br><br>
                <strong>Nama Sekretaris PC</strong><br>
                NIA. xxxxxxxx
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="b-bottom">
            <div class="b-aturan">
                <ol>
                    <li>Kartu ini adalah identitas keanggotaan resmi kader PMII.</li>
                    <li>Kartu ini dapat digunakan dalam acara resmi organisasi.</li>
                    <li>Jika kartu ini hilang, harap menghubungi sekretaris PC PMII.</li>
                    <li>Apabila menyalahgunakan kartu ini, akan dikenakan sanksi.</li>
                </ol>
            </div>
            <div class="b-qr">
                <!-- QR CODE UNTUK VERIFIKASI KEASLIAN -->
                <?php if (!empty($qrBase64)): ?>
                    <img src="<?= $qrBase64 ?>">
                <?php endif; ?>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

</body>

</html>