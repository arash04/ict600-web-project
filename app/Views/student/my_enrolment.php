<h2 class="page-title text-center mb-4">My Enrolment</h2>

<div class="row justify-content-center">
    <div class="col-md-8">

        <table class="table table-bordered table-lg text-center">
            <tr>
                <th>Package</th>
                <td class="fw-bold">
                    <?= esc($enrolment['package_name']) ?>
                </td>
            </tr>
            <tr>
                <th>Payment Method</th>
                <td><?= esc($enrolment['payment_method']) ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="badge bg-success">
                        <?= esc($enrolment['payment_status']) ?>
                    </span>
                </td>
            </tr>
        </table>

        <!-- 🔍 Package explanation -->
        <?php
        $packageName = strtolower($enrolment['package_name']);
        ?>

        <div class="alert alert-info text-center">
            <?php if ($packageName === 'free'): ?>
                You can access all <strong>free courses</strong>.
                Paid courses can be purchased individually.
            <?php elseif (in_array($packageName, ['premium', 'family'])): ?>
                You have <strong>full access</strong> to all courses without extra payment.
            <?php else: ?>
                You can purchase <strong>individual courses</strong> based on your needs.
            <?php endif; ?>
        </div>

        <!-- 🔘 Actions -->
        <div class="text-center mt-4">
            <a href="/student/courses" class="btn btn-primary me-2">
                View Courses
            </a>

            <a href="/student/dashboard" class="btn btn-secondary">
                Back to Dashboard
            </a>
        </div>

    </div>
</div>
