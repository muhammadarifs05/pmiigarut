<!-- Main Footer -->
<footer class="w-full text-slate-300 pt-8 pb-5" style="background-color: #071942; border-top: 3px solid #f59e0b;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Top 4-Column Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-6 items-start">

            <!-- Column 1: Brand Card, Deskripsi & Badge Wilayah (4 cols) -->
            <div class="lg:col-span-4 flex flex-col">
                <!-- Compact Brand Box -->
                <div class="rounded-xl px-4 py-3.5"
                    style="background-color: #0b2259; border: 1px solid rgba(96, 165, 250, 0.22);">
                    <div class="flex items-center gap-2.5">
                        <img src="<?= base_url('assets/frontend/img/apple-touch-icon2.png'); ?>"
                            alt="Logo PC PMII Garut"
                            class="w-8 h-8 rounded-full object-cover shrink-0 bg-[#082963]"
                            style="border: 1.5px solid rgba(255, 255, 255, 0.85);" />
                        <div class="flex items-center gap-1.5">
                            <h3 class="text-xl font-extrabold text-white tracking-tight leading-none m-0">
                                pmiigarut.com
                            </h3>
                            <span class="w-2 h-2 rounded-full inline-block" style="background-color: #f59e0b;"></span>
                        </div>
                    </div>
                    <p class="italic text-[11.5px] text-slate-300 leading-snug mt-1.5 mb-0">
                        Website Resmi Pengurus Cabang PMII Kabupaten Garut
                    </p>
                </div>

                <!-- Deskripsi Organisasi -->
                <p class="text-[11.5px] text-slate-300 leading-relaxed mt-3 mb-3">
                    Wadah perjuangan, pembinaan intelektual, spiritual, dan integritas mahasiswa di Kabupaten Garut.
                </p>

                <!-- Badge Wilayah -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="px-2.5 py-1 rounded-md text-[11px] font-semibold text-blue-200 leading-none"
                        style="background-color: #132f73; border: 1px solid rgba(96, 165, 250, 0.2);">
                        Cabang Garut
                    </span>
                    <span class="px-2.5 py-1 rounded-md text-[11px] font-semibold text-blue-200 leading-none"
                        style="background-color: #132f73; border: 1px solid rgba(96, 165, 250, 0.2);">
                        Jawa Barat
                    </span>
                </div>
            </div>

            <!-- Column 2: Useful Links (3 cols) -->
            <div class="lg:col-span-3 lg:pl-8">
                <h4 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-white mb-3 mt-0">
                    <span class="w-2 h-2 rounded-full inline-block" style="background-color: #60a5fa;"></span>
                    <span>USEFUL LINKS</span>
                </h4>
                <ul class="space-y-1.5 text-xs text-slate-200 list-none p-0 m-0">
                    <li>
                        <a href="<?= base_url('/'); ?>" class="inline-flex items-center gap-2 text-slate-200 hover:text-amber-400 transition-colors no-underline">
                            <span class="text-blue-400 font-bold">&rsaquo;</span>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('about'); ?>" class="inline-flex items-center gap-2 text-slate-200 hover:text-amber-400 transition-colors no-underline">
                            <span class="text-blue-400 font-bold">&rsaquo;</span>
                            <span>About us</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('gallery'); ?>" class="inline-flex items-center gap-2 text-slate-200 hover:text-amber-400 transition-colors no-underline">
                            <span class="text-blue-400 font-bold">&rsaquo;</span>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('team'); ?>" class="inline-flex items-center gap-2 text-slate-200 hover:text-amber-400 transition-colors no-underline">
                            <span class="text-blue-400 font-bold">&rsaquo;</span>
                            <span>Team / Pengurus</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('document'); ?>" class="inline-flex items-center gap-2 text-slate-200 hover:text-amber-400 transition-colors no-underline">
                            <span class="text-blue-400 font-bold">&rsaquo;</span>
                            <span>Document</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('contact'); ?>" class="inline-flex items-center gap-2 text-slate-200 hover:text-amber-400 transition-colors no-underline">
                            <span class="text-blue-400 font-bold">&rsaquo;</span>
                            <span>Contact</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Our Information (2 cols) -->
            <div class="lg:col-span-2">
                <h4 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-white mb-3 mt-0">
                    <span class="w-2 h-2 rounded-full inline-block" style="background-color: #60a5fa;"></span>
                    <span>OUR INFORMATION</span>
                </h4>
                <ul class="space-y-1.5 text-xs text-slate-200 list-none p-0 m-0">
                    <li>
                        <a href="<?= base_url('post'); ?>" class="inline-flex items-center gap-2 text-slate-200 hover:text-amber-400 transition-colors no-underline">
                            <span class="text-blue-400 font-bold">&rsaquo;</span>
                            <span>All Post</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('category/news'); ?>" class="inline-flex items-center gap-2 text-slate-200 hover:text-amber-400 transition-colors no-underline">
                            <span class="text-blue-400 font-bold">&rsaquo;</span>
                            <span>News</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('category/opinion'); ?>" class="inline-flex items-center gap-2 text-slate-200 hover:text-amber-400 transition-colors no-underline">
                            <span class="text-blue-400 font-bold">&rsaquo;</span>
                            <span>Opinion</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('category/siaran-pers'); ?>" class="inline-flex items-center gap-2 text-slate-200 hover:text-amber-400 transition-colors no-underline">
                            <span class="text-blue-400 font-bold">&rsaquo;</span>
                            <span>Siaran Pers</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Our Social Networks (3 cols) -->
            <div class="lg:col-span-3">
                <h4 class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-white mb-2.5 mt-0">
                    <span class="w-2 h-2 rounded-full inline-block" style="background-color: #60a5fa;"></span>
                    <span>OUR SOCIAL NETWORKS</span>
                </h4>
                <p class="text-xs text-slate-300 leading-relaxed mb-3 mt-0">
                    Sosial Media Resmi PC PMII Garut
                </p>

                <div class="flex items-center gap-2">
                    <!-- Instagram -->
                    <a href="<?= esc($site['instagram'] ?? '#'); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-white hover:opacity-90 transition"
                        style="background-color: #264896;">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>

                    <!-- Facebook -->
                    <a href="<?= esc($site['facebook'] ?? '#'); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-white hover:opacity-90 transition"
                        style="background-color: #264896;">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                        </svg>
                    </a>

                    <!-- X / Twitter -->
                    <a href="<?= esc($site['twitter'] ?? '#'); ?>" target="_blank" rel="noopener noreferrer" aria-label="X / Twitter"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-white hover:opacity-90 transition"
                        style="background-color: #264896;">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>

                    <!-- LinkedIn -->
                    <a href="<?= esc($site['linkedin'] ?? '#'); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-white hover:opacity-90 transition"
                        style="background-color: #264896;">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <!-- Bottom Bar: Copyright & Utility Links -->
        <div class="mt-6 pt-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-300"
            style="border-top: 1px solid rgba(96, 165, 250, 0.18);">
            <p class="m-0 text-center sm:text-left">
                &copy; <?= date('Y'); ?> PMII Kabupaten Garut. All rights reserved.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-5">
                <a href="<?= base_url('about'); ?>" class="text-slate-300 hover:text-amber-400 transition-colors no-underline">
                    Kebijakan Privasi
                </a>
                <a href="<?= base_url('document'); ?>" class="text-slate-300 hover:text-amber-400 transition-colors no-underline">
                    Pedoman Kader
                </a>
                <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;"
                    class="inline-flex items-center gap-1 text-slate-300 hover:text-amber-400 transition-colors no-underline">
                    <span>Back to top</span>
                    <span>&uarr;</span>
                </a>
            </div>
        </div>

    </div>
</footer>