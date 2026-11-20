<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$aboutData = $about ?? [];
$teamsData = $teams ?? [];

/**
 * Helper pemetaan kategori filter berdasarkan teks jabatan di database
 */
$detectDivision = static function (string $jabatan): array {
    $lower = mb_strtolower($jabatan);

    if (str_contains($lower, 'kopri') || str_contains($lower, 'putri') || str_contains($lower, 'perempuan')) {
        return ['slug' => 'kopri', 'badge' => 'KOPRI', 'label1' => 'Korps', 'label2' => 'PMII', 'label3' => 'Putri'];
    }
    // if (str_contains($lower, 'kaderisasi') || str_contains($lower, 'litbang') || str_contains($lower, 'riset') || str_contains($lower, 'komisariat')) {
    //     return ['slug' => 'kaderisasi', 'badge' => 'Kaderisasi', 'label1' => 'Bidang', 'label2' => 'Kaderisasi', 'label3' => 'Internal'];
    // }
    // if (str_contains($lower, 'eksternal') || str_contains($lower, 'advokasi') || str_contains($lower, 'media') || str_contains($lower, 'humas') || str_contains($lower, 'hubungan')) {
    //     return ['slug' => 'eksternal', 'badge' => 'Eksternal', 'label1' => 'Bidang', 'label2' => 'Eksternal', 'label3' => 'Advokasi'];
    // }
    // if (str_contains($lower, 'keagamaan') || str_contains($lower, 'dakwah') || str_contains($lower, 'pesantren') || str_contains($lower, 'aswaja')) {
    //     return ['slug' => 'keagamaan', 'badge' => 'Keagamaan', 'label1' => 'Bidang', 'label2' => 'Dakwah &', 'label3' => 'Keagamaan'];
    // }

    return ['slug' => 'bph', 'badge' => 'BPH', 'label1' => 'Badan', 'label2' => 'Pengurus', 'label3' => 'Harian'];
};
?>

<main class="w-full pt-20 bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">

        <!-- ======= Subtle Ambient Glow Canvas ======= -->
        <div class="relative w-full overflow-hidden pb-space-xl">
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[720px] h-[340px] bg-gradient-to-br from-primary-fixed/60 via-surface-container-high/40 to-transparent rounded-full blur-3xl pointer-events-none -z-10"></div>
            <div class="absolute top-48 right-10 w-72 h-72 bg-secondary-fixed/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

            <!-- Header Section -->
            <div class="max-w-7xl mx-auto px-gutter pt-space-xl flex flex-col items-center text-center" data-aos="fade-up">
                <!-- Section Tag Pill -->
                <div class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-surface-container text-primary font-label-xs text-label-xs uppercase tracking-widest shadow-sm">
                    <span class="material-symbols-outlined text-[15px]">corporate_fare</span>
                    <span>STRUKTUR ORGANISASI</span>
                </div>

                <!-- Main Headline -->
                <h1 class="mt-space-md font-headline-xl text-3xl sm:text-headline-xl text-primary tracking-tight font-extrabold max-w-2xl">
                    <?= esc($aboutData['about_name'] ?? 'PC PMII Kab. Garut'); ?>
                </h1>
                <div class="w-16 h-1 rounded-full bg-secondary-container mt-space-sm mb-space-sm"></div>

                <!-- Tenure / Masa Khidmat Pill -->
                <div class="inline-flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface-container-highest text-on-surface-variant font-label-md text-label-md tracking-wider shadow-sm">
                    <span class="material-symbols-outlined text-secondary text-[17px]">event</span>
                    <span>MASA KHIDMAT 2025/2026</span>
                </div>

                <p class="mt-space-md max-w-xl font-body-md text-body-md text-on-surface-variant">
                    Komposisi kepemimpinan Badan Pengurus Harian (BPH) dan jajaran biro pergerakan yang berdedikasi mengawal kaderisasi, intelektualisme, serta advokasi kerakyatan di Tatar Garut.
                </p>

                <!-- Category Filter Tabs -->
                <?php if (! empty($teamsData)) : ?>
                    <div class="mt-space-xl inline-flex flex-wrap items-center justify-center gap-space-xs bg-surface-container-low p-1.5 rounded-full shadow-sm max-w-full">
                        <button type="button" data-filter="all"
                            class="filter-tab px-space-md py-1.5 rounded-full bg-primary-container text-on-primary font-label-md text-label-md shadow-sm transition-all border-0 cursor-pointer">
                            Semua Pengurus (<?= count($teamsData); ?>)
                        </button>
                        <!-- <button type="button" data-filter="bph"
                            class="filter-tab px-space-md py-1.5 rounded-full text-on-surface-variant hover:text-on-surface hover:bg-surface-container font-label-md text-label-md transition-all bg-transparent border-0 cursor-pointer">
                            Badan Pengurus Harian
                        </button>
                        <button type="button" data-filter="kaderisasi"
                            class="filter-tab px-space-md py-1.5 rounded-full text-on-surface-variant hover:text-on-surface hover:bg-surface-container font-label-md text-label-md transition-all bg-transparent border-0 cursor-pointer">
                            Bidang Kaderisasi
                        </button>
                        <button type="button" data-filter="eksternal"
                            class="filter-tab px-space-md py-1.5 rounded-full text-on-surface-variant hover:text-on-surface hover:bg-surface-container font-label-md text-label-md transition-all bg-transparent border-0 cursor-pointer">
                            Bidang Eksternal
                        </button>
                        <button type="button" data-filter="keagamaan"
                            class="filter-tab px-space-md py-1.5 rounded-full text-on-surface-variant hover:text-on-surface hover:bg-surface-container font-label-md text-label-md transition-all bg-transparent border-0 cursor-pointer">
                            Bidang Keagamaan
                        </button> -->
                        <button type="button" data-filter="kopri"
                            class="filter-tab px-space-md py-1.5 rounded-full text-on-surface-variant hover:text-on-surface hover:bg-surface-container font-label-md text-label-md transition-all bg-transparent border-0 cursor-pointer">
                            KOPRI PC Garut
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Officers Photo Gallery Grid -->
            <div class="max-w-7xl mx-auto px-gutter mt-space-xl pb-space-xl">
                <?php if (! empty($teamsData)) : ?>
                    <div id="teamGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
                        <?php foreach ($teamsData as $index => $team) : ?>
                            <?php
                            $divInfo  = $detectDivision($team['team_jabatan'] ?? '');
                            $photoUrl = ! empty($team['team_image'])
                                ? base_url('assets/backend/images/team/' . esc($team['team_image']))
                                : base_url('assets/frontend/img/team/team-1.jpg');
                            ?>
                            <article class="team-card flex flex-col bg-surface-container-lowest rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group"
                                data-category="<?= esc($divInfo['slug']); ?>"
                                data-aos="fade-up"
                                data-aos-delay="<?= 60 + (($index % 4) * 40); ?>">

                                <!-- Upper Portrait Banner -->
                                <div class="relative w-full aspect-[4/5] bg-gradient-to-br from-primary via-primary-container to-tertiary p-space-md flex flex-col justify-between overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-transparent to-primary/40 pointer-events-none z-10"></div>
                                    <div class="absolute -right-10 -bottom-8 w-48 h-48 bg-secondary-container/20 rounded-full blur-2xl pointer-events-none"></div>

                                    <!-- Top Pill & Division Title -->
                                    <div class="relative z-20 flex items-start justify-between">
                                        <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-full bg-surface-container-lowest text-primary font-label-xs text-label-xs shadow-sm font-bold">
                                            <?= esc($divInfo['badge']); ?>
                                        </span>
                                        <div class="text-right">
                                            <span class="font-headline-sm text-headline-sm text-secondary-fixed block leading-none font-extrabold tracking-tight drop-shadow-sm">
                                                <?= esc($divInfo['label1']); ?>
                                            </span>
                                            <span class="font-headline-sm text-headline-sm text-on-primary block leading-tight font-extrabold tracking-tight drop-shadow-sm">
                                                <?= esc($divInfo['label2']); ?>
                                            </span>
                                            <span class="font-headline-sm text-headline-sm text-secondary-fixed-dim block leading-tight font-extrabold tracking-tight drop-shadow-sm">
                                                <?= esc($divInfo['label3']); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Officer Image -->
                                    <div class="absolute inset-x-0 bottom-0 h-4/5 flex items-end justify-center z-10 overflow-hidden">
                                        <img src="<?= $photoUrl; ?>"
                                            alt="<?= esc($team['team_name'] ?? 'Pengurus'); ?>"
                                            class="h-full w-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                </div>

                                <!-- Lower Info & Social Links -->
                                <div class="p-space-lg flex flex-col flex-1 items-center text-center justify-between bg-surface-container-lowest">
                                    <div class="flex flex-col items-center w-full">
                                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold tracking-tight m-0">
                                            <?= esc($team['team_name'] ?? '-'); ?>
                                        </h3>
                                        <div class="mt-space-xs inline-flex items-center px-space-md py-1 rounded-full bg-surface-container text-primary font-label-sm text-label-sm font-semibold">
                                            <?= esc($team['team_jabatan'] ?? '-'); ?>
                                        </div>
                                        <div class="w-12 h-0.5 rounded-full bg-primary-container mt-space-md mb-space-sm opacity-60"></div>
                                        <!-- <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 m-0">
                                            Pengurus Cabang Pergerakan Mahasiswa Islam Indonesia Kabupaten Garut Masa Khidmat 2025/2026.
                                        </p> -->
                                    </div>

                                    <!-- Social Media Buttons -->
                                    <div class="mt-space-md flex items-center justify-center gap-space-sm">
                                        <?php if (! empty($team['team_instagram'])) : ?>
                                            <a href="<?= esc($team['team_instagram']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram"
                                                class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-primary-container hover:text-on-primary transition-colors">
                                                <i class="bi bi-instagram text-[14px]"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (! empty($team['team_facebook'])) : ?>
                                            <a href="<?= esc($team['team_facebook']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                                                class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-primary-container hover:text-on-primary transition-colors">
                                                <i class="bi bi-facebook text-[14px]"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (! empty($team['team_twitter'])) : ?>
                                            <a href="<?= esc($team['team_twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter / X"
                                                class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-primary-container hover:text-on-primary transition-colors">
                                                <i class="bi bi-twitter text-[14px]"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (! empty($team['team_linked'])) : ?>
                                            <a href="<?= esc($team['team_linked']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"
                                                class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:bg-primary-container hover:text-on-primary transition-colors">
                                                <i class="bi bi-linkedin text-[14px]"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (empty($team['team_instagram']) && empty($team['team_facebook']) && empty($team['team_twitter']) && empty($team['team_linked'])) : ?>
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-surface-container-low text-on-surface-variant font-label-xs text-label-xs">
                                                <span class="material-symbols-outlined text-[14px] text-primary">verified</span>
                                                <span>PC PMII Garut</span>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>

                    <!-- Empty Filter State -->
                    <div id="emptyFilterState" class="hidden bg-surface-container-lowest rounded-2xl p-10 text-center shadow-sm max-w-md mx-auto">
                        <div class="w-14 h-14 rounded-2xl bg-surface-container-high text-primary flex items-center justify-center mx-auto mb-space-sm">
                            <span class="material-symbols-outlined text-[28px]">person_search</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold mb-1">Belum Ada Data di Bidang Ini</h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant m-0">
                            Silakan pilih tab bidang lainnya untuk melihat daftar pengurus.
                        </p>
                    </div>
                <?php else : ?>
                    <!-- Empty Database State -->
                    <div class="bg-surface-container-lowest rounded-2xl p-12 text-center shadow-sm max-w-lg mx-auto" data-aos="fade-up">
                        <div class="w-16 h-16 rounded-2xl bg-surface-container-high text-primary flex items-center justify-center mx-auto mb-space-md">
                            <span class="material-symbols-outlined text-[32px]">groups</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold mb-space-xs">Data Pengurus Belum Tersedia</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant m-0">
                            Informasi struktur kepengurusan akan ditampilkan di sini setelah data diperbarui.
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.filter-tab');
        const cards = document.querySelectorAll('.team-card');
        const emptyState = document.getElementById('emptyFilterState');

        tabs.forEach(button => {
            button.addEventListener('click', () => {
                const selected = button.getAttribute('data-filter');

                tabs.forEach(btn => {
                    btn.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-sm');
                    btn.classList.add('text-on-surface-variant', 'bg-transparent');
                });

                button.classList.remove('text-on-surface-variant', 'bg-transparent');
                button.classList.add('bg-primary-container', 'text-on-primary', 'shadow-sm');

                let visibleCount = 0;
                cards.forEach(card => {
                    if (selected === 'all' || card.getAttribute('data-category') === selected) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (emptyState) {
                    if (visibleCount === 0) {
                        emptyState.classList.remove('hidden');
                    } else {
                        emptyState.classList.add('hidden');
                    }
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>