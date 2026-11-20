<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$namaLengkap = $kader['nama_lengkap'] ?? '';
$nimKader    = $kader['nim'] ?? '';
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)] flex flex-col justify-between">

    <!-- Page Title & Breadcrumb Bar -->
    <section class="bg-surface-container-lowest border-b border-outline-variant/30 py-4 shadow-2xs">
        <div class="max-w-7xl mx-auto px-gutter flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <h1 class="font-headline-sm text-xl sm:text-2xl font-bold text-on-surface tracking-tight m-0">
                Status Pengajuan
            </h1>
            <nav aria-label="Breadcrumb" class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-1.5">
                <a href="<?= base_url('/'); ?>" class="text-primary hover:underline font-medium">Home</a>
                <span class="text-outline">/</span>
                <span class="text-on-surface-variant">Status KTA</span>
            </nav>
        </div>
    </section>

    <!-- Main Success Card Section -->
    <section class="flex-grow py-space-xl px-gutter flex items-center justify-center" data-aos="fade-up">
        <div class="w-full max-w-2xl bg-surface-container-lowest rounded-xl shadow-sm p-space-lg sm:p-12 text-center relative overflow-hidden"
            style="border: 1px solid rgba(203, 213, 225, 0.7); border-top: 4px solid #059669; border-bottom: 4px solid #059669;">

            <!-- Big Green Circle Checkmark Icon -->
            <div class="mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-space-md"
                style="border: 3.5px solid #10b981; color: #10b981;">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <!-- Main Heading -->
            <h2 class="font-headline-md text-2xl sm:text-3xl font-bold text-on-surface tracking-tight mb-space-md">
                Pengajuan KTA Berhasil Dikirim!
            </h2>

            <!-- Message Text -->
            <div class="font-body-md text-body-md text-on-surface-variant leading-relaxed max-w-lg mx-auto mb-space-lg">
                <p class="mb-1">
                    Terima kasih <strong class="text-on-surface font-semibold"><?= esc($namaLengkap); ?></strong>.
                </p>
                <p class="m-0">
                    Data pengajuan KTA Anda saat ini sedang dalam proses verifikasi oleh Admin PC PMII Garut.
                </p>
            </div>

            <!-- Info Alert Box -->
            <div class="rounded-r-lg p-space-md text-left font-body-sm text-body-sm text-on-surface-variant space-y-2 mb-space-lg"
                style="background-color: #f0f6ff; border-left: 4px solid #1d72e8;">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="font-bold text-on-surface">Status:</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded font-label-xs text-label-xs font-semibold"
                        style="background-color: #ffb703; color: #0f172a;">
                        Menunggu Verifikasi (Pending)
                    </span>
                </div>

                <p class="leading-relaxed m-0">
                    <span class="font-bold text-on-surface">Cara Cek Progres &amp; Unduh KTA:</span>
                    Gunakan <span class="font-semibold text-on-surface">NIM (<?= esc($nimKader); ?>)</span> dan <span class="font-semibold text-on-surface">Tanggal Lahir</span> Anda pada menu
                    <a href="<?= base_url('kta/cek-status'); ?>" class="italic text-primary hover:underline font-medium">Cek Status Pengajuan</a>.
                </p>
            </div>

            <!-- Action Button -->
            <div>
                <a href="<?= base_url('/'); ?>"
                    class="inline-flex items-center justify-center gap-2 bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md px-6 py-2.5 rounded-full shadow-sm hover:shadow-md transition-all duration-200">
                    <span class="material-symbols-outlined text-[18px]">home</span>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>

        </div>
    </section>

</main>

<?= $this->endSection(); ?>