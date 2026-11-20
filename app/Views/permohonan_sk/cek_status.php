<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$pengajuanData      = $pengajuan ?? null;
$komisariatData     = $komisariat ?? null;
$kodePengajuanValue = $kode_pengajuan ?? '';
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="relative w-full overflow-hidden">
        <!-- Ambient Background Glow -->
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[820px] h-[300px] bg-gradient-to-b from-primary-container/10 via-surface-container/50 to-transparent blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-5xl mx-auto px-gutter py-space-xl flex flex-col gap-space-xl">

            <!-- Page Top Header & Pill Badge -->
            <section class="text-center max-w-3xl mx-auto" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-space-md py-1.5 rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs tracking-widest uppercase shadow-sm mb-space-md">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span>CEK STATUS PENGAJUAN</span>
                </div>
                <h1 class="font-headline-lg text-2xl sm:text-headline-lg text-on-surface font-extrabold tracking-tight leading-tight m-0">
                    Layanan Mandiri Pelacakan Status SK
                </h1>
                <p class="mt-space-xs font-body-md text-sm sm:text-body-md text-on-surface-variant max-w-2xl mx-auto">
                    Sistem Verifikasi &amp; Legalisasi Surat Keputusan Pengurus Komisariat PC PMII Kabupaten Garut
                </p>
            </section>

            <!-- Info & Action Cards Grid -->
            <section class="grid grid-cols-1 md:grid-cols-2 gap-space-lg" data-aos="fade-up" data-aos-delay="60">

                <!-- Card 1: Informasi & Panduan Pelacakan -->
                <article class="relative bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-secondary-container to-secondary-fixed-dim"></div>
                    <div>
                        <span class="inline-block px-3 py-1 rounded-md font-label-xs text-label-xs uppercase tracking-wider bg-primary/10 text-primary mb-space-md">
                            INFORMASI
                        </span>
                        <h2 class="font-headline-sm text-xl text-on-surface font-bold mb-space-xs">
                            Cek Progres Pengajuan Anda
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-space-lg">
                            Gunakan kode pengajuan yang didapat setelah submit formulir untuk melihat status terbaru beserta catatan resmi dari admin verifikator.
                        </p>

                        <ul class="space-y-3 m-0 p-0 list-none">
                            <li class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <span class="material-symbols-outlined text-[14px]">check</span>
                                </span>
                                <span class="font-body-sm text-body-sm font-medium text-on-surface">Tidak perlu isi ulang formulir berkas permohonan</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <span class="material-symbols-outlined text-[14px]">check</span>
                                </span>
                                <span class="font-body-sm text-body-sm font-medium text-on-surface">Status dapat dicek kapan saja secara transparan &amp; real-time</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <span class="material-symbols-outlined text-[14px]">check</span>
                                </span>
                                <span class="font-body-sm text-body-sm font-medium text-on-surface">Catatan revisi dan instruksi perbaikan tampil jika tersedia</span>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-space-lg pt-space-md border-t border-outline-variant/30 flex items-center font-label-xs text-label-xs text-on-surface-variant">
                        <span class="material-symbols-outlined text-[16px] mr-1.5 text-secondary-container">info</span>
                        Data sinkron langsung dengan Database PC PMII Garut.
                    </div>
                </article>

                <!-- Card 2: Butuh Pengajuan Baru? -->
                <article class="relative bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-sm hover:shadow-md transition-all flex flex-col justify-between overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-primary-container to-primary"></div>
                    <div>
                        <span class="inline-block px-3 py-1 rounded-md font-label-xs text-label-xs uppercase tracking-wider bg-secondary-fixed text-on-secondary-fixed mb-space-md">
                            BUTUH PENGAJUAN BARU?
                        </span>
                        <h2 class="font-headline-sm text-xl text-on-surface font-bold mb-space-xs">
                            Ajukan Permohonan SK
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-space-lg">
                            Jika Anda belum pernah mengajukan atau kepengurusan telah berganti periode, silakan lanjut ke halaman formulir untuk mengisi data dan mengunggah dokumen persyaratan.
                        </p>

                        <div class="p-3.5 bg-surface-container-low rounded-xl border border-outline-variant/30 mb-space-lg flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[20px]">description</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-normal m-0">
                                Siapkan: Surat Permohonan, Berita Acara RTK, Susunan Pengurus, CV BPH/Pengurus, dan Database Anggota (PDF).
                            </p>
                        </div>
                    </div>

                    <div>
                        <a href="<?= base_url('/permohonan-sk'); ?>"
                            class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 rounded-xl bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md shadow-md hover:shadow-lg transition-all duration-200 group">
                            <span>Buka Form Pengajuan</span>
                            <span class="material-symbols-outlined text-[18px] ml-2 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </article>

            </section>

            <!-- Flashdata Error Alert -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="p-space-md rounded-2xl bg-error-container text-on-error-container font-body-sm text-body-sm flex items-center gap-space-sm shadow-sm">
                    <span class="material-symbols-outlined text-error text-[20px] shrink-0">error</span>
                    <span><?= esc(session()->getFlashdata('error')); ?></span>
                </div>
            <?php endif; ?>

            <!-- Search Form Section -->
            <section class="bg-surface-container-lowest rounded-3xl shadow-sm p-space-lg sm:p-space-xl relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center max-w-xl mx-auto mb-space-lg relative z-10">
                    <span class="inline-block px-3.5 py-1 rounded-full font-label-xs text-label-xs uppercase tracking-wider bg-primary/10 text-primary mb-space-sm">
                        PENCARIAN STATUS
                    </span>
                    <h2 class="font-headline-md text-2xl sm:text-headline-md text-on-surface font-extrabold tracking-tight m-0">
                        Masukkan Kode Pengajuan
                    </h2>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs m-0">
                        Contoh format kode:
                        <span class="font-mono font-semibold text-on-surface bg-surface-container-low px-2 py-0.5 rounded border border-outline-variant/40">SKK-20260527-7B176</span>
                    </p>
                </div>

                <form id="cekStatusForm" action="<?= base_url('/cek-status-pengajuan/hasil'); ?>" method="post" autocomplete="off" class="max-w-2xl mx-auto relative z-10">
                    <?= csrf_field(); ?>

                    <div class="bg-surface-container-low/80 rounded-2xl p-space-md sm:p-space-lg border border-outline-variant/30">
                        <label for="kode_pengajuan" class="block font-label-xs text-label-xs text-on-surface uppercase tracking-wider mb-space-xs">
                            Kode Pengajuan / Nomor Registrasi
                        </label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined text-outline text-[20px] absolute left-4 pointer-events-none">key</span>
                            <input type="text"
                                id="kode_pengajuan"
                                name="kode_pengajuan"
                                value="<?= esc($kodePengajuanValue); ?>"
                                autocomplete="off"
                                placeholder="Masukkan kode pengajuan (misal: SKK-20260527-7B176)"
                                required
                                class="w-full h-12 pl-12 pr-4 bg-surface-container-lowest rounded-xl text-on-surface font-mono text-sm sm:text-base focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/40" />
                        </div>

                        <div class="flex items-center justify-between font-label-xs text-label-xs text-on-surface-variant mt-space-xs px-1">
                            <span>Pastikan kode tidak memiliki spasi di awal atau akhir.</span>
                            <button type="button"
                                onclick="document.getElementById('kode_pengajuan').value=''; document.getElementById('kode_pengajuan').focus();"
                                class="text-primary hover:underline font-semibold bg-transparent border-0 p-0 cursor-pointer">
                                Bersihkan
                            </button>
                        </div>
                    </div>

                    <div class="mt-space-lg flex justify-center">
                        <button type="submit"
                            class="w-full sm:w-auto min-w-[200px] px-8 py-3.5 rounded-xl bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition-all duration-200 border-0 cursor-pointer active:scale-95">
                            <span class="material-symbols-outlined text-[20px]">search</span>
                            <span>Cek Status</span>
                        </button>
                    </div>
                </form>
            </section>

            <!-- Result Card (Tampil Jika Data Pengajuan Ditemukan) -->
            <?php if ($pengajuanData) : ?>
                <section id="hasil-pencarian" class="flex flex-col gap-space-md" data-aos="fade-up">
                    <div>
                        <span class="inline-block px-3 py-1 rounded-md font-label-xs text-label-xs uppercase tracking-wider bg-surface-container-highest text-primary mb-space-xs">
                            HASIL PENCARIAN
                        </span>
                        <h3 class="font-headline-md text-2xl text-on-surface font-bold tracking-tight m-0">
                            Detail Pengajuan
                        </h3>
                    </div>

                    <div class="bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-sm overflow-hidden">
                        <div class="divide-y divide-outline-variant/25 font-body-sm text-body-sm">
                            <div class="flex flex-col sm:flex-row py-3.5 gap-1">
                                <span class="sm:w-52 font-bold text-on-surface shrink-0">Kode Pengajuan</span>
                                <span class="font-mono font-semibold text-primary"><?= esc($pengajuanData['kode_pengajuan']); ?></span>
                            </div>
                            <div class="flex flex-col sm:flex-row py-3.5 gap-1">
                                <span class="sm:w-52 font-bold text-on-surface shrink-0">Nama Pemohon</span>
                                <span class="text-on-surface-variant"><?= esc($pengajuanData['nama_pemohon']); ?></span>
                            </div>
                            <div class="flex flex-col sm:flex-row py-3.5 gap-1">
                                <span class="sm:w-52 font-bold text-on-surface shrink-0">WhatsApp</span>
                                <span class="text-on-surface-variant"><?= esc($pengajuanData['whatsapp']); ?></span>
                            </div>
                            <div class="flex flex-col sm:flex-row py-3.5 gap-1">
                                <span class="sm:w-52 font-bold text-on-surface shrink-0">Komisariat</span>
                                <span class="text-on-surface font-medium"><?= esc($komisariatData['nama_komisariat'] ?? '-'); ?></span>
                            </div>
                            <div class="flex flex-col sm:flex-row py-3.5 gap-1">
                                <span class="sm:w-52 font-bold text-on-surface shrink-0">Kampus / Fakultas</span>
                                <span class="text-on-surface-variant"><?= esc($komisariatData['kampus_fakultas'] ?? '-'); ?></span>
                            </div>
                            <div class="flex flex-col sm:flex-row py-3.5 sm:items-center gap-1">
                                <span class="sm:w-52 font-bold text-on-surface shrink-0">Status</span>
                                <div>
                                    <?php if ($pengajuanData['status'] === 'menunggu') : ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-label-xs text-label-xs bg-amber-100 text-amber-800 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                            Menunggu Verifikasi
                                        </span>
                                    <?php elseif ($pengajuanData['status'] === 'diterima') : ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-label-xs text-label-xs bg-emerald-600 text-white">
                                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                            Diterima
                                        </span>
                                    <?php elseif ($pengajuanData['status'] === 'ditolak') : ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-label-xs text-label-xs bg-error text-on-error">
                                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                            Ditolak
                                        </span>
                                    <?php elseif ($pengajuanData['status'] === 'revisi') : ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-label-xs text-label-xs bg-sky-100 text-sky-800 border border-sky-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-sky-600"></span>
                                            Perlu Revisi
                                        </span>
                                    <?php else : ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full font-label-xs text-label-xs bg-surface-container-high text-on-surface">
                                            <?= esc(ucfirst($pengajuanData['status'])); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row py-3.5 gap-1">
                                <span class="sm:w-52 font-bold text-on-surface shrink-0">Tanggal Pengajuan</span>
                                <span class="text-on-surface-variant"><?= esc($pengajuanData['submitted_at'] ?? '-'); ?></span>
                            </div>
                            <div class="flex flex-col sm:flex-row py-3.5 gap-1">
                                <span class="sm:w-52 font-bold text-on-surface shrink-0">Catatan Admin</span>
                                <span class="text-on-surface-variant leading-relaxed"><?= nl2br(esc($pengajuanData['catatan_admin'] ?: '-')); ?></span>
                            </div>
                        </div>

                        <?php if (in_array($pengajuanData['status'], ['revisi', 'ditolak'], true)) : ?>
                            <div class="mt-space-lg p-space-md rounded-xl bg-secondary-fixed text-on-secondary-fixed font-body-sm text-body-sm flex flex-col sm:flex-row sm:items-center justify-between gap-space-md">
                                <div class="flex items-start gap-space-sm">
                                    <span class="material-symbols-outlined text-[20px] shrink-0 mt-0.5">upload_file</span>
                                    <span>Pengajuan ini dapat diperbarui kembali. Silakan upload ulang berkas sesuai catatan admin.</span>
                                </div>
                                <a href="<?= base_url('/permohonan-sk/upload-ulang/' . esc($pengajuanData['kode_pengajuan'])); ?>"
                                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-primary-container hover:bg-primary text-on-primary font-label-sm text-label-sm shrink-0 transition">
                                    <span>Upload Ulang Berkas</span>
                                    <span class="material-symbols-outlined text-[16px] ml-1.5">arrow_forward</span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>

        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const hasilEl = document.getElementById('hasil-pencarian');
        if (hasilEl) {
            hasilEl.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
</script>

<?= $this->endSection(); ?>