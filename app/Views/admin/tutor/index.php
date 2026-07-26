<h2 class="page-title">Manage Tutors</h2>

<a href="<?= base_url('admin/tutors/create') ?>"
   class="btn btn-edit mb-3">
    + Add Tutor
</a>

<div class="table-wrapper">
<table class="admin-table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($tutors as $t): ?>
            <tr>
                <td>
                    <?php if ($t['image_path']): ?>
                        <img src="<?= base_url('image/tutors/' . $t['image_path']) ?>"
                            style="width:60px;border-radius:6px;">
                    <?php endif; ?>
                </td>

                <td><?= esc($t['name']) ?></td>
                <td><?= esc($t['contact']) ?></td>
                <td><?= esc($t['email']) ?></td>

                <td>
                    <a href="<?= base_url('admin/tutors/edit/' . $t['tutor_id']) ?>"
                        class="btn btn-edit">Edit</a>

                    <a href="<?= base_url('admin/tutors/delete/' . $t['tutor_id']) ?>"
                        class="btn btn-delete"
                        onclick="return confirm('Are you sure you want to delete this tutor?')">
                        Delete
                    </a>
                </td>

            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>