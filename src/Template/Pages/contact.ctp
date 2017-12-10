<?php $this->start('page_title'); ?>
<h1><?= __('Contact Us') ?></h1>
<?php $this->end(); ?>


<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    <?= __('Contact us <small>You can send us message anytime you want</small>') ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
               <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'ContactMessages', 'action' => 'add']
                ]); ?>

                <div class="row">
                    <div class="col-md-6">
                         <div class="input-group">
                            <?php echo $this->Form->control('name'); ?>
                         </div>       
                         <br>    
                         <div class="input-group">
                            <?php echo $this->Form->control('email'); ?>
                         </div>
                         <br>
                         <div class="input-group">
                            <?php echo $this->Form->control('subject', ['type' => 'select', 'options' => ['Adding events', 'Suggestions', 'Product Support']]); ?>
                        </div>
                     </div>   
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $this->Form->control('message', ['rows' => '9', 'cols' => '25', 'required' => 'required', 'placeholder' => 'Message']); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                            <?= __('Send Message') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span> <?= __('Our office') ?></legend>
            <address>
                <strong><?= __('Abdullah Gul University') ?></strong><br>
                <?= __('Sümer Campus') ?><br>
                <?= __('Kayseri, Turkey') ?><br>
                <abbr title="Phone">
                    P:</abbr>
                (352) 224 88 00 - 02 - 03
            </address>
            <address>
                <strong><?= __('Our mail adress') ?></strong><br>
                <a href="mailto:#">gonullubankasi@agu.edu.tr</a>
            </address>
            </form>
        </div>
    </div>
</div>
