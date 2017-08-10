<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Gönüllü Bankası';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('https://fonts.googleapis.com/css?family=Rambla&amp;subset=latin-ext'); ?>
    <?= $this->Html->css('base.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'); ?>
</head>
<body>
  <div class="row">
    <div class="col-md-3 hidden-sm hidden-xs"><?php echo $this->Html->image('agu.jpeg', array('id'=>'header-logo', 'border' => '0', 'data-src' => 'img')); ?></div>
    <div class="col-md-6 col-sm-7 col-xs-10"><?= $this->Html->link('<h2>'.__('Gönüllü Bankası').'</h2>', ['controller'=>'events','action'=>'index'],['class'=>'header_name','escape'=>false]) ?></div>
    <div class="col-md-3 col-sm-5 col-xs-2 buttonss">
      <?php if($lang == 'en'): ?>
        <?=$this->Html->link('TR',['controller'=>'language','action'=>'switchTo','tr'], ['class' => 'btn btn-link buttonn']) ?>
      <?php else: ?>
        <?=$this->Html->link('EN',['controller'=>'language','action'=>'switchTo','en'], ['class' => 'btn btn-link buttonn',]) ?>
      <?php endif;?>
      <span class="hidden-xs">
        <?php if($this->request->Session()->read('Auth.User')): ?>
          <?= $this->Html->link(__('Add Post'),['controller'=>'Posts','action'=>'add']) ?>
          <?= $this->Html->link(__('Profile'),['controller'=>'Profiles','action'=>'edit']) ?>
          <a href="<?= $this->Url->build([
                "controller" => "Users",
                "action" => "logout"
            ]); ?>"
                type="button" class="btn btn-link buttonn"><?= __('Log out') ?></a>
        <?php else: ?>
          <a href="<?= $this->Url->build([
                "controller" => "Users",
                "action" => "add"
            ]); ?>"
                type="button" class="btn btn-link buttonn"><?= __('Sign Up') ?></a>
          <a href="<?= $this->Url->build([
                "controller" => "Users",
                "action" => "login"
            ]); ?>" class="btn btn-link buttonn"><?= __('Sign In') ?></a>
        <?php endif; ?>
      </span>
    </div>
</div>


<hr style='margin-top:5px'>
<div class="modal fade" id="loginPopUpWindow">
    <div class="modal-dialog">
        <div class="model-content">
            <div class="model-header"></div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="model-body"></div>
            <form role="form">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Şifre">
                </div>
            </form>
            <div class="model-footer"></div>
            <button class="btn btn-primary btn-block"> Giriş Yap</button>
        </div>
    </div>
</div>
<div class="modal fade" id="signUpPopUpWindow">
    <div class="modal-dialog">
        <div class="model-content">
            <div class="model-header"></div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="model-body"></div>
            <form role="form">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Adı">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Soyadı">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Şifre">
                </div>
            </form>
            <div class="model-footer"></div>
            <button class="btn btn-primary btn-block"> Üye Ol</button>
        </div>
    </div>
</div>
</div>
</div>
</div>

<nav>
    <div class="navbarplace">
      <span class="visible-xs-inline">
        <ul class="nav navbar-nav">
          <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= __('Menu') ?> <span class="caret"></span></a>
             <ul class="dropdown-menu">
                <?php if($this->request->Session()->read('Auth.User')): ?>
                  <li><?= $this->Html->link(__('Profile'),['controller'=>'Profiles','action'=>'edit']) ?></li>
                  <li><?= $this->Html->link(__('Log out'),['controller'=>'Users','action'=>'logout']) ?></li>
                  <li role="separator" class="divider"></li>
                  <li><?= $this->Html->link(__('Add Post'),['controller'=>'Posts','action'=>'add']) ?></li>
                <?php else :?>
                  <li><?= $this->Html->link(__('Sign Up'),['controller'=>'Users','action'=>'add']) ?></li>
                  <li><?= $this->Html->link(__('Sign In'),['controller'=>'Users','action'=>'login']) ?></li>
                <?php endif; ?>
                  <li role="separator" class="divider"></li>
                  <li><?= $this->Html->link(__('Homepage'), ['controller'=>'Events','action'=>'index']) ?></li>
                  <li><?= $this->Html->link(__('Volunteams'),['controller'=>'pages','action'=>'volunteams']) ?></li>
                  <li><?= $this->Html->link(__('Add Event'),['controller'=>'events','action'=>'add'])?></li>
                  <li><?= $this->Html->link(__('Join Us'),['controller'=>'events','action'=>'index']) ?></li>
                  <li><?= $this->Html->link(__('FAQ'),['controller'=>'pages','action'=>'faq']) ?></li>
                  <li><?= $this->Html->link(__('Contact'),['controller'=>'pages','action'=>'contact']) ?></li>
             </ul>
           </li>
        </ul>
      </span>
      <span class="hidden-xs">
      <a href="<?= $this->Url->build([
            "controller" => "Events",
            "action" => "index"
        ]); ?>" class="nav_icons navbarspace" align = 'middle'><?php echo $this->Html->image('homepage.png',
    array('alt' => __('Homepage'), 'border' => '0', 'data-src' => 'img')); ?><h4><?= __('Homepage'); ?></h4></a>
    <div class='icon-with-dropdown'>
      <a href="#<?php $this->Url->build([
            "controller" => "Pages",
            "action" => "volunteams"
        ]); ?>" class="nav_icons navbarspace dropdown-toggle" align = 'middle' type="button"
        data-toggle="dropdown" ><?php echo $this->Html->image('members.png',
    array('alt' => __('Volunteams'), 'border' => '0', 'data-src' => 'img')); ?><h4><?= __('Volunteams'); ?><span class="caret"></span></h4>

    </a>
    <ul class="dropdown-menu">
      <?php foreach($posts as $post): ?>
        <li><a href="<?= $this->Url->build([
            "controller" => "Posts",
            "action" => "View",
            $post['post_id']
        ]); ?>"><?= $post['title']; ?></a></li>

      <?php endforeach; ?>
      <li><a href="http://www.ihtiyacharitasi.org/"><?= __('İhtiyaç Haritası') ?></a></li>
    </ul>
    </div>
      <a href="<?= $this->Url->build([
            "controller" => "Events",
            "action" => "add"
        ]); ?>" class="nav_icons navbarspace" align = 'middle'><?php echo $this->Html->image('reusable-shopping-bag.png',
    array('alt' => __('Add Event'), 'border' => '0', 'data-src' => 'img')); ?><h4><?= __('Add Event')?></h4></a>

      <a href="#" class="nav_icons navbarspace" align = 'middle'><?php echo $this->Html->image('share-file.png',
    array('alt' => __('Join Us'), 'border' => '0', 'data-src' => 'img')); ?><h4><?= __('Join Us'); ?></h4></a>
      <a href="<?= $this->Url->build([
            "controller" => "Pages",
            "action" => "faq"
        ]); ?>" class="nav_icons navbarspace" align = 'middle'><?php echo $this->Html->image('notebook.png',
    array('alt' =>  __('Frequently Asked Questions'), 'border' => '0', 'data-src' => 'img')); ?><h4><?= __('FAQ'); ?></h4></a>
      <a href="<?= $this->Url->build([
            "controller" => "Pages",
            "action" => "Contact"
        ]); ?>" class="nav_icons navbarspace" align = 'middle'><?php echo $this->Html->image('telephone-handle.png',
    array('alt' => __('Contact'), 'border' => '0', 'data-src' => 'img')); ?><h4><?= __('Contact'); ?></h4></a>
      </span>
    </div>
    <hr>
</nav>

<section>

  <div class="container" id='big-img' style='width:100%'>
    <?php if(empty($this->fetch('jumbotron_content')) && ! empty($this->fetch('jumbotron_enabled'))): ?>
    <div class="jumbotron">
      <h1><?= __('Be a part of the change! ');?></h1>
      <p><?= __('You are welcome to join Gonullu Bank to make a difference in the society'); ?></p>
    </div>
  <?php elseif(! empty($this->fetch('jumbotron_content'))): ?>
  <?php echo $this->fetch('jumbotron_content'); ?>
  <?php endif; ?>
  </div>

    <div class="container">
        <div class="page-header">
          <?= $this->Flash->render() ?>
          <?= $this->fetch('page_title') ?>
        </div>
        <?= $this->fetch('content') ?>

    </div>
</section>

<div class="footer-bottom">

  <div class="container">

    <div class="row">

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

        <div class="copyright">

          <?= __('© 2017, AGU Developers, All rights reserved') ?>

        </div>

      </div>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

        <div class="design">

           <a href="#"><?= __('Gönüllü Bankası') ?> </a> |  <a target="_blank" href="http://www.agu.edu.tr"><?= __('Abdullah Gül Üniversitesi') ?></a>

        </div>

      </div>

    </div>

  </div>

</div>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <?= $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'); ?>
</body>
</html>
