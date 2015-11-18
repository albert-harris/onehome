<?php
/* @var $data Listing */
$f = Yii::app()->format;
$mDefaultPhoto = Listing::getDefaultImgListing($data->id);
$linkImage = $data->getDefaultImageUrl(266, 161);
$user = $data->rUser;
if (!$user) 
	$user = Users::model()->findByAttributes(array(
	'role_id' => ROLE_AGENT,
	'status'=> STATUS_ACTIVE
));
$phone = $f->formatFullPhone($user);
$propName = Listing::FormatNameListingIndexGrid($data, array('not_type'=>1));

// add this button
Yii::app()->clientScript->registerScriptFile(
	"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56133df5326f44f0", 
	CClientScript::POS_END, array('async'=>'async')
);
?>

<?php if($index%2==0): ?>
<div class="row">
<?php endif ?>
	
<div class="col-sm-6">
	<div class="prop-item-2">
		<div class="row">
			<div class="image col-md-4">
				<div class="img-box">
					<?= InputHelper::holderImage($linkImage, 266, 161) ?>
				</div>
				<div class="description">
					<?php
						$urlReturn =  "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->requestUri;
						$link = Yii::app()->createAbsoluteUrl('site/login', array('returnUrl'=>$urlReturn));
						if(!(isset(Yii::app()->user->role_id)) || (Yii::app()->user->role_id == ROLE_REGISTER_MEMBER)): ?>
					<p><a next="<?php echo $link ?>" href="javascript:void(0);" data-listing-id="<?php echo $data->id; ?>" class="ico-star shortlist">Shortlist</a></p>
					<?php endif; ?>

					<p>&nbsp;<i class="fa fa-eye fa-lg"></i>&nbsp;&nbsp;
							<?= (int)$data->view_count ?> views</p>
					<div class="addthis_native_toolbox" data-title="<?php echo $propName ?>"
						 accesskey=""data-url="<?= $this->createAbsoluteUrl('site/listingdetail', array('slug' => $data->slug)); ?>"></div>
				</div>
			</div><!-- image -->

			<div class="col-md-8">
			<div class="description">
				<h3>
					<a href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail',array('slug'=>$data->slug));?>">
						<?php echo Listing::FormatNameListingIndexGrid($data, array('not_type'=>1)); ?>
					</a>
				</h3>
				<p><?php echo $data->rPropertyType ? $data->rPropertyType->name : '';?></p>
				<p><?php echo Listing::FormatShowBuildingOrStreet($data);?></p>
				<p>Marketed by 
					<a href="<?= $this->createUrl('/agent/view', array('slug'=>$user->slug)) ?>"><?= $user->name_for_slug ?></a> - 
					<strong>Call 
					<?php $this->widget('ShortTextWidget', array(
						'text' => $phone,
						'urlOnCLick' => $this->createUrl('/agent/fieldClick', array('id'=>$user->id, 'field'=>'phone'))
					)) ?></strong>
				</p>
				<p class="type"><?php echo Listing::FormatListedDate($data);?></p>
				<p class="price">S$<?php echo $f->formatPrice($data->price); ?></p>
				<?php
					if($data->property_type_2 ==42){//property type land
						 $sqft = MyFunctionCustom::convertData($data->land_area,'sqm');
						 $sqftcontent = "$sqft sqft";
					 }else{
						$sqft = $data->floor_area;
						$sqm = $data->floor_area;
						if($data->floor_area_unit == Listing::FLOOR_UNIT_SQM){
							$sqft  = MyFunctionCustom::convertData($data->floor_area,'sqm');
						}
						if($data->floor_area_unit == Listing::FLOOR_UNIT_SQFT){
							$sqm   = MyFunctionCustom::convertData($data->floor_area,'sqft');
						}
						$sqftcontent =  "$sqft sqft / $sqm sqm (built-up) ";                           
					 }
				?>
				<p><?php echo $sqftcontent;?></p>
				<div class="ico-group clearfix">
					<?php echo $data->showiconBedroomBathroom($data); ?>
					<p class="info"><?php echo ProMasterFurnished::getInforFurnishedBYId($data->furnished);?></p>
				</div>
			</div><!-- description -->
			</div><!-- col-md-8 -->
		</div>
	</div><!-- prop-item-2 -->
</div>
	
<?php if($index%2!=0 || ($index==($widget->dataProvider->itemCount-1))): ?>
</div>
<?php endif;?>