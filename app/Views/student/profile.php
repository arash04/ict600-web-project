<h2 class="page-title text-center mb-4">My Profile</h2>

<div class="row justify-content-center">
    <div class="mb-3 text-center">
        <?php if (!empty($student['image_path'])): ?>
            <img
                src="<?= base_url('image/students/' . $student['image_path']) ?>"
                alt="Profile Image"
                class="rounded-circle"
                width="120"
                height="120">
        <?php else: ?>
            <img
                src="<?= base_url('image/default-profile.jpg') ?>"
                alt="Default Profile"
                class="rounded-circle"
                width="120"
                height="120">
        <?php endif; ?>
    </div>

    <div class="col-md-8">

        <table class="table table-bordered table-lg text-center">
            <tr>
                <th>Name</th>
                <td><?= esc($student['name']) ?></td>
            </tr>
            <tr>
                <th>Contact</th>
                <td><?= esc($student['contact']) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= esc($user['email']) ?></td>
            </tr>
        </table>

        <div class="text-center">
            <a href="/student/edit" class="btn btn-primary">
                Edit Profile
            </a>
        </div>

    </div>
</div>