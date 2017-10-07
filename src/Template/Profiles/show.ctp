<?php $this->append('page_title'); ?>
<h1><?= h($first_name . " " . $last_name) ?>
    <?php if($id != $this->request->Session()->read('Auth.User')['id']): ?>
    <small><?= $this->Html->link(_('Send a message'), ['controller'=>'messages','action'=>'with', $id]);?></small></h1>
    <?php endif; ?>
<?php $this->end(); ?>

<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
          <?php if($image != null) echo $this->Html->image('/files/Users/image/'.$image, array('border' => '0', 'style'=> 'width:100%', 'class'=>'img-responsive')); 
                else echo $this->Html->image("blank-profile-picture.png", ['class'=>'img-responsive']);  ?>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?= h($first_name . " " . $last_name) ?>
					</div>
					<div class="profile-usertitle-job">
						<?= h($university) ?> - <?= h($department) ?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
          <?= $this->Html->link(_('Send a message'), ['controller'=>'messages','action'=>'with', $id], ['class'=>'btn btn-danger btn-sm']);?>

				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="javascript:void(0)" data-href='overview'>
							<i class="glyphicon glyphicon-home"></i>
							<?= __('Overview'); ?> </a>
						</li>
						<li>
							<a href="javascript:void(0)" data-href='applications'>
							<i class="glyphicon glyphicon-ok"></i>
							<?= __('Applications'); ?> </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
        <div class="profile-content active" id='overview'>
          <h4><?= __('About me'); ?></h4>  
          <?php if(! empty($about)): ?>
          <p><?= $about; ?></p>
          <?php else: ?>
          <p><?= __('No information provided yet.'); ?></p>
          <?php endif; ?>
          <h4><?= __('My skills and hobbies'); ?></h4>  
          <?php if(! empty($skills_and_hobbies)): ?>
          <p><?= $skills_and_hobbies; ?></p>
          <?php else: ?>
          <p><?= __('No information provided yet.'); ?></p>
          <?php endif; ?>
          <h4><?= __('My personal values'); ?></h4>  
          <?php if(! empty($personal_values)): ?>
          <p><?= $personal_values; ?></p>
          <?php else: ?>
          <p><?= __('No information provided yet.'); ?></p>
          <?php endif;?>
        </div>
        
        <div class="profile-content" id='applications'>
                <table class="table table-striped">
                  <thead>
                    <th><?= __('Event name') ?></th>
                    <th><?= __('Event date') ?></th>
                    <th>&nbsp;</th>
                  </thead>
                  <tbody>
                    <?php if(count($applications) == 0): ?>
                      <tr>
                       <td>-</td> 
                       <td>-</td> 
                       <td>-</td> 
                      </tr>
                    <?php endif; ?>
                    <?php foreach ($applications as $row): ?>
                      <tr>
                        <td><?= $row->event->title; ?></td>
                        <td><?= $row->event->deadline->nice(); ?></td>
                        <td><?= $this->Html->link(__('See'),['controller'=>'events','action'=>'view',$row->event->id]); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                  <?php if(count($applications) == 0): ?>
                      <?= __('This user has not applied to any event so far.');?>
                    <?php endif; ?>
        </div>
            
		</div>
	</div>
</div>
<script type='text/javascript'>
  $('.profile-usermenu a').click(function() {
    if($(this).hasClass('active'))
       return false;
    
    $('.profile-usermenu li, .profile-content').removeClass('active');
    $(this).parent().addClass('active');
    
    $('#'+$(this).data('href')).addClass('active');
    
  })
</script>
<style>
/***
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/
  .profile-content {
    display:none;
  }
  .profile-content.active {
    display:block
  }
  .profile-content h4 {
    padding: 5px;
    margin-top: 5px;
    border-bottom: 1px solid #999;
    
  }
/* Profile container */
.profile {
  margin: 20px 0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 50%;
  height: 50%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: 460px;
}
</style>
<!--
<h4 style="position:fixed;top:100px;right:25px" class="visible-lg-block">lg</h4>
<h4 style="position:fixed;top:100px;right:25px" class="visible-md-block">md</h4>
<h4 style="position:fixed;top:100px;right:25px" class="visible-sm-block">sm</h4>
<h4 style="position:fixed;top:100px;right:25px" class="visible-xs-block">xs</h4>
-->

<?php $this->append('css') ?>
<style>
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
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



fieldset, label { margin: 0; padding: 0; }
body{ margin: 20px; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating {
  border: none;
}

.rating > input { display: none; }
.rating > label:before {
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before {
  content: "\f089";
  position: absolute;
}

.rating > label {
  color: #ddd;
 float: right;
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  }

</style>
<?php $this->end(); ?>
