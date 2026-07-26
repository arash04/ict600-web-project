<div class="table-wrapper">
<table class="table table-bordered">
    <tr>
        <th>Course</th>
        <th>Price</th>
        <th>Free</th>
    </tr>
    <?php foreach ($courses as $c): ?>
    <tr>
        <td><?= esc($c['course_name']) ?></td>
        <td>RM <?= number_format($c['price'], 2) ?></td>
        <td><?= $c['is_free'] ? 'Yes' : 'No' ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
