<h2 class="page-title text-center mb-4">Our Tutors</h2>

<div class="row g-4">
    <?php if (!empty($tutors)): ?>
        <?php foreach ($tutors as $t): ?>
            <div class="col-md-4">
                <div class="card tutor-card h-100 text-center shadow-sm">
                    <img
                        src="<?= base_url('assets/img/' . esc($t['image_path'])) ?>"
                        class="card-img-top tutor-img"
                        alt="<?= esc($t['name']) ?>"
                    >
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($t['name']) ?></h5>
                        <p class="card-text"><?= esc($t['email']) ?></p>
                        <p class="card-text"><?= esc($t['contact']) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">No tutors available at the moment.</p>
    <?php endif; ?>
</div>
