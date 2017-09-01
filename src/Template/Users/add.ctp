<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="container">
    <div class="row main">
        <div class="main-login main-center">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?php
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('username');
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
        </div>
    </div>
</div>