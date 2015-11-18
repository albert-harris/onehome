<?php /* @var $this Controller */ ?>
<?php $this->beginContent('/layouts/onehome/site'); ?>
	<?php echo $this->clips['top-banner']; ?>
	
	<section class="page-content two-col-left">
	<div class="container">
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links' => $this->breadcrumbs,
			'separator' => '&nbsp;&raquo;&nbsp;',
			'homeLink'=> CHtml::link('Home', Yii::app()->homeUrl),
			'tagName' => 'div',
			'activeLinkTemplate' => '<a href="{url}">{label}</a>',
			'inactiveLinkTemplate' => '<span>{label}</span>',
			'htmlOptions'=>array('class'=>'breadcrumb')
		)); ?>
		<div class="row">
			<main class="main-content col-md-9 col-md-push-3">
				<?php echo $content; ?>
				<?php $this->widget('AdsBannerBottomWidget'); ?>
			</main>
			<div class="sidebar col-md-3 col-md-pull-9">
				<?php echo $this->clips['sidebar']; ?>
			</div>
		</div>
	</div>
	</section>
<?php $this->endContent(); ?>