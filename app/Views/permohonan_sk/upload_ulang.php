<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$pengajuanData        = $pengajuan ?? null;
$komisariatData       = $komisariat ?? null;
$validationData       = $validation ?? null;
$tempFilesData        = $tempFiles ?? [];
$kodePengajuanValue   = $pengajuanData['kode_pengajuan'] ?? '';
$statusPengajuanValue = $pengajuanData['status'] ?? '';

$dokumenList = [
    'surat_pengajuan_sk'                    => 'Surat Pengajuan SK',
    'berita_acara_rtk'                      => 'Berita Acara RTK',
    'berita_acara_formatur'                 => 'Berita Acara Formatur',
    'struktur_kepengurusan'                 => 'Struktur Kepengurusan',
    'laporan_pertanggungjawaban_demisioner' => 'Laporan Pertanggungjawaban Pengurus Demisioner',
    'dokumentasi_rtk'                       => 'Dokumentasi RTK',
    'sertifikat_pkd_ketua_bph'              => 'Fotocopy Sertifikat PKD bagi Ketua dan BPH Komisariat',
    'cv_pengurus_ktm_ktp_transkrip'         => 'CV Pengurus Komisariat yang dilengkapi KTM, KTP, dan Transkrip Nilai',
    'cv_bph_komisariat'                     => 'CV Badan Pengurus Harian (BPH) Komisariat',
    'database_anggota'                      => 'Database Anggota Lengkap',
];
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="relative w-full overflow-hidden">
        <div class="max-w-5xl mx-auto px-gutter py-space-xl flex flex-col gap-space-xl">

            <!-- Header Section -->
            <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-space-md py-1.5 rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs tracking-wider uppercase shadow-sm mb-space-sm">
                    <span class="material-symbols-outlined text-[16px]">upload_file</span>
                    <span>UPLOAD ULANG BERKAS</span>
                </div>
                <h1 class="font-headline-lg text-2xl sm:text-headline-lg text-on-surface font-extrabold tracking-tight m-0">
                    Perbarui Berkas Pengajuan SK
                </h1>
                <p class="font-body-md text-body-md text-on-surface-variant mt-space-xs m-0">
                    Perbarui berkas pengajuan sesuai catatan admin tanpa membuat kode pengajuan baru.
                </p>
            </div>

            <!-- Alerts -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div id="server-alert-box" class="p-space-md rounded-2xl bg-error-container text-on-error-container font-body-sm text-body-sm flex items-center gap-space-sm shadow-sm">
                    <span class="material-symbols-outlined text-error text-[20px] shrink-0">error</span>
                    <span><?= esc(session()->getFlashdata('error')); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($validationData && $validationData->getErrors()) : ?>
                <div id="server-alert-box" class="p-space-md rounded-2xl bg-error-container text-on-error-container font-body-sm text-body-sm shadow-sm">
                    <div class="flex items-center gap-space-sm font-bold mb-1">
                        <span class="material-symbols-outlined text-error text-[20px]">warning</span>
                        <span>Periksa kembali file yang diunggah (berkas valid sebelumnya tetap tersimpan):</span>
                    </div>
                    <ul class="list-disc pl-6 m-0 space-y-1">
                        <?php foreach ($validationData->getErrors() as $error) : ?>
                            <li><?= esc($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div id="client-alert-box" class="hidden p-space-md rounded-2xl bg-error-container text-on-error-container font-body-sm text-body-sm flex items-center gap-space-sm shadow-sm">
                <span class="material-symbols-outlined text-error text-[20px] shrink-0">warning</span>
                <span id="client-alert-desc">Silakan pilih minimal satu berkas PDF yang ingin diperbarui sebelum mengirim.</span>
            </div>

            <!-- Detail & Guidance Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg" data-aos="fade-up" data-aos-delay="60">
                <!-- Detail Pengajuan -->
                <div class="bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-sm relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-secondary-container to-secondary-fixed-dim"></div>
                    <div>
                        <span class="inline-block font-label-xs text-label-xs text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-wider mb-space-md">
                            Detail Pengajuan
                        </span>
                        <h2 class="font-mono text-xl font-extrabold text-primary mb-space-xs">
                            <?= esc($kodePengajuanValue ?: '-'); ?>
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">
                            Komisariat: <strong class="text-on-surface"><?= esc($komisariatData['nama_komisariat'] ?? '-'); ?></strong><br />
                            Status saat ini: <strong class="text-on-surface"><?= esc(ucfirst($statusPengajuanValue ?: '-')); ?></strong>
                        </p>
                        <ul class="space-y-2 m-0 p-0 list-none font-body-sm text-body-sm text-on-surface">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-primary">check_circle</span>
                                Upload ulang dilakukan pada pengajuan yang sama
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-primary">check_circle</span>
                                Setelah dikirim, status kembali menjadi menunggu
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Petunjuk -->
                <div class="bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-sm relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-primary-container to-primary"></div>
                    <div>
                        <span class="inline-block font-label-xs text-label-xs text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-wider mb-space-md">
                            Petunjuk
                        </span>
                        <h2 class="font-headline-sm text-xl font-bold text-on-surface mb-space-xs">
                            Perbarui Seperlunya
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-space-lg">
                            Anda cukup mengunggah file yang ingin diperbaiki sesuai arahan admin. Minimal unggah satu file dalam format PDF (maks. 10 MB).
                        </p>
                    </div>
                    <div>
                        <a href="<?= base_url('/cek-status-pengajuan'); ?>"
                            class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl font-label-sm text-label-sm text-primary bg-surface-container-low hover:bg-surface-container-high transition no-underline">
                            <span class="material-symbols-outlined text-[18px] mr-1.5">arrow_back</span>
                            <span>Kembali ke Cek Status</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Catatan Admin -->
            <?php if (! empty($pengajuanData['catatan_admin'])) : ?>
                <div class="p-space-md sm:p-space-lg rounded-2xl bg-secondary-fixed text-on-secondary-fixed font-body-sm text-body-sm shadow-sm flex items-start gap-space-sm">
                    <span class="material-symbols-outlined text-[22px] shrink-0 mt-0.5">rate_review</span>
                    <div>
                        <strong class="font-bold block mb-1">Catatan Admin:</strong>
                        <p class="m-0 leading-relaxed"><?= nl2br(esc($pengajuanData['catatan_admin'])); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Form Upload Ulang -->
            <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg sm:p-space-xl" data-aos="fade-up" data-aos-delay="100">
                <div class="mb-space-lg flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <span class="inline-block font-label-xs text-label-xs text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-wider mb-space-xs">
                            Form Upload Ulang
                        </span>
                        <h3 class="font-title-md text-title-md text-on-surface font-bold mb-1">Unggah Berkas yang Diperbarui</h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant m-0">
                            Pilih file PDF yang ingin diperbarui. File yang tidak dipilih akan tetap menggunakan berkas sebelumnya.
                        </p>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-surface-container-low text-xs font-semibold text-primary shrink-0">
                        <span class="material-symbols-outlined text-[16px]">upload_file</span>
                        <span id="reupload-counter">0 Berkas Diperbarui</span>
                    </div>
                </div>

                <form id="form-upload-ulang-sk" action="<?= base_url('/permohonan-sk/upload-ulang/' . esc($kodePengajuanValue)); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                    <?= csrf_field(); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md mb-space-lg">
                        <?php foreach ($dokumenList as $fieldName => $fieldLabel) : ?>
                            <?php
                            $hasExisting = ! empty($pengajuanData[$fieldName]);
                            $cachedFile  = $tempFilesData[$fieldName] ?? null;
                            $hasCached   = ! empty($cachedFile['name']);
                            ?>
                            <div id="wrap-<?= esc($fieldName); ?>"
                                data-has-cached="<?= $hasCached ? '1' : '0'; ?>"
                                class="reupload-card rounded-xl p-space-md bg-surface-container-low/70 hover:bg-surface-container-low border <?= $hasCached ? 'border-primary/60' : 'border-outline-variant/30'; ?> transition flex flex-col justify-between">
                                <div class="flex items-start justify-between gap-2 mb-space-sm">
                                    <label for="<?= esc($fieldName); ?>" class="block font-label-sm text-label-sm text-on-surface leading-snug">
                                        <?= esc($fieldLabel); ?>
                                    </label>
                                    <?php if ($hasCached) : ?>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-50 text-primary border border-blue-200 shrink-0">
                                            Siap Dikirim
                                        </span>
                                    <?php elseif ($hasExisting) : ?>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                                            Tersimpan
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="relative flex items-center bg-surface-container-lowest border border-outline-variant/40 rounded-lg p-1.5 cursor-pointer hover:border-primary-container transition">
                                    <input type="file"
                                        id="<?= esc($fieldName); ?>"
                                        name="<?= esc($fieldName); ?>"
                                        accept=".pdf,application/pdf"
                                        class="reupload-file-input absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" />
                                    <span class="font-label-xs text-label-xs text-on-surface bg-surface-container-high py-1.5 px-3 rounded border border-outline-variant/30 shrink-0 pointer-events-none">
                                        Pilih File
                                    </span>
                                    <span class="file-name-display font-body-sm text-body-sm <?= $hasCached ? 'text-primary font-medium' : 'text-outline'; ?> ml-3 truncate pointer-events-none">
                                        <?= $hasCached ? esc($cachedFile['name']) : 'Pertahankan file lama'; ?>
                                    </span>
                                </div>
                                <p id="err-<?= esc($fieldName); ?>" class="hidden text-xs text-error mt-1.5 mb-0 font-medium"></p>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="pt-space-lg border-t border-outline-variant/30 flex flex-col sm:flex-row items-center justify-between gap-space-md">
                        <div class="flex items-center font-body-sm text-body-sm text-on-surface-variant order-2 sm:order-1">
                            <span class="material-symbols-outlined text-primary text-[18px] mr-2 shrink-0">info</span>
                            <span>Minimal unggah satu file yang ingin diperbarui sebelum mengirim upload ulang.</span>
                        </div>

                        <button type="submit"
                            id="btn-submit-reupload"
                            class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-label-md text-label-md text-on-primary bg-primary-container hover:bg-primary shadow-md hover:shadow-lg transition-all duration-200 order-1 sm:order-2 flex items-center justify-center gap-2 border-0 cursor-pointer active:scale-95">
                            <span>Kirim Upload Ulang</span>
                            <span class="material-symbols-outlined text-[18px]">send</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form-upload-ulang-sk');
        const fileInputs = document.querySelectorAll('.reupload-file-input');
        const counterEl = document.getElementById('reupload-counter');
        const clientAlert = document.getElementById('client-alert-box');
        const clientDesc = document.getElementById('client-alert-desc');
        const submitBtn = document.getElementById('btn-submit-reupload');
        const MAX_BYTES = 10 * 1024 * 1024;

        const serverAlert = document.getElementById('server-alert-box');
        if (serverAlert) {
            serverAlert.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function resetAllReuploadFields(forceReset = false) {
            if (!form) return;
            if (!forceReset && serverAlert) return;

            form.reset();
            if (forceReset && serverAlert) serverAlert.classList.add('hidden');
            if (clientAlert) clientAlert.classList.add('hidden');

            fileInputs.forEach((input) => {
                input.value = '';
                const card = input.closest('.reupload-card');
                const label = input.parentElement.querySelector('.file-name-display');
                if (card) {
                    card.dataset.hasCached = '0';
                    card.classList.remove('border-primary/60', 'border-error');
                    card.classList.add('border-outline-variant/30');
                }
                if (label) {
                    label.textContent = 'Pertahankan file lama';
                    label.classList.add('text-outline');
                    label.classList.remove('text-primary', 'font-medium');
                }
            });
            updateCounter();
        }

        const navEntries = performance.getEntriesByType('navigation');
        const isBackForward = navEntries.length > 0 && navEntries[0].type === 'back_forward';

        resetAllReuploadFields(isBackForward);

        window.addEventListener('pageshow', function(event) {
            const nav = performance.getEntriesByType('navigation');
            const fromHistory = event.persisted || (nav.length > 0 && nav[0].type === 'back_forward');
            if (fromHistory) {
                resetAllReuploadFields(true);
            }
        });

        function updateCounter() {
            let count = 0;
            fileInputs.forEach((input) => {
                const card = input.closest('.reupload-card');
                const hasCached = card && card.dataset.hasCached === '1';
                const hasNew = input.files && input.files.length > 0;
                if (hasNew || hasCached) count++;
            });
            if (counterEl) counterEl.textContent = `${count} Berkas Diperbarui`;
            return count;
        }

        fileInputs.forEach((input) => {
            input.addEventListener('change', function() {
                const card = this.closest('.reupload-card');
                const errEl = document.getElementById('err-' + this.id);
                const label = this.parentElement.querySelector('.file-name-display');

                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    const isPdf = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');

                    if (!isPdf || file.size > MAX_BYTES) {
                        this.value = '';
                        if (errEl) {
                            errEl.textContent = !isPdf ? 'Format file harus PDF.' : 'Ukuran file maksimal 10 MB.';
                            errEl.classList.remove('hidden');
                        }
                        if (card) card.classList.add('border-error');
                        updateCounter();
                        return;
                    }

                    if (errEl) errEl.classList.add('hidden');
                    if (card) {
                        card.classList.remove('border-error', 'border-outline-variant/30');
                        card.classList.add('border-primary/60');
                    }
                    if (label) {
                        label.textContent = file.name;
                        label.classList.remove('text-outline');
                        label.classList.add('text-primary', 'font-medium');
                    }
                }
                if (clientAlert) clientAlert.classList.add('hidden');
                updateCounter();
            });
        });

        updateCounter();

        if (form) {
            form.addEventListener('submit', function(e) {
                if (updateCounter() === 0) {
                    e.preventDefault();
                    if (clientAlert && clientDesc) {
                        clientDesc.textContent = 'Silakan pilih minimal satu berkas PDF yang ingin diperbarui terlebih dahulu.';
                        clientAlert.classList.remove('hidden');
                        clientAlert.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                    return;
                }
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span>Mengirim Berkas...</span>';
                }
            });
        }
    });
</script>

<?= $this->endSection(); ?>