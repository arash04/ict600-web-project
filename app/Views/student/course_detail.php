<h2 class="page-title"><?= esc($course['course_name']) ?></h2>

<?php if (!empty($course['tutor_name'])): ?>
    <p class="text-muted">
        Tutor: <strong><?= esc($course['tutor_name']) ?></strong>
    </p>
<?php else: ?>
    <p class="text-muted">
        Tutor: <em>Not assigned yet</em>
    </p>
<?php endif; ?>

<!-- STATUS BADGE -->
<?php if ($hasBought): ?>
    <span class="badge bg-success mb-3">
        Purchased • Paid
    </span>

<?php elseif ($course['is_free']): ?>
    <span class="badge bg-success mb-3">
        Free Course
    </span>

<?php else: ?>
    <span class="badge bg-warning text-dark mb-3">
        Paid Course
    </span>
<?php endif; ?>



<!-- DESCRIPTION -->
<p class="mt-3">
    This course provides structured learning materials, guided exercises,
    and practical examples to help you master the topic.
</p>

<!-- PRICE (only if NOT free) -->
<?php if (!$course['is_free']): ?>
    <p class="fw-bold">
        Price: RM <?= number_format($course['price'], 2) ?>
    </p>
<?php endif; ?>

<hr>

<!-- ACTION BUTTON -->
<hr>

<?php if ($course['is_free']): ?>

    <a href="#" class="btn btn-primary">
        Start Course
    </a>

<?php elseif (in_array($packageName, ['premium', 'family'])): ?>

    <a href="#" class="btn btn-primary">
        Start Course
    </a>

<?php elseif ($hasBought): ?>

    <a href="#" class="btn btn-primary">
        Start Course
    </a>

<?php else: ?>

    <p class="fw-bold">
        Price: RM <?= number_format($course['price'], 2) ?>
    </p>

    <a href="<?= base_url('/student/buy-course/' . $course['course_id']) ?>"
        class="btn btn-success">
        Buy Course
    </a>

<?php endif; ?>


<a href="/student/courses" class="btn btn-secondary ms-2">
    Back to Courses
</a>