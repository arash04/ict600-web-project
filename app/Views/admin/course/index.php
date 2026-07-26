<h2 class="page-title">Manage Courses</h2>

<form method="get" class="mb-3">
    <input
        type="text"
        name="q"
        class="form-control"
        placeholder="Search course name"
        value="<?= esc($_GET['q'] ?? '') ?>"
    >
</form>


<a href="<?= base_url('admin/course/create') ?>"
   class="btn btn-edit mb-3">
    + Add Course
</a>

<div class="table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Price (RM)</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $c): ?>
                    <tr>
                        <td><?= esc($c['course_name']) ?></td>

                        <td>
                            RM <?= number_format($c['price'], 2) ?>
                        </td>

                        <td>
                            <a href="<?= base_url('admin/course/edit/' . $c['course_id']) ?>"
                               class="btn btn-edit">
                                Edit
                            </a>

                            <a href="<?= base_url('admin/course/delete/' . $c['course_id']) ?>"
                               class="btn btn-delete"
                               onclick="return confirm('Are you sure you want to delete this course?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">
                        No courses found.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
