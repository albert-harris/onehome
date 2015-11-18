<?php /* @var $this Controller */ ?>
<?php $this->beginContent('/layouts/onehome/site'); ?>
	<?php echo $this->clips['top-banner']; ?>
	
	<section class="page-content">
	<div class="container">
		<div class="row">
			<div class="sidebar-left col-md-3">
				<?php echo $this->clips['sidebar']; ?>
				<?php $this->widget('AdsBannerMiddleHomeWidget'); ?>
			</div>
			<main class="main-content col-md-6">
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links' => $this->breadcrumbs,
					'separator' => '&nbsp;&raquo;&nbsp;',
					'homeLink'=> CHtml::link('Home', Yii::app()->homeUrl),
					'tagName' => 'div',
					'activeLinkTemplate' => '<a href="{url}">{label}</a>',
					'inactiveLinkTemplate' => '<span>{label}</span>',
					'htmlOptions'=>array('class'=>'breadcrumb')
				)); ?>
				<?php echo $content; ?>
				<?php $this->widget('AdsBannerBottomWidget'); ?>
			</main>
			<div class="sidebar col-md-3">
				<?php echo $this->clips['right-sidebar']; ?>
			</div>
		</div>
	</div>
	</section>
<?php $this->endContent(); ?>