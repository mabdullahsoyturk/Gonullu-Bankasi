<ul class="list-group">
    <?php foreach($users as $user):?>
      <?php
      if($user->id == $this->request->Session()->read('Auth.User')['id'])
        continue;
      ?>
        <li class="list-group-item clearfix">
          <?= $this->Html->link(h($user->username), ['controller'=>'profiles', 'action'=>'show', $user->id], ['class'=>'text-primary']) ?>
          <span class="pull-right">
              <span class="btn btn-xs btn-default">
                <?= $this->Html->link(_('Send a message'), ['controller'=>'messages', 'action'=>'with', $user->id]) ?>

              </span>
          </span>
        </li>

    <?php endforeach; ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</ul>
