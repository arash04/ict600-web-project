<h2 class="page-title">
    Welcome
</h2>

<?php if (!$enrolment): ?>
    <p class="text-muted">
        You are not enrolled in any package yet. Start by choosing a package below.
    </p>
<?php else: ?>
    <p class="text-muted">
        You are currently enrolled in the <strong><?= esc($enrolment['package_name']) ?></strong> package.
    </p>
<?php endif; ?>

<div class="row mt-4">

    <!-- PROFILE -->
    <div class="col-md-4 mb-3">
        <div class="card text-center">
            <div class="card-body">
                <h5>My Profile</h5>
                <p>View or update your information</p>
                <a href="/student/profile" class="btn btn-primary">
                    View Profile
                </a>
            </div>
        </div>
    </div>

    <?php if ($enrolment): ?>
        <!-- MY ENROLMENT (only if paid) -->
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>My Enrolment</h5>
                    <p>
                        Package: <?= esc($enrolment['package_name']) ?>
                    </p>
                    <a href="/student/enrolment" class="btn btn-success">
                        View Enrolment
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- PACKAGE (only if NOT paid) -->
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Choose Package</h5>
                    <p>Select a package to start learning</p>
                    <a href="/student/enrol" class="btn btn-success">
                        View Packages
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($enrolment): ?>
        <!-- COURSES (optional but logical) -->
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>My Courses</h5>
                    <p>Access your available courses</p>
                    <a href="/student/courses" class="btn btn-secondary">
                        View Courses
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
