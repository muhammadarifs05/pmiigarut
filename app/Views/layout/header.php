<?php
$currentUri = trim(uri_string(), '/');
$isActive = static function (array $prefixes) use ($currentUri): bool {
    foreach ($prefixes as $prefix) {
        if ($prefix === '' && $currentUri === '') {
            return true;
        }
        if ($prefix !== '' && ($currentUri === $prefix || str_starts_with($currentUri, $prefix . '/'))) {
            return true;
        }
    }
    return false;
};

$navItems = [
    ['label' => 'Home',     'url' => base_url('/'),         'active' => $isActive([''])],
    ['label' => 'About',    'url' => base_url('#about'),    'active' => $isActive(['about'])],
    ['label' => 'Gallery',  'url' => base_url('gallery'),  'active' => $isActive(['gallery'])],
    ['label' => 'Pengurus', 'url' => base_url('team'),     'active' => $isActive(['team'])],
    ['label' => 'News',     'url' => base_url('post'),     'active' => $isActive(['post', 'category', 'tag'])],
    ['label' => 'Document', 'url' => base_url('document'), 'active' => $isActive(['document'])],
    ['label' => 'Contact',  'url' => base_url('contact'),  'active' => $isActive(['contact'])],
];
?>

<header id="main-header"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/85 backdrop-blur-xl border-b border-slate-200/60">
    <!-- Scroll Progress Indicator -->
    <div id="header-scroll-progress"
        class="absolute bottom-0 left-0 h-[2.5px] w-0 transition-[width] duration-150 pointer-events-none"
        style="background: linear-gradient(90deg, #003178 0%, #1d63dc 60%, #f59e0b 100%);"></div>

    <div id="header-inner"
        class="h-16 sm:h-20 max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 flex items-center justify-between gap-2 sm:gap-3 transition-all duration-300">

        <!-- Brand Logo & Creative Institutional Lockup -->
        <a href="<?= base_url('/'); ?>" class="flex items-center gap-2 sm:gap-3.5 min-w-0 shrink group no-underline select-none">
            <!-- Logo Container -->
            <div class="relative w-9 h-9 sm:w-11 sm:h-11 rounded-xl flex items-center justify-center shrink-0 shadow-md transition-all duration-300 group-hover:scale-105 group-hover:-rotate-2"
                style="background: linear-gradient(135deg, #003178 0%, #1565c0 100%); box-shadow: 0 4px 12px rgba(0, 49, 120, 0.22);">
                <img src="<?= base_url('assets/frontend/img/apple-touch-icon2.png'); ?>"
                    alt="Logo PC PMII Garut"
                    class="w-6 h-6 sm:w-7 sm:h-7 rounded-full object-cover bg-[#082963] ring-2 ring-amber-400/90" />
            </div>

            <!-- Lockup Tipografi Dual-Tone -->
            <div class="flex flex-col justify-center min-w-0">
                <!-- Baris Atas: PC PMII + Lencana Kab. Garut -->
                <div class="flex items-center gap-1.5 sm:gap-2 whitespace-nowrap">
                    <span class="font-extrabold text-[15px] sm:text-[18.5px] leading-none tracking-tight bg-clip-text text-transparent transition-all duration-300"
                        style="background-image: linear-gradient(90deg, #003178 0%, #0d5bd7 100%);">
                        PC PMII
                    </span>
                    <span class="inline-flex items-center px-1.5 sm:px-2 py-0.5 rounded-md text-[9.5px] sm:text-[11px] font-extrabold uppercase tracking-wider leading-none shadow-2xs transition-transform duration-300 group-hover:translate-x-0.5"
                        style="background-color: #fef3c7; color: #92400e; border: 1px solid #fcd34d;">
                        Kab. Garut
                    </span>
                </div>

                <!-- Baris Bawah: Tampil mulai layar tablet/desktop agar header HP tidak meluber -->
                <div class="hidden sm:flex items-center gap-1.5 mt-1.5 whitespace-nowrap">
                    <span class="w-3 h-[2px] rounded-full inline-block shrink-0 transition-all duration-300 group-hover:w-5"
                        style="background-color: #f59e0b;"></span>
                    <span class="text-[9px] sm:text-[9.5px] font-bold text-slate-600 uppercase tracking-[0.06em] leading-none">
                        Pergerakan Mahasiswa Islam Indonesia
                    </span>
                </div>
            </div>
        </a>

        <!-- Center Pill Navigation with Sliding Indicator -->
        <nav id="desktop-nav-pill"
            aria-label="Navigasi Utama"
            class="hidden xl:flex items-center relative p-1.5 rounded-full bg-slate-100/95 border border-slate-200/80 shadow-inner">
            <!-- Animated Sliding Pill -->
            <span id="nav-sliding-pill"
                aria-hidden="true"
                class="rounded-full shadow-sm pointer-events-none"
                style="position: absolute; top: 6px; bottom: 6px; left: 6px; width: 0; background-color: #003178; z-index: 1; transition: left 0.28s cubic-bezier(0.25, 1, 0.5, 1), width 0.28s cubic-bezier(0.25, 1, 0.5, 1);"></span>

            <?php foreach ($navItems as $item) : ?>
                <a href="<?= $item['url']; ?>"
                    data-active="<?= $item['active'] ? '1' : '0'; ?>"
                    class="nav-pill-link px-3.5 py-1.5 rounded-full text-[13.5px] font-semibold transition-colors duration-200 no-underline whitespace-nowrap"
                    style="position: relative; z-index: 2; color: <?= $item['active'] ? '#ffffff' : '#334155'; ?>;">
                    <?= esc($item['label']); ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- Right Actions -->
        <div class="flex items-center gap-1.5 sm:gap-2.5 shrink-0">

            <!-- Quick Search Toggle -->
            <button id="btn-toggle-search"
                type="button"
                aria-label="Cari artikel atau dokumen"
                class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-100/90 hover:bg-blue-50 text-slate-700 hover:text-[#003178] flex items-center justify-center transition-all duration-200 hover:scale-105 cursor-pointer border-0 shrink-0">
                <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px]" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path stroke-linecap="round" d="M20 20l-3.5-3.5"></path>
                </svg>
            </button>

            <!-- Kader Aktif Direct Button -> Cek Status KTA -->
            <a href="<?= base_url('kta/cek-status'); ?>"
                title="Cek Status KTA Kader Aktif"
                class="inline-flex items-center gap-1 sm:gap-1.5 px-2.5 sm:px-4 py-1.5 sm:py-2 rounded-full text-[11px] sm:text-[13px] font-bold shadow-sm transition-all duration-200 hover:brightness-105 hover:-translate-y-0.5 no-underline whitespace-nowrap shrink-0"
                style="background-color: #ffa71a; color: #3b2200;">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span>Kader Aktif</span>
            </a>

            <!-- Mobile Hamburger Button -->
            <button id="btn-mobile-menu"
                type="button"
                aria-label="Buka Menu"
                class="xl:hidden w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-slate-100 hover:bg-slate-200/80 text-slate-800 flex items-center justify-center transition-colors border-0 cursor-pointer shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Expandable Quick Search Bar -->
    <div id="header-search-bar"
        class="hidden border-t border-slate-200/70 bg-white/95 backdrop-blur-xl px-4 py-3 shadow-sm">
        <form action="<?= base_url('search'); ?>" method="get" class="max-w-3xl mx-auto flex items-center gap-2">
            <input type="text"
                name="keyword"
                placeholder="Cari berita, opini, atau dokumen organisasi..."
                class="w-full px-4 py-2 rounded-full bg-slate-100 border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-[#003178] focus:bg-white transition" />
            <button type="submit"
                class="px-5 py-2 rounded-full text-xs font-bold text-white shrink-0 cursor-pointer border-0"
                style="background-color: #003178;">
                Cari
            </button>
        </form>
    </div>

    <!-- Mobile Slide-Down Drawer -->
    <div id="mobile-nav-drawer"
        class="hidden xl:hidden border-t border-slate-200/70 bg-white/95 backdrop-blur-xl px-4 py-4 shadow-lg">
        <div class="flex flex-col gap-1">
            <?php foreach ($navItems as $item) : ?>
                <a href="<?= $item['url']; ?>"
                    class="px-4 py-2.5 rounded-xl text-sm font-semibold no-underline transition-colors <?= $item['active'] ? 'text-white bg-[#003178]' : 'text-slate-700 hover:bg-slate-100'; ?>">
                    <?= esc($item['label']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('main-header');
        const headerInner = document.getElementById('header-inner');
        const progressBar = document.getElementById('header-scroll-progress');
        const navContainer = document.getElementById('desktop-nav-pill');
        const slidingPill = document.getElementById('nav-sliding-pill');
        const navLinks = document.querySelectorAll('.nav-pill-link');
        const searchBtn = document.getElementById('btn-toggle-search');
        const searchBar = document.getElementById('header-search-bar');
        const mobileBtn = document.getElementById('btn-mobile-menu');
        const mobileDrawer = document.getElementById('mobile-nav-drawer');

        // 1. Scroll Shrink & Reading Progress
        function handleScroll() {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const pct = docHeight > 0 ? Math.min(100, (scrollTop / docHeight) * 100) : 0;

            if (progressBar) progressBar.style.width = pct + '%';

            if (header && headerInner) {
                if (scrollTop > 24) {
                    header.classList.add('shadow-md', 'bg-white/95');
                    header.classList.remove('bg-white/85');
                    headerInner.classList.replace('sm:h-20', 'sm:h-16');
                } else {
                    header.classList.remove('shadow-md', 'bg-white/95');
                    header.classList.add('bg-white/85');
                    headerInner.classList.replace('sm:h-16', 'sm:h-20');
                }
            }
        }
        window.addEventListener('scroll', handleScroll, {
            passive: true
        });
        handleScroll();

        // 2. Sliding Pill Indicator on Hover & Active Route
        if (navContainer && slidingPill && navLinks.length) {
            const activeLink = Array.from(navLinks).find(el => el.dataset.active === '1') || navLinks[0];

            function movePillTo(target) {
                if (!target) return;
                slidingPill.style.width = target.offsetWidth + 'px';
                slidingPill.style.left = target.offsetLeft + 'px';

                navLinks.forEach(link => {
                    link.style.color = (link === target) ? '#ffffff' : '#334155';
                });
            }

            movePillTo(activeLink);
            window.addEventListener('resize', () => movePillTo(activeLink));

            navLinks.forEach(link => {
                link.addEventListener('mouseenter', () => movePillTo(link));
            });

            navContainer.addEventListener('mouseleave', () => movePillTo(activeLink));
        }

        // 3. Toggle Search & Mobile Drawer
        if (searchBtn && searchBar) {
            searchBtn.addEventListener('click', () => {
                searchBar.classList.toggle('hidden');
                if (mobileDrawer) mobileDrawer.classList.add('hidden');
                const input = searchBar.querySelector('input');
                if (input && !searchBar.classList.contains('hidden')) input.focus();
            });
        }

        if (mobileBtn && mobileDrawer) {
            mobileBtn.addEventListener('click', () => {
                mobileDrawer.classList.toggle('hidden');
                if (searchBar) searchBar.classList.add('hidden');
            });
        }
    });
</script>