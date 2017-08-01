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
        <?= $this->Html->image('student_clubs1.png', array('alt' => __('Student Clubs'), 'border' => '0', 'width' => '100%', 'data-src' => 'img'));?>
      </div>

      <div class="item">
        <?= $this->Html->image('student_clubs2.png', array('alt' => __('Student Clubs'), 'border' => '0', 'width' => '100%', 'data-src' => 'img'));?>
      </div>

      <div class="item">
        <?= $this->Html->image('student_clubs3.png', array('alt' => __('Student Clubs'), 'border' => '0', 'width' => '100%', 'data-src' => 'img'));?>
      </div>

      <div class="item">
        <?= $this->Html->image('student_clubs4.png', array('alt' => __('Student Clubs'), 'border' => '0', 'width' => '100%', 'data-src' => 'img'));?>
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

    <div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6" >
    <h2><?= __('Öğrenci Kulüpleri') ?></h2>
    <p><?= __('Üniversite içerisindeki öğrenci kulüpleri yaptıkları çalışmalar konusunda Abdullah Gül Üniversitesi yönetimi tarafından desteklenmektedirler. Her kulüp aktivitesini misyonlarına uygun sırasıyla belli bir perspektif ve amaç içerisinde yürütür. Bunun akabinde üniversite içerisinde yıl boyunca belli kulüplerin çatısı altında renkli etkinlikler ve gönüllülük faaliyetleri sürdürülür. Abdullah Gül Üniversitesi öğrenci mevcudu az ve öğrencileri genel kapsamda yoğun bir eğitim içerisinde olduklarından etkinliklerin gerek hazırlanışına yardımcı olacak gerek sadece katılımcı olacak gönüllülere ihtiyaç oluşmuştur.
Yıl içerisinde Kulüpler Birliği Konseyinde aktif yer alan ve gönüllülük çalışmaları yürüten bazı kulüpler Gönüllü Bankasında yer almak üzere seçilmiştir. Linklere tıklayarak bu kulüpler ve yaptıkları çalışmalar hakkında daha fazla bilgi edinebilirsiniz.
') ?> </p>

<span class="col-md-3"></span>

<span class="col-md-6">
  <ul>
        <li><a href="https://www.facebook.com/aguscitech/"><?= __('AGÜ Bilim ve Teknoloji Kulübü') ?></a></li>
        <li><a href="https://www.facebook.com/Agu.IdC/?fref=ts"><?= __('AGÜ Fikir Kulübü') ?></a></li>
        <li><a href="https://www.facebook.com/aguyapikulubu/?fref=ts"><?= __('AGU Yapı Kulübü') ?></a></li>
        <li><a href="https://www.facebook.com/AGUbusinessclub/?fref=ts"><?= __('AGU İşletme Kulübü') ?></a></li>
    </ul>
    </span>
  </div>
</div>