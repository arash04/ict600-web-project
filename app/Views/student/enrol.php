<h2 class="page-title text-center mb-4">Package Enrolment</h2>

<form method="post" action="/student/enrol" class="container mb-5">

    <div class="row g-4 mb-4">
        <?php foreach ($package as $p): ?>

            <?php
                $cardClass = 'border-secondary';
                $headerClass = 'bg-secondary text-white';

                if (strtolower($p['package_name']) === 'premium') {
                    $cardClass = 'border-primary';
                    $headerClass = 'bg-primary text-white';
                } elseif (strtolower($p['package_name']) === 'family') {
                    $cardClass = 'border-success';
                    $headerClass = 'bg-success text-white';
                }
            ?>

            <div class="col-md-4">
                <label class="w-100">

                    <!-- HIDDEN RADIO -->
                    <input
                        type="radio"
                        name="package_id"
                        value="<?= $p['package_id'] ?>"
                        class="d-none package-radio"
                        required
                    >

                    <!-- CARD -->
                    <div class="card h-100 text-center selectable-card <?= $cardClass ?>">
                        <div class="card-header <?= $headerClass ?>">
                            <h5 class="mb-0"><?= esc($p['package_name']) ?></h5>
                        </div>

                        <div class="card-body">
                            <h6 class="mb-3">RM <?= esc($p['price']) ?></h6>

                            <!-- FEATURE LIST -->
                            <ul class="list-unstyled text-start">
                                <?php
                                    // Simple feature mapping (safe & clear)
                                    if (strtolower($p['package_name']) === 'free') {
                                        $features = [
                                            ['Basic courses', true],
                                            ['Community support', true],
                                            ['Tutor consultation', false],
                                            ['Certificate', false]
                                        ];
                                    } elseif (strtolower($p['package_name']) === 'premium') {
                                        $features = [
                                            ['All courses access', true],
                                            ['Tutor consultation', true],
                                            ['Certificate', true],
                                            ['Priority support', true]
                                        ];
                                    } else { // family
                                        $features = [
                                            ['Up to 5 users', true],
                                            ['All premium features', true],
                                            ['Family dashboard', true],
                                            ['Progress tracking', true]
                                        ];
                                    }
                                ?>

                                <?php foreach ($features as [$text, $ok]): ?>
                                    <li class="mb-1">
                                        <span class="<?= $ok ? 'text-success' : 'text-danger' ?>">
                                            <?= $ok ? '✔' : '✖' ?>
                                        </span>
                                        <?= esc($text) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                    </div>

                </label>
            </div>

        <?php endforeach; ?>
    </div>

    <!-- PAYMENT METHOD -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <label class="form-label">Payment Method</label>
            <select name="payment_method" class="form-control" required>
                <option value="">-- Select Payment Method --</option>
                <option value="Online Banking">Online Banking</option>
                <option value="Credit/Debit Card">Credit / Debit Card</option>
                <option value="E-Wallet">E-Wallet</option>
            </select>
        </div>
    </div>

    <!-- SUBMIT BUTTON -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <button type="submit" class="btn btn-success w-100 py-2">
                Proceed Payment
            </button>
        </div>
    </div>

</form>
