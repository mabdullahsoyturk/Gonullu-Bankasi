<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="eventApplications form large-9 medium-8 columns content">
    <?= $this->Form->create($eventApplication) ?>
    <fieldset>
        <legend><?= __('Edit Event Application') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('event_id', ['options' => $events]);
            echo $this->Form->control('description');
            echo $this->Form->control('created_time');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
