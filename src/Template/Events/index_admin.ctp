<h1><?= _('Unapproved events: ')?></h1>
<?php foreach ($events as $event): ?>
<div class="col-md-4 col-sm-6">

<div class="thumbnail">

        <?= $this->Html->image('/files/Events/image/'.$event->image, array('border' => '0', 'style'=> 'width:100%;height:100%', 'class' => 'responsive')); ?>

  </div>

    <div class="caption">

        <h4><?= $this->Html->link($event->title, ['action' => 'view', $event->id]) ?></h4>
    </div>

    <h5>
        <?= __('Event Owner'); ?>: <?= $this->Html->link(h($event->user->username), ['controller'=>'profiles', 'action'=>'show', $event->user->id]) ?>
    </h5>

    <h5>
        <?= __('Address'); ?>: <?= $this->Html->link($event->address, ['action' => 'view', $event->id]) ?>
    </h5>
    <h5>
        <?= __('Deadline'); ?>: <?= $event->deadline->nice(); ?>
    </h5>

    <?= $this->Text->autoParagraph(h($this->Text->truncate($event->description, 200, ['exact'=>false, 'html'=>true]))); ?>

  <div class="details"><?= $this->Html->link(__('Details'), ['action' => 'view', $event->id]); ?></div>
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
    <p>
        <?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?>
    </p>
</div>
