<div class="row">
    <ol class="breadcrumb">
        <?php foreach ($level as $k => $v): ?>
            <li><a href="<?= $v ?>"><?= $k; ?></a></li>
        <?php endforeach; ?>
        <li class="active"><?= $active; ?></li>
    </ol>
</div>