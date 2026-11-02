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
                                <h4 class="panel-title">Add Komisariat</h4>
                            </div>

                            <div class="panel-body">
                                <?php if (session()->getFlashdata('validation')) : ?>
                                    <?php $validation = session()->getFlashdata('validation'); ?>
                                    <div class="alert alert-danger">
                                        <strong>Periksa kembali data yang diisi.</strong>
                                        <ul class="m-b-0 m-t-sm">
                                            <?php foreach ($validation->getErrors() as $error) : ?>
                                                <li><?= esc($error); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <form action="/<?= session('role'); ?>/komisariat/save" method="post">
                                    <?= csrf_field(); ?>

                                    <div class="form-group">
                                        <label>Nama Komisariat</label>
                                        <input type="text" name="nama_komisariat" class="form-control" value="<?= old('nama_komisariat'); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Kampus / Fakultas</label>
                                        <input type="text" name="kampus_fakultas" class="form-control" value="<?= old('kampus_fakultas'); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Ketua</label>
                                        <input type="text" name="nama_ketua" class="form-control" value="<?= old('nama_ketua'); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status_aktif" class="form-control" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="aktif" <?= old('status_aktif') === 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                                            <option value="nonaktif" <?= old('status_aktif') === 'nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
                                        </select>
                                    </div>

                                    <div class="form-group m-b-0">
                                        <a href="/<?= session('role'); ?>/komisariat" class="btn btn-default">Kembali</a>
                                        <button type="submit" class="btn btn-success">Simpan Data</button>
                                    </div>
                                </form>
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
</body>

</html>