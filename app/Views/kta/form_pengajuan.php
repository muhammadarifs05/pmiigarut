<?php

/**
 * @var string $title
 * @var array $komisariat
 */
?>
<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">
    <!-- Content Section -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <span class="about-badge">Layanan KTA</span>
                <h3>Layanan <span>KTA Digital</span></h3>
                <p>Lengkapi data diri untuk proses penerbitan Kartu Tanda Anggota (KTA) atau cek status pengajuan yang sudah pernah dilakukan.</p>
            </div>

            <!-- DUA KOTAK PILIHAN (MIRIP PERMOHONAN SK) -->
            <div class="row justify-content-center mb-5">

                <!-- Kotak 1: Info Pengajuan Baru -->
                <div class="col-lg-6 col-md-6 d-flex align-items-stretch mb-3">
                    <div style="background: #fff; width: 100%; padding: 30px; border-radius: 8px; box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.08); border-top: 3px solid #106eea;">
                        <span style="background: #eef4ff; color: #106eea; padding: 5px 12px; font-size: 12px; font-weight: bold; border-radius: 4px; display: inline-block; margin-bottom: 15px;">PENGAJUAN BARU</span>
                        <h4 style="font-weight: bold; color: #37517e; margin-bottom: 15px;">Formulir Pengajuan KTA</h4>
                        <p style="color: #666; font-size: 14px; margin-bottom: 20px;">
                            Pastikan seluruh data diri (NIK, Nama, dan Pasfoto) disiapkan dengan valid agar proses verifikasi berjalan cepat dan akurat.
                        </p>
                        <ul style="list-style: none; padding: 0; font-size: 13px; color: #555; margin-bottom: 0;">
                            <li class="mb-2"><i class="bx bx-check text-success me-2"></i> Wajib melampirkan Pasfoto Formal</li>
                            <li class="mb-2"><i class="bx bx-check text-success me-2"></i> Wajib melampirkan Sertifikat Mapaba</li>
                            <li><i class="bx bx-check text-success me-2"></i> Data terverifikasi oleh Admin PC PMII Garut</li>
                        </ul>
                    </div>
                </div>

                <!-- Kotak 2: Cek Status Pengajuan -->
                <div class="col-lg-6 col-md-6 d-flex align-items-stretch mb-3">
                    <div style="background: #fff; width: 100%; padding: 30px; border-radius: 8px; box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.08); border-top: 3px solid #106eea;">
                        <span style="background: #eef4ff; color: #106eea; padding: 5px 12px; font-size: 12px; font-weight: bold; border-radius: 4px; display: inline-block; margin-bottom: 15px;">SUDAH PERNAH MENGAJUKAN?</span>
                        <h4 style="font-weight: bold; color: #37517e; margin-bottom: 15px">Cek Status Pengajuan</h4>
                        <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                            Gunakan <strong>NIK dan Tanggal Lahir</strong> Anda untuk memantau status verifikasi serta mengunduh KTA Digital dalam format PDF maupun JPG.
                        </p>
                        <div class="mt-4">
                            <a href="<?= base_url('kta/cek-status') ?>" class="btn btn-success px-4 py-2" style="background: #205ec9; border-color: #205ec9; font-weight: 600; border-radius: 4px;">
                                <i class="bx bx-search me-1"></i> Cek Status Pengajuan &rarr;
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- FORMULIR PENGAJUAN DI BAWAHNYA -->
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white py-3" style="background-color: #205ec9;">
                            <h5 class="mb-0"><i class="bx bx-edit me-2"></i> Formulir Pengajuan KTA Digital</h5>
                        </div>
                        <div class="card-body p-4">

                            <?php if (session()->getFlashdata('errors')) : ?>
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif ?>

                            <form action="<?= base_url('kta/store') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="nik" class="form-label fw-bold">NIK (Nomor Induk Kependudukan)</label>
                                        <input type="text" name="nik" class="form-control" id="nik" maxlength="16" value="<?= old('nik') ?>" required placeholder="3205xxxxxxxxxxxx">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="nama_lengkap" class="form-label fw-bold">Nama Lengkap (Sesuai KTP)</label>
                                        <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="<?= old('nama_lengkap') ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?= old('tempat_lahir') ?>" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?= old('tanggal_lahir') ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                                        <input type="text" name="alamat" class="form-control" id="alamat" value="<?= old('alamat') ?>" required placeholder="Contoh: Jl. Pembangunan No. 12, Tarogong Kidul, Kab. Garut">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                            <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="komisariat_id" class="form-label fw-bold">Asal Komisariat</label>
                                        <select name="komisariat_id" class="form-control" id="komisariat_id" required>
                                            <option value="">-- Pilih Komisariat --</option>
                                            <?php foreach (($komisariat ?? []) as $k) : ?>
                                                <option value="<?= $k['id'] ?>" <?= old('komisariat_id') == $k['id'] ? 'selected' : '' ?>>
                                                    <?= esc($k['nama_komisariat']) ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="rayon" class="form-label fw-bold">Asal Rayon (Opsional)</label>
                                        <input type="text" name="rayon" class="form-control" id="rayon" value="<?= old('rayon') ?>" placeholder="Contoh: Rayon Tarbiyah">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="tahun_mapaba" class="form-label fw-bold">Tahun Pelaksanaan Mapaba</label>
                                        <input type="number" name="tahun_mapaba" class="form-control" id="tahun_mapaba" min="2000" max="<?= date('Y') ?>" value="<?= old('tahun_mapaba', date('Y')) ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="pas_foto" class="form-label fw-bold">Pasfoto Formal 3x4, Latar Biru (Format JPG/PNG, Max 2MB)</label>
                                        <input type="file" name="pas_foto" class="form-control" id="pas_foto" accept="image/*" required>
                                        <small class="text-muted d-block mt-1">
                                            Gunakan pasfoto resmi berjas PMII dengan ukuran foto <strong>3x4</strong> (ukuran ideal <strong>450 × 600 piksel</strong>). <strong>Latar Belakang Biru.</strong>
                                        </small>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="berkas_bukti" class="form-label fw-bold">Bukti Sertifikat Mapaba (JPG/PNG/PDF, Max 2MB)</label>
                                        <input type="file" name="berkas_bukti" class="form-control" id="berkas_bukti" accept="image/*,.pdf" required>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold" style="background: #106eea; border: 0; border-radius: 4px; color: #fff;">Kirim Pengajuan KTA</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</main>

<?= $this->endSection(); ?>