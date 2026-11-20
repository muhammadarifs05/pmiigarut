<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
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

$pengajuanData = $pengajuan ?? null;
$nimInputValue = $nim_input ?? '';
$tglInputValue = $tgl_input ?? '';
?>

<style>
    .kta-preview-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        justify-content: center;
        align-items: center;
        padding: 16px;
        background: #f2f3ff;
        border-radius: 14px;
        overflow: hidden;
    }

    @media (min-width: 640px) {
        .kta-preview-wrapper {
            gap: 24px;
            padding: 24px;
        }
    }

    .kta-card-scaler {
        width: 380px;
        height: 240px;
        position: relative;
        flex-shrink: 0;
    }

    .kta-card-box {
        width: 380px;
        height: 240px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 22px rgba(11, 44, 107, 0.16);
        background: #ffffff;
        font-family: Arial, Helvetica, sans-serif !important;
        text-align: left !important;
        flex-shrink: 0;
        box-sizing: border-box;
        line-height: normal !important;
        transform-origin: top left;
    }

    .kta-card-box * {
        box-sizing: border-box;
    }

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
        font-family: Georgia, 'Times New Roman', serif !important;
        font-style: italic;
        font-weight: 700;
        font-size: 12.5px;
        color: #f3c430;
        line-height: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .kta-f-title {
        position: absolute;
        top: 24px;
        left: 0;
        font-size: 20px;
        font-weight: 800;
        letter-spacing: 1.4px;
        color: #ffffff;
        line-height: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .kta-f-sub {
        position: absolute;
        top: 47px;
        left: 0;
        font-size: 7.3px;
        font-weight: 700;
        letter-spacing: 0.65px;
        color: #ffffff;
        line-height: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .kta-f-cabang {
        position: absolute;
        top: 57px;
        left: 0;
        font-size: 8.3px;
        font-weight: 700;
        letter-spacing: 2px;
        color: #f3c430;
        line-height: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
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
        top: 84px;
        left: 112px;
        right: 16px;
    }

    .kta-f-nama {
        font-family: Georgia, 'Times New Roman', serif !important;
        font-size: 15.5px;
        font-weight: 700;
        color: #0b2c6b;
        line-height: 1.15 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .kta-f-nia {
        font-size: 9.8px;
        font-weight: 700;
        color: #1565c0;
        margin: 2px 0 0 0 !important;
        padding: 0 !important;
        letter-spacing: 0.5px;
        line-height: 1.15 !important;
    }

    .kta-f-nia span {
        color: #c59b27;
        margin-right: 4px;
    }

    .kta-f-divider {
        height: 1px;
        background: #d4af37;
        margin: 5px 0 !important;
        padding: 0 !important;
    }

    .kta-f-table,
    .kta-f-table tbody,
    .kta-f-table tr {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        border: 0 !important;
        border-collapse: collapse !important;
        background: transparent !important;
    }

    .kta-f-table td {
        padding: 1.6px 0 !important;
        margin: 0 !important;
        border: 0 !important;
        background: transparent !important;
        vertical-align: baseline !important;
        font-family: Arial, Helvetica, sans-serif !important;
        line-height: 1.25 !important;
    }

    .kta-f-lbl {
        width: 62px !important;
        padding-right: 6px !important;
        font-size: 7.4px !important;
        font-weight: 700 !important;
        color: #6c7a9c !important;
        letter-spacing: 0.4px !important;
        text-transform: uppercase !important;
    }

    .kta-f-val {
        font-size: 8.3px !important;
        font-weight: 500 !important;
        color: #1e293b !important;
        line-height: 1.25 !important;
    }

    .kta-f-val-bold {
        font-size: 8.3px !important;
        font-weight: 700 !important;
        color: #0b2c6b !important;
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
        line-height: 1 !important;
    }

    .kta-f-footer-r {
        position: absolute;
        top: 5px;
        right: 18px;
        font-family: Georgia, 'Times New Roman', serif !important;
        font-style: italic;
        font-weight: 700;
        font-size: 8px;
        color: #f3c430;
        line-height: 1 !important;
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
        line-height: 1 !important;
    }

    .kta-b-tujuan-box {
        position: absolute;
        top: 37px;
        left: 18px;
        right: 18px;
        text-align: center !important;
    }

    .kta-b-title {
        font-family: Georgia, 'Times New Roman', serif !important;
        font-style: italic;
        font-weight: 700;
        font-size: 14px;
        color: #0b2c6b;
        line-height: 1.1 !important;
    }

    .kta-b-line {
        width: 34px;
        height: 1.5px;
        background: #f3c430;
        margin: 3px auto 5px auto !important;
    }

    .kta-b-tujuan {
        font-size: 7.7px;
        color: #334155;
        line-height: 1.36 !important;
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

    .kta-b-ttd-table,
    .kta-b-ttd-table tbody,
    .kta-b-ttd-table tr {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        border: 0 !important;
        border-collapse: collapse !important;
        background: transparent !important;
    }

    .kta-b-ttd-table td {
        width: 33.33% !important;
        padding: 0 !important;
        margin: 0 !important;
        border: 0 !important;
        background: transparent !important;
        text-align: center !important;
        vertical-align: bottom !important;
    }

    .kta-b-sign-space {
        height: 30px;
        margin-bottom: -4px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .kta-b-sign-space img {
        height: 30px;
        width: auto;
        margin: 0 auto !important;
        display: block !important;
    }

    .kta-b-sign-name {
        font-family: Georgia, 'Times New Roman', serif !important;
        font-size: 9px;
        font-weight: 700;
        color: #0b2c6b;
        text-decoration: underline;
        line-height: 1.2 !important;
    }

    .kta-b-sign-role {
        font-size: 6px;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 1.1px;
        margin-top: 1px;
        line-height: 1.1 !important;
    }

    .kta-b-stamp-img {
        height: 38px;
        width: auto;
        margin: 0 auto !important;
        display: block !important;
    }

    .kta-b-ketentuan {
        position: absolute;
        bottom: 15px;
        left: 16px;
        width: 280px;
        text-align: left !important;
    }

    .kta-b-ketentuan-title {
        font-size: 7px;
        font-weight: 700;
        color: #c59b27;
        letter-spacing: 0.8px;
        margin-bottom: 1.5px;
        line-height: 1.1 !important;
    }

    .kta-b-ketentuan-list {
        font-size: 6.3px;
        color: #334155;
        line-height: 1.34 !important;
    }

    .kta-b-qr {
        position: absolute;
        bottom: 15px;
        right: 16px;
        width: 44px;
        height: 44px;
        border: 1.5px solid #0c44a6;
        border-radius: 6px;
        padding: 3px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .kta-b-qr img {
        width: 100% !important;
        height: 100% !important;
        object-fit: contain !important;
        display: block !important;
        image-rendering: pixelated;
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

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">

        <!-- Breadcrumb & Sub-Header Strip -->
        <!-- <section class="w-full bg-surface-container-low border-b border-outline-variant/30">
            <div class="max-w-7xl mx-auto px-gutter py-space-md flex flex-col sm:flex-row sm:items-center sm:justify-between gap-space-xs">
                <nav aria-label="Breadcrumb" class="flex items-center gap-space-xs font-body-sm text-body-sm text-on-surface-variant">
                    <span class="text-primary font-label-sm">Cek Status KTA</span>
                </nav>
            </div>
        </section> -->

        <!-- Hero Header Block -->
        <section class="w-full pt-space-xl pb-space-lg" data-aos="fade-up">
            <div class="max-w-4xl mx-auto px-gutter text-center flex flex-col items-center">
                <span class="inline-flex items-center font-label-xs text-label-xs tracking-wider uppercase bg-primary-fixed text-primary px-space-md py-1 rounded-full mb-space-sm font-bold">
                    LACAK PENGAJUAN
                </span>
                <h2 class="font-headline-xl text-3xl sm:text-4xl lg:text-headline-xl text-on-surface font-extrabold tracking-tight leading-tight m-0">
                    Cek Status &amp; Unduh <span class="relative inline-block text-primary">KTA Digital<span class="absolute left-0 -bottom-1.5 w-full h-1 bg-secondary-container rounded-full"></span></span>
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mt-space-md mb-0">
                    Masukkan <strong class="text-on-surface">NIM</strong> dan <strong class="text-on-surface">Tanggal Lahir</strong> Anda untuk memantau progres verifikasi atau mengunduh KTA Digital resmi PC PMII Kab. Garut.
                </p>
            </div>
        </section>

        <!-- Main Verification Card Component -->
        <section class="w-full pb-space-xl" data-aos="fade-up" data-aos-delay="60">
            <div class="max-w-5xl mx-auto px-gutter">
                <div class="relative bg-surface-container-lowest rounded-2xl shadow-md p-space-md md:p-space-lg border border-outline-variant/30 overflow-hidden">
                    <!-- Top institutional decorative bar -->
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-primary via-primary-container to-secondary-container"></div>

                    <!-- Error Alert -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="mt-space-xs mb-space-md p-space-md rounded-xl bg-error-container text-on-error-container font-body-sm text-body-sm flex items-center gap-space-sm">
                            <span class="material-symbols-outlined text-error text-[20px] shrink-0">error</span>
                            <span><?= esc(session()->getFlashdata('error')); ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Search / Verification Form -->
                    <form id="cekStatusKtaForm" action="<?= base_url('kta/cek-status'); ?>" method="post" autocomplete="off" class="grid grid-cols-1 md:grid-cols-12 gap-space-md items-end pt-space-xs">
                        <?= csrf_field(); ?>

                        <div class="md:col-span-5 flex flex-col gap-1.5">
                            <label for="nim" class="font-label-sm text-label-sm text-on-surface-variant font-semibold">NIM / NPM</label>
                            <input type="text"
                                id="nim"
                                name="nim"
                                maxlength="30"
                                autocomplete="off"
                                value="<?= esc($nimInputValue); ?>"
                                placeholder="Masukkan NIM/NPM Anda"
                                required
                                class="w-full h-11 px-space-md rounded-lg bg-surface-container-low text-on-surface font-body-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container border border-outline-variant/30 transition-all" />
                        </div>

                        <div class="md:col-span-4 flex flex-col gap-1.5">
                            <label for="tanggal_lahir" class="font-label-sm text-label-sm text-on-surface-variant font-semibold">Tanggal Lahir</label>
                            <input type="date"
                                id="tanggal_lahir"
                                name="tanggal_lahir"
                                autocomplete="off"
                                value="<?= esc($tglInputValue); ?>"
                                required
                                class="w-full h-11 px-space-md rounded-lg bg-surface-container-low text-on-surface font-body-md focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container border border-outline-variant/30 transition-all" />
                        </div>

                        <div class="md:col-span-3">
                            <button type="submit"
                                class="w-full h-11 rounded-lg bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md font-semibold inline-flex items-center justify-center gap-space-xs shadow-sm hover:shadow transition-all border-0 cursor-pointer active:scale-95">
                                <span class="material-symbols-outlined text-[18px]">search</span>
                                <span>Cek Status</span>
                            </button>
                        </div>
                    </form>

                    <!-- Hasil Pencarian -->
                    <?php if ($pengajuanData) : ?>
                        <div id="hasil-pencarian-kta" class="mt-space-lg pt-space-lg border-t border-outline-variant/30">

                            <!-- Information Pengajuan Table Section -->
                            <div class="mb-space-lg">
                                <div class="flex flex-wrap items-center justify-between gap-2 mb-space-sm">
                                    <h3 class="font-title-sm text-title-sm text-on-surface font-bold m-0">Informasi Pengajuan KTA</h3>
                                    <span class="font-label-xs text-label-xs text-on-surface-variant bg-surface-container px-2.5 py-1 rounded-full">Sistem Validasi Kader</span>
                                </div>

                                <div class="rounded-xl overflow-hidden border border-outline-variant/30 bg-surface-container-low">
                                    <div class="grid grid-cols-1 md:grid-cols-12 px-space-md py-3.5 gap-1 md:gap-2 items-center">
                                        <span class="md:col-span-4 font-label-md text-[13px] md:text-label-md text-on-surface-variant font-medium">Nama Pemohon</span>
                                        <span class="md:col-span-8 font-title-sm text-title-sm text-on-surface font-semibold"><?= esc($pengajuanData['nama_lengkap']); ?></span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-12 px-space-md py-3.5 gap-1 md:gap-2 items-center bg-surface-container-lowest">
                                        <span class="md:col-span-4 font-label-md text-[13px] md:text-label-md text-on-surface-variant font-medium">Komisariat</span>
                                        <span class="md:col-span-8 font-body-md text-body-md text-on-surface"><?= esc($pengajuanData['kampus_fakultas'] ?: ($pengajuanData['nama_komisariat'] ?? '-')); ?></span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-12 px-space-md py-3.5 gap-1 md:gap-2 items-center">
                                        <span class="md:col-span-4 font-label-md text-[13px] md:text-label-md text-on-surface-variant font-medium">Tanggal Pengajuan</span>
                                        <span class="md:col-span-8 font-body-md text-body-md text-on-surface"><?= date('d M Y H:i', strtotime($pengajuanData['created_at'])); ?> WIB</span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-12 px-space-md py-3.5 gap-1.5 md:gap-2 bg-surface-container-lowest items-start">
                                        <span class="md:col-span-4 font-label-md text-[13px] md:text-label-md text-on-surface-variant font-medium md:pt-1">Status Saat Ini</span>
                                        <div class="md:col-span-8 flex flex-col gap-1.5 items-start">
                                            <?php if ($pengajuanData['status'] === 'pending') : ?>
                                                <span class="inline-flex items-center gap-1.5 bg-amber-400 text-slate-900 px-3 py-1 rounded text-[12px] font-semibold">
                                                    <span class="material-symbols-outlined text-[16px]">schedule</span>
                                                    <span>Menunggu Verifikasi Admin</span>
                                                </span>
                                            <?php elseif ($pengajuanData['status'] === 'approved') : ?>
                                                <span class="inline-flex items-center gap-1.5 bg-[#007038] text-white px-3 py-1 rounded text-[12px] font-semibold tracking-wide">
                                                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                                    <span>Diterima &amp; Terverifikasi</span>
                                                </span>
                                                <span class="font-label-sm text-label-sm font-bold text-primary">
                                                    Nomor Anggota (NIA): <?= esc($pengajuanData['nomor_kta']); ?>
                                                </span>
                                            <?php elseif ($pengajuanData['status'] === 'rejected') : ?>
                                                <span class="inline-flex items-center gap-1.5 bg-error text-on-error px-3 py-1 rounded text-[12px] font-semibold">
                                                    <span class="material-symbols-outlined text-[16px]">cancel</span>
                                                    <span>Pengajuan Ditolak</span>
                                                </span>
                                                <?php if (! empty($pengajuanData['catatan_admin'])) : ?>
                                                    <div class="mt-1 p-3 rounded-lg bg-secondary-fixed text-on-secondary-fixed font-body-sm text-body-sm w-full">
                                                        <strong>Catatan Admin:</strong> <?= esc($pengajuanData['catatan_admin']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Jika Diterima: Tampilkan Pratinjau Kartu + Tombol Unduh PDF & JPG -->
                            <?php if ($pengajuanData['status'] === 'approved') : ?>
                                <?php
                                $kampusOnly = ! empty($pengajuanData['kampus_fakultas']) ? esc($pengajuanData['kampus_fakultas']) : esc($pengajuanData['nama_komisariat'] ?? '-');
                                $alamatText = ! empty($pengajuanData['alamat']) ? esc($pengajuanData['alamat']) : 'Kab. Garut';
                                ?>
                                <div class="mt-space-lg">
                                    <h3 class="font-title-sm text-title-sm text-on-surface font-bold text-center mb-space-md">Pratinjau KTA Digital Anda</h3>

                                    <div id="kta-capture-area" class="kta-preview-wrapper mb-space-lg">

                                        <!-- KARTU DEPAN -->
                                        <div class="kta-card-scaler">
                                            <div id="kta-card-front" class="kta-card-box">
                                                <div class="kta-f-header">
                                                    <?php if ($finalLogoB64 !== '') : ?>
                                                        <div class="kta-f-logo">
                                                            <img src="<?= $finalLogoB64; ?>" alt="Logo PMII">
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
                                                        <img src="<?= $fotoBase64; ?>" style="<?= $fotoImgStyle; ?>" alt="Foto Kader">
                                                    <?php else : ?>
                                                        <div class="kta-f-foto-empty">FOTO 3x4<br>Jas PMII</div>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="kta-f-bio">
                                                    <div class="kta-f-nama"><?= esc($pengajuanData['nama_lengkap']); ?></div>
                                                    <div class="kta-f-nia"><span>NIA :</span><?= esc($pengajuanData['nomor_kta']); ?></div>
                                                    <div class="kta-f-divider"></div>
                                                    <table class="kta-f-table">
                                                        <tr>
                                                            <td class="kta-f-lbl">TTL</td>
                                                            <td class="kta-f-val"><?= esc($pengajuanData['tempat_lahir']); ?>, <?= date('d F Y', strtotime($pengajuanData['tanggal_lahir'])); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="kta-f-lbl">ALAMAT</td>
                                                            <td class="kta-f-val"><?= $alamatText; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="kta-f-lbl">KOMISARIAT</td>
                                                            <td class="kta-f-val kta-f-val-bold"><?= $kampusOnly; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="kta-f-lbl">RAYON</td>
                                                            <td class="kta-f-val"><?= esc(! empty($pengajuanData['rayon']) ? $pengajuanData['rayon'] : '-'); ?></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="kta-f-footer">
                                                    <span class="kta-f-footer-l">Berlaku selama menjadi kader PMII</span>
                                                    <span class="kta-f-footer-r">Dzikir, Fikir dan Amal Sholeh</span>
                                                </div>
                                            </div>
                                        </div><!-- Penutup scaler Kartu Depan (yang sebelumnya terlewat) -->

                                        <!-- KARTU BELAKANG -->
                                        <div class="kta-card-scaler">
                                            <div id="kta-card-back" class="kta-card-box">
                                                <div class="kta-b-header">
                                                    <?php if ($finalLogoB64 !== '') : ?>
                                                        <div class="kta-b-header-logo">
                                                            <img src="<?= $finalLogoB64; ?>" alt="Logo">
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
                                                                        <img src="<?= $ttdKetuaB64; ?>" alt="TTD Ketua">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="kta-b-sign-name">Adrian Hidayat</div>
                                                                <div class="kta-b-sign-role">KETUA</div>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <?php if ($stempelB64 !== '') : ?>
                                                                    <img src="<?= $stempelB64; ?>" class="kta-b-stamp-img" alt="Stempel PC">
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <div class="kta-b-sign-space">
                                                                    <?php if ($ttdSekreB64 !== '') : ?>
                                                                        <img src="<?= $ttdSekreB64; ?>" alt="TTD Sekretaris">
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
                                                        <img src="<?= $qrBase64; ?>" alt="QR Verifikasi">
                                                    <?php endif; ?>
                                                </div>

                                                <div class="kta-b-footer"></div>
                                            </div>
                                        </div><!-- Penutup scaler Kartu Belakang -->

                                    </div><!-- Penutup #kta-capture-area -->

                                    <!-- Download Action Buttons -->
                                    <div class="flex flex-col sm:flex-row items-center justify-center gap-space-md pt-space-xs">
                                        <button type="button" id="btn-download-pdf"
                                            class="w-full sm:w-auto inline-flex items-center justify-center gap-space-xs bg-[#c92a2a] hover:bg-[#a61e1e] text-white px-space-lg py-2.5 rounded-lg font-label-md text-label-md shadow-sm transition-all border-0 cursor-pointer">
                                            <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span>
                                            <span>Unduh KTA (PDF)</span>
                                        </button>
                                        <button type="button" id="btn-download-jpg"
                                            class="w-full sm:w-auto inline-flex items-center justify-center gap-space-xs bg-[#007038] hover:bg-[#005a2d] text-white px-space-lg py-2.5 rounded-lg font-label-md text-label-md shadow-sm transition-all border-0 cursor-pointer">
                                            <span class="material-symbols-outlined text-[20px]">image</span>
                                            <span>Unduh KTA (JPG)</span>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div><!-- Penutup #hasil-pencarian-kta -->
                    <?php endif; ?>
                </div><!-- Penutup Main Verification Card -->

                <!-- Additional Instructional Help Notice -->
                <div class="mt-space-lg bg-surface-container-low rounded-2xl p-space-md flex items-start gap-space-md border border-outline-variant/25">
                    <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center text-primary shrink-0 mt-0.5">
                        <span class="material-symbols-outlined text-[18px]">info</span>
                    </div>
                    <div class="flex flex-col text-on-surface-variant font-body-sm text-body-sm leading-relaxed">
                        <span class="font-title-sm text-title-sm text-on-surface font-semibold mb-0.5">Butuh Perubahan Data Anggota?</span>
                        <span>Jika terdapat kesalahan penulisan nama, status kaderisasi, atau komisariat pada KTA Digital Anda, silakan ajukan permohonan revisi data melalui sekretariat Biro Kaderisasi PC PMII Kab. Garut atau hubungi pengurus komisariat asal.</span>
                    </div>
                </div>
            </div>
        </section>

    </div>
</main>

<!-- Library html2canvas & jsPDF -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hasilEl = document.getElementById('hasil-pencarian-kta');
        if (hasilEl) {
            hasilEl.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Penyesuaian skala pratinjau KTA agar pas di layar HP maupun Laptop
        const previewWrapper = document.getElementById('kta-capture-area');

        function fitKtaPreviewScale() {
            if (!previewWrapper) return;
            const style = window.getComputedStyle(previewWrapper);
            const padX = parseFloat(style.paddingLeft || 0) + parseFloat(style.paddingRight || 0);
            const availWidth = previewWrapper.clientWidth - padX;
            const scale = availWidth < 380 ? Math.max(0.65, availWidth / 380) : 1;

            previewWrapper.querySelectorAll('.kta-card-scaler').forEach((scaler) => {
                scaler.style.width = (380 * scale) + 'px';
                scaler.style.height = (240 * scale) + 'px';
                const card = scaler.querySelector('.kta-card-box');
                if (card) {
                    card.style.transform = scale < 1 ? `scale(${scale})` : 'none';
                }
            });
        }

        fitKtaPreviewScale();
        window.addEventListener('resize', fitKtaPreviewScale);

        const btnJpg = document.getElementById('btn-download-jpg');
        const btnPdf = document.getElementById('btn-download-pdf');
        const fileBaseName = 'KTA_PMII_<?= esc(str_replace('.', '', $pengajuanData['nomor_kta'] ?? 'Digital')); ?>';

        // Penyesuaian jarak antarbaris header & reset skala khusus pada hasil render unduhan (JPG & PDF)
        function tuneExportHeader(clonedDoc) {
            clonedDoc.querySelectorAll('.kta-card-scaler').forEach((scaler) => {
                scaler.style.width = '380px';
                scaler.style.height = '240px';
            });
            clonedDoc.querySelectorAll('.kta-card-box').forEach((card) => {
                card.style.transform = 'none';
            });

            const kicker = clonedDoc.querySelector('.kta-f-kicker');
            const title = clonedDoc.querySelector('.kta-f-title');
            const sub = clonedDoc.querySelector('.kta-f-sub');
            const cabang = clonedDoc.querySelector('.kta-f-cabang');

            if (kicker) kicker.style.top = '8.5px';
            if (title) title.style.top = '26.5px';
            if (sub) sub.style.top = '45.5px';
            if (cabang) cabang.style.top = '55.5px';

            clonedDoc.querySelectorAll('.kta-f-table td').forEach((td) => {
                td.style.setProperty('vertical-align', 'top', 'important');
            });

            clonedDoc.querySelectorAll('.kta-f-lbl').forEach((lbl) => {
                lbl.style.setProperty('width', '65px', 'important');
                lbl.style.setProperty('padding-top', '2.1px', 'important');
            });

            clonedDoc.querySelectorAll('.kta-f-val').forEach((val) => {
                val.style.setProperty('padding-top', '1.6px', 'important');
            });
        }

        if (btnJpg) {
            btnJpg.addEventListener('click', async function() {
                const target = document.getElementById('kta-capture-area');
                const defaultLabel = '<span class="material-symbols-outlined text-[20px]">image</span><span>Unduh KTA (JPG)</span>';

                btnJpg.disabled = true;
                btnJpg.innerHTML = '<span class="material-symbols-outlined animate-spin text-[20px]">progress_activity</span><span>Memproses JPG...</span>';

                try {
                    if (document.fonts && document.fonts.ready) {
                        await document.fonts.ready;
                    }

                    const canvas = await html2canvas(target, {
                        scale: 4,
                        useCORS: true,
                        backgroundColor: '#f2f3ff',
                        scrollX: 0,
                        scrollY: -window.scrollY,
                        logging: false,
                        onclone: function(clonedDoc) {
                            const clonedArea = clonedDoc.getElementById('kta-capture-area');
                            if (clonedArea) {
                                clonedArea.style.width = '832px';
                                clonedArea.style.flexWrap = 'nowrap';
                                clonedArea.style.gap = '24px';
                                clonedArea.style.padding = '24px';
                                clonedArea.style.margin = '0';
                            }
                            tuneExportHeader(clonedDoc);
                        }
                    });

                    const link = document.createElement('a');
                    link.download = fileBaseName + '.jpg';
                    link.href = canvas.toDataURL('image/jpeg', 0.98);
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } finally {
                    btnJpg.disabled = false;
                    btnJpg.innerHTML = defaultLabel;
                }
            });
        }

        if (btnPdf) {
            btnPdf.addEventListener('click', async function() {
                const cardFront = document.getElementById('kta-card-front');
                const cardBack = document.getElementById('kta-card-back');
                const defaultLabel = '<span class="material-symbols-outlined text-[20px]">picture_as_pdf</span><span>Unduh KTA (PDF)</span>';

                btnPdf.disabled = true;
                btnPdf.innerHTML = '<span class="material-symbols-outlined animate-spin text-[20px]">progress_activity</span><span>Memproses PDF...</span>';

                try {
                    if (document.fonts && document.fonts.ready) {
                        await document.fonts.ready;
                    }

                    const opts = {
                        scale: 4,
                        useCORS: true,
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
                    window.location.href = '<?= base_url('kta/download-pdf/' . ($pengajuanData['uuid_token'] ?? '')); ?>';
                } finally {
                    btnPdf.disabled = false;
                    btnPdf.innerHTML = defaultLabel;
                }
            });
        }
    });
</script>

<?= $this->endSection(); ?>