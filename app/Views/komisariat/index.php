<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$komisariatData = $komisariat ?? [];
$totalKomisariat = count($komisariatData);
?>

<main id="main">
    <section class="komisariat-page">
        <div class="container">
            <div class="section-title komisariat-hero">
                <span class="about-badge">Daftar Komisariat Aktif PMII Garut</span>
                <p>Informasi komisariat aktif PMII Kabupaten Garut.</p>
            </div>

            <div class="komisariat-summary">
                <div class="komisariat-summary-card">
                    <h4>Informasi Publik Komisariat</h4>
                    <p>
                        Halaman ini menampilkan daftar komisariat aktif PMII Garut yang dapat diakses sebagai
                        referensi publik untuk melihat sebaran komisariat dan kepengurusan yang sedang berjalan.
                    </p>
                </div>

                <div class="komisariat-stat-card">
                    <h4>Total Komisariat Aktif</h4>
                    <div class="komisariat-stat-value">
                        <span class="komisariat-stat-badge">
                            <i class="bx bx-building-house"></i>
                        </span>
                        <span class="komisariat-stat-number"><?= $totalKomisariat; ?></span>
                    </div>
                </div>
            </div>

            <div class="komisariat-table-shell">
                <div class="komisariat-table-head">
                    <div>
                        <h4>Daftar Komisariat</h4>
                        <p>Informasi kampus/fakultas dan nama ketua komisariat aktif PMII Garut.</p>
                    </div>
                </div>

                <?php if (! empty($komisariatData)) : ?>
                    <div class="table-responsive">
                        <table class="table komisariat-table">
                            <thead>
                                <tr>
                                    <th width="60">No</th>
                                    <th>Nama Komisariat</th>
                                    <th>Kampus / Fakultas</th>
                                    <th>Nama Ketua</th>
                                    <th width="140">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($komisariatData as $item) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="komisariat-row-name"><?= esc($item['nama_komisariat']); ?></td>
                                        <td class="komisariat-row-campus"><?= esc($item['kampus_fakultas']); ?></td>
                                        <td><?= esc($item['nama_ketua']); ?></td>
                                        <td>
                                            <span class="komisariat-status-badge"><?= esc(ucfirst($item['status_aktif'])); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="komisariat-empty">
                        Belum ada data komisariat yang tersedia saat ini.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?= $this->endSection(); ?>