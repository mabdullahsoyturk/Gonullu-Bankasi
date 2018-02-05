<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="events form large-9 medium-8 columns content">
  <?= $this->Form->create($event, ['type' => 'file']) ?>
  <fieldset>
      <legend><?= __('Edit the event') ?></legend>
      <?php if($applicationNumber) : ?>
      <div class="alert alert-warning"><?= __("Changing an event where there are standing by or approved applications, will cancel the applications and will ask them to approve their applications.") ?></div>
    <?php endif; ?>
      <?php
          echo $this->Form->control('user_id', [
                      'value' => $this->request->Session()->read('Auth.User')['id'],
                      'type'=> 'hidden']);
          echo $this->Form->control('title', ['type'=>'text', 'label'=>'Title']);
          echo $this->Form->control('description', ['label'=>'Description']);
          echo $this->Form->control('specifications', ['label'=>'Specifications']);
    
  ?>
  <div class="form-group">
    <label for=""><?= __('Current picture') ?></label>
      <div class="form-group">
          <div class="row">
              <div class="col-md-8">
                <?php echo $this->Html->image('/files/Events/image/'.$event->image,
                      array( 'border' => '0', 'width'=>400)); ?>
              </div>
          </div>
      </div>
  </div>
  <?php
          echo $this->Form->control('image', ['type' => 'file', 'label'=>'Image']);
          echo $this->Form->control('address', ['type'=>'text', 'label'=>'Adress']);
          echo $this->Form->control('deadline', ['type'=>'hidden']);

     ?>
     <div style="overflow:hidden;">
       <label for=""><?= __('Event time') ?></label>
         <div class="form-group">
             <div class="row">
                 <div class="col-md-8">
                     <div id="datetimepicker12"></div>
                 </div>
             </div>
         </div>
         <script type="text/javascript">
            var x;
             $(function () {
                 $('#datetimepicker12').datetimepicker({
                     inline: true,
                     sideBySide: true,
                     locale:'tr',
                     defaultDate:new Date('<?= $event->deadline; ?>')

                 });

                 $('#saveForm').click(function() {

                   var starttime = $('#datetimepicker12').data("DateTimePicker").date().toDate();
                   // Get the iso time (GMT 0 == UTC 0)
                   var isotime = new Date((new Date(starttime)).toISOString() );
                   // getTime() is the unix time value, in milliseconds.
                   // getTimezoneOffset() is UTC time and local time in minutes.
                   // 60000 = 60*1000 converts getTimezoneOffset() from minutes to milliseconds.
                   var fixedtime = new Date(isotime.getTime()-(starttime.getTimezoneOffset()*60000));
                   // toISOString() is always 24 characters long: YYYY-MM-DDTHH:mm:ss.sssZ.
                   // .slice(0, 19) removes the last 5 chars, ".sssZ",which is (UTC offset).
                   // .replace('T', ' ') removes the pad between the date and time.
                   var formatedMysqlString = fixedtime.toISOString().slice(0, 19).replace('T', ' ');
                   $('input[name=deadline]').val(formatedMysqlString);

                   $('.events.form form').submit();
                 })
             });
         </script>
     </div>
  </fieldset>
  <hr>
  <?= $this->Form->button(__('Save'), ['type'=>'button', 'id'=>'saveForm', 'class' => 'btn-primary btn-lg']) ?>
  <?= $this->Form->end() ?>
</div>
<?= $this->Html->script('/bower_components/moment/min/moment.min.js'); ?>
<?= $this->Html->script('/bower_components/moment/locale/tr.js'); ?>
<?= $this->Html->script('/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'); ?>
<?= $this->Html->css('/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'); ?>
