<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$pengajuanData = $pengajuan ?? null;
$komisariatData = $komisariat ?? null;
$kodePengajuanValue = $kode_pengajuan ?? '';
?>

<main id="main">
    <section class="cek-status-page">
        <div class="container">
            <div class="section-title cek-status-title">
                <span class="about-badge">Cek Status Pengajuan</span>
            </div>

            <div class="status-entry-shell">
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-7">
                        <div class="status-entry-card status-entry-info">
                            <span class="entry-badge">Informasi</span>
                            <h4>Cek progres pengajuan Anda</h4>
                            <p>
                                Gunakan kode pengajuan yang didapat setelah submit formulir untuk melihat status terbaru beserta catatan dari admin.
                            </p>

                            <div class="entry-meta">
                                <span><i class="bx bx-check-circle"></i> Tidak perlu isi ulang formulir</span>
                                <span><i class="bx bx-check-circle"></i> Status dapat dicek kapan saja</span>
                                <span><i class="bx bx-check-circle"></i> Catatan revisi akan tampil jika tersedia</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="status-entry-card status-entry-action">
                            <span class="entry-badge">Butuh Pengajuan Baru?</span>
                            <h4>Ajukan Permohonan</h4>
                            <p>
                                Jika Anda belum pernah mengajukan, silakan lanjut ke halaman permohonan untuk mengisi data dan mengunggah berkas.
                            </p>
                            <a href="/permohonan-sk" class="entry-action-btn">
                                Buka Form Pengajuan
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger status-alert">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <div class="status-form-shell">
                <div class="status-form-head">
                    <span class="form-kicker">Pencarian Status</span>
                    <h4>Masukkan Kode Pengajuan</h4>
                    <p>Contoh kode pengajuan: <strong>SKK-20260527-7B176</strong></p>
                </div>

                <form action="/cek-status-pengajuan/hasil" method="post" class="status-form">
                    <?= csrf_field(); ?>

                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="status-form-card">
                                <label for="kode_pengajuan" class="form-label">Kode Pengajuan</label>
                                <input
                                    type="text"
                                    class="form-control status-input"
                                    id="kode_pengajuan"
                                    name="kode_pengajuan"
                                    value="<?= esc(old('kode_pengajuan', $kodePengajuanValue)); ?>"
                                    placeholder="Masukkan kode pengajuan"
                                    required>
                            </div>
                        </div>

                        <div class="col-lg-8 mt-3">
                            <button type="submit" class="btn status-submit-btn">Cek Status</button>
                        </div>
                    </div>
                </form>
            </div>

            <?php if ($pengajuanData) : ?>
                <div class="status-result-shell">
                    <div class="status-result-head">
                        <span class="form-kicker">Hasil Pencarian</span>
                        <h4>Detail Pengajuan</h4>
                    </div>

                    <div class="status-result-card">
                        <div class="table-responsive">
                            <table class="table status-result-table align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <th width="240">Kode Pengajuan</th>
                                        <td><?= esc($pengajuanData['kode_pengajuan']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pemohon</th>
                                        <td><?= esc($pengajuanData['nama_pemohon']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>WhatsApp</th>
                                        <td><?= esc($pengajuanData['whatsapp']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Komisariat</th>
                                        <td><?= esc($komisariatData['nama_komisariat'] ?? '-'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kampus / Fakultas</th>
                                        <td><?= esc($komisariatData['kampus_fakultas'] ?? '-'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <?php if ($pengajuanData['status'] === 'menunggu') : ?>
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            <?php elseif ($pengajuanData['status'] === 'diterima') : ?>
                                                <span class="badge bg-success">Diterima</span>
                                            <?php elseif ($pengajuanData['status'] === 'ditolak') : ?>
                                                <span class="badge bg-danger">Ditolak</span>
                                            <?php elseif ($pengajuanData['status'] === 'revisi') : ?>
                                                <span class="badge bg-info text-dark">Revisi</span>
                                            <?php else : ?>
                                                <span class="badge bg-secondary"><?= esc($pengajuanData['status']); ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pengajuan</th>
                                        <td><?= esc($pengajuanData['submitted_at'] ?? '-'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Catatan Admin</th>
                                        <td><?= esc($pengajuanData['catatan_admin'] ?? '-'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <?php if (in_array($pengajuanData['status'], ['revisi', 'ditolak'], true)) : ?>
                            <div class="alert alert-warning mt-4 mb-3">
                                Pengajuan ini dapat diperbarui kembali. Silakan upload ulang berkas sesuai catatan admin.
                            </div>

                            <div class="text-end">
                                <a href="/permohonan-sk/upload-ulang/<?= esc($pengajuanData['kode_pengajuan']); ?>" class="btn btn-warning">
                                    Upload Ulang Berkas
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?= $this->endSection(); ?>