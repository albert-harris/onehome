<?php /* @var $this Controller */ ?>
<?php $this->beginContent('/layouts/onehome/site'); ?>
	<?php echo $this->clips['top-banner']; ?>
	
	<section class="page-content two-col-right">
	<div class="container">
		<div class="row">
			<main class="main-content col-md-9">
				<?php echo $content; ?>
				<?php $this->widget('AdsBannerBottomWidget'); ?>
			</main>
			<div class="sidebar col-md-3">
				<?php echo $this->clips['sidebar']; ?>
				<?php $this->widget('AdsBannerMiddleHomeWidget'); ?>
			</div>
		</div>
	</div>
	</section>
<?php $this->endContent(); ?>