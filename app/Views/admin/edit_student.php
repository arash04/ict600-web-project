<h2 class="page-title">Edit Student</h2>

<form method="post" action="/admin/students/update" class="w-50">

    <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>">

    <div class="mb-3">
        <label>Name</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="<?= esc($student['name']) ?>"
            required
        >
    </div>

    <div class="mb-3">
        <label>Contact</label>
        <input
            type="text"
            name="contact"
            class="form-control"
            value="<?= esc($student['contact']) ?>"
            required
        >
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input
            type="email"
            class="form-control"
            value="<?= esc($student['email']) ?>"
            readonly
        >
    </div>

    <button class="btn btn-primary">Save Changes</button>
    <a href="/admin/students" class="btn btn-secondary">Cancel</a>
</form>
