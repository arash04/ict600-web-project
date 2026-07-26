<h2 class="page-title mb-4">Available Courses</h2>

<?php foreach ($courses as $course): ?>
    <div class="card mb-4">
        <div class="card-body">

            <!-- Course title -->
            <h4><?= esc($course['course_name']) ?></h4>

            <!-- Status badge -->
            <?php if ($course['is_free']): ?>
                <span class="badge bg-success mb-2">Free Course</span>
            <?php else: ?>
                <span class="badge bg-warning text-dark mb-2">Paid Course</span>
            <?php endif; ?>

            <!-- Tutor -->
            <?php if (!empty($course['tutor_name'])): ?>
                <p class="text-muted mb-1">
                    Tutor: <strong><?= esc($course['tutor_name']) ?></strong>
                </p>
            <?php endif; ?>

            <!-- Description -->
            <p class="mt-2">
                This course provides structured learning materials, guided exercises,
                and practical examples to help you master the topic.
            </p>

            <!-- Price (only if paid) -->
            <?php if (!$course['is_free']): ?>
                <p class="fw-bold">
                    Price: RM <?= number_format($course['price'], 2) ?>
                </p>
            <?php endif; ?>

            <hr>

            <!-- Public action -->
            <a href="<?= base_url('/login') ?>" class="btn btn-primary">
                Login to Enrol
            </a>
        </div>
    </div>
<?php endforeach; ?>
