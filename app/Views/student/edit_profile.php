<h2 class="page-title">Edit Profile</h2>

<form method="post"
      action="<?= base_url('/student/update') ?>"
      enctype="multipart/form-data">

    <div class="mb-3">
        <label>Name</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="<?= esc($student['name']) ?>"
            required>
    </div>

    <div class="mb-3">
        <label>Contact</label>
        <input
            type="text"
            name="contact"
            class="form-control"
            value="<?= esc($student['contact']) ?>"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Profile Image</label>
        <input
            type="file"
            name="image"
            class="form-control"
            accept="image/*">
    </div>


    <button class="btn btn-primary">Update</button>
    <a href="/student/profile" class="btn btn-secondary">Cancel</a>

</form>