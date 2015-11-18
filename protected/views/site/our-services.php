<?php
/* @var $this CController */
/* @var $model OurService */

// register royal slider library
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/royalslider/royalslider.css');
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->theme->baseUrl.'/royalslider/jquery.royalslider.min.js');

$startSlideId = 0;	// slider item id to start autoplay

// hide the ads on the left
Yii::app()->clientScript->registerScript('our-service-page', "
	$('.sidebar-left .bn-small').addClass('hide');
");

$this->breadcrumbs = array(
	'Our Services' => array('ourServices'),
	$model->name
);
?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'top-banner')); ?>
<div style="position: relative" class="hidden-xs">
	<div id="service-slider" class="royalSlider heroSlider rsMinW">
		<?php foreach(OurService::getMainCategories() as $k => $category): ?>
		<?php if ($category->id == $model->id) {
			$startSlideId = $k;
		} ?>
		<div class="rsContent"> 
			<?= InputHelper::holderImage($category->getImageUrl(1903, 407), 1903, 407, array('class'=>'rsImg')) ?>
			<span class="rsTmb"><?= $category->name ?></span>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="service-tab">
		<div class="container"><div class="table-responsive"><!-- content added by js --></div></div>
	</div>
</div>

<div class="visible-xs-block" style="margin-top: 20px">
	<div class="collapse in navbar-collapse" id="bs-example-navbar-collapse-2">
		<ul class="nav navbar-nav service-nav">
			<?php foreach(OurService::getMainCategories() as $category): ?>
			<li class="dropdown"> 
				<span><?= $category->name ?></span>

				<i class="fa fa-angle-right dropdown-toggle"
				   data-toggle="dropdown" 
				   role="button" aria-haspopup="true" 
				   aria-expanded="false"
				>&nbsp;</i>

				<ul class="dropdown-menu">
				<?php foreach($category->childs as $child): ?>
					<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/ourServices', array('slug'=>$child->slug)) ?>"
						><?= $child->name ?></a></li>
				<?php endforeach ?>
				</ul>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>	
</div>

<?php $this->endWidget();?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'sidebar')); ?>
	<?php $this->widget('OurServiceLinkWidget', array(
		'model' => $model
	)) ?>
<?php $this->endWidget();?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'right-sidebar')); ?>
<div class="green-tab sidebar-tab">
	<ul role="tablist" class="nav nav-tabs">
		<li class="active first"><a href="javascript:void(0)">ASK FOR QUOTATION</a>
		</li>
	</ul>
	<div class="tab-content" style="border: medium none; padding: 0">
		<div class="tab-pane active">
		<?php $this->widget('ServiceFormWidget', array(
			'serviceId' => $model->id
		)) ?>
		</div>
	</div>
</div>
<?php $this->endWidget();?>

<div style="text-align: right; color: red; font-style: italic; margin-top: -37px;font-size: 10px;">*** Prices subject to changes without prior notice</div>

<h1><?= $model->name ?></h1>
<div class="cms-content">
	<?= $model->description ?>
	<p><a href="<?php echo $this->createUrl('service/step1') ?>">
		<img src="<?= Yii::app()->theme->baseUrl ?>/img/contact-banner.jpg" alt="" class="img-responsive"></a></p>
</div>

<?php
Yii::app()->clientScript->registerScript('royal-slider', "
	window.ourServiceSlider = $('#service-slider').royalSlider({
		/* size of all images  */
		imgWidth: 1903,
		imgHeight: 407,
		arrowsNav: false,
		fadeinLoadedSlide: false,
		controlNavigationSpacing: 0,
		controlNavigation: 'tabs',
		imageScaleMode: 'fill',
		autoScaleSlider: true, 
		autoScaleSliderWidth: 1903,     
		autoScaleSliderHeight: 407,
		startSlideId: $startSlideId,
		autoPlay: {
    		enabled: true,
    		pauseOnHover: true,
			delay: 3000
    	}
	});
	$('.service-tab .table-responsive').append(ourServiceSlider.find('.rsNav'));
	setInterval(function () {
		$('#service-slider').data('royalSlider').startAutoPlay();
	}, 8000);
");
?>

<style>
h1 {
  border-bottom: 2px solid #3ab54a;
  color: #3ab54a;
  font-size: 25px;
  font-weight: bold;
  margin-bottom: 20px;
  padding-bottom: 12px;
}

hr {
  border-color: #3ab54a;
  border-width: 2px;
}

/*
 * service testimonial
 */

.service-tm h3 {
  background-color: #45c355;
  border-radius: 6px;
  color: #fff;
  font-size: 18px;
  font-weight: bold;
  margin-top: 0;
  padding: 13px 0;
  text-align: center;
  text-transform: uppercase;
}

.service-tm h4 {
  border-bottom: 2px solid #45c355;
  color: #45c355;
  font-size: 13px;
  font-weight: bold;
  margin-bottom: 20px;
  padding-bottom: 5px;
  position: relative;
  text-transform: uppercase;
}

.service-tm h4:before {
  border-left: 9px solid transparent;
  border-right: 9px solid transparent;
  border-top: 13px solid #45c355;
  bottom: -13px;
  content: " ";
  height: 0;
  left: 20px;
  position: absolute;
  width: 0;
}

.tm-carousel .controls {
  float: right;
  position: relative;
  z-index: 1;
}

.tm-carousel .carousel-control {
  display: inline-block;
  position: static;
}

.tm-carousel .carousel-control.left {
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
  border-bottom: 7px solid transparent;
  border-right: 13px solid #bcbcbc;
  border-top: 7px solid transparent;
  height: 0;
  width: 0;
  margin-right: 10px;
}

.tm-carousel .carousel-control.right {
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
  border-bottom: 7px solid transparent;
  border-left: 13px solid #bcbcbc;
  border-top: 7px solid transparent;
  height: 0;
  width: 0;
}
</style>