<h2 class="page-title">Edit Tutor</h2>

<form method="post"
      action="<?= base_url('/admin/tutor/update/' . $tutor['tutor_id']) ?>"
      enctype="multipart/form-data"
      class="mt-4">

    <div class="row">

        <!-- LEFT: IMAGE -->
        <div class="col-md-4 text-center">
            <img
                src="<?= $tutor['image_path']
                    ? base_url('image/tutors/' . $tutor['image_path'])
                    : base_url('image/default-profile.png') ?>"
                class="rounded-circle mb-3"
                width="140"
                height="140"
                alt="Tutor Image"
                id="previewImage"
            >

            <input
                type="file"
                name="image"
                class="form-control"
                accept="image/*"
                onchange="previewFile(this)"
            >
            <small class="text-muted">
                Leave empty to keep current image
            </small>
        </div>

        <!-- RIGHT: DETAILS -->
        <div class="col-md-8">

            <div class="mb-3">
                <label class="form-label">Tutor Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?= esc($tutor['name']) ?>"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="<?= esc($tutor['email']) ?>"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Contact</label>
                <input
                    type="text"
                    name="contact"
                    class="form-control"
                    value="<?= esc($tutor['contact']) ?>"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary">
                Update Tutor
            </button>

            <a href="<?= base_url('/admin/tutors') ?>" class="btn btn-secondary ms-2">
                Cancel
            </a>

        </div>
    </div>
</form>

<script>
function previewFile(input) {
    const file = input.files[0];
    if (file) {
        document.getElementById('previewImage').src =
            URL.createObjectURL(file);
    }
}
</script>
