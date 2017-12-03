<?php foreach ($notifications as $notification) :?>
<div class="panel <?= $notification->status == 1  ? 'panel-default' : 'panel-info' ?>">
  <div class="panel-heading"><?= $notification->title ?></div>
  <div class="panel-body">
    <?= $notification->body ?>
  </div>
</div>

<?php endforeach; ?>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>
