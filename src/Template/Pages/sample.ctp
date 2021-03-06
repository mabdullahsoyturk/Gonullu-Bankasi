<?php $this->append('page_title'); ?>
<h1>Burak Usul</h1>
<?php $this->end(); ?>
<div class="row profile-row">
  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 col-lg-offset-0 col-md-offset-0 col-sm-offset-2 col-xs-offset-0" style="border-right: 1px solid #eee; text-align:center">
    <?= $this->Html->image('sample-pp.jpeg') ?>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-7">
    <div style="padding-top:10px">
      <h4 class="front">Burak Usul</h4>
      <h4 class="front">Abdullah Gul University</h4>
      <h4 class="front">Computer Engineering</h4>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div style="padding-top:10px">
      <q class="about">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas hendrerit mattis convallis. Maecenas ornare eleifend quam dictum efficitur. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum iaculis leo turpis, quis nullam sodales.</q>
    </div>
  </div>
</div>
<br>
<?php $event = 10;?>
<h1 class="page-header">Events</h1>
<div class="row">
  <div class="col-md-9 col-lg-9">
    <table class="table table-striped">
      <thead>
        <th><?= __('Event name') ?></th>
        <th><?= __('Event date') ?></th>
        <th>&nbsp;</th>
      </thead>
      <tbody>
        <tr>
          <td>Sample Event</td>
          <td>4th of July, 2015</td>
          <td><a href="#">Show</a>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-lg-3 col-md-3" style="border-left: 1px solid #eee;">
    <div class="events">
      <div style="text-align:right">Volunteer Power</div>
      <div style="text-align:right"><?= __("{1}{2}{3} events", ['Burak','<span class="badge">',12,'</span>']) ?>
        <?= __('{0}{1}{2} votes', ['<span class="badge">',40,'</span>']) ?></div>
      <fieldset class="rating">
        <input type="radio" id="star5" name="rating" value="5"/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
        <input type="radio" id="star4" name="rating" value="4"/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
        <input type="radio" id="star3" name="rating" value="3"/><label class = "full" for="star3" title="Average - 3 stars"></label>
        <input type="radio" id="star2" name="rating" value="2"/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
        <input type="radio" id="star1" name="rating" value="1"/><label class = "full" for="star1" title="S  ucks big time - 1 star"></label>
      </fieldset>
      <br>
      <br>
    </div>
  </div>

</div>

<!--
<h4 style="position:fixed;top:100px;right:25px" class="visible-lg-block">lg</h4>
<h4 style="position:fixed;top:100px;right:25px" class="visible-md-block">md</h4>
<h4 style="position:fixed;top:100px;right:25px" class="visible-sm-block">sm</h4>
<h4 style="position:fixed;top:100px;right:25px" class="visible-xs-block">xs</h4>
-->

<?php $this->append('css') ?>
<style>
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
.events
{
  font-size: 21px;
}
.profile-row
{
  min-width: 518px;
}
.about
{
  font-size:21px;
}
.front
{
  border-left: 10px solid #bd352f;
  padding-left:10px
}



fieldset, label { margin: 0; padding: 0; }
body{ margin: 20px; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating {
  border: none;
}

.rating > input { display: none; }
.rating > label:before {
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before {
  content: "\f089";
  position: absolute;
}

.rating > label {
  color: #ddd;
 float: right;
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  }

</style>
<?php $this->end(); ?>
