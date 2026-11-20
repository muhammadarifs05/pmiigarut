<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$komisariatData = $komisariat ?? [];
$errorsData     = session()->getFlashdata('errors') ?? [];
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="relative w-full overflow-hidden">
        <!-- Ambient Background Glow -->
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[820px] h-[300px] bg-gradient-to-b from-primary-container/10 via-surface-container/50 to-transparent blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-5xl mx-auto px-gutter py-space-xl flex flex-col gap-space-xl">

            <!-- Hero Headline Section -->
            <section class="text-center max-w-3xl mx-auto" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-space-md py-1.5 rounded-full bg-surface-container-highest text-primary font-label-xs text-label-xs tracking-widest uppercase shadow-sm mb-space-sm">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span>LAYANAN KTA</span>
                </div>

                <h1 class="font-headline-xl text-3xl sm:text-4xl lg:text-headline-xl text-on-surface font-extrabold tracking-tight leading-tight m-0">
                    Layanan <span class="text-primary">KTA Digital</span>
                </h1>

                <!-- Split Color Bar Indicator -->
                <div class="flex items-center justify-center gap-1.5 my-space-sm">
                    <span class="h-1 w-10 bg-primary-container rounded-full"></span>
                    <span class="h-1 w-6 bg-secondary-container rounded-full"></span>
                </div>

                <p class="max-w-2xl mx-auto font-body-lg text-sm sm:text-body-lg text-on-surface-variant leading-relaxed m-0">
                    Lengkapi data diri untuk proses penerbitan Kartu Tanda Anggota (KTA) atau cek status pengajuan yang sudah pernah dilakukan.
                </p>
            </section>

            <!-- Dual Informational Cards Section -->
            <section class="grid grid-cols-1 md:grid-cols-2 gap-space-lg" data-aos="fade-up" data-aos-delay="60">

                <!-- Left Card: Pengajuan Baru -->
                <div class="bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-sm hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between border border-outline-variant/30">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-primary-container to-primary"></div>
                    <div>
                        <span class="inline-block bg-primary/10 text-primary font-label-xs text-label-xs tracking-wider uppercase px-3 py-1 rounded-md mb-space-sm">
                            PENGAJUAN BARU
                        </span>
                        <h2 class="font-headline-sm text-lg sm:text-xl font-bold text-on-surface mb-space-xs">
                            Formulir Pengajuan KTA
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-space-md">
                            Pastikan seluruh data diri (NIM, Nama, dan Pasfoto) disiapkan dengan valid agar proses verifikasi berjalan cepat dan akurat.
                        </p>
                    </div>

                    <ul class="space-y-2.5 pt-space-md border-t border-outline-variant/25 font-body-sm text-body-sm font-medium text-on-surface m-0 p-0 list-none">
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[14px]">check</span>
                            </span>
                            <span>Wajib melampirkan Pasfoto Formal</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[14px]">check</span>
                            </span>
                            <span>Wajib melampirkan Sertifikat Mapaba</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[14px]">check</span>
                            </span>
                            <span>Data terverifikasi oleh Admin PC PMII Garut</span>
                        </li>
                    </ul>
                </div>

                <!-- Right Card: Cek Status Pengajuan -->
                <div class="bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-sm hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between border border-outline-variant/30">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-secondary-container to-secondary-fixed-dim"></div>
                    <div>
                        <span class="inline-block bg-primary/10 text-primary font-label-xs text-label-xs tracking-wider uppercase px-3 py-1 rounded-md mb-space-sm">
                            SUDAH PERNAH MENGAJUKAN?
                        </span>
                        <h2 class="font-headline-sm text-lg sm:text-xl font-bold text-on-surface mb-space-xs">
                            Cek Status Pengajuan
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-space-lg">
                            Gunakan <strong class="font-semibold text-on-surface">NIM dan Tanggal Lahir</strong> Anda untuk memantau status verifikasi serta mengunduh KTA Digital dalam format PDF maupun JPG.
                        </p>
                    </div>

                    <div class="pt-space-xs">
                        <a href="<?= base_url('kta/cek-status'); ?>"
                            class="inline-flex items-center justify-center gap-2 bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md px-5 py-3 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 group">
                            <span class="material-symbols-outlined text-[18px]">search</span>
                            <span>Cek Status Pengajuan</span>
                            <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </section>

            <!-- Registration Form Container -->
            <section class="bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden border border-outline-variant/30" data-aos="fade-up" data-aos-delay="100">

                <!-- Form Header Ribbon -->
                <div class="bg-primary-container px-space-lg py-4 flex items-center gap-2.5 text-white">
                    <span class="material-symbols-outlined text-[20px] text-white">edit_square</span>
                    <h3 class="font-title-md text-title-md font-bold tracking-wide text-white m-0">
                        Formulir Pengajuan KTA Digital
                    </h3>
                </div>

                <!-- Main Form Body -->
                <div class="p-space-lg sm:p-space-xl">

                    <!-- Validation Errors Alert -->
                    <?php if (! empty($errorsData)) : ?>
                        <div class="mb-space-lg p-space-md rounded-2xl bg-error-container text-on-error-container font-body-sm text-body-sm shadow-sm">
                            <div class="flex items-center gap-space-sm font-bold mb-1">
                                <span class="material-symbols-outlined text-error text-[20px]">warning</span>
                                <span>Periksa kembali data pengajuan Anda:</span>
                            </div>
                            <ul class="list-disc pl-6 m-0 space-y-1">
                                <?php foreach ($errorsData as $error) : ?>
                                    <li><?= esc($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('kta/store'); ?>" method="post" enctype="multipart/form-data" class="flex flex-col gap-space-md">
                        <?= csrf_field(); ?>

                        <!-- Row 1: NIM and Full Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                            <div>
                                <label for="nim" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    NIM / NPM <span class="text-error">*</span>
                                </label>
                                <input type="text"
                                    id="nim"
                                    name="nim"
                                    maxlength="30"
                                    value="<?= esc(old('nim')); ?>"
                                    placeholder="Masukkan NIM/NPM Anda"
                                    required
                                    class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30" />
                            </div>

                            <div>
                                <label for="nama_lengkap" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    Nama Lengkap (Sesuai KTP) <span class="text-error">*</span>
                                </label>
                                <input type="text"
                                    id="nama_lengkap"
                                    name="nama_lengkap"
                                    value="<?= esc(old('nama_lengkap')); ?>"
                                    placeholder="Masukkan nama lengkap sesuai KTP"
                                    required
                                    class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30" />
                            </div>
                        </div>

                        <!-- Row 2: Email and WhatsApp -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                            <div>
                                <label for="email" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    Email Aktif <span class="text-error">*</span>
                                </label>
                                <input type="email"
                                    id="email"
                                    name="email"
                                    value="<?= esc(old('email')); ?>"
                                    placeholder="nama@email.com"
                                    required
                                    class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30" />
                                <p class="font-label-xs text-label-xs text-on-surface-variant mt-1.5 m-0">
                                    Notifikasi KTA terbit akan dikirim ke alamat email ini.
                                </p>
                            </div>

                            <div>
                                <label for="no_hp" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    No. HP / WhatsApp <span class="text-error">*</span>
                                </label>
                                <input type="tel"
                                    id="no_hp"
                                    name="no_hp"
                                    maxlength="20"
                                    value="<?= esc(old('no_hp')); ?>"
                                    placeholder="08xxxxxxxxxx"
                                    required
                                    class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30" />
                            </div>
                        </div>

                        <!-- Row 3: Place & Date of Birth -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                            <div>
                                <label for="tempat_lahir" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    Tempat Lahir <span class="text-error">*</span>
                                </label>
                                <input type="text"
                                    id="tempat_lahir"
                                    name="tempat_lahir"
                                    value="<?= esc(old('tempat_lahir')); ?>"
                                    placeholder="Contoh: Garut"
                                    required
                                    class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30" />
                            </div>

                            <div>
                                <label for="tanggal_lahir" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    Tanggal Lahir <span class="text-error">*</span>
                                </label>
                                <input type="date"
                                    id="tanggal_lahir"
                                    name="tanggal_lahir"
                                    value="<?= esc(old('tanggal_lahir')); ?>"
                                    required
                                    class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30" />
                            </div>
                        </div>

                        <!-- Row 4: Full Address -->
                        <div>
                            <label for="alamat" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                Alamat Lengkap <span class="text-error">*</span>
                            </label>
                            <input type="text"
                                id="alamat"
                                name="alamat"
                                value="<?= esc(old('alamat')); ?>"
                                placeholder="Contoh: Jl. Pembangunan No. 12, Tarogong Kidul, Kab. Garut"
                                required
                                class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30" />
                        </div>

                        <!-- Row 5: Gender and Komisariat -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                            <div>
                                <label for="jenis_kelamin" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    Jenis Kelamin <span class="text-error">*</span>
                                </label>
                                <div class="relative">
                                    <select id="jenis_kelamin"
                                        name="jenis_kelamin"
                                        required
                                        class="w-full h-11 appearance-none px-space-md pr-10 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30 cursor-pointer">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" <?= old('jenis_kelamin') === 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                        <option value="P" <?= old('jenis_kelamin') === 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                    <span class="material-symbols-outlined text-outline text-[20px] absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                                </div>
                            </div>

                            <div>
                                <label for="komisariat_id" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    Asal Komisariat <span class="text-error">*</span>
                                </label>
                                <div class="relative">
                                    <select id="komisariat_id"
                                        name="komisariat_id"
                                        required
                                        class="w-full h-11 appearance-none px-space-md pr-10 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30 cursor-pointer">
                                        <option value="">-- Pilih Komisariat --</option>
                                        <?php foreach ($komisariatData as $k) : ?>
                                            <option value="<?= esc((string) $k['id']); ?>" <?= old('komisariat_id') == $k['id'] ? 'selected' : ''; ?>>
                                                <?= esc($k['nama_komisariat']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="material-symbols-outlined text-outline text-[20px] absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                        </div>

                        <!-- Row 6: Rayon and Mapaba Year -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                            <div>
                                <label for="rayon" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    Asal Rayon (Opsional)
                                </label>
                                <input type="text"
                                    id="rayon"
                                    name="rayon"
                                    value="<?= esc(old('rayon')); ?>"
                                    placeholder="Contoh: Rayon Tarbiyah"
                                    class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30" />
                            </div>

                            <div>
                                <label for="tahun_mapaba" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    Tahun Pelaksanaan Mapaba <span class="text-error">*</span>
                                </label>
                                <input type="number"
                                    id="tahun_mapaba"
                                    name="tahun_mapaba"
                                    min="2000"
                                    max="<?= date('Y'); ?>"
                                    value="<?= esc((string) old('tahun_mapaba', date('Y'))); ?>"
                                    required
                                    class="w-full h-11 px-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md font-medium focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container outline-none transition border border-outline-variant/30" />
                            </div>
                        </div>

                        <!-- Row 7: File Uploads -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md pt-space-xs">
                            <!-- Pasfoto Upload -->
                            <div>
                                <label for="pas_foto" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    Pasfoto Formal 3×4, Latar Biru (Format JPG/PNG, Max 2MB) <span class="text-error">*</span>
                                </label>
                                <div class="relative flex items-center bg-surface-container-low/80 border border-outline-variant/40 rounded-xl p-1.5 cursor-pointer hover:border-primary-container transition">
                                    <input type="file"
                                        id="pas_foto"
                                        name="pas_foto"
                                        accept="image/png, image/jpeg, image/jpg"
                                        required
                                        class="kta-file-input absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" />
                                    <span class="font-label-xs text-label-xs text-on-surface bg-surface-container-lowest py-1.5 px-3 rounded-lg border border-outline-variant/40 shadow-2xs shrink-0 pointer-events-none">
                                        Choose File
                                    </span>
                                    <span class="file-name-display font-body-sm text-body-sm text-outline ml-3 truncate pointer-events-none">
                                        Belum ada file dipilih
                                    </span>
                                </div>
                                <p class="font-label-xs text-label-xs text-on-surface-variant mt-1.5 leading-snug m-0">
                                    Gunakan pasfoto resmi berjas PMII dengan ukuran foto <strong class="text-on-surface">3×4</strong> (ukuran ideal <strong class="text-on-surface">450 × 600 piksel</strong>). <strong class="text-on-surface">Latar Belakang Biru.</strong>
                                </p>
                            </div>

                            <!-- Bukti Sertifikat Upload -->
                            <div>
                                <label for="berkas_bukti" class="block font-label-sm text-label-sm text-on-surface mb-space-xs">
                                    Bukti Sertifikat Mapaba (JPG/PNG/PDF, Max 2MB) <span class="text-error">*</span>
                                </label>
                                <div class="relative flex items-center bg-surface-container-low/80 border border-outline-variant/40 rounded-xl p-1.5 cursor-pointer hover:border-primary-container transition">
                                    <input type="file"
                                        id="berkas_bukti"
                                        name="berkas_bukti"
                                        accept="image/png, image/jpeg, image/jpg, application/pdf"
                                        required
                                        class="kta-file-input absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" />
                                    <span class="font-label-xs text-label-xs text-on-surface bg-surface-container-lowest py-1.5 px-3 rounded-lg border border-outline-variant/40 shadow-2xs shrink-0 pointer-events-none">
                                        Choose File
                                    </span>
                                    <span class="file-name-display font-body-sm text-body-sm text-outline ml-3 truncate pointer-events-none">
                                        Belum ada file dipilih
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button Action -->
                        <div class="pt-space-md flex justify-center">
                            <button type="submit"
                                class="w-full sm:w-auto min-w-[260px] bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md px-8 py-3.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2 border-0 cursor-pointer active:scale-95">
                                <span>Kirim Pengajuan KTA</span>
                                <span class="material-symbols-outlined text-[18px]">send</span>
                            </button>
                        </div>
                    </form>

                </div>
            </section>

        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.kta-file-input').forEach((input) => {
            input.addEventListener('change', () => {
                const label = input.parentElement?.querySelector('.file-name-display');
                if (!label) return;

                if (input.files && input.files[0]) {
                    label.textContent = input.files[0].name;
                    label.classList.remove('text-outline');
                    label.classList.add('text-primary', 'font-medium');
                } else {
                    label.textContent = 'Belum ada file dipilih';
                    label.classList.add('text-outline');
                    label.classList.remove('text-primary', 'font-medium');
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>