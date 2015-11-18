<?php /* @var $this Controller */ ?>
<?php $this->beginContent('/layouts/onehome/site'); ?>
	<?php echo $this->clips['top-banner']; ?>
	
	<section class="page-content">
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

			<?php $this->widget('Notification') ?>
			<?php echo $content; ?>
			<?php $this->widget('AdsBannerBottomWidget'); ?>
		</div>
	</section>
<?php $this->endContent(); ?>