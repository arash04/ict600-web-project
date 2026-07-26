<div class="table-wrapper">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Student</th>
            <th>Package</th>
            <th>Payment Method</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($payments as $p): ?>
        <tr>
            <td><?= esc($p['name']) ?></td>
            <td><?= esc($p['package_name']) ?></td>
            <td><?= esc($p['payment_method']) ?></td>
            <td><?= esc($p['payment_status']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>