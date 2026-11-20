<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$komisariatData = $komisariat ?? [];
$validationData = $validation ?? null;
$tempFilesData  = $tempFiles ?? [];

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
        <!-- Ambient Background Glow -->
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[820px] h-[300px] bg-gradient-to-b from-primary-container/10 via-surface-container/50 to-transparent blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-5xl mx-auto px-gutter py-space-xl flex flex-col gap-space-xl">

            <!-- Subheader / Pill Title -->
            <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-space-md py-1.5 rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs tracking-wider uppercase shadow-sm mb-space-sm">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span>PERMOHONAN SK</span>
                </div>
                <p class="font-body-lg text-base sm:text-body-lg text-on-surface-variant leading-relaxed m-0">
                    Lengkapi data pemohon dan seluruh dokumen persyaratan untuk proses penerbitan Surat Keputusan (SK) Pengurus Komisariat.
                </p>
            </div>

            <!-- Top Cards Grid (2 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg" data-aos="fade-up" data-aos-delay="60">

                <!-- Left Card: Panduan Pengajuan Baru -->
                <div class="bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-sm hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-secondary-container to-secondary-fixed-dim"></div>
                    <div>
                        <span class="inline-block font-label-xs text-label-xs text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-wider mb-space-md">
                            Pengajuan Baru
                        </span>
                        <h1 class="font-headline-sm text-xl text-on-surface font-bold tracking-tight mb-space-xs">
                            Ajukan SK Pengurus Komisariat
                        </h1>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-space-lg">
                            Pastikan seluruh berkas telah disiapkan dalam format PDF agar proses verifikasi berjalan lebih cepat dan tertata.
                        </p>

                        <ul class="space-y-2.5 m-0 p-0 list-none">
                            <li class="flex items-center font-body-sm text-body-sm text-on-surface font-medium">
                                <span class="w-5 h-5 rounded-full bg-primary/10 text-primary flex items-center justify-center mr-3 shrink-0">
                                    <span class="material-symbols-outlined text-[14px]">check</span>
                                </span>
                                Semua berkas wajib PDF
                            </li>
                            <li class="flex items-center font-body-sm text-body-sm text-on-surface font-medium">
                                <span class="w-5 h-5 rounded-full bg-primary/10 text-primary flex items-center justify-center mr-3 shrink-0">
                                    <span class="material-symbols-outlined text-[14px]">check</span>
                                </span>
                                Maksimal 10 MB per file
                            </li>
                            <li class="flex items-center font-body-sm text-body-sm text-on-surface font-medium">
                                <span class="w-5 h-5 rounded-full bg-primary/10 text-primary flex items-center justify-center mr-3 shrink-0">
                                    <span class="material-symbols-outlined text-[14px]">check</span>
                                </span>
                                1 komisariat hanya 1 pengajuan aktif
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Card: Status Tracking -->
                <div class="bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-sm hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-primary-container to-primary"></div>
                    <div>
                        <span class="inline-block font-label-xs text-label-xs text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-wider mb-space-md">
                            Sudah Pernah Mengajukan?
                        </span>
                        <h2 class="font-headline-sm text-xl text-on-surface font-bold tracking-tight mb-space-xs">
                            Cek Status Pengajuan
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-space-lg">
                            Gunakan kode pengajuan untuk melihat perkembangan status permohonan dan catatan admin terbaru.
                        </p>
                    </div>
                    <div>
                        <a href="<?= base_url('/cek-status-pengajuan'); ?>"
                            class="inline-flex items-center justify-center px-6 py-3 rounded-xl font-label-md text-label-md text-on-primary bg-primary-container hover:bg-primary shadow-md hover:shadow-lg transition-all duration-200 group no-underline">
                            <span>Cek Status Pengajuan</span>
                            <span class="material-symbols-outlined text-[18px] ml-2 group-hover:translate-x-1 transition-transform duration-200">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Alerts & Validation Messages -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div id="server-alert-box" class="p-space-md rounded-2xl bg-error-container text-on-error-container font-body-sm text-body-sm flex items-start gap-space-sm shadow-sm">
                    <span class="material-symbols-outlined text-error text-[20px] shrink-0 mt-0.5">error</span>
                    <div>
                        <strong class="font-bold">Pengajuan belum dapat diproses.</strong> <?= esc(session()->getFlashdata('error')); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($validationData && $validationData->getErrors()) : ?>
                <div id="server-alert-box" class="p-space-md rounded-2xl bg-error-container text-on-error-container font-body-sm text-body-sm shadow-sm">
                    <div class="flex items-center gap-space-sm font-bold mb-1">
                        <span class="material-symbols-outlined text-error text-[20px]">warning</span>
                        <span>Periksa kembali data yang diisi (isian sebelumnya tetap tersimpan):</span>
                    </div>
                    <ul class="list-disc pl-6 m-0 space-y-1">
                        <?php foreach ($validationData->getErrors() as $error) : ?>
                            <li><?= esc($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Client-side Instant Validation Banner -->
            <div id="client-alert-box" class="hidden p-space-md rounded-2xl bg-error-container text-on-error-container font-body-sm text-body-sm shadow-sm">
                <div class="flex items-center gap-space-sm font-bold mb-1">
                    <span class="material-symbols-outlined text-error text-[20px]">warning</span>
                    <span id="client-alert-title">Mohon lengkapi bagian yang ditandai merah:</span>
                </div>
                <p id="client-alert-desc" class="m-0 pl-7"></p>
            </div>

            <?php if (empty($komisariatData)) : ?>
                <div class="p-space-md rounded-2xl bg-secondary-fixed text-on-secondary-fixed font-body-sm text-body-sm flex items-center gap-space-sm shadow-sm">
                    <span class="material-symbols-outlined text-[20px] shrink-0">info</span>
                    <span>Data komisariat belum tersedia. Silakan hubungi admin terlebih dahulu.</span>
                </div>
            <?php endif; ?>

            <!-- Main Application Form -->
            <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg sm:p-space-xl" data-aos="fade-up" data-aos-delay="100">

                <!-- Form Section Header -->
                <div class="mb-space-lg flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <span class="inline-block font-label-xs text-label-xs text-primary bg-primary/10 px-3 py-1 rounded-full uppercase tracking-wider mb-space-xs">
                            Formulir Pengajuan
                        </span>
                        <p class="font-body-sm text-body-sm text-on-surface-variant m-0">
                            Isi formulir berikut hanya jika Anda belum memiliki pengajuan aktif untuk komisariat yang dipilih.
                        </p>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-surface-container-low text-xs font-semibold text-primary shrink-0">
                        <span class="material-symbols-outlined text-[16px]">task_alt</span>
                        <span id="berkas-counter">0 / <?= count($dokumenList); ?> Berkas Siap</span>
                    </div>
                </div>

                <form id="form-pengajuan-sk" action="<?= base_url('/permohonan-sk/store'); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
                    <?= csrf_field(); ?>

                    <!-- Applicant Details: Two Columns -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md mb-space-md">
                        <!-- Nama Lengkap Pemohon -->
                        <div id="wrap-nama_pemohon">
                            <label for="nama_pemohon" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                Nama Lengkap Pemohon <span class="text-error">*</span>
                            </label>
                            <input type="text"
                                id="nama_pemohon"
                                name="nama_pemohon"
                                value="<?= esc(old('nama_pemohon') ?? ''); ?>"
                                placeholder="Contoh: Ahmad Fauzi"
                                required
                                class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-transparent" />
                            <p id="err-nama_pemohon" class="hidden text-xs text-error mt-1 mb-0 font-medium"></p>
                        </div>

                        <!-- WhatsApp -->
                        <div id="wrap-whatsapp">
                            <label for="whatsapp" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                Nomor WhatsApp Aktif <span class="text-error">*</span>
                            </label>
                            <input type="tel"
                                id="whatsapp"
                                name="whatsapp"
                                inputmode="numeric"
                                maxlength="16"
                                value="<?= esc(old('whatsapp') ?? ''); ?>"
                                placeholder="Contoh: 081234567890"
                                required
                                class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-transparent" />
                            <p id="help-whatsapp" class="text-[11.5px] text-on-surface-variant mt-1 mb-0">
                                Masukkan nomor HP/WhatsApp aktif (10–14 digit, diawali 08).
                            </p>
                            <p id="err-whatsapp" class="hidden text-xs text-error mt-1 mb-0 font-medium"></p>
                        </div>
                    </div>

                    <!-- Komisariat Dropdown Selector -->
                    <div id="wrap-komisariat_id" class="mb-space-xl">
                        <label for="komisariat_id" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                            Komisariat <span class="text-error">*</span>
                        </label>
                        <div class="relative">
                            <select id="komisariat_id"
                                name="komisariat_id"
                                required
                                class="w-full h-11 appearance-none px-space-md pr-10 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-transparent cursor-pointer">
                                <option value="">-- Pilih Komisariat --</option>
                                <?php foreach ($komisariatData as $item) : ?>
                                    <option value="<?= esc((string) $item['id']); ?>" <?= (string) old('komisariat_id') === (string) $item['id'] ? 'selected' : ''; ?>>
                                        <?= esc($item['nama_komisariat']); ?> - <?= esc($item['kampus_fakultas']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="material-symbols-outlined text-outline text-[20px] absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                        </div>
                        <p id="err-komisariat_id" class="hidden text-xs text-error mt-1 mb-0 font-medium"></p>
                    </div>

                    <!-- Section: Dokumen Wajib -->
                    <div class="pt-space-lg border-t border-outline-variant/30 mb-space-lg">
                        <h3 class="font-title-md text-title-md text-on-surface font-bold mb-1">Dokumen Wajib</h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-lg">
                            Semua berkas di bawah ini wajib diunggah dalam format PDF (maksimal 10 MB per file).
                        </p>

                        <!-- Upload Grid: 10 Items (2 Columns) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                            <?php foreach ($dokumenList as $fieldName => $fieldLabel) : ?>
                                <?php
                                $cachedFile = $tempFilesData[$fieldName] ?? null;
                                $hasCached  = ! empty($cachedFile['name']);
                                ?>
                                <div id="wrap-<?= esc($fieldName); ?>"
                                    data-has-cached="<?= $hasCached ? '1' : '0'; ?>"
                                    class="doc-upload-card rounded-xl p-space-md bg-surface-container-low/70 hover:bg-surface-container-low border <?= $hasCached ? 'border-emerald-400/70' : 'border-outline-variant/30'; ?> transition flex flex-col justify-between">
                                    <div class="flex items-start justify-between gap-2 mb-space-sm">
                                        <label for="<?= esc($fieldName); ?>" class="block font-label-sm text-label-sm text-on-surface leading-snug">
                                            <?= esc($fieldLabel); ?> <span class="text-error">*</span>
                                        </label>
                                        <?php if ($hasCached) : ?>
                                            <span class="cached-badge px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                                                Tersimpan
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="file-drop-box relative flex items-center bg-surface-container-lowest border border-outline-variant/40 rounded-lg p-1.5 cursor-pointer hover:border-primary-container transition">
                                        <input type="file"
                                            id="<?= esc($fieldName); ?>"
                                            name="<?= esc($fieldName); ?>"
                                            data-label="<?= esc($fieldLabel); ?>"
                                            accept=".pdf,application/pdf"
                                            <?= $hasCached ? '' : 'required'; ?>
                                            class="doc-file-input absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" />
                                        <span class="font-label-xs text-label-xs text-on-surface bg-surface-container-high py-1.5 px-3 rounded border border-outline-variant/30 shrink-0 pointer-events-none">
                                            <?= $hasCached ? 'Ganti File' : 'Pilih File'; ?>
                                        </span>
                                        <span class="file-name-display font-body-sm text-body-sm <?= $hasCached ? 'text-emerald-700 font-medium' : 'text-outline'; ?> ml-3 truncate pointer-events-none">
                                            <?= $hasCached ? esc($cachedFile['name']) : 'Belum ada file dipilih'; ?>
                                        </span>
                                    </div>
                                    <p id="err-<?= esc($fieldName); ?>" class="hidden text-xs text-error mt-1.5 mb-0 font-medium"></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Form Submission Bar -->
                    <div class="pt-space-lg border-t border-outline-variant/30 flex flex-col sm:flex-row items-center justify-between gap-space-md">
                        <div class="flex items-center font-body-sm text-body-sm text-on-surface-variant order-2 sm:order-1">
                            <span class="material-symbols-outlined text-primary text-[18px] mr-2 shrink-0">info</span>
                            <span>Pastikan semua file sudah benar sebelum menekan tombol submit.</span>
                        </div>

                        <button type="submit"
                            id="btn-submit-sk"
                            class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-label-md text-label-md text-on-primary bg-primary-container hover:bg-primary shadow-md hover:shadow-lg transition-all duration-200 order-1 sm:order-2 flex items-center justify-center gap-2 border-0 cursor-pointer active:scale-95">
                            <span>Submit Pengajuan</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form-pengajuan-sk');
        const namaInput = document.getElementById('nama_pemohon');
        const waInput = document.getElementById('whatsapp');
        const komSelect = document.getElementById('komisariat_id');
        const fileInputs = document.querySelectorAll('.doc-file-input');
        const counterEl = document.getElementById('berkas-counter');
        const clientAlert = document.getElementById('client-alert-box');
        const clientDesc = document.getElementById('client-alert-desc');
        const submitBtn = document.getElementById('btn-submit-sk');
        const MAX_BYTES = 10 * 1024 * 1024; // 10 MB

        // Scroll ke pesan error server jika ada
        const serverAlert = document.getElementById('server-alert-box');
        if (serverAlert) {
            serverAlert.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        // Jika halaman dibuka baru, di-refresh, atau kembali dari halaman lain (bukan redirect error submit), kosongkan form
        function resetAllFields(forceReset = false) {
            if (!form) return;
            if (!forceReset && serverAlert) return;

            form.reset();
            if (namaInput) namaInput.value = '';
            if (waInput) waInput.value = '';
            if (komSelect) komSelect.value = '';

            // Sembunyikan alert lama jika berasal dari bfcache tombol Back
            if (forceReset && serverAlert) {
                serverAlert.classList.add('hidden');
            }
            if (clientAlert) {
                clientAlert.classList.add('hidden');
            }

            // Bersihkan status field teks & select
            ['nama_pemohon', 'whatsapp', 'komisariat_id'].forEach((id) => clearFieldError(id));

            // Bersihkan semua input file & badge "Tersimpan"
            fileInputs.forEach((input) => {
                input.value = '';
                const card = input.closest('.doc-upload-card');
                const label = input.parentElement.querySelector('.file-name-display');
                const btnText = input.parentElement.querySelector('span:first-of-type');
                const badge = card ? card.querySelector('.cached-badge') : null;

                if (card) {
                    card.dataset.hasCached = '0';
                    card.classList.remove('border-emerald-400/70', 'border-primary/50', 'border-error', 'bg-error-container/20');
                    card.classList.add('border-outline-variant/30');
                }
                if (badge) badge.remove();
                if (label) {
                    label.textContent = 'Belum ada file dipilih';
                    label.classList.add('text-outline');
                    label.classList.remove('text-primary', 'text-emerald-700', 'font-medium');
                }
                if (btnText) btnText.textContent = 'Pilih File';
                clearFieldError(input.id);
            });

            updateCounter();
        }

        // Cek apakah halaman dimuat lewat tombol Back/Forward browser
        const navEntries = performance.getEntriesByType('navigation');
        const isBackForward = navEntries.length > 0 && navEntries[0].type === 'back_forward';

        resetAllFields(isBackForward);

        window.addEventListener('pageshow', function(event) {
            const nav = performance.getEntriesByType('navigation');
            const fromHistory = event.persisted || (nav.length > 0 && nav[0].type === 'back_forward');
            if (fromHistory) {
                resetAllFields(true);
            }
        });

        // Normalisasi otomatis nomor WhatsApp saat mengetik / paste (+62 / 62 / spasi / strip -> 08...)
        function normalizeWa(raw) {
            let digits = (raw || '').replace(/[^0-9]/g, '');
            if (digits.startsWith('62')) {
                digits = '0' + digits.slice(2);
            } else if (digits.startsWith('8')) {
                digits = '0' + digits;
            }
            return digits;
        }

        if (waInput) {
            waInput.addEventListener('input', function() {
                const clean = normalizeWa(this.value);
                if (this.value !== clean) {
                    this.value = clean;
                }
                if (clean === '' || /^08[1-9][0-9]{7,11}$/.test(clean)) {
                    clearFieldError('whatsapp');
                }
            });
        }

        if (namaInput) {
            namaInput.addEventListener('input', function() {
                if (this.value.trim().length >= 3) clearFieldError('nama_pemohon');
            });
        }

        if (komSelect) {
            komSelect.addEventListener('change', function() {
                if (this.value !== '') clearFieldError('komisariat_id');
            });
        }

        function updateCounter() {
            if (!counterEl) return;
            let ready = 0;
            fileInputs.forEach((input) => {
                const card = input.closest('.doc-upload-card');
                const hasCached = card && card.dataset.hasCached === '1';
                const hasNewFile = input.files && input.files.length > 0;
                if (hasNewFile || hasCached) ready++;
            });
            counterEl.textContent = `${ready} / ${fileInputs.length} Berkas Siap`;
        }

        function setFieldError(fieldId, msg) {
            const errEl = document.getElementById('err-' + fieldId);
            const inputEl = document.getElementById(fieldId);
            const cardEl = document.getElementById('wrap-' + fieldId);

            if (errEl) {
                errEl.textContent = msg;
                errEl.classList.remove('hidden');
            }
            if (inputEl && (inputEl.tagName === 'INPUT' || inputEl.tagName === 'SELECT') && inputEl.type !== 'file') {
                inputEl.classList.add('border-error', 'ring-2', 'ring-error/30');
                inputEl.classList.remove('border-transparent');
            }
            if (cardEl && cardEl.classList.contains('doc-upload-card')) {
                cardEl.classList.add('border-error', 'bg-error-container/20');
                cardEl.classList.remove('border-outline-variant/30', 'border-emerald-400/70');
            }
        }

        function clearFieldError(fieldId) {
            const errEl = document.getElementById('err-' + fieldId);
            const inputEl = document.getElementById(fieldId);
            const cardEl = document.getElementById('wrap-' + fieldId);

            if (errEl) {
                errEl.textContent = '';
                errEl.classList.add('hidden');
            }
            if (inputEl && (inputEl.tagName === 'INPUT' || inputEl.tagName === 'SELECT') && inputEl.type !== 'file') {
                inputEl.classList.remove('border-error', 'ring-2', 'ring-error/30');
                inputEl.classList.add('border-transparent');
            }
            if (cardEl && cardEl.classList.contains('doc-upload-card')) {
                cardEl.classList.remove('border-error', 'bg-error-container/20');
                if (cardEl.dataset.hasCached === '1') {
                    cardEl.classList.add('border-emerald-400/70');
                } else {
                    cardEl.classList.add('border-outline-variant/30');
                }
            }
        }

        fileInputs.forEach((input) => {
            input.addEventListener('change', function() {
                const card = this.closest('.doc-upload-card');
                const label = this.parentElement.querySelector('.file-name-display');
                const btnText = this.parentElement.querySelector('span:first-of-type');

                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    const isPdf = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');

                    if (!isPdf) {
                        this.value = '';
                        setFieldError(this.id, 'Format file harus PDF.');
                        updateCounter();
                        return;
                    }

                    if (file.size > MAX_BYTES) {
                        this.value = '';
                        setFieldError(this.id, 'Ukuran file melebihi batas maksimal 10 MB.');
                        updateCounter();
                        return;
                    }

                    clearFieldError(this.id);
                    if (label) {
                        label.textContent = file.name;
                        label.classList.remove('text-outline');
                        label.classList.add('text-primary', 'font-medium');
                    }
                    if (btnText) btnText.textContent = 'Ganti File';
                    if (card) {
                        card.classList.add('border-primary/50');
                    }
                }
                updateCounter();
            });
        });

        updateCounter();

        if (form) {
            form.addEventListener('submit', function(e) {
                let firstInvalidEl = null;
                let errorCount = 0;

                // 1. Validasi Nama
                const namaVal = (namaInput ? namaInput.value.trim() : '');
                if (namaVal.length < 3) {
                    setFieldError('nama_pemohon', 'Nama lengkap pemohon wajib diisi (minimal 3 karakter).');
                    firstInvalidEl = firstInvalidEl || namaInput;
                    errorCount++;
                } else {
                    clearFieldError('nama_pemohon');
                }

                // 2. Validasi WhatsApp
                const waVal = normalizeWa(waInput ? waInput.value : '');
                if (waInput) waInput.value = waVal;
                if (!/^08[1-9][0-9]{7,11}$/.test(waVal)) {
                    setFieldError('whatsapp', 'Masukkan nomor WhatsApp aktif yang valid (10–14 digit, diawali 08).');
                    firstInvalidEl = firstInvalidEl || waInput;
                    errorCount++;
                } else {
                    clearFieldError('whatsapp');
                }

                // 3. Validasi Komisariat
                if (!komSelect || komSelect.value === '') {
                    setFieldError('komisariat_id', 'Silakan pilih Komisariat terlebih dahulu.');
                    firstInvalidEl = firstInvalidEl || komSelect;
                    errorCount++;
                } else {
                    clearFieldError('komisariat_id');
                }

                // 4. Validasi 10 Berkas PDF
                fileInputs.forEach((input) => {
                    const card = input.closest('.doc-upload-card');
                    const hasCached = card && card.dataset.hasCached === '1';
                    const hasNew = input.files && input.files.length > 0;

                    if (!hasNew && !hasCached) {
                        setFieldError(input.id, 'Berkas PDF ini wajib diunggah.');
                        firstInvalidEl = firstInvalidEl || card;
                        errorCount++;
                    } else {
                        clearFieldError(input.id);
                    }
                });

                if (errorCount > 0) {
                    e.preventDefault();
                    if (clientAlert && clientDesc) {
                        clientDesc.textContent = `Terdapat ${errorCount} kolom atau berkas yang belum lengkap/sesuai. Isian Anda yang lain tetap aman.`;
                        clientAlert.classList.remove('hidden');
                    }
                    if (firstInvalidEl) {
                        firstInvalidEl.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        if (typeof firstInvalidEl.focus === 'function') {
                            firstInvalidEl.focus({
                                preventScroll: true
                            });
                        }
                    }
                    return;
                }

                if (clientAlert) clientAlert.classList.add('hidden');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span>Mengirim Pengajuan...</span>';
                }
            });
        }
    });
</script>

<?= $this->endSection(); ?>