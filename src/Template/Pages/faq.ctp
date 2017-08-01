		<?php $this->start('page_title'); ?>
		<h1><?= __('Frequently Asked Questions') ?></h1>
		<?php $this->end(); ?>

		<div class="alert alert-warning alert-dismissible" role="alert">
    	Bu sayfa <strong>Gönüllü Bankası</strong>'nın işlevleriyle ilgili bilgiler ve sıkça sorulan soruları içerir. Eğer sorunuzun cevabını burada bulamazsanız bize mutlaka ulaşın. <br/>
    	<strong><a href="gonullubankasi.org/contact">İletişim Bilgileri</a></strong>
    </div>

    <hr>
        <div class="faqHeader">Proje Yöneticileri</div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Kimler projesini ekleyip, gönüllü arayabilir?</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                    Üye olan herhangi bir kişi <strong>Gönüllü Bankası</strong>'na proje ekleyebilir. Proje yönetim kurulundan kabul aldığında <strong>Gönüllü Bankası</strong>'nda görünür hale gelir.
                </div>
            </div>
        </div>

		<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Projenin onay alıp almadığı kaç gün içinde belli olur?</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    Ortalama olarak başvuru yapıldıktan birkaç saat sonra gerekli bilgilendirme mail yolu ile yapılır.
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Proje eklemek istiyorum. Bunun için aşamalar nelerdir?</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    Proje ekleme süreci gayet basit. Yapmanız gereken şeyler:
                    <ul>
                        <li>Üye olun.</li>
                        <li>Hesabınızı aktif edin.</li>
                        <li><strong>Proje ekle</strong> kısmına gidip projenizi ekleyin.</li>
                        <li>Bir sonraki aşama onay aşamasıdır. Genellikle birkaç saat içinde geri dönüş yapılır.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Başvuru yapacak gönüllüleri kendim seçebilir miyim?</a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
                    Evet. Projenize başvuru yapan gönüllülerin geçmiş deneyimlerine ve diğer bilgilerine gönüllü adayının profiline girerek ulaşabilirsiniz.
                </div>
            </div>
        </div>
        <hr>
        <div class="faqHeader">Gönüllüler</div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Gönüllülük yapmak istiyorum. Bunu yapabilmem için gereken aşamalar nelerdir?</a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
                <div class="panel-body">
                    <strong>Gönüllü Bankası</strong>'nda gönüllülük yapmak gayet basittir. <strong>Başvur</strong> kısmında aktif ve gönüllüye ihtiyaç duyan projelere ulaşıp istediğiniz herhangi birine başvurabilirsiniz. <br/>
                    Geri dönüş alma süreniz proje sahibinin kendi değerlendirme sürecine göre değişkenlik gösterebilir.
                </div>
            </div>
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
