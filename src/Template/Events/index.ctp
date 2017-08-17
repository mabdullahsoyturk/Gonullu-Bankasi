<?php
/**
  * @var \App\View\AppView $this
  */
  $this->assign('jumbotron_enabled', 'true');
?>
<style media="screen">

  .paginator {
    clear:both;
  }
  .single-product figure {
    position: relative;
    width: 150px;
    height: 150px;
    margin: 0;
    margin-right: 20px;
    margin-bottom: 5px;
    float: left;
    border-radius: 4px;
    overflow: hidden;
  }
  .single-product {
    clear:both;
    width:100%;
  }
</style>

  <div class="container">

    <div class="row text-center" style="display:flex; flex-wrap:wrap;">
      <?php $this->start('page_title'); ?>
      <h1><?= __('Call for Volunteers') ?></h1>
      <?php $this->end(); ?>


        <?php foreach ($events as $event): ?>
        <div class="col-md-3 col-sm-6">
           
        <div class="thumbnail">

                <?= $this->Html->image('/files/Events/image/'.$event->image, array('border' => '0', 'style'=> 'width:100%;height:100%', 'class' => 'responsive')); ?>

          </div>

            <div class="caption">

                <h4><?= $this->Html->link($event->title, ['action' => 'view', $event->id]) ?></h4>
            </div>

            <h5>
                <?= __('Event Owner'); ?>: <?= $this->Html->link(h($event->user->username), ['controller'=>'profiles', 'action'=>'show', $event->user->id]) ?>
            </h5>

            <h5>
                <?= __('Address'); ?>: <?= $this->Html->link($event->address, ['action' => 'view', $event->id]) ?>
            </h5>
            <h5>
                <?= __('Deadline'); ?>: <?= $event->deadline->nice(); ?>
            </h5>
            <?php
              $description = explode("::", wordwrap(h(str_replace("\n", "", $event->description)), 200, "::"));
              if(! empty($description[1])) {
                  $description = $description[0]."...";
              } else {
                  $description = $description[0];
              }
            ?>
            <?= $this->Text->autoParagraph($description); ?>

          <div class="details"><?= $this->Html->link(__('Details'), ['action' => 'view', $event->id]); ?></div>
        </div>

        <?php endforeach; ?>
    </div>
  </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p>
                <?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?>
            </p>
        </div>
        <div class="row row-5 beast-triple-column">
        <div class="column col-md-4 col-sm-6 beast-top-row5-column1">
          <div class="panel-pane pane-fieldable-panels-pane pane-vuuid-c84b786a-cbe4-46dd-99b6-230109091bff pane-bundle-text">



  <div class="pane-content">
    <div class="fieldable-panels-pane">
    <div class="field field-name-field-basic-text-text field-type-text-long field-label-hidden"><div class="field-items"><div class="field-item even">
      
      <?= $this->Html->image('start.jpg', array('class' => 'rounded', 'border' => '0', 'style'=> 'width:360px;height:220px;')); ?>

<h4><a href="javascript:void(0)"><?= __('Be a part of the change!') ?></a></h4>
<p><?= __('Apply to the projects that need volunteers and become a part of their dream.') ?></p>
<p> <br></p>
</div></div></div></div>
  </div>


  </div>
        </div>
        <div class="column col-md-4 col-sm-6 beast-top-row5-column2">
          <div class="panel-pane pane-fieldable-panels-pane pane-vuuid-b0a8b7b1-7c72-4447-b90b-f1a89a0bd104 pane-bundle-text">



  <div class="pane-content">
    <div class="fieldable-panels-pane">
    <div class="field field-name-field-basic-text-text field-type-text-long field-label-hidden"><div class="field-items"><div class="field-item even">
<?= $this->Html->image('serve.jpg', array('class' => 'rounded','border' => '0', 'style'=> 'width:360px;height:220px;')); ?>
    <h4><a href="javascript:void(0)"><?= __('Be the change itself') ?></a></h4>
    <p><?= __('Share your project and find your dream mates!') ?></p>
    </div></div></div></div>
  </div>


  </div>
        </div>
        <div class="column col-md-4 col-sm-6 beast-top-row5-column3">
          <div class="panel-pane pane-fieldable-panels-pane pane-vuuid-fb16e6c6-0972-4947-b27c-1b4cf34fe95a pane-bundle-text">

  <div class="pane-content">
    <div class="fieldable-panels-pane">
    <div class="field field-name-field-basic-text-text field-type-text-long field-label-hidden"><div class="field-items"><div class="field-item even">
      <?= $this->Html->image('explore.jpg', array('class' => 'rounded','border' => '0', 'style'=> 'width:360px;height:220px;')); ?>

      <h4><a href="javascript:void(0)"><?= __('Explore') ?></a></h4>
    <p><?= __('Explore yourself and decide your role for the future!') ?></p>
    </div></div></div></div>
  </div>


  </div>
        </div>
      </div>
