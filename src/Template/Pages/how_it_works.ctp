    <?php $this->start('page_title'); ?>
    <h1><?= __('How it works?') ?></h1>
    <?php $this->end(); ?>

    <div class="faqHeader"><?= __('Misyonumuz') ?></div>

    <div class="alert alert-success" role="alert">
    	<?= __('Yerelde ve ulusal da gönüllülük faaliyetlerini her türlü maddi ve manevi ihtiyaçlarını karşılayabilecek ve onların başarıya ulaşabilmesi için gerekli deneyimlerim paylaşılabilceği tarafsız çalışmalarıyla alanında öncü ve çatı bir kuruluş oluşturmak.') ?>
    </div>

    <div class="faqHeader"><?= __('Vizyonumuz') ?></div>

    <div class="alert alert-info" role="alert">
        <?= __('Gönüllülük  faaliyetlerine marka değeri katarak uluslararası alanda öncü bir topluluk haline gelmek.') ?>
    </div>

    <div class="faqHeader"><?= __('Amaçlarımız'> ?></div>

    <div class="alert alert-warning" role="alert">

     <ul>
        <li><?= __('Üniversitemizde yürütülen gönüllülük faaliyetleri arasında koordinasyonu sağlamak.') ?></li>
        <li><?= __('Gönüllülük faaliyetlerine gerekli fon desteğini sağlamak.') ?></li>
        <li><?= __('Gönüllülük faaliyetlerinde rol almak isteyen öğrenciler ile gönüllü proje çalışmalarında bulunan ekipler arasında köprü görevi görmek.') ?></li>
        <li><?= __('Ulusal ve uluslarası platform da gönüllük faaliyetlerinin yaygınlaştırılmasını sağlamak.') ?></li>
        <li><?= __('Gönüllü Bankasının marka değerinin oluşturması konusunda çalışmalar yapmak.') ?></li>
        <li><?= __('STK’lar ve gönüllülük faaliyetleri yürüten kurum ve kuruluşlar ile ortak çalışmalar yürütmek.') ?></li>

    </ul>
    </div>

    <div class="faqHeader"><?= __('Gönüllülük Faaliyetlerimiz') ?></div>

    <div class="alert alert-danger" role="alert">
        <li><a href="SET"> <?= __('SET (Sevgi, Emek, Tebessüm)') ?></a></li>
        <li><a href="SivilLab"><?= __('SivilLab') ?></a></li>
        <li><a href="IH"><?= __('İH (İhtiyaç Haritası)') ?></a></li>
        <li><a href="GencBank"><?= __('Genç Bank') ?></a></li>
        <li><a href="Kulupler"><?= __('AGÜ Öğrenci Kulüpleri') ?></a></li>
    </div>

<style>
    .faqHeader {
        font-size: 27px;
        margin: 20px;
    }

    .panel-heading [data-toggle="collapse"]:after {
        font-family: 'Glyphicons Halflings';
        float: right;
        color: #F58723;
        font-size: 18px;
        line-height: 22px;
        /* rotate "play" icon from > (right arrow) to down arrow */
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .panel-heading [data-toggle="collapse"].collapsed:after {
        /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        color: #454444;
    }
</style>
