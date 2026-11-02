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
    <link href="/assets/backend/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/backend/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css" />
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
    $statusFilterValue = $statusFilter ?? 'semua';
    $keywordFilterValue = $keywordFilter ?? '';
    $isFiltering = $statusFilterValue !== 'semua' || $keywordFilterValue !== '';
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
                            <div class="panel-body">
                                <form action="/<?= session('role'); ?>/pengajuan-sk" method="get" class="m-b-md">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group m-b-0">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="semua" <?= $statusFilterValue === 'semua' ? 'selected' : ''; ?>>Semua Status</option>
                                                    <option value="menunggu" <?= $statusFilterValue === 'menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                                                    <option value="revisi" <?= $statusFilterValue === 'revisi' ? 'selected' : ''; ?>>Revisi</option>
                                                    <option value="ditolak" <?= $statusFilterValue === 'ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                                                    <option value="diterima" <?= $statusFilterValue === 'diterima' ? 'selected' : ''; ?>>Diterima</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group m-b-0">
                                                <label>Pencarian</label>
                                                <input
                                                    type="text"
                                                    name="keyword"
                                                    class="form-control"
                                                    value="<?= esc($keywordFilterValue); ?>"
                                                    placeholder="Cari kode pengajuan, nama pemohon, atau komisariat">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>&nbsp;</label>
                                            <div>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-search"></i> Filter
                                                </button>
                                                <a href="/<?= session('role'); ?>/pengajuan-sk" class="btn btn-default">
                                                    Reset
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table id="data-table" class="display table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No</th>
                                                <th>Kode Pengajuan</th>
                                                <th>Nama Pemohon</th>
                                                <th>WhatsApp</th>
                                                <th>Komisariat</th>
                                                <th>Status</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th style="text-align: center; width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-table">
                                            <?php if (! empty($pengajuanData)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($pengajuanData as $item) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= esc($item['kode_pengajuan']); ?></td>
                                                        <td><?= esc($item['nama_pemohon']); ?></td>
                                                        <td><?= esc($item['whatsapp']); ?></td>
                                                        <td><?= esc($item['nama_komisariat'] ?? '-'); ?></td>
                                                        <td>
                                                            <?php if ($item['status'] === 'menunggu') : ?>
                                                                <span class="label label-warning">Menunggu</span>
                                                            <?php elseif ($item['status'] === 'diterima') : ?>
                                                                <span class="label label-success">Diterima</span>
                                                            <?php elseif ($item['status'] === 'ditolak') : ?>
                                                                <span class="label label-danger">Ditolak</span>
                                                            <?php elseif ($item['status'] === 'revisi') : ?>
                                                                <span class="label label-info">Revisi</span>
                                                            <?php else : ?>
                                                                <span class="label label-default"><?= esc($item['status']); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= esc($item['submitted_at'] ?? '-'); ?></td>
                                                        <td style="text-align: center;">
                                                            <a href="/<?= session('role'); ?>/pengajuan-sk/<?= $item['id']; ?>/detail" class="btn btn-xs" title="Detail">
                                                                <span class="fa fa-eye"></span>
                                                            </a>
                                                            <a href="javascript:void(0);" class="btn btn-xs btn-delete" data-id="<?= $item['id']; ?>" title="Delete">
                                                                <span class="fa fa-trash"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php if ($isFiltering && empty($pengajuanData)) : ?>
                                    <div class="alert alert-info m-t-md m-b-0">
                                        Tidak ada data pengajuan yang cocok dengan filter atau kata kunci yang dimasukkan.
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

    <form action="/<?= session('role'); ?>/pengajuan-sk" method="post">
        <input type="hidden" name="_method" value="DELETE" />
        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Pengajuan SK</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Anda yakin mau menghapus data pengajuan SK ini?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" required>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
    <script src="/assets/backend/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
    <script src="/assets/backend/plugins/moment/moment.js"></script>
    <script src="/assets/backend/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="/assets/backend/js/modern.min.js"></script>
    <script src="/assets/backend/plugins/toastr/jquery.toast.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#data-table').dataTable({
                language: {
                    emptyTable: "Belum ada data pengajuan."
                }
            });

            $('#body-table').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                $('[name="id"]').val(id);
                $('#DeleteModal').modal('show');
            });
        });
    </script>

    <?php if (session()->getFlashData('msg') == 'success-delete') : ?>
        <script>
            $.toast({
                heading: 'Success',
                text: "Data pengajuan SK berhasil dihapus!",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif (session()->getFlashData('msg') == 'error-notfound') : ?>
        <script>
            $.toast({
                heading: 'Warning',
                text: "Data pengajuan SK tidak ditemukan.",
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