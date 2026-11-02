<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$kodePengajuanValue = $kode_pengajuan ?? '';
?>

<main id="main">
    <section class="py-5">
        <div class="container">
            <div class="section-title">
                <span class="about-badge">Pengajuan Berhasil</span>
                <p>Simpan kode pengajuan berikut untuk keperluan pengecekan status pengajuan.</p>
            </div>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success text-center">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <div class="text-center">
                <div class="alert alert-success">
                    <p class="mb-2">Permohonan Anda berhasil dikirim.</p>
                    <p class="mb-2">Simpan kode pengajuan berikut untuk mengecek status pengajuan Anda sewaktu-waktu.</p>
                    <strong style="font-size: 24px;"><?= esc($kodePengajuanValue); ?></strong>
                </div>

                <div class="d-flex justify-content-center gap-2 flex-wrap">
                    <a href="/cek-status-pengajuan" class="btn btn-outline-primary">Cek Status Pengajuan</a>
                    <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?= $this->endSection(); ?>