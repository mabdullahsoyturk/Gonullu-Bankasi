<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php $this->start('page_title'); ?>
<h1><?= __('Create an event')  ?></h1>
<?php $this->end(); ?>

<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event, ['type' => 'file']) ?>
    <fieldset>
        <?php
            echo $this->Form->control('user_id', [
                        'value' => $this->request->Session()->read('Auth.User')['id'],
                        'type'=> 'hidden']);
            echo $this->Form->control('title', ['type'=>'text', 'label'=>__('Event Title')]);
            echo $this->Form->control('deadline', ['type'=>'hidden']);
            echo $this->Form->control('address', ['type'=>'text', 'label'=>__('Address')]);
            echo $this->Form->control('volunteer_count', ['label' => __('How many volunteers do you need?')]);
            echo $this->Form->control('description', ['label'=>__('Why do you need volunteers? Briefly explain.')]);
            echo $this->Form->control('specifications', ['label'=>__('What are your requirements?')]);
            echo $this->Form->control('image', ['type' => 'file', 'id' => 'image-field']);
       ?>

      <div class="file-upload">
  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
    <div class="drag-text">
      <h3>Drag and drop a file or select add Image</h3>
    </div>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
</div>

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
             
             function readURL(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function(e) {
                      $('.image-upload-wrap').hide();

                      $('.file-upload-image').attr('src', e.target.result);

                      $('.file-upload-content').show();

                      $('.image-title').html(input.files[0].name);
                      $('input[name=image]').val(input.files[0]);
                    };

                  reader.readAsDataURL(input.files[0]);
              } else {
              removeUpload();
              }
          }

            function removeUpload() {
              $('.file-upload-input').replaceWith($('.file-upload-input').clone());
              $('.file-upload-content').hide();
              $('.image-upload-wrap').show();
              $('input[name=image]').val('');
            }
            $('.image-upload-wrap').bind('dragover', function () {
                $('.image-upload-wrap').addClass('image-dropping');
              });
              $('.image-upload-wrap').bind('dragleave', function () {
                $('.image-upload-wrap').removeClass('image-dropping');
            });

           </script>

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
