<h2><?= _('Messenger'); ?></h2>
<?php foreach($msgGroups as $group): ?>
    <div class="media">
            <div class="media-left" style="width:64px; height:64px; float:left">
                <?php if($group->otherUserImage != null) echo $this->Html->image('/files/Users/image/'.$group->otherUserImage, array('border' => '0', 'style'=> 'width:100%')); else echo $this->Html->image("blank-profile-picture.png", ['style'=>'width:100%']);  ?>
            </div>
            <div class="media-body">
                <a href="<?= $this->Url->build(['controller'=>'messages', 'action'=>'with', $group->otherUserId]); ?>">

                <h4 class="media-heading"><?= $group->name; ?></h4>
                <?= $group->message_user_id == $userId ? sprintf('%s:', _('You')) : ''; ?><?= htmlentities($group->message); ?>
                </a>
            </div>

    </div>
<?php endforeach; ?>
