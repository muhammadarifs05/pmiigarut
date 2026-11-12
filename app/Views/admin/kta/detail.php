<?php

/**
 * @var string $title
 * @var array $pengajuan
 */
$pengajuanData = $pengajuan ?? [];
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

        <!-- Memanggil Sidebar Bawaan -->
        <?= $this->include('layout/sidebar-dashboard'); ?>

        <div class="page-inner">

            <!-- Memanggil Title/Header Bawaan -->
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
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="180">Token Pelacakan</th>
                                                <td><code><?= esc($pengajuanData['uuid_token'] ?? '-'); ?></code></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <td><?= esc($pengajuanData['nama_lengkap'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td><?= esc($pengajuanData['nik'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Komisariat</th>
                                                <td><?= esc($pengajuanData['nama_komisariat'] ?? '-'); ?></td>
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
                                                    <th>Nomor KTA</th>
                                                    <td><strong><?= esc($pengajuanData['nomor_kta'] ?? '-'); ?></strong></td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>

                                        <!-- Tombol Cetak KTA PDF -->
                                        <?php if (($pengajuanData['status'] ?? '') === 'approved') : ?>
                                            <a href="/admin/kta/pdf/<?= esc($pengajuanData['id']); ?>" target="_blank" class="btn btn-primary" style="margin-top: 10px;">
                                                <i class="fa fa-print"></i> Cetak PDF KTA
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Form Update Status -->
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
                                                <textarea name="catatan_admin" class="form-control" rows="5" placeholder="Berikan catatan jika ditolak..."><?= esc(old('catatan_admin', $pengajuanData['catatan_admin'] ?? '')); ?></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-success">Simpan Status</button>
                                        </form>
                                    </div>
                                </div>

                                <hr>

                                <h4 class="m-b-md">Dokumen Lampiran Kader</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Dokumen</th>
                                                <th width="220">Status Upload</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Pasfoto Formal</td>
                                                <td><span class="label label-info">File Tersimpan</span></td>
                                            </tr>
                                            <tr>
                                                <td>Sertifikat Mapaba / Surat Bukti</td>
                                                <td><span class="label label-info">File Tersimpan</span></td>
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

    <!-- Scripts Bawaan -->
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

    <!-- Notifikasi Toastr jika status berhasil diubah -->
    <?php if (session()->getFlashData('msg') == 'status-updated') : ?>
        <script>
            $.toast({
                heading: 'Success',
                text: "Status pengajuan berhasil diperbarui!",
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