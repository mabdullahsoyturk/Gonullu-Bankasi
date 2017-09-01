<?php
/**
  * @var \App\View\AppView $this
  */
?>

<<<<<<< HEAD
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
=======
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('email');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('phone');
            echo $this->Form->control('university');
            echo $this->Form->control('department');
            echo $this->Form->control('about');
>>>>>>> a8314dab44904a4f667a97f7534ade16d128cbba
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
<<<<<<< HEAD
        </div>
    </div>
</div>
=======
</div>
>>>>>>> a8314dab44904a4f667a97f7534ade16d128cbba
