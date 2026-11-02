<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$pengajuanData = $pengajuan ?? null;
$komisariatData = $komisariat ?? null;
$validationData = $validation ?? null;
$kodePengajuanValue = $pengajuanData['kode_pengajuan'] ?? '';
$statusPengajuanValue = $pengajuanData['status'] ?? '';
?>

<main id="main">
    <section class="permohonan-sk-page">
        <div class="container">
            <div class="section-title permohonan-title">
                <span class="about-badge">Upload Ulang</span>
                <h3><span>Upload Ulang Berkas Pengajuan</span></h3>
                <p>
                    Perbarui berkas pengajuan sesuai catatan admin tanpa membuat pengajuan baru.
                </p>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger submission-alert">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php if ($validationData && $validationData->getErrors()) : ?>
                <div class="alert alert-danger submission-alert">
                    <strong>Periksa kembali file yang diunggah.</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($validationData->getErrors() as $error) : ?>
                            <li><?= esc($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="submission-entry-panel">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="submission-entry-card primary-entry">
                            <span class="entry-badge">Detail Pengajuan</span>
                            <h4><?= esc($kodePengajuanValue ?: '-'); ?></h4>
                            <p>
                                Komisariat: <strong><?= esc($komisariatData['nama_komisariat'] ?? '-'); ?></strong><br>
                                Status saat ini:
                                <strong><?= esc(ucfirst($statusPengajuanValue ?: '-')); ?></strong>
                            </p>
                            <div class="entry-meta">
                                <span><i class="bx bx-check-circle"></i> Upload ulang dilakukan pada pengajuan yang sama</span>
                                <span><i class="bx bx-check-circle"></i> Tidak perlu membuat kode pengajuan baru</span>
                                <span><i class="bx bx-check-circle"></i> Setelah dikirim, status kembali menjadi menunggu</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="submission-entry-card secondary-entry">
                            <span class="entry-badge">Petunjuk</span>
                            <h4>Perbarui seperlunya</h4>
                            <p>
                                Anda cukup mengunggah file yang ingin diperbaiki atau diperbarui sesuai arahan admin. Minimal unggah satu file.
                            </p>
                            <a href="/cek-status-pengajuan" class="entry-action-btn">
                                Kembali ke Cek Status
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (! empty($pengajuanData['catatan_admin'])) : ?>
                <div class="alert alert-warning submission-alert">
                    <strong>Catatan Admin:</strong><br>
                    <?= nl2br(esc($pengajuanData['catatan_admin'])); ?>
                </div>
            <?php endif; ?>

            <div class="submission-form-shell">
                <div class="submission-form-head">
                    <span class="form-kicker">Form Upload Ulang</span>
                    <h4>Unggah Berkas yang Diperbarui</h4>
                    <p>
                        Pilih file yang ingin diperbarui. File yang tidak dipilih akan tetap menggunakan berkas sebelumnya.
                    </p>
                </div>

                <form action="/permohonan-sk/upload-ulang/<?= esc($kodePengajuanValue); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="submission-upload-group">
                        <div class="upload-group-head">
                            <h5>Dokumen Pengajuan</h5>
                            <p>Semua file yang diunggah ulang harus dalam format PDF.</p>
                        </div>

                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="submission-upload-card">
                                    <label class="form-label">Surat Pengajuan SK</label>
                                    <input type="file" class="form-control submission-input" name="surat_pengajuan_sk" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="submission-upload-card">
                                    <label class="form-label">Berita Acara RTK</label>
                                    <input type="file" class="form-control submission-input" name="berita_acara_rtk" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="submission-upload-card">
                                    <label class="form-label">Berita Acara Formatur</label>
                                    <input type="file" class="form-control submission-input" name="berita_acara_formatur" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="submission-upload-card">
                                    <label class="form-label">Struktur Kepengurusan</label>
                                    <input type="file" class="form-control submission-input" name="struktur_kepengurusan" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="submission-upload-card">
                                    <label class="form-label">Laporan Pertanggungjawaban Pengurus Demisioner</label>
                                    <input type="file" class="form-control submission-input" name="laporan_pertanggungjawaban_demisioner" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="submission-upload-card">
                                    <label class="form-label">Dokumentasi RTK</label>
                                    <input type="file" class="form-control submission-input" name="dokumentasi_rtk" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="submission-upload-card">
                                    <label class="form-label">Fotocopy Sertifikat PKD bagi Ketua dan BPH Komisariat</label>
                                    <input type="file" class="form-control submission-input" name="sertifikat_pkd_ketua_bph" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="submission-upload-card">
                                    <label class="form-label">CV Pengurus Komisariat yang dilengkapi KTM, KTP, dan Transkrip Nilai</label>
                                    <input type="file" class="form-control submission-input" name="cv_pengurus_ktm_ktp_transkrip" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="submission-upload-card">
                                    <label class="form-label">CV Badan Pengurus Harian (BPH) Komisariat</label>
                                    <input type="file" class="form-control submission-input" name="cv_bph_komisariat" accept=".pdf">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="submission-upload-card">
                                    <label class="form-label">Database Anggota Lengkap</label>
                                    <input type="file" class="form-control submission-input" name="database_anggota" accept=".pdf">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submission-form-footer mt-4">
                        <div class="submission-note">
                            <i class="bx bx-info-circle"></i>
                            <span>Minimal unggah satu file yang ingin diperbarui sebelum mengirim upload ulang.</span>
                        </div>
                        <button type="submit" class="btn submission-submit-btn">Kirim Upload Ulang</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?= $this->endSection(); ?>