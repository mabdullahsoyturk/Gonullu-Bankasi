<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post) ?>
    <fieldset>
        <legend><?= __('Add Post') ?></legend>
    </fieldset>
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#en"><?= __('English'); ?> </a></li>
      <li><a data-toggle="tab" href="#tr"><?= __('Turkish'); ?> </a></li>    
    </ul>

    <div class="tab-content">
      <div id="en" class="tab-pane fade in active">
        <?php echo $this->Form->control('title_en', ['type'=>'text', 'label'=>__('Title'), 'required'=>TRUE, 'value' => $post->post_contents[0]->title]); ?>
        <?php echo $this->Form->control('description_en', ['type'=>'textarea', 'label'=>__('Description'), 'value' => $post->post_contents[0]->description]); ?>
      </div>
      <div id="tr" class="tab-pane fade">
        <?php echo $this->Form->control('title_tr', ['type'=>'text', 'label'=>__('Title'), 'required'=>TRUE, 'value' => $post->post_contents[1]->title]); ?>
        <?php echo $this->Form->control('description_tr', ['type'=>'textarea', 'label'=>__('Description'), 'value' => $post->post_contents[1]->description]); ?>

      </div>
     
    </div>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=vaqrj8v8hy505p5l7d4aqodhbhw0vcgprmixxm4e98civt78"></script>
<script>tinymce.init({ selector:'textarea',
height: 500,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons paste textcolor colorpicker textpattern imagetools toc'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'preview media | forecolor backcolor emoticons',
  image_advtab: true,
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ] });</script>