<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contact Message'), ['action' => 'edit', $contactMessage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contact Message'), ['action' => 'delete', $contactMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactMessage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contact Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contact Message'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contactMessages view large-9 medium-8 columns content">
    <h3><?= h($contactMessage->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($contactMessage->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($contactMessage->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($contactMessage->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($contactMessage->message)); ?>
    </div>
    <div class="row">
        <h4><?= __('Subject') ?></h4>
        <?= $this->Text->autoParagraph(h($contactMessage->subject)); ?>
    </div>
</div>
