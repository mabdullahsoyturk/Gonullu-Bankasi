<?php foreach ($notifications as $notification) :?>
<div class="panel <?= $notification->status == 1  ? 'panel-default' : 'panel-info' ?>">
  <div class="panel-heading"><?= $notification->title ?></div>
  <div class="panel-body">
    <?= $notification->body ?>
  </div>
</div>

<?php endforeach; ?>
