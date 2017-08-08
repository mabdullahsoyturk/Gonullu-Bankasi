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
                <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                <?= __('Name') ?></label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">
                                <?= __('Email Adress') ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                <?= __('Subject') ?></label>
                            <select id="subject" name="subject" class="form-control" required="required">
                                <option value="na" selected=""><?= __('Select one:') ?></option>
                                <option value="service"><?= __('Adding events') ?></option>
                                <option value="suggestions"><?= __('Suggestions') ?></option>
                                <option value="product"><?= __('Product support') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                <?= __('Message') ?></label>
                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                placeholder="Message"></textarea>
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
            <legend><span class="glyphicon glyphicon-globe"></span> <?= __('Ofisimiz') ?></legend>
            <address>
                <strong><?= __('Abdullah Gul University') ?></strong><br>
                <?= __('Sümer Campus') ?><br>
                <?= __('Kayseri, Turkey') ?><br>
                <abbr title="Phone">
                    P:</abbr>
                (352) 224 88 00 - 02 - 03
            </address>
            <address>
                <strong><?= __('Mail adresimiz') ?></strong><br>
                <a href="mailto:#">gonullubankasi@agu.edu.tr</a>
            </address>
            </form>
        </div>
    </div>
</div>
