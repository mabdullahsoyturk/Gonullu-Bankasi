<div class="container">
    <div class="row main">
        <div class="main-login main-center">
<?php $this->start('page_title'); ?>
<h1><?= __('Login') ?></h1>
<?php $this->end(); ?>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>
<?= $this->Html->link('Forgot your password?', ['controller' => 'users', 'action' => 'password']); ?>
		</div>
    </div>
</div>
