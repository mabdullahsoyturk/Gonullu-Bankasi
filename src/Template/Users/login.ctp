<?php $this->start('page_title'); ?>
<h1><?= __('Login') ?></h1>
<?php $this->end(); ?>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>
