<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$komisariatData = $komisariat ?? [];
$validationData = $validation ?? null;
?>

<main id="main">
    <section class="permohonan-sk-page">
        <div class="container">
            <div class="section-title permohonan-title">
                <span class="about-badge">Permohonan SK</span>
                <!-- <h3><span>Permohonan SK Pengurus Komisariat</span></h3> -->
                <p>
                    Lengkapi data pemohon dan seluruh dokumen persyaratan untuk proses penerbitan
                    Surat Keputusan (SK) Pengurus Komisariat.
                </p>
            </div>

            <div class="submission-entry-panel">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="submission-entry-card primary-entry">
                            <span class="entry-badge">Pengajuan Baru</span>
                            <h4>Ajukan SK Pengurus Komisariat</h4>
                            <p>
                                Pastikan seluruh berkas telah disiapkan dalam format PDF agar proses verifikasi berjalan lebih cepat dan tertata.
                            </p>
                            <div class="entry-meta">
                                <span><i class="bx bx-check-circle"></i> Semua berkas wajib PDF</span>
                                <span><i class="bx bx-check-circle"></i> Maksimal 10 MB per file</span>
                                <span><i class="bx bx-check-circle"></i> 1 komisariat hanya 1 pengajuan aktif</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="submission-entry-card secondary-entry">
                            <span class="entry-badge">Sudah Pernah Mengajukan?</span>
                            <h4>Cek Status Pengajuan</h4>
                            <p>
                                Gunakan kode pengajuan untuk melihat perkembangan status permohonan dan catatan admin terbaru.
                            </p>
                            <a href="/cek-status-pengajuan" class="entry-action-btn">
                                Cek Status Pengajuan
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show submission-alert" role="alert">
                    <strong>Pengajuan gagal.</strong> <?= session()->getFlashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($validationData && $validationData->getErrors()) : ?>
                <div class="alert alert-danger submission-alert">
                    <strong>Periksa kembali data yang diisi.</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($validationData->getErrors() as $error) : ?>
                            <li><?= esc($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (empty($komisariatData)) : ?>
                <div class="alert alert-warning submission-alert">
                    Data komisariat belum tersedia. Silakan hubungi admin terlebih dahulu.
                </div>
            <?php endif; ?>

            <div class="submission-form-shell">
                <div class="submission-form-head">
                    <span class="form-kicker">Formulir Pengajuan</span>
                    <!-- <h4>Form Pengajuan Baru</h4> -->
                    <p>Isi formulir berikut hanya jika Anda belum memiliki pengajuan aktif untuk komisariat yang dipilih.</p>
                </div>

                <form action="/permohonan-sk/store" method="post" enctype="multipart/form-data" class="submission-form-grid">
                    <?= csrf_field(); ?>

                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="submission-field-card">
                                <label for="nama_pemohon" class="form-label">Nama Lengkap Pemohon</label>
                                <input type="text" class="form-control submission-input" id="nama_pemohon" name="nama_pemohon" value="<?= old('nama_pemohon'); ?>" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="submission-field-card">
                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control submission-input" id="whatsapp" name="whatsapp" value="<?= old('whatsapp'); ?>" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="submission-field-card">
                                <label for="komisariat_id" class="form-label">Komisariat</label>
                                <select class="form-select submission-input" id="komisariat_id" name="komisariat_id" required>
                                    <option value="">-- Pilih Komisariat --</option>
                                    <?php foreach ($komisariatData as $item) : ?>
                                        <option value="<?= esc($item['id']); ?>" <?= old('komisariat_id') == $item['id'] ? 'selected' : ''; ?>>
                                            <?= esc($item['nama_komisariat']); ?> - <?= esc($item['kampus_fakultas']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="submission-upload-group">
                                <div class="upload-group-head">
                                    <h5>Dokumen Wajib</h5>
                                    <p>Semua berkas di bawah ini wajib diunggah dalam format PDF.</p>
                                </div>

                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="submission-upload-card">
                                            <label class="form-label">Surat Pengajuan SK</label>
                                            <input type="file" class="form-control submission-input" name="surat_pengajuan_sk" accept=".pdf" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="submission-upload-card">
                                            <label class="form-label">Berita Acara RTK</label>
                                            <input type="file" class="form-control submission-input" name="berita_acara_rtk" accept=".pdf" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="submission-upload-card">
                                            <label class="form-label">Berita Acara Formatur</label>
                                            <input type="file" class="form-control submission-input" name="berita_acara_formatur" accept=".pdf" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="submission-upload-card">
                                            <label class="form-label">Struktur Kepengurusan</label>
                                            <input type="file" class="form-control submission-input" name="struktur_kepengurusan" accept=".pdf" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="submission-upload-card">
                                            <label class="form-label">Laporan Pertanggungjawaban Pengurus Demisioner</label>
                                            <input type="file" class="form-control submission-input" name="laporan_pertanggungjawaban_demisioner" accept=".pdf" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="submission-upload-card">
                                            <label class="form-label">Dokumentasi RTK</label>
                                            <input type="file" class="form-control submission-input" name="dokumentasi_rtk" accept=".pdf" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="submission-upload-card">
                                            <label class="form-label">Fotocopy Sertifikat PKD bagi Ketua dan BPH Komisariat</label>
                                            <input type="file" class="form-control submission-input" name="sertifikat_pkd_ketua_bph" accept=".pdf" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="submission-upload-card">
                                            <label class="form-label">CV Pengurus Komisariat yang dilengkapi KTM, KTP, dan Transkrip Nilai</label>
                                            <input type="file" class="form-control submission-input" name="cv_pengurus_ktm_ktp_transkrip" accept=".pdf" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="submission-upload-card">
                                            <label class="form-label">CV Badan Pengurus Harian (BPH) Komisariat</label>
                                            <input type="file" class="form-control submission-input" name="cv_bph_komisariat" accept=".pdf" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="submission-upload-card">
                                            <label class="form-label">Database Anggota Lengkap</label>
                                            <input type="file" class="form-control submission-input" name="database_anggota" accept=".pdf" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="submission-form-footer">
                                <div class="submission-note">
                                    <i class="bx bx-info-circle"></i>
                                    <span>Pastikan semua file sudah benar sebelum menekan tombol submit.</span>
                                </div>
                                <button type="submit" class="btn submission-submit-btn">Submit Pengajuan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?= $this->endSection(); ?>