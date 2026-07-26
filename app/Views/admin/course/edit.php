<h2 class="page-title">Edit Course</h2>

<form method="post" action="<?= base_url('/admin/course/update/' . $course['course_id']) ?>">

    <div class="mb-3">
        <label class="form-label">Course Name</label>
        <input
            type="text"
            name="course_name"
            class="form-control"
            value="<?= esc($course['course_name']) ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price (RM)</label>
        <input
            type="number"
            step="0.01"
            name="price"
            class="form-control"
            value="<?= esc($course['price']) ?>"
            required>
    </div>
    <div class="mb-3">
        <label class="form-label">Assign Tutor</label>
        <select name="tutor_id" class="form-select" required>
            <option value="">-- Select Tutor --</option>

            <?php foreach ($tutors as $tutor): ?>
                <option value="<?= $tutor['tutor_id'] ?>"
                    <?= isset($course) && $course['tutor_id'] == $tutor['tutor_id'] ? 'selected' : '' ?>>
                    <?= esc($tutor['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="mb-3 form-check">
        <input
            type="checkbox"
            name="is_free"
            class="form-check-input"
            value="1"
            <?= $course['is_free'] ? 'checked' : '' ?>>
        <label class="form-check-label">
            Free course (available to free users)
        </label>
    </div>

    <button type="submit" class="btn btn-primary">
        Update Course
    </button>

    <a href="<?= base_url('/admin/course') ?>" class="btn btn-secondary ms-2">
        Cancel
    </a>

</form>