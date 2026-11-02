<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
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

    <?php
    $pengajuanData = $pengajuan ?? [];
    $fileFieldsData = $fileFields ?? [];
    $historiesData = $histories ?? [];
    ?>

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
                                <h4 class="panel-title">Detail Pengajuan SK</h4>
                            </div>

                            <div class="panel-body">
                                <a href="/<?= session('role'); ?>/pengajuan-sk" class="btn btn-default m-b-sm">Kembali</a>

                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="180">Kode Pengajuan</th>
                                                <td><?= esc($pengajuanData['kode_pengajuan'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Pemohon</th>
                                                <td><?= esc($pengajuanData['nama_pemohon'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>WhatsApp</th>
                                                <td><?= esc($pengajuanData['whatsapp'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Komisariat</th>
                                                <td><?= esc($pengajuanData['nama_komisariat'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kampus / Fakultas</th>
                                                <td><?= esc($pengajuanData['kampus_fakultas'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Ketua</th>
                                                <td><?= esc($pengajuanData['nama_ketua'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pengajuan</th>
                                                <td><?= esc($pengajuanData['submitted_at'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Terakhir Ditinjau</th>
                                                <td><?= esc($pengajuanData['reviewed_at'] ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <?php if (($pengajuanData['status'] ?? '') === 'menunggu') : ?>
                                                        <span class="label label-warning">Menunggu</span>
                                                    <?php elseif (($pengajuanData['status'] ?? '') === 'diterima') : ?>
                                                        <span class="label label-success">Diterima</span>
                                                    <?php elseif (($pengajuanData['status'] ?? '') === 'ditolak') : ?>
                                                        <span class="label label-danger">Ditolak</span>
                                                    <?php elseif (($pengajuanData['status'] ?? '') === 'revisi') : ?>
                                                        <span class="label label-info">Revisi</span>
                                                    <?php else : ?>
                                                        <span class="label label-default"><?= esc($pengajuanData['status'] ?? '-'); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <form action="/<?= session('role'); ?>/pengajuan-sk/<?= esc($pengajuanData['id'] ?? ''); ?>/update-status" method="post">
                                            <?= csrf_field(); ?>

                                            <div class="form-group">
                                                <label>Status Pengajuan</label>
                                                <select name="status" class="form-control" required>
                                                    <option value="menunggu" <?= ($pengajuanData['status'] ?? '') === 'menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                                                    <option value="diterima" <?= ($pengajuanData['status'] ?? '') === 'diterima' ? 'selected' : ''; ?>>Diterima</option>
                                                    <option value="ditolak" <?= ($pengajuanData['status'] ?? '') === 'ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                                                    <option value="revisi" <?= ($pengajuanData['status'] ?? '') === 'revisi' ? 'selected' : ''; ?>>Revisi</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Catatan Admin</label>
                                                <textarea name="catatan_admin" class="form-control" rows="5" placeholder="Tulis catatan untuk pemohon bila diperlukan..."><?= esc(old('catatan_admin', $pengajuanData['catatan_admin'] ?? '')); ?></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-success">Update Status</button>
                                        </form>
                                    </div>
                                </div>

                                <hr>

                                <h4 class="m-b-md">Dokumen Pengajuan</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Dokumen</th>
                                                <th width="220">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($fileFieldsData as $field => $label) : ?>
                                                <tr>
                                                    <td><?= esc($label); ?></td>
                                                    <td>
                                                        <?php if (! empty($pengajuanData[$field])) : ?>
                                                            <a href="/<?= session('role'); ?>/pengajuan-sk/<?= esc($pengajuanData['id'] ?? ''); ?>/preview/<?= esc($field); ?>" class="btn btn-xs btn-info" target="_blank">
                                                                <i class="fa fa-eye"></i> Preview
                                                            </a>
                                                            <a href="/<?= session('role'); ?>/pengajuan-sk/<?= esc($pengajuanData['id'] ?? ''); ?>/download/<?= esc($field); ?>" class="btn btn-xs btn-success">
                                                                <i class="fa fa-download"></i> Download
                                                            </a>
                                                        <?php else : ?>
                                                            <span class="label label-default">File tidak tersedia</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center m-b-md">
                                    <h4 class="m-b-0">Riwayat Pengajuan</h4>
                                    <?php if (! empty($historiesData)) : ?>
                                        <a class="btn btn-default btn-sm history-toggle" data-toggle="collapse" href="#historyCollapse" role="button" aria-expanded="false" aria-controls="historyCollapse">
                                            Lihat Riwayat
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <?php if (! empty($historiesData)) : ?>
                                    <div class="collapse" id="historyCollapse">
                                        <div class="history-timeline">
                                            <?php foreach ($historiesData as $history) : ?>
                                                <?php
                                                $aksi = $history['aksi'] ?? '';
                                                $statusLama = $history['status_lama'] ?? '';
                                                $statusBaru = $history['status_baru'] ?? '';
                                                ?>
                                                <div class="history-item">
                                                    <span class="history-time"><?= esc($history['created_at'] ?? '-'); ?></span>

                                                    <h5 class="history-title">
                                                        <?php
                                                        if ($aksi === 'submit_pengajuan') {
                                                            echo 'Pengajuan Baru';
                                                        } elseif ($aksi === 'update_status') {
                                                            echo 'Perubahan Status oleh Admin';
                                                        } elseif ($aksi === 'upload_ulang') {
                                                            echo 'Upload Ulang oleh Pemohon';
                                                        } elseif ($aksi === 'delete_pengajuan') {
                                                            echo 'Pengajuan Dihapus';
                                                        } else {
                                                            echo esc(ucwords(str_replace('_', ' ', $aksi)));
                                                        }
                                                        ?>
                                                    </h5>

                                                    <div class="history-meta">
                                                        <?php if ($aksi === 'submit_pengajuan') : ?>
                                                            <span class="label label-warning">Status awal: menunggu</span>
                                                        <?php else : ?>
                                                            <?php if ($statusLama !== '') : ?>
                                                                <?php if ($statusLama === 'menunggu') : ?>
                                                                    <span class="label label-warning">menunggu</span>
                                                                <?php elseif ($statusLama === 'diterima') : ?>
                                                                    <span class="label label-success">diterima</span>
                                                                <?php elseif ($statusLama === 'ditolak') : ?>
                                                                    <span class="label label-danger">ditolak</span>
                                                                <?php elseif ($statusLama === 'revisi') : ?>
                                                                    <span class="label label-info">revisi</span>
                                                                <?php else : ?>
                                                                    <span class="label label-default"><?= esc($statusLama); ?></span>
                                                                <?php endif; ?>

                                                                <i class="fa fa-arrow-right" style="margin: 0 6px;"></i>

                                                                <?php if ($statusBaru === 'menunggu') : ?>
                                                                    <span class="label label-warning">menunggu</span>
                                                                <?php elseif ($statusBaru === 'diterima') : ?>
                                                                    <span class="label label-success">diterima</span>
                                                                <?php elseif ($statusBaru === 'ditolak') : ?>
                                                                    <span class="label label-danger">ditolak</span>
                                                                <?php elseif ($statusBaru === 'revisi') : ?>
                                                                    <span class="label label-info">revisi</span>
                                                                <?php elseif ($statusBaru !== '') : ?>
                                                                    <span class="label label-default"><?= esc($statusBaru); ?></span>
                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <span class="label label-default">Tidak ada perubahan status</span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                    <p class="history-note">
                                                        <?= esc($history['catatan'] ?? '-'); ?>
                                                    </p>

                                                    <div class="history-actor">
                                                        Oleh: <strong><?= esc($history['performed_by_role'] ?? '-'); ?></strong>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="alert alert-info">
                                        Belum ada riwayat perubahan untuk pengajuan ini.
                                    </div>
                                <?php endif; ?>
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
                text: "Status pengajuan berhasil diperbarui!",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashData('msg') == 'error-validation') : ?>
        <script>
            $.toast({
                heading: 'Warning',
                text: "Periksa kembali status atau catatan admin yang diisi.",
                showHideTransition: 'slide',
                icon: 'warning',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#f0ad4e'
            });
        </script>
    <?php endif; ?>
</body>

</html>