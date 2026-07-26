<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<h2 class="text-center">Student Registration</h2>

<form method="post" action="/register" class="w-50 mx-auto">

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Contact</label>
        <input type="text" name="contact" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input
            type="password"
            name="password"
            class="form-control"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input
            type="password"
            name="confirm_password"
            class="form-control"
            required>
    </div>


    <button class="btn btn-primary w-100">Register</button>
</form>