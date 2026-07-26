<h2 class="page-title">Courses</h2>

<form method="get" class="mb-4">
    <input
        type="text"
        name="q"
        class="form-control"
        placeholder="Search course"
        value="<?= esc($_GET['q'] ?? '') ?>">
</form>

<div class="row mt-4">

    <?php foreach ($courses as $course): ?>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5><?= esc($course['course_name']) ?></h5>

                    <?php if (!$course['is_free']): ?>
                        <p class="text-muted mb-2">
                            Price: RM <?= number_format($course['price'], 2) ?>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($course['is_free'])): ?>
                        <span class="badge bg-success mb-2">Free</span>
                    <?php endif; ?>

                    <div class="mt-3">
                        <a href="/student/course/<?= $course['course_id'] ?>"
                            class="btn btn-primary w-100">
                            View Course
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>