<h2 class="page-title text-center mb-4">Our Packages</h2>

<p class="text-center mb-5">
    Choose a package that fits your learning goals.
</p>

<div class="row justify-content-center">

    <?php foreach ($packages as $package): ?>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm package-card">
                <div class="card-body d-flex flex-column">

                    <h5 class="card-title fw-bold">
                        <?= esc($package['package_name']) ?>
                    </h5>

                    <?php if (!empty($package['package_type'])): ?>
                        <span class="badge bg-secondary mb-2">
                            <?= esc($package['package_type']) ?>
                        </span>
                    <?php endif; ?>

                    <p class="text-muted small flex-grow-1">
                        <?= esc($package['description'] ?? 'Access curated learning content and guidance.') ?>
                    </p>

                    <h4 class="mb-3">
                        RM <?= number_format($package['price'], 2) ?>
                    </h4>

                    <a href="/login" class="btn btn-outline-dark w-100">
                        Login to Enrol
                    </a>

                </div>
            </div>
        </div>

    <?php endforeach; ?>

</div>
