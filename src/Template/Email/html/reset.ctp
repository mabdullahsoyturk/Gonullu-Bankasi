In order to change your password, click to the link below.
<?= $this->Html->link(
    'Change now!',
    ['controller' => 'Users', 'action' => 'verifyForgottenCode', $token, '_full' => true]
); ?>