<?= $this->extend('layout/template-home'); ?>
<?= $this->section('content'); ?>

<main id="main" data-aos="fade-up">

    <section id="team" class="team">
        <div class="container" data-aos="fade-up">

            <div class="section-title team-title-wrap">
                <span class="team-badge-heading">Struktur Organisasi</span>
                <h3><span><?= $about['about_name']; ?></span></h3>
                <p class="team-badge-heading">Masa Khidmat 2025/2026</p>
            </div>

            <?php if (!empty($teams)) : ?>
                <div class="row team-grid">
                    <?php foreach ($teams as $index => $team) : ?>
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="<?= 80 + (($index % 4) * 40); ?>">
                            <article class="member">
                                <div class="member-img">
                                    <img src="/assets/backend/images/team/<?= $team['team_image']; ?>" class="img-fluid" alt="<?= $team['team_name']; ?>">
                                    <div class="member-overlay"></div>

                                    <div class="member-role-badge">
                                        <span>BPH</span>
                                    </div>

                                    <div class="social">
                                        <?php if (!empty($team['team_twitter'])) : ?>
                                            <a href="<?= $team['team_twitter']; ?>" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter"></i></a>
                                        <?php endif; ?>
                                        <?php if (!empty($team['team_facebook'])) : ?>
                                            <a href="<?= $team['team_facebook']; ?>" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
                                        <?php endif; ?>
                                        <?php if (!empty($team['team_instagram'])) : ?>
                                            <a href="<?= $team['team_instagram']; ?>" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
                                        <?php endif; ?>
                                        <?php if (!empty($team['team_linked'])) : ?>
                                            <a href="<?= $team['team_linked']; ?>" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="member-info">
                                    <h4><?= $team['team_name']; ?></h4>
                                    <span class="member-position"><?= $team['team_jabatan']; ?></span>
                                    <div class="member-divider"></div>
                                    <!-- <p>Bagian dari kepengurusan PC PMII Kab. Garut masa khidmat 2025/2026.</p> -->
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="team-empty" data-aos="fade-up">
                    <div class="team-empty-icon">
                        <i class="bx bx-group"></i>
                    </div>
                    <h4>Data Pengurus Belum Tersedia</h4>
                    <p>Informasi struktur kepengurusan akan ditampilkan di sini setelah data diperbarui.</p>
                </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<?= $this->endSection(); ?>