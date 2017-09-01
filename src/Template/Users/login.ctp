<div class="container">
    <div class="row main">
        <div class="main-login main-center">
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>
		</div>
    </div>
</div>