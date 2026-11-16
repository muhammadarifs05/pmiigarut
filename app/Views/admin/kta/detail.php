<?php

/**
 * @var string $title
 * @var array $pengajuan
 */
$pengajuanData = $pengajuan ?? [];
$jenisKelaminLabel = '-';
if (($pengajuanData['jenis_kelamin'] ?? '') === 'L') {
    $jenisKelaminLabel = 'Laki-laki';
} elseif (($pengajuanData['jenis_kelamin'] ?? '') === 'P') {
    $jenisKelaminLabel = 'Perempuan';
}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?= esc($title); ?></title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="author" content="Muhammad Arif Syamsudin" />
    <link rel="shortcut icon" href="/assets/frontend/img/apple-touch-icon2.png">

    <link href="/assets/backend/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet" />
    <link href="/assets/backend/plugins/uniform/css/uniform.default.min.css" rel="stylesheet" />
    <link href="/assets/backend/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/waves/waves.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/toastr/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/modern.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/themes/dark.css" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/css/custom.css" rel="stylesheet" type="text/css" />

    <script src="/assets/backend/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
</head>

<body class="page-header-fixed compact-menu pace-done page-sidebar-fixed">

    <div class="overlay"></div>
    <main class="page-content content-wrap">

        <?= $this->include('layout/sidebar-dashboard'); ?>

        <div class="page-inner">

            <?= $this->include('layout/title-dashboard'); ?>

            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Tinjau Data Pengajuan KTA</h4>
                            </div>

                            <div class="panel-body">
                                <a href="/admin/kta" class="btn btn-default m-b-sm">Kembali</a>

                                <div class="row">
                                    <!-- Kolom Data Lengkap Pemohon -->
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="190">NIK</th>
                                                <td><?= esc($pengajuanData['nik'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <td><strong><?= esc($pengajuanData['nama_lengkap'] ?? '-'); ?></strong></td>
                                            </tr>
                                            <tr>
                                                <th>Tempat, Tanggal Lahir</th>
                                                <td>
                                                    <?= esc($pengajuanData['tempat_lahir'] ?? '-'); ?>,
                                                    <?= ! empty($pengajuanData['tanggal_lahir']) ? date('d M Y', strtotime($pengajuanData['tanggal_lahir'])) : '-'; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Alamat Lengkap</th>
                                                <td><?= esc(! empty($pengajuanData['alamat']) ? $pengajuanData['alamat'] : '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td><?= esc($jenisKelaminLabel); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Asal Komisariat</th>
                                                <td><?= esc($pengajuanData['nama_komisariat'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Asal Rayon</th>
                                                <td><?= esc(! empty($pengajuanData['rayon']) ? $pengajuanData['rayon'] : '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tahun Mapaba</th>
                                                <td><?= esc($pengajuanData['tahun_mapaba'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pengajuan</th>
                                                <td><?= esc($pengajuanData['created_at'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status Pengajuan</th>
                                                <td>
                                                    <?php if (($pengajuanData['status'] ?? '') === 'pending') : ?>
                                                        <span class="label label-warning">Menunggu</span>
                                                    <?php elseif (($pengajuanData['status'] ?? '') === 'approved') : ?>
                                                        <span class="label label-success">Diterima</span>
                                                    <?php elseif (($pengajuanData['status'] ?? '') === 'rejected') : ?>
                                                        <span class="label label-danger">Ditolak</span>
                                                    <?php else : ?>
                                                        <span class="label label-default"><?= esc($pengajuanData['status'] ?? '-'); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php if (($pengajuanData['status'] ?? '') === 'approved') : ?>
                                                <tr>
                                                    <th>Nomor KTA (NIA)</th>
                                                    <td><strong><?= esc($pengajuanData['nomor_kta'] ?? '-'); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Disetujui</th>
                                                    <td><?= esc($pengajuanData['approved_at'] ?? '-'); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>

                                        <?php if (($pengajuanData['status'] ?? '') === 'approved') : ?>
                                            <a href="/admin/kta/pdf/<?= esc($pengajuanData['id']); ?>" target="_blank" class="btn btn-primary" style="margin-top: 10px;">
                                                <i class="fa fa-print"></i> Cetak PDF KTA
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Kolom Form Verifikasi Admin -->
                                    <div class="col-md-6">
                                        <form action="/admin/kta/<?= esc($pengajuanData['id'] ?? ''); ?>/update-status" method="post">
                                            <?= csrf_field(); ?>

                                            <div class="form-group">
                                                <label>Ubah Status Pengajuan</label>
                                                <select name="status" class="form-control" required>
                                                    <option value="pending" <?= ($pengajuanData['status'] ?? '') === 'pending' ? 'selected' : ''; ?>>Menunggu</option>
                                                    <option value="approved" <?= ($pengajuanData['status'] ?? '') === 'approved' ? 'selected' : ''; ?>>Diterima (Terbitkan KTA)</option>
                                                    <option value="rejected" <?= ($pengajuanData['status'] ?? '') === 'rejected' ? 'selected' : ''; ?>>Ditolak</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Catatan Admin (Opsional)</label>
                                                <textarea name="catatan_admin" class="form-control" rows="5" placeholder="Tulis catatan untuk pemohon bila ditolak atau perlu perbaikan..."><?= esc(old('catatan_admin', $pengajuanData['catatan_admin'] ?? '')); ?></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-success">Simpan Status</button>
                                        </form>
                                    </div>
                                </div>

                                <hr>

                                <!-- Tabel Dokumen Lampiran + Preview & Download -->
                                <h4 class="m-b-md">Dokumen Lampiran Kader</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Dokumen</th>
                                                <th width="220">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Pasfoto Formal</td>
                                                <td>
                                                    <?php if (! empty($pengajuanData['pas_foto'])) : ?>
                                                        <a href="/admin/kta/<?= esc($pengajuanData['id']); ?>/preview/pas_foto" class="btn btn-xs btn-info" target="_blank">
                                                            <i class="fa fa-eye"></i> Preview
                                                        </a>
                                                        <a href="/admin/kta/<?= esc($pengajuanData['id']); ?>/download/pas_foto" class="btn btn-xs btn-success">
                                                            <i class="fa fa-download"></i> Download
                                                        </a>
                                                    <?php else : ?>
                                                        <span class="label label-default">File tidak tersedia</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sertifikat Mapaba / Surat Bukti</td>
                                                <td>
                                                    <?php if (! empty($pengajuanData['berkas_bukti'])) : ?>
                                                        <a href="/admin/kta/<?= esc($pengajuanData['id']); ?>/preview/berkas_bukti" class="btn btn-xs btn-info" target="_blank">
                                                            <i class="fa fa-eye"></i> Preview
                                                        </a>
                                                        <a href="/admin/kta/<?= esc($pengajuanData['id']); ?>/download/berkas_bukti" class="btn btn-xs btn-success">
                                                            <i class="fa fa-download"></i> Download
                                                        </a>
                                                    <?php else : ?>
                                                        <span class="label label-default">File tidak tersedia</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-footer">
                <p class="no-s"><?= date('Y'); ?> &copy; Powered by Muhammad Arif Syamsudin.</p>
            </div>
        </div>
    </main>

    <script src="/assets/backend/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="/assets/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/backend/plugins/pace-master/pace.min.js"></script>
    <script src="/assets/backend/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="/assets/backend/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/assets/backend/plugins/switchery/switchery.min.js"></script>
    <script src="/assets/backend/plugins/uniform/jquery.uniform.min.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/classie.js"></script>
    <script src="/assets/backend/plugins/offcanvasmenueffects/js/main.js"></script>
    <script src="/assets/backend/plugins/waves/waves.min.js"></script>
    <script src="/assets/backend/plugins/3d-bold-navigation/js/main.js"></script>
    <script src="/assets/backend/js/modern.min.js"></script>
    <script src="/assets/backend/plugins/toastr/jquery.toast.min.js"></script>

    <?php if (session()->getFlashData('msg') == 'status-updated') : ?>
        <script>
            $.toast({
                heading: 'Success',
                text: "Status pengajuan KTA berhasil diperbarui!",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php endif; ?>
</body>

</html>