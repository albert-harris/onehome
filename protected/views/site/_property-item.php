<?php
/* @var $model Listing */
$f = Yii::app()->format;

$urlReturn = "http://" . $_SERVER['HTTP_HOST'] . Yii::app()->request->requestUri;
$link = Yii::app()->createAbsoluteUrl('site/login', array('returnUrl' => $urlReturn));

$propUrl = $this->createAbsoluteUrl('site/listingdetail', array('slug' => $model->slug));
$propName = StringHelper::limitStringLength(
	Listing::FormatNameListingIndexGrid($model, array('not_type' => 1)), 22);
$propAddr = StringHelper::limitStringLength(strip_tags(Listing::FormatShowBuildingOrStreet($model)), 30);
$sp = $model->rUser;
$linkAgent = $this->createUrl('/agent/view', array('slug'=>$model->rUser->slug));

// shortlist js
$uId = (int)Yii::app()->user->id;
$rId = (int)Yii::app()->user->role_id;
$roleMember = ROLE_REGISTER_MEMBER;
$url = Yii::app()->createAbsoluteUrl('site/addShortlist');
Yii::app()->clientScript->registerScript('shortlist-add-button', "setupShortList({ 
	userId: $uId,
	roleId: $rId,
	roleMember: $roleMember,
	addShortListUrl: '$url'
});");

// add this button
Yii::app()->clientScript->registerScriptFile(
	"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56133df5326f44f0", 
	CClientScript::POS_END, array('async'=>'async')
);
?>
<div class="col-sm-6 col-md-4">
	<div class="property-item">
		<div class="image">
			<div class="img-rad">
				<?= InputHelper::holderImage($model->getDefaultImageUrl(266,161), 266, 161)?>
			</div>
			<div class="price">
				<span class="head">
					<span class="tail">
						<span class="mid">Price: S$ <?php echo $f->formatPrice($model->price); ?></span>
					</span>
				</span>
			</div>
			<ul class="links">
				<?php if ( !(isset(Yii::app()->user->role_id)) || 
					(Yii::app()->user->role_id == ROLE_REGISTER_MEMBER) ): ?>
				<li><a href="<?php echo $link ?>"><span class="pi heart"></span>Shortlist</a></li>
				<?php endif ?>
				
				<li><a href="<?php echo $propUrl ?>">
					<span class="pi detail"></span>More Details
				</a></li>
			</ul>
		</div>
		<div class="desc">
			<?php $model->showiconBedroomBathroom($model) ?>
			<h3 class="name">
				<a href="<?php echo $propUrl ?>"><?php echo $propName ?>&nbsp;</a>
			</h3>
			
			<div class="address"><?php echo $propAddr ?>&nbsp;</div>
			
			<div class="meta">
				<div class="row">
					<?php if ($model->canShowBedroomAndBathRoom()): ?>
					<div class="col-xs-4 info">
						<span class="pi bedroom"></span> <?php echo (int) $model->of_bedroom; ?>
					</div>
					<div class="col-xs-4 info" style="text-align: center">
						<span class="pi bathroom"></span> <?php echo (int) $model->of_bathrooms; ?>
					</div>
					<?php else: ?>
					<div class="col-xs-8"><?= $model->rPropertyType2->name ?></div>
					<?php endif ?>
					<div class="col-xs-4 sqft">
						<small>SQFT</small>
						<?= $model->getSqft() ?>
					</div>
				</div>
			</div>
			<div class="community">
				<div class="row">
					<div class="col-xs-5">
						&nbsp;<i class="fa fa-eye fa-lg"></i>&nbsp;&nbsp;
						<?= (int)$model->view_count ?> views</div>
					<div class="col-xs-7">
						<div class="addthis_native_toolbox" data-title="<?= CHtml::encode($propName) ?>"
							 data-url="<?= $propUrl ?>"></div>
					</div>
				</div>
			</div>
			<div class="author">Posted by: 
				<span class="author-image">
					<?= InputHelper::holderImage($model->rUser->getAvatarUrl(27,27), 27, 27)?>
				</span> 
				<a href="<?= $linkAgent ?>"><?= $sp->first_name." ".$sp->last_name ?></a></div>
		</div>
	</div>
</div>