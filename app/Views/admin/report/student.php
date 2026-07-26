<div class="table-wrapper">
<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Contact</th>
    </tr>
    <?php foreach ($students as $s): ?>
    <tr>
        <td><?= esc($s['name']) ?></td>
        <td><?= esc($s['contact']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</div>