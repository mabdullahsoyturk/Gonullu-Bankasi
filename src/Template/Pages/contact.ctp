<?php $this->start('page_title'); ?>
<h1><?= __('Contact Us') ?></h1>
<?php $this->end(); ?>


<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    <?= __('Bize ulaşın <small>Her zaman iletişime geçebilirsiniz</small>') ?></h1>
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
                                <?= __('İsminiz') ?></label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">
                                <?= __('Email Adresi') ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                <?= __('Konu') ?></label>
                            <select id="subject" name="subject" class="form-control" required="required">
                                <option value="na" selected="">Birini seçin:</option>
                                <option value="service">Etkinlik ekleme</option>
                                <option value="suggestions">Öneriler</option>
                                <option value="product">Ürün desteği</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                <?= __('Mesaj') ?></label>
                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                            <?= __('Mesajı gönder') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span> <?= __('Ofisimiz') ?></legend>
            <address>
                <strong><?= __('Abdullah Gül Üniversitesi') ?></strong><br>
                <?= __('Sümer Kampüsü') ?><br>
                <?= __('Kayseri, Türkiye') ?><br>
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
