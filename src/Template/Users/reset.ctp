<?php $this->assign('title', 'Reset Password'); ?>
<div class="users form large-9 medium-8 columns content">
    <?php echo $this->Form->create($user) ?>
    <fieldset>
        <legend><?php echo __('Reset Password') ?>
    <?php
        echo $this->Form->control('old_password', ['required' => true, 'autofocus' => true]); ?>
        <p class="helper">Passwords must be at least 8 characters and contain at least 1 number, 1 uppercase, 1 lowercase and 1 special character</p>
    <?php 
        echo $this->Form->control('new_password', ['type' => 'password', 'required' => true]);
    ?>
    </fieldset>
 	<?php echo $this->Form->button(__('Submit')); ?>
    <?php echo $this->Form->end(); ?>
</div>

