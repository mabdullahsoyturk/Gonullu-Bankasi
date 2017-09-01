<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php $this->start('page_title'); ?>
<h1><?= __('Create an event')  ?></h1>
<?php $this->end(); ?>

<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event, ['type' => 'file']) ?>
    <fieldset>
        <?php
            echo $this->Form->control('user_id', [
                        'value' => $this->request->Session()->read('Auth.User')['id'],
                        'type'=> 'hidden']);
            echo $this->Form->control('title', ['type'=>'text', 'label'=>__('Title')]);
            echo $this->Form->control('description', ['label'=>__('Description')]);
            echo $this->Form->control('image', ['type' => 'file', 'label'=>__('Image')]);
            echo $this->Form->control('address', ['type'=>'text', 'label'=>__('Address')]);
            echo $this->Form->control('deadline', ['type'=>'hidden']);
            echo $this->Form->control('volunteer_count');
       ?>
       <div style="overflow:hidden;">
         <label for=""><?= __('Event date') ?></label>
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
