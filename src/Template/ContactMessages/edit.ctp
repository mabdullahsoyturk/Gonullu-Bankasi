<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contactMessage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contactMessage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Contact Messages'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="contactMessages form large-9 medium-8 columns content">
    <?= $this->Form->create($contactMessage) ?>
    <fieldset>
        <legend><?= __('Edit Contact Message') ?></legend>
        <?php
            echo $this->Form->control('message');
            echo $this->Form->control('email');
            echo $this->Form->control('name');
            echo $this->Form->control('subject');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
