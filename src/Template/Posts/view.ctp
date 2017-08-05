<?php
/**
  * @var \App\View\AppView $this
  */
$languages = ['en' => $post['post_contents'][0], 
              'tr' => $post['post_contents'][1]];

$postContent = $languages[$lang];

$user = $this->request->Session()->read('Auth.User');
$isOwner = FALSE;
if($user && $user['id'] == $post->user_id) {
	$isOwner = TRUE;
}

?>

<div class="posts view large-9 medium-8 columns content">
  
    <h1><?= h($postContent->title) ?></h1>
    <?php if($isOwner): ?>
	<?= $this->Html->link(__('Edit'),['controller'=>'Posts','action'=>'edit', $post->id]); ?>
	<br>
    <?php endif; ?>
   
    <div style='margin-top:30px'></div>
    <?= $postContent->description ?>
 	<?= __('Author:'); ?><?= $this->Html->link(sprintf('%s %s', $post->user->first_name, $post->user->last_name), ['controller' => 'Profiles', 'action' => 'show', $post->user->id]) ?>
</div>