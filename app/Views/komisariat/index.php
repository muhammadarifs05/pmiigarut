<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$komisariatData  = $komisariat ?? [];
$totalKomisariat = count($komisariatData);
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="relative w-full overflow-hidden">
        <!-- Ambient Background Glow -->
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[820px] h-[320px] bg-gradient-to-b from-primary-container/10 via-surface-container/50 to-transparent blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-gutter py-space-xl flex flex-col gap-space-xl">

            <!-- Top Badge & Page Header -->
            <section aria-label="Judul Halaman" class="flex flex-col gap-space-xs" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-space-md py-1.5 rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs tracking-wider uppercase shadow-sm w-fit">
                    <span class="material-symbols-outlined text-[16px]">domain</span>
                    <span>Daftar Komisariat Aktif PMII Garut</span>
                </div>
                <p class="mt-space-xs font-body-lg text-base sm:text-body-lg text-on-surface-variant m-0">
                    Informasi komisariat aktif PMII Kabupaten Garut masa khidmat berjalan.
                </p>
            </section>

            <!-- Highlight Cards: Informasi Publik & Total Statistik -->
            <section aria-label="Ringkasan Statistik" class="grid grid-cols-1 lg:grid-cols-3 gap-space-lg" data-aos="fade-up" data-aos-delay="60">

                <!-- Card Kiri: Informasi Publik Komisariat (2 Kolom) -->
                <div class="lg:col-span-2 bg-surface-container-lowest rounded-2xl p-space-lg md:p-space-xl shadow-sm hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-secondary-container via-secondary-fixed-dim to-primary-container"></div>

                    <div>
                        <div class="flex items-center gap-space-sm">
                            <span class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[22px]">info</span>
                            </span>
                            <h1 class="font-headline-md text-xl md:text-headline-md text-on-surface font-bold tracking-tight m-0">
                                Informasi Publik Komisariat
                            </h1>
                        </div>

                        <p class="mt-space-md font-body-md text-body-md text-on-surface-variant leading-relaxed m-0">
                            Halaman ini menampilkan daftar komisariat aktif PMII Garut yang dapat diakses sebagai referensi publik untuk melihat sebaran komisariat dan kepengurusan yang sedang berjalan di berbagai perguruan tinggi.
                        </p>
                    </div>

                    <div class="mt-space-lg pt-space-md border-t border-outline-variant/30 flex flex-wrap items-center gap-space-sm font-label-xs text-label-xs text-on-surface-variant">
                        <span class="inline-flex items-center gap-1.5 text-primary bg-primary/10 px-space-sm py-1 rounded-lg font-semibold">
                            <span class="material-symbols-outlined text-[16px] text-emerald-600">verified</span>
                            Data Terverifikasi PC PMII Garut
                        </span>
                        <span class="text-outline">•</span>
                        <span>Update Terakhir: Masa Khidmat Berjalan</span>
                    </div>
                </div>

                <!-- Card Kanan: Total Komisariat Aktif (1 Kolom) -->
                <div class="bg-surface-container-lowest rounded-2xl p-space-lg md:p-space-xl shadow-sm hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-secondary-fixed-dim to-secondary-container"></div>

                    <div>
                        <h2 class="font-title-md text-title-md text-on-surface font-bold tracking-tight m-0">
                            Total Komisariat Aktif
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 m-0">
                            Perguruan Tinggi se-Kabupaten Garut
                        </p>
                    </div>

                    <div class="my-space-lg flex items-center gap-space-md">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-container to-primary flex items-center justify-center text-on-primary shadow-md shrink-0">
                            <span class="material-symbols-outlined text-[32px]">apartment</span>
                        </div>
                        <div>
                            <span class="font-headline-xl text-4xl sm:text-5xl font-extrabold text-primary tracking-tight block leading-none">
                                <?= $totalKomisariat; ?>
                            </span>
                            <span class="mt-1 block font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wider">
                                Komisariat Definitif
                            </span>
                        </div>
                    </div>

                    <div class="pt-space-sm border-t border-outline-variant/30 flex items-center justify-between font-label-xs text-label-xs text-primary font-semibold">
                        <span>Status: 100% Sah &amp; Aktif</span>
                        <span class="text-emerald-600 font-bold inline-flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                            Terdaftar
                        </span>
                    </div>
                </div>

            </section>

            <!-- Section Card: Tabel Daftar Komisariat -->
            <section aria-label="Tabel Komisariat" class="bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up" data-aos-delay="100">

                <!-- Table Header Bar & Filter Controls -->
                <div class="p-space-lg md:p-space-xl border-b border-outline-variant/30 flex flex-col md:flex-row md:items-center justify-between gap-space-md">
                    <div>
                        <h2 class="font-headline-md text-xl md:text-headline-md text-on-surface font-bold tracking-tight m-0">
                            Daftar Komisariat
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 m-0">
                            Informasi kampus/fakultas dan nama ketua komisariat aktif PMII Garut.
                        </p>
                    </div>

                    <!-- Search & Print Controls -->
                    <div class="flex items-center gap-space-sm w-full md:w-auto">
                        <div class="relative w-full md:w-72 flex items-center bg-surface-container-low rounded-xl px-space-md">
                            <span class="material-symbols-outlined text-outline text-[20px]">search</span>
                            <input id="komisariatSearchInput"
                                type="text"
                                placeholder="Cari komisariat, kampus, atau ketua..."
                                class="w-full pl-space-sm pr-2 py-2.5 bg-transparent font-body-sm text-body-sm text-on-surface placeholder:text-outline focus:outline-none border-0" />
                        </div>
                        <!-- <button type="button"
                            onclick="window.print()"
                            title="Cetak Daftar Komisariat"
                            aria-label="Cetak Daftar Komisariat"
                            class="w-10 h-10 rounded-xl bg-surface-container-low hover:bg-primary hover:text-on-primary text-primary flex items-center justify-center transition-colors shrink-0 border-0 cursor-pointer">
                            <span class="material-symbols-outlined text-[20px]">print</span>
                        </button> -->
                    </div>
                </div>

                <?php if (! empty($komisariatData)) : ?>
                    <!-- Responsive Table Container -->
                    <div class="overflow-x-auto">
                        <table id="komisariat-table" class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/80 border-b border-outline-variant/40 font-label-xs text-label-xs uppercase tracking-wider text-on-surface-variant">
                                    <th scope="col" class="py-4 px-6 text-center w-16">NO</th>
                                    <th scope="col" class="py-4 px-6">NAMA KOMISARIAT</th>
                                    <th scope="col" class="py-4 px-6">KAMPUS / FAKULTAS</th>
                                    <th scope="col" class="py-4 px-6">NAMA KETUA</th>
                                    <th scope="col" class="py-4 px-6 text-center w-36">STATUS</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="divide-y divide-outline-variant/25 font-body-md text-body-md text-on-surface">
                                <?php $no = 1; ?>
                                <?php foreach ($komisariatData as $item) : ?>
                                    <tr class="komisariat-row hover:bg-surface-container-low/60 transition-colors group">
                                        <td class="py-4 px-6 text-center font-semibold text-on-surface-variant">
                                            <?= $no++; ?>
                                        </td>
                                        <td class="py-4 px-6 font-semibold text-on-surface group-hover:text-primary transition-colors">
                                            <?= esc($item['nama_komisariat']); ?>
                                        </td>
                                        <td class="py-4 px-6 text-on-surface-variant">
                                            <?= esc($item['kampus_fakultas']); ?>
                                        </td>
                                        <td class="py-4 px-6 font-medium text-on-surface">
                                            <?= esc($item['nama_ketua']); ?>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-label-xs text-label-xs bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                                <?= esc(ucfirst($item['status_aktif'])); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Empty Search Filter State -->
                    <div id="komisariatSearchEmpty" class="hidden p-10 text-center">
                        <div class="w-12 h-12 rounded-xl bg-surface-container-high text-primary flex items-center justify-center mx-auto mb-space-sm">
                            <span class="material-symbols-outlined text-[24px]">search_off</span>
                        </div>
                        <p class="font-title-sm text-title-sm text-on-surface font-bold mb-1">Komisariat Tidak Ditemukan</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant m-0">Tidak ada data komisariat yang sesuai dengan kata kunci pencarian Anda.</p>
                    </div>

                    <!-- Table Footer / Information Note -->
                    <div class="p-space-md sm:px-space-xl bg-surface-container-low/60 border-t border-outline-variant/30 flex flex-col sm:flex-row items-center justify-between gap-space-sm font-body-sm text-body-sm text-on-surface-variant">
                        <p class="m-0">
                            Menampilkan <span id="visibleKomisariatCount" class="font-bold text-primary"><?= $totalKomisariat; ?></span> dari <?= $totalKomisariat; ?> komisariat definitif terdaftar.
                        </p>
                        <div class="flex items-center gap-1.5">
                            <span>Perlu memperbarui nama ketua atau susunan pengurus?</span>
                            <a href="<?= base_url('/contact'); ?>" class="font-semibold text-primary hover:underline">Hubungi PC PMII Garut</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-surface-container-high text-primary flex items-center justify-center mx-auto mb-space-md">
                            <span class="material-symbols-outlined text-[32px]">apartment</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold mb-1">Belum Ada Data Komisariat</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant m-0">
                            Belum ada data komisariat aktif yang tersedia saat ini.
                        </p>
                    </div>
                <?php endif; ?>

            </section>

        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('komisariatSearchInput');
        const rows = document.querySelectorAll('.komisariat-row');
        const countEl = document.getElementById('visibleKomisariatCount');
        const emptySearch = document.getElementById('komisariatSearchEmpty');
        const tableWrapper = document.querySelector('#komisariat-table')?.parentElement;

        searchInput?.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            let visible = 0;

            rows.forEach(row => {
                const match = row.innerText.toLowerCase().includes(query);
                row.classList.toggle('hidden', !match);
                if (match) visible++;
            });

            if (countEl) countEl.textContent = visible;
            if (emptySearch && tableWrapper) {
                emptySearch.classList.toggle('hidden', visible > 0);
                tableWrapper.classList.toggle('hidden', visible === 0);
            }
        });
    });
</script>

<?= $this->endSection(); ?>