Welcome to gonullu bankasi,
In order to provide a safer experience please confirm your Email
<?= $this->Html->link(
    'Verify now!',
    ['controller' => 'Users', 'action' => 'verify', $token, '_full' => true]
); ?>
