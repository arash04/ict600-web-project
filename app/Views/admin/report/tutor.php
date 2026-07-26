<div class="table-wrapper">
<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
    </tr>
    <?php foreach ($tutors as $t): ?>
    <tr>
        <td><?= esc($t['name']) ?></td>
        <td><?= esc($t['email']) ?></td>
        <td><?= esc($t['contact']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</div>