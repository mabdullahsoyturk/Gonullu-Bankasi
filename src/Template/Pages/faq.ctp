		<?php $this->start('page_title'); ?>
		<h1><?= __('Frequently Asked Questions') ?></h1>
		<?php $this->end(); ?>

		<div class="alert alert-warning alert-dismissible" role="alert">
        <?= __('This page includes information about how Gönüllü Bankası works and frequently asked questions. If you cannot find the answer of your question, please contact us.') ?>     
    	<strong><a href="http://gonullubankasi.org/pages/contact"><?= __('Contact Details') ?></a></strong>
    </div>

    <hr>
        <div class="faqHeader"><?= __('Project Owners') ?></div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <?= __('Do I need to have a title to add a project in order to find volunteers?')?></a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                    <?= __('Anyone who is a member of Gonullu Bankasi can add projects to find volunteers, if the target of project is found valid by the Gonullu Bankasi committe.  ') ?>
                </div>
            </div>
        </div>	

		<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    <?= __('How much time does it take Gonullu Bankasi committe to consider my application?') ?>         
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <?= __('It usually takes a few hours. The informing process is made via email.') ?>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    <?= __('I would like to add a project. What is the process for it?') ?>
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <?= __('The application process is very simple.') ?>
                    <ul>
                        <li><?= __('Sign up') ?></li>
                        <li><?= __('Verify your account') ?></li>
                        <li><?= __('<strong>Go to Add Event</strong>') ?></li>
                        <li><?= __('The next step is approval process. It usually takes a few hours') ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                    <?= __('Can I pick certain volunteers between volunteer candidates?') ?>         
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
                    <?= __('Yes. You can also see the volunteering history of volunteer candidates') ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="faqHeader"><?= __('Volunteers') ?></div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                    <?= __('I want to be a volunteer. What is the process for it?') ?>
                    </a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
                <div class="panel-body">
                    <?= __('Being a volunteer via <strong>Gonullu Bankasi</strong> is very easy. You can find the projects that are looking for volunteers via Homepage and apply one of those project that you want to contribute') ?>
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
