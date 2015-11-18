<?php
/* @var $isSale boolean */
$_GET['listing_for'] = 'for_rent';
$activeForRent = 'active';
$activeForSale = '';
if( $isSale ){
	$_GET['listing_for'] = 'for_sale';
	$activeForSale = 'active';
	$activeForRent = '';
}

$forSaleUrl = Yii::app()->createAbsoluteUrl("page/index", array('slug'=>'for-sale'));
$forRentUrl = Yii::app()->createAbsoluteUrl("page/index", array('slug'=>'for-rent'));
?>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'sidebar')); ?>
	<div class="box-1">
		<div class="title"><h3>Property Search</h3></div>
		<div class="content">
			<ul class="nav-list">
				<li class="<?= $activeForRent ?> first"><a href="<?= $forRentUrl ?>">For Rent</a></li>
				<li class="<?= $activeForSale ?> last"><a href="<?= $forSaleUrl ?>">For Sale</a></li>
			</ul>
		</div>
	</div>
	<?php $this->widget('PropertySearch'); ?>
	<?php $this->widget('AdsBannerMiddleWidget'); ?>
<?php $this->endWidget();?>

<?php $this->widget('ListingWidget', array(
	'dataProvider' => Listing::searchAtIndex(),
)); ?>
