<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<?php
$titleValue = $title ?? 'Contact';
$aboutData = $about ?? [];
$siteData = $site ?? [];

$aboutName = $aboutData['about_name'] ?? 'PMII Garut';
$aboutAddress = $aboutData['about_alamat'] ?? '-';
$siteMail = $siteData['site_mail'] ?? '-';
$siteWa = $siteData['site_wa'] ?? '-';
$siteWaLink = preg_replace('/[^0-9]/', '', $siteWa);
?>

<main id="main" data-aos="fade-up">

    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title contact-title-wrap">
                <span class="contact-kicker">Hubungi Kami</span>
                <h3><span><?= esc($aboutName); ?></span></h3>
                <p>
                    Halaman ini berisi narahubung dan profil organisasi untuk menjalin
                    komunikasi, kolaborasi, maupun kebutuhan informasi lainnya.
                </p>
            </div>

            <div class="row contact-top-grid" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6 d-flex">
                    <div class="info-box info-box-address w-100">
                        <div class="info-box-icon">
                            <i class="bx bx-map"></i>
                        </div>
                        <div class="info-box-content">
                            <span class="info-label">Sekretariat</span>
                            <h3>Alamat</h3>
                            <a href="https://goo.gl/maps/yNZWhx9ySUwc5gVg9" target="_blank" rel="noopener noreferrer">
                                <?= esc($aboutAddress); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="info-box w-100">
                        <div class="info-box-icon">
                            <i class="bx bx-envelope"></i>
                        </div>
                        <div class="info-box-content">
                            <span class="info-label">Email</span>
                            <h3>Hubungi Email</h3>
                            <a href="mailto:<?= esc($siteMail); ?>"><?= esc($siteMail); ?></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="info-box w-100">
                        <div class="info-box-icon">
                            <i class="bx bx-phone-call"></i>
                        </div>
                        <div class="info-box-content">
                            <span class="info-label">WhatsApp</span>
                            <h3>Kontak Cepat</h3>
                            <a href="https://wa.me/<?= esc($siteWaLink); ?>" target="_blank" rel="noopener noreferrer">
                                <?= esc($siteWa); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row contact-main-grid g-4" data-aos="fade-up" data-aos-delay="140">
                <div class="col-lg-7">
                    <div class="contact-form-card" id="message-box">
                        <div class="contact-card-head">
                            <span class="contact-card-kicker">Message Box</span>
                            <h3>Kirim Pesan ke PMII Garut</h3>
                            <p>
                                Sampaikan pertanyaan, informasi, atau pesan kolaborasi melalui formulir di bawah ini.
                            </p>
                        </div>

                        <?php if (session()->getFlashData('success') || session()->getFlashData('danger')) : ?>
                            <div class="alert alert-<?= session()->getFlashData('success') ? 'success' : 'warning' ?> alert-dismissible fade show contact-alert" role="alert">
                                <?= session()->getFlashData('success') ?? session()->getFlashData('danger') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form class="contact-form" action="/contact" method="post" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="inbox_name" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="inbox_name" class="form-control" id="inbox_name" placeholder="Masukkan nama lengkap" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="inbox_email" class="form-label">Email</label>
                                    <input type="email" name="inbox_email" class="form-control" id="inbox_email" placeholder="nama@email.com" required>
                                </div>

                                <div class="col-12">
                                    <label for="inbox_subject" class="form-label">Subjek</label>
                                    <input type="text" name="inbox_subject" class="form-control" id="inbox_subject" placeholder="Tulis subjek pesan" required>
                                </div>

                                <div class="col-12">
                                    <label for="inbox_message" class="form-label">Pesan</label>
                                    <textarea name="inbox_message" id="inbox_message" class="form-control" rows="6" placeholder="Tulis isi pesan di sini..." required></textarea>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="contact-submit-btn">
                                        <span>Submit Message</span>
                                        <i class="bx bx-send"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="contact-map-card">
                        <div class="contact-card-head">
                            <span class="contact-card-kicker">Lokasi</span>
                            <h3>Sekretariat PMII Garut</h3>
                            <p>
                                Temukan lokasi sekretariat kami untuk kebutuhan koordinasi, silaturahmi, dan kegiatan organisasi.
                            </p>
                        </div>

                        <div class="map-section">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d498.0090737095298!2d107.88122266923538!3d-7.206301296397533!2m3!1f0!2f0!3f0!2m3!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b1004687ddc1%3A0x134e0e301aa65980!2ssekre%20Cabang%20PMII%20Garut!5e1!3m2!1sid!2sid!4v1776007761547!5m2!1sid!2sid"
                                height="450"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <div class="contact-map-note">
                            <i class="bx bx-info-circle"></i>
                            <span>Silakan hubungi kami terlebih dahulu sebelum berkunjung agar koordinasi lebih mudah.</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main>

<?= $this->endSection(); ?>