<?php

/**
 * @var string $title
 * @var array $kader
 * @var array $maskedNik
 */
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0 text-center">
                    <div class="card-header bg-success text-white py-3">
                        <h5 class="mb-0">✓ KARTU TANDA ANGGOTA SAH</h5>
                        <small>PC PMII KABUPATEN GARUT</small>
                    </div>
                    <div class="card-body p-4">
                        <div class="badge bg-primary fs-6 mb-3">Nomor KTA: <?= esc($kader['nomor_kta']) ?></div>
                        <table class="table table-borderless text-start mt-2">
                            <tr>
                                <th width="40%">Nama Lengkap</th>
                                <td>: <?= esc($kader['nama_lengkap']) ?></td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>: <?= esc($maskedNik) ?></td>
                            </tr>
                            <tr>
                                <th>Komisariat</th>
                                <td>: <?= esc($kader['nama_komisariat']) ?></td>
                            </tr>
                            <tr>
                                <th>Angkatan Mapaba</th>
                                <td>: <?= esc($kader['tahun_mapaba']) ?></td>
                            </tr>
                            <tr>
                                <th>Status Keaktifan</th>
                                <td>: <span class="badge bg-success">AKTIFF / TERVERIFIKASI</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer bg-white text-muted small py-3">
                        Halaman ini dikirim resmi secara sistemik dari Portal Web PC PMII Garut.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>