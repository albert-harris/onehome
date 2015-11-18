<?php
// add this button
Yii::app()->clientScript->registerScriptFile(
	"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56133df5326f44f0", 
	CClientScript::POS_END, array('async'=>'async')
);

$this->breadcrumbs = array(
	$model->rPropertyType->name,
	CmsFormatter::getListingNameDetail($model)
);

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
?>
<div class="listing-detail">
    <div class="intro">
        <div class="clearfix">
            <h1 class="pull-left"><?php echo CmsFormatter::getListingNameDetail($model); ?></h1>
            
            <?php
            // shortlist button
            $ad_nb_scenario = Listing::getScenarioOfListing($model);
            $urlReturn = "http://" . $_SERVER['HTTP_HOST'] . Yii::app()->request->requestUri;
            $link = Yii::app()->createAbsoluteUrl('site/login', array('returnUrl' => $urlReturn));
            if (!(isset(Yii::app()->user->role_id)) || (Yii::app()->user->role_id == ROLE_REGISTER_MEMBER)):
                ?>
                <a next="<?php echo $link ?>" data-listing-id="<?php echo $model->id; ?>" href="javascript:void(0);" class="btn-5 shortlist"><span class="ico-star">Shortlist</span></a>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <?php
                if ($model->property_type_2 ==42){//property type land
                     $sqft = MyFunctionCustom::convertData($model->land_area,'sqm');
                     $sqftcontent = (($sqft !=0 && $sqft !='')) ?   "$sqft sqft" : '';
                 }else{
                    $sqft = $model->floor_area;
                    $sqm = $model->floor_area;
                    if ($model->floor_area_unit == Listing::FLOOR_UNIT_SQM){
                        $sqft  = MyFunctionCustom::convertData($model->floor_area,'sqm');
                    }
                    if ($model->floor_area_unit == Listing::FLOOR_UNIT_SQFT){
                        $sqm   = MyFunctionCustom::convertData($model->floor_area,'sqft');
                    }

                    $tmp = array();
                    if ($sqft !=0 && $sqft !='')  $tmp[] = "$sqft sqft";
                    if ($sqm  !=0 && $sqm !='')  $tmp[] = "$sqm sqm (built-up)";
                    $sqftcontent =   implode(' / ', $tmp);      
                 }
                $sqf = $model->search_psf;
                ?>
    
                <div class="primary-info">
                    <p><span class="price">S$ <?php echo Yii::app()->format->formatPrice($model->price); ?></span> 
                        <?php if ( $model->asking_price_select ): ?>
                            <?php 
                                $text_price = "(".Listing::$ARR_PRICE_SELECT[$model->asking_price_select].")";
                                if ( $model->asking_price_select == Listing::NB_PRICE_OTHER ){
                                    $text_price = "(".trim($model->asking_price_select_other).")";
                                }
                            ?>
                            <span class="type ">
                                <?php echo $text_price;?>
                            </span>
                        <?php endif;?>
                    </p>
                    <p><?php echo "$sqf psf (built-up)"; ?></p>
                    <p><?php echo Listing::showSqft($sqftcontent,Listing::GetFormatLandArea($model)) ?></p>
                    <?php $addressTitle = Listing::GetAddressReal($model); ?>
                    <p><?php echo $addressTitle ;?>, Singapore <?php echo $model->postal_code; ?></p>
                </div>
            </div>

            <div class="col-sm-6">
                <p><?php echo Listing::getViewDetailPropertyType($model); ?> 
                    <span class="type"> <?php echo Listing::getViewDetailTenure($model); ?></span> 
                </p>
                <div class="ico-group clearfix">
                    <?php echo $model->showiconBedroomBathroom($model); ?>
                    <div class="hdb-town"><?php echo $model->hdb_town_estate ?></div>
                </div>
                <p class="type"><?php echo Listing::FormatListedDate($model);?></p>
				
				<p>&nbsp;<i class="fa fa-eye fa-lg"></i>&nbsp;&nbsp;
					<?= (int)$model->view_count ?> views</p>
				
				<div class="addthis_native_toolbox" data-title="<?php echo CmsFormatter::getListingNameDetail($model); ?>"
					 accesskey=""data-url="<?= $this->createAbsoluteUrl('site/listingdetail', array('slug' => $model->slug)); ?>"></div>				
            </div>
        </div>
    </div>
    
	<div class="green-tab">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li <?php if (!isset($_GET['m'])) echo 'class="active"'; ?> >
                <a href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $model->slug)) ?>">Listing Details
                </a>
            </li>
            <li <?php if (isset($_GET['m'])) echo 'class="active"'; ?> >
                <a href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $model->slug, 'm' => 'map','type' => 'location')) ?>">
                    Listing Map
                </a>
            </li>
        </ul>
		
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active">
				<?php
				$titleAressMap = ($model->display_title !='') ? $model->display_title : Listing::GetAddressReal($model); // ANH DUNG FIX Listing::GetAddressReal($model) Mar 10, 2015
				$this->widget('MapWidget', array(
					'json_map' => $model->json_map, 
					'postal_code' => $model->postal_code_xy, 
					'title' =>  $titleAressMap.", Singapore $model->postal_code", 
					'sizeMap' => 'big_map',
					'model'=>$model,
					'fullScreen'=>'menu'
				)); ?>
            </div>
        </div><!-- tab-content -->
    </div><!-- green-tab -->
</div><!-- listing-detail -->