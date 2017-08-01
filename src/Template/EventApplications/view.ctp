<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="eventApplications view large-9 medium-8 columns content">
    <table class="table table-responsive">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $eventApplication->has('user') ? $this->Html->link($eventApplication->user->username, ['controller' => 'Users', 'action' => 'view', $eventApplication->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= $eventApplication->has('event') ? $this->Html->link($eventApplication->event->title, ['controller' => 'Events', 'action' => 'view', $eventApplication->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Application Time') ?></th>
            <td><?= h($eventApplication->created_time->nice()) ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Description') ?></th>
          <td><?= $this->Text->autoParagraph(h($eventApplication->description)); ?></td>
        </tr>
        <tr>
          <th scope="row"><?= __('Status') ?></th>
          <td><?= $eventApplication->status == 1 ? __('Approved') : __('Not Approved') ?></td>
        </tr>
        <?php if($eventApplication->master == 1 && $eventApplication->status == 0): ?>
          <tr>
            <td colspan="2" style="text-align:right"><?= $this->Html->link(__('Approve it'), ['controller'=>'EventApplications','action'=>'approve',$eventApplication->id])?></td>
          </tr>
        <?php endif; ?>
    </table>
</div>
