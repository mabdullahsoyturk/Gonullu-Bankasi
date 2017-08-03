<form method="post">
<?php $this->append('page_title'); ?>
<h1><?= h($first_name . " " . $last_name) ?></h1>
<h3><?= $this->Html->link(__('Preview'),['action'=>'show', $user_id]) ?></h3> 
<?php $this->end(); ?>
<div class="row profile-row">
  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-0 col-md-offset-0 col-xs-offset-0" style="border-right: 1px solid #eee; text-align:center">
    <?php if($image != null) echo $this->Html->image($image); else echo $this->Html->image("blank-profile-picture.png");  ?>
    <?= $this->Form->control('image', ['type'=>'file']) ?>
  </div>
  <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
    <?= $this->Form->control('first_name', ['value'=>$first_name ,'maxlength'=>50]) ?>
    <?= $this->Form->control('last_name', ['value'=>$last_name, 'maxlength'=>50]) ?>
    <?= $this->Form->control('university', ['value'=>$university, 'maxlength'=>100]) ?>
    <?= $this->Form->control('department', ['value'=>$department, 'maxlength'=>100]) ?>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <?= $this->Form->control('about',['value'=>$about, 'maxlength' => 100, 'type'=>'textarea']) ?>
  </div>
</div>
<?= $this->Form->submit() ?>

<!--
<h4 style="position:fixed;top:100px;right:25px" class="visible-lg-block">lg</h4>
<h4 style="position:fixed;top:100px;right:25px" class="visible-md-block">md</h4>
<h4 style="position:fixed;top:100px;right:25px" class="visible-sm-block">sm</h4>
<h4 style="position:fixed;top:100px;right:25px" class="visible-xs-block">xs</h4>
-->

<?php $this->append('css') ?>
<style>
.events
{
  font-size: 21px;
}
.profile-row
{
  min-width: 518px;
}
.about
{
  font-size:21px;
}
.front
{
  border-left: 10px solid #bd352f;
  padding-left:10px
}
</style>
<?php $this->end(); ?>
<?= $this->Form->end(); ?>
