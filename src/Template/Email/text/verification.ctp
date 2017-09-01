Welcome to gonullu bankasi,
In order to provide a safer experience please confirm your Email
<?=$this->Url->build(['controller'=>'users', 'action' => 'verify', $token], [
    'escape' => false,
    'fullBase' => true
]); ?>
