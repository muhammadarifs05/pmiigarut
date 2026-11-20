<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$kodePengajuanValue = $kode_pengajuan ?? '';
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)] flex items-center">
    <div class="max-w-2xl w-full mx-auto px-gutter py-space-xl" data-aos="fade-up">

        <div class="bg-surface-container-lowest rounded-3xl p-space-lg sm:p-space-xl shadow-sm relative overflow-hidden text-center">
            <!-- Top Accent -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-500 via-primary-container to-secondary-container"></div>

            <!-- Success Icon -->
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center mx-auto mb-space-md shadow-sm">
                <span class="material-symbols-outlined text-[36px]">check_circle</span>
            </div>

            <span class="inline-block px-3.5 py-1 rounded-full font-label-xs text-label-xs uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 mb-space-sm">
                Pengajuan Berhasil
            </span>

            <h1 class="font-headline-md text-2xl sm:text-headline-md text-on-surface font-extrabold tracking-tight mb-space-xs">
                Permohonan SK Berhasil Dikirim
            </h1>

            <p class="font-body-md text-body-md text-on-surface-variant max-w-lg mx-auto mb-space-lg">
                <?= esc(session()->getFlashdata('success') ?: 'Simpan kode pengajuan berikut untuk mengecek perkembangan status verifikasi dan catatan admin sewaktu-waktu.'); ?>
            </p>

            <!-- Kode Pengajuan Box with Copy Button -->
            <div class="bg-surface-container-low rounded-2xl p-space-lg border border-outline-variant/40 mb-space-lg">
                <span class="block font-label-xs text-label-xs uppercase tracking-wider text-on-surface-variant mb-space-xs">
                    Kode Pengajuan Anda
                </span>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-space-sm">
                    <strong id="kodePengajuanText" class="font-mono text-2xl sm:text-3xl font-extrabold text-primary tracking-wider select-all">
                        <?= esc($kodePengajuanValue); ?>
                    </strong>
                    <?php if ($kodePengajuanValue !== '') : ?>
                        <button type="button"
                            onclick="navigator.clipboard?.writeText('<?= esc($kodePengajuanValue, 'js'); ?>'); const el = document.getElementById('copyStatusLabel'); el.textContent = 'Tersalin!'; setTimeout(() => el.textContent = 'Salin Kode', 2000);"
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-surface-container-lowest hover:bg-primary hover:text-on-primary text-primary border border-outline-variant/40 font-label-xs text-label-xs transition cursor-pointer">
                            <span class="material-symbols-outlined text-[16px]">content_copy</span>
                            <span id="copyStatusLabel">Salin Kode</span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-space-sm">
                <a href="<?= base_url('/cek-status-pengajuan'); ?>"
                    class="w-full sm:w-auto px-6 py-3 rounded-xl bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md inline-flex items-center justify-center gap-2 shadow-md transition">
                    <span class="material-symbols-outlined text-[18px]">fact_check</span>
                    <span>Cek Status Pengajuan</span>
                </a>
                <a href="<?= base_url('/'); ?>"
                    class="w-full sm:w-auto px-6 py-3 rounded-xl bg-surface-container-low hover:bg-surface-container-high text-on-surface font-label-md text-label-md inline-flex items-center justify-center gap-2 transition">
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>

    </div>
</main>

<?= $this->endSection(); ?>