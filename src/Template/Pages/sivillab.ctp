<div id="myCarousel" class="carousel slide container" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <?= $this->Html->image('sivillab_carousel1.png', array('alt' => __('Sivil Lab'), 'border' => '0', 'width' => '100%', 'data-src' => 'img'));?>
      </div>

      <div class="item">
        <?= $this->Html->image('sivillab_carousel2.png', array('alt' => __('Sivil Lab'), 'border' => '0', 'width' => '100%', 'data-src' => 'img'));?>
      </div>

      <div class="item">
        <?= $this->Html->image('sivillab_carousel3.png', array('alt' => __('Sivil Lab'), 'border' => '0', 'width' => '100%', 'data-src' => 'img'));?>
      </div>

      <div class="item">
        <?= $this->Html->image('sivillab_carousel4.png', array('alt' => __('Sivil Lab'), 'border' => '0', 'width' => '100%', 'data-src' => 'img'));?>
      </div>

      <div class="item">
        <?= $this->Html->image('sivillab_carousel5.png', array('alt' => __('Sivil Lab'), 'border' => '0', 'width' => '100%', 'data-src' => 'img'));?>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>

    <br>
    <br>

<div class="row">
  <div class="col-md-3"><?= $this->Html->image('sivillab.png', array('alt' => __('Sivil Lab'), 'border' => '0', 'width' =>'100%', 'data-src' => 'img'));?></div>
  <div class="col-md-6" >
    <h2><?= __('SivilLAB') ?></h2>
    <p><?= __('SivilLAB, Robert Bosch Stiftung ve Goethe-Institut Ankara’nın ortak olarak düzenlediği programdır. Programın yürütüldüğü şehirlerdeki yerel aktörlerle birlikte projeler geliştirmeyi ve Türkiye’deki sosyal aktiviteleri desteklemeyi amaçlıyor.

	Mayıs 2016’da başlayan SivilLAB programı; Eskişehir, İstanbul ve Kayseri’deki yerel proje geliştirme koordinatörleri tarafından yürütülüyor. Koordinatörler, kendilerine ev sahipliği yapan kurumlarla birlikte, gençlerin katılımını güçlendirmek ve sınırlar ötesi aktörleri bir araya getirmek üzere yenilikçi yaklaşımlar geliştiriyorlar.
') ?> </p>
  </div>
</div>

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <p><?= __('Bu dönem SivilLab, temel olarak Kayseride ki yerel halk ile mülteciler arasında iletişim köprüsü kurma amaçlı projeler kapsamında çalıştı. Bu hedefe ulaşmak için OAK adı verilen Suriyeli çocuklara Türkçe eğitim fırsatları tanıyan ve kadınlara uğraşlar bulan hayır kurumu ile iş birliği yaptı. OAK ile işbirliğinde yürütülen çalışmalar aşağıda belirtilmiş bulunmakta:
') ?> </p>
  </div>
</div>

<span class="col-md-3"></span>

<span class="col-md-6">
	<ul>
        <li><?= __('Takım için Atölye Çalışmaları.') ?></li>
        <li><?= __('Komşu Mutfağım.') ?></li>
        <li><?= __('Suriyeli Gençlerin AGÜ Ziyareti.') ?></li>
        <li><?= __('Komşu Mutfağım 2') ?></li>
        <li><?= __('Renkli Bahçe.') ?></li>
    </ul>
    </span>

</div>

<style>
	@media only screen and (max-width: 959px) {}

/* Tablet Portrait size to standard 960 (devices and browsers) */
@media only screen and (min-width: 768px) and (max-width: 959px) {}

/* All Mobile Sizes (devices and browser) */
@media only screen and (max-width: 767px) {}

/* Mobile Landscape Size to Tablet Portrait (devices and browsers) */
@media only screen and (min-width: 480px) and (max-width: 767px) {}

/* Mobile Portrait Size to Mobile Landscape Size (devices and browsers) */
@media only screen and (max-width: 479px) {}
}

</style>
