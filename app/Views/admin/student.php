<h2 class="page-title">Manage Students</h2>

<form method="get" class="mb-3">
    <input
        type="text"
        name="q"
        class="form-control"
        placeholder="Search student name or email"
        value="<?= esc($_GET['q'] ?? '') ?>"
    >
</form>

<div class="table-wrapper">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $s): ?>
            <tr>
                <td><?= esc($s['name']) ?></td>
                <td><?= esc($s['contact']) ?></td>
                <td><?= esc($s['email']) ?></td>
                <td>
                    <div class="form-actions">
                    <a href="<?= base_url('admin/students/edit/' . $s['student_id']) ?>"
                        class="btn btn-edit">Edit</a>
                <a href="/admin/students/delete/<?= $s['student_id'] ?>"
                    class="btn btn-delete"
                    onclick="return confirm('Are you sure you want to delete this student?')">
                    Delete
                </a>
                </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>