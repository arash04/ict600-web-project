<h2 class="page-title">Buy Course</h2>

<div class="card mt-4">
    <div class="card-body">
        <h4><?= esc($course['course_name']) ?></h4>

        <p class="mt-3">
            You are about to purchase this course.
        </p>

        <p class="fw-bold">
            Price: RM <?= number_format($course['price'], 2) ?>
        </p>

        <form method="post" action="<?= base_url('/student/buy-course/' . $course['course_id']) ?>">
            <button type="submit" class="btn btn-success">
                Confirm Purchase
            </button>

            <a href="<?= base_url('/student/course/' . $course['course_id']) ?>"
               class="btn btn-secondary ms-2">
                Cancel
            </a>
        </form>
    </div>
</div>
