<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php $this->start('page_title'); ?>
<h1><?= __('Applications to'). ' '. $eventApplications->first()->event->title; ?></h1>
<?php $this->end(); ?>

    <div class="eventApplications index large-9 medium-8 columns content">
        <?php if($eventApplications->first()): ?>

        <?php else:?>
          <?= __('No applications submitted yet'); ?>
        <?php endif;?>
        <div class="products">
        <?php foreach ($eventApplications as $eventApplication): ?>
        <div class="single-product">
          <table>
            <tr>
              <td class="rTA"><b><?= __('Username').':'; ?></b></td>
              <td class="lPad"><?= $this->Html->link($eventApplication->user->username, ['controller'=>'Users','action'=>'view',$eventApplication->user->id]) ?></td>
            </tr>
            <tr>
              <td class="rTA"><b><?= __('Email address')?>: </b></td>
              <td class="lPad"><?= $eventApplication->user->email; ?></td>
            </tr>
            <tr>
              <td class="rTA"><b><?= __('Application Date')?>: </b></td>
              <td class="lPad"><?= h($eventApplication->created_time) ?></td>
            </tr>
            <tr>
              <td class="rTA"><b><?= __('Description').':'; ?></b></td>
              <td class="lPad"><?= h($eventApplication->description); ?></td>
            </tr>
            <tr>
              <td class="rTA"><b><?= __('Status').':'; ?></b></td>
              <td class="lPad"><?= $eventApplication->status == 1 ? __('Approved') : __('Not Approved') ?></td>
            </tr>
            <tr>
              <td colspan="2" class="rTA end"><?= $this->Html->link(__('See'), ['action' => 'view', $eventApplication->id]) ?></td>
            </tr>
          </table>
        </div>
        <?php endforeach; ?>
        </div>
        </table>
        <?php if(count($eventApplications) > 0): ?>
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
      <?php endif; ?>
    </div>


    <style media="screen">
        .paginator {
            clear: both;
        }

        .single-product figure {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0;
            margin-right: 20px;
            margin-bottom: 5px;
            float: left;
            border-radius: 4px;
            overflow: hidden;
        }

        .single-product {
            clear: both;
            width: 100%;
        }

        .rTA
        {
          text-align: right;
          padding: 3px;
        }

        .lPad
        {
          padding: 3px;
          padding-left: 8px;
        }

        .end
        {
          border-bottom: 1px solid black;
        }

        .single-product:nth-child(2n) table
        {
          background-color: #f2f2f2;
        }
    </style>
