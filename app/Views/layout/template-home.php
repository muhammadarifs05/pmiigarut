<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC PMII Garut</title>
    <meta name="description" content="<?= esc($site['site_description'] ?? 'Website Resmi Pengurus Cabang Pergerakan Mahasiswa Islam Indonesia Kabupaten Garut'); ?>">

    <!-- Favicons -->
    <link href="<?= base_url('assets/frontend/img/apple-touch-icon2.png'); ?>" rel="icon">
    <link href="<?= base_url('assets/frontend/img/apple-touch-icon2.png'); ?>" rel="apple-touch-icon">

    <!-- Google Fonts: Plus Jakarta Sans, Inter & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=block" rel="stylesheet">

    <!-- Vendor CSS (Untuk kompatibilitas halaman lain & popup GLightbox) -->
    <link href="<?= base_url('assets/frontend/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/plugins/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/plugins/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/plugins/aos/aos.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/plugins/glightbox/css/glightbox.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/plugins/swiper/swiper-bundle.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/frontend/css/style.css'); ?>" rel="stylesheet">

    <!-- Tailwind CSS + Design System PC PMII Garut -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: false, // Mencegah bentrok dengan Bootstrap 5 pada halaman yang belum dimigrasi
            },
            theme: {
                extend: {
                    colors: {
                        "on-error": "#ffffff",
                        "on-primary-fixed": "#001945",
                        "on-surface-variant": "#434652",
                        "on-secondary": "#ffffff",
                        "on-surface": "#131b2e",
                        "secondary-fixed-dim": "#ffb95f",
                        "primary-container": "#0d47a1",
                        "tertiary-container": "#0042b2",
                        "surface-container": "#eaedff",
                        "error": "#ba1a1a",
                        "surface-container-highest": "#dae2fd",
                        "surface-container-low": "#f2f3ff",
                        "background": "#faf8ff",
                        "secondary-fixed": "#ffddb8",
                        "primary": "#003178",
                        "on-primary-fixed-variant": "#00429c",
                        "tertiary-fixed": "#dbe1ff",
                        "primary-fixed": "#d9e2ff",
                        "surface-dim": "#d2d9f4",
                        "on-primary": "#ffffff",
                        "outline": "#737783",
                        "on-secondary-fixed": "#2a1700",
                        "on-secondary-container": "#684000",
                        "on-secondary-fixed-variant": "#653e00",
                        "primary-fixed-dim": "#b0c6ff",
                        "outline-variant": "#c3c6d4",
                        "on-tertiary-fixed-variant": "#003ea8",
                        "on-tertiary-fixed": "#00174b",
                        "on-primary-container": "#a1bbff",
                        "tertiary-fixed-dim": "#b4c5ff",
                        "inverse-on-surface": "#eef0ff",
                        "on-tertiary": "#ffffff",
                        "on-error-container": "#93000a",
                        "surface": "#faf8ff",
                        "inverse-surface": "#283044",
                        "secondary": "#855300",
                        "surface-bright": "#faf8ff",
                        "surface-container-high": "#e2e7ff",
                        "error-container": "#ffdad6",
                        "surface-variant": "#dae2fd",
                        "surface-tint": "#2b5bb5",
                        "inverse-primary": "#b0c6ff",
                        "surface-container-lowest": "#ffffff",
                        "on-background": "#131b2e",
                        "on-tertiary-container": "#a5baff",
                        "tertiary": "#002e82",
                        "secondary-container": "#fea619"
                    },
                    spacing: {
                        "space-xl": "2.5rem",
                        "space-md": "1rem",
                        "margin-mobile": "1rem",
                        "space-lg": "1.5rem",
                        "gutter-mobile": "1rem",
                        "space-xs": "0.25rem",
                        "space-sm": "0.5rem",
                        "gutter": "1.5rem",
                        "margin": "2rem"
                    },
                    fontFamily: {
                        "body-md": ["Inter", "sans-serif"],
                        "body-lg": ["Inter", "sans-serif"],
                        "body-sm": ["Inter", "sans-serif"],
                        "title-md": ["Plus Jakarta Sans", "sans-serif"],
                        "title-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "label-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "label-md": ["Plus Jakarta Sans", "sans-serif"],
                        "label-xs": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-xl": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-md": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-sm": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    fontSize: {
                        "body-md": ["15px", {
                            lineHeight: "24px",
                            fontWeight: "400"
                        }],
                        "title-md": ["18px", {
                            lineHeight: "26px",
                            fontWeight: "600"
                        }],
                        "label-sm": ["12px", {
                            lineHeight: "16px",
                            letterSpacing: "0.02em",
                            fontWeight: "600"
                        }],
                        "label-md": ["14px", {
                            lineHeight: "20px",
                            letterSpacing: "0.01em",
                            fontWeight: "600"
                        }],
                        "body-lg": ["18px", {
                            lineHeight: "28px",
                            fontWeight: "400"
                        }],
                        "headline-sm": ["20px", {
                            lineHeight: "28px",
                            fontWeight: "600"
                        }],
                        "label-xs": ["11px", {
                            lineHeight: "14px",
                            letterSpacing: "0.04em",
                            fontWeight: "700"
                        }],
                        "headline-xl": ["48px", {
                            lineHeight: "56px",
                            letterSpacing: "-0.025em",
                            fontWeight: "800"
                        }],
                        "title-sm": ["16px", {
                            lineHeight: "24px",
                            fontWeight: "600"
                        }],
                        "body-sm": ["13px", {
                            lineHeight: "20px",
                            fontWeight: "400"
                        }],
                        "headline-lg": ["36px", {
                            lineHeight: "44px",
                            letterSpacing: "-0.02em",
                            fontWeight: "700"
                        }],
                        "headline-md": ["24px", {
                            lineHeight: "32px",
                            letterSpacing: "-0.015em",
                            fontWeight: "700"
                        }]
                    }
                }
            }
        }
    </script>
    <style>
        body.pmii-portal {
            margin: 0;
            padding: 0;
            background-color: #faf8ff;
            color: #131b2e;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .pmii-portal a {
            text-decoration: none;
        }
    </style>

    <style>
        /* Sembunyikan teks mentah ikon secara total sebelum font siap */
        .material-symbols-outlined {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            width: 1em;
            height: 1em;
            overflow: hidden;
            white-space: nowrap;
            vertical-align: middle;
            color: transparent !important;
            user-select: none;
        }

        html.icons-ready .material-symbols-outlined {
            color: inherit !important;
        }
    </style>

    <script>
        (function() {
            const revealIcons = () => document.documentElement.classList.add('icons-ready');

            if (document.fonts && document.fonts.ready) {
                document.fonts.ready.then(() => {
                    if (document.fonts.check('24px "Material Symbols Outlined"')) {
                        revealIcons();
                    } else {
                        window.addEventListener('load', revealIcons, {
                            once: true
                        });
                    }
                });
                setTimeout(revealIcons, 2000);
            } else {
                window.addEventListener('load', revealIcons, {
                    once: true
                });
            }
        })();
    </script>
</head>

<body class="pmii-portal bg-surface font-body-md text-body-md text-on-surface antialiased">

    <?= $this->include('layout/header'); ?>

    <?= $this->renderSection('content'); ?>

    <?= $this->include('layout/footer'); ?>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/frontend/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/frontend/plugins/aos/aos.js'); ?>"></script>
    <script src="<?= base_url('assets/frontend/plugins/glightbox/js/glightbox.min.js'); ?>"></script>
    <script src="<?= base_url('assets/frontend/plugins/isotope-layout/isotope.pkgd.min.js'); ?>"></script>
    <script src="<?= base_url('assets/frontend/plugins/purecounter/purecounter.js'); ?>"></script>
    <script src="<?= base_url('assets/frontend/plugins/swiper/swiper-bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/frontend/js/main.js'); ?>"></script>
</body>

</html>