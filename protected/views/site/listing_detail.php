<?php
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->theme->baseUrl.'/js/jcarousel.js');
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->theme->baseUrl.'/js/fancybox.js');
// add this button
Yii::app()->clientScript->registerScriptFile(
	"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56133df5326f44f0", 
	CClientScript::POS_END, array('async'=>'async')
);
Yii::app()->clientScript->registerScript('property-gallery', 'setupPropertyPhotoGallery();');
Yii::app()->clientScript->registerScript('fullscreen-fancybox', "
	$('.Fullscreen').click(function() {
		var photos = new Array();
		$('.fancybox').each(function() {
		   var href = $(this).attr('custom');
		   var title = $(this).attr('title');
			photos.push({'href': href, 'title': title});
		});
		$.fancybox(photos,
			{'transitionIn': 'elastic',
				'easingIn': 'easeOutBack',
				'transitionOut': 'elastic',
				'easingOut': 'easeInBack',
				'opacity': false,
				'titleShow': true,
				'titlePosition': 'over',
				'type': 'image',
				'titleFromAlt': true
			}
		);
	});
");

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
                    <p>
						<span class="price">S$ <?php echo Yii::app()->format->formatPrice($model->price); ?></span> 
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
                <div class="row">
                    <div class="col-md-9">
                        <!-- photo and video -->
                        <div class="box-3">
                            <h2 class="title-2">Photos &amp; Videos</h2>
                            <div class="clearfix">
                                <p class="btn-6 pull-left">
                                    <?php
                                        $photoList = ProListingPhotos::getPhotoByListing($model->id);
                                        if (count($photoList) <= 1) echo count($photoList) . ' Photo';
                                        else echo count($photoList) . ' Photos';
                                    ?>
                                </p>
                                <p class="pull-right">
                                    <a href="javascript:;"><strong class="Fullscreen">Fullscreen</strong></a>
                                </p>
                            </div>

                            <?php if (empty($photoList)): ?>
							<p><img src="<?= Yii::app()->theme->baseUrl ?>/img/advertise.jpg" class="img-responsive" alt=""></p>
							<?php else: ?>
							<div class="jcarousel-wrapper photo-gallery">
                                <div class="jcarousel">
                                    <ul id="mycarousel">
                                    <?php foreach ($photoList as $key => $item): if ($key==0) $img = $item->getImageUrl(633, 390, true); ?>
                                        <li>
                                            <a class="fancybox thumb" rel="gallery1" custom="<?= InputHelper::holderUrl($item->getImageUrl(1024, 768, true), 1024, 768) ?>" href="<?= InputHelper::holderUrl($item->getImageUrl(633, 390, true), 633, 390) ?>" >
                                                <?= InputHelper::holderImage($item->getImageUrl(77, 47, true), 77, 47) ?>
                                            </a>
                                        </li> 
                                    <?php endforeach; ?>
                                    </ul>
                                </div>

                                <a href="#" class="jcarousel-control-prev">&nbsp;</a>
                                <a href="#" class="jcarousel-control-next">&nbsp;</a>
                            </div>

                            <div class="big-photo">
                                <?php echo CHtml::image(InputHelper::holderUrl($img, 633, 390), '', array('id' => 'img_main', 'class'=>'img-responsive')); ?>
                            </div>
							<?php endif ?>
                        </div><!-- box-3 -->

                        <!-- property info -->
                        <div class="box-3">
                            <h2 class="title-2">Property Info</h2>
                            <div class="property-info">
                                <div class="ico-bg">
                                    <h3>Description</h3>
                                    <?php echo $model->listing_description; ?>
                                </div>

                                <div class="ico-bg">
                                    <h3>Details</h3>
                                    <div class="row info-list">
                                        <div class="col-sm-6">
                                            <ul class="list-unstyled">
                                                <li><span>Property Name:</span><strong><?php echo $model->property_name_or_address; ?></strong></li>
                                                <li><span>Property Type:</span><strong><?php echo Listing::getViewDetailPropertyType($model); ?></strong></li>
                                                <li><span>Price:</span><strong><?php echo Listing::getViewDetailPrice($model); ?></strong></li>
                                                <?php if (Listing::CanView($model, $ad_nb_scenario, 'office_bkank_valuation') 
                                                        && $model->office_bkank_valuation>0 
                                                        && $model->listing_type == Listing::FOR_RENT 
                                                        ): 
                                                ?>
                                                    <li><span>Official / Bank Valuation:</span><strong><?php echo Listing::getViewDetailOfficialBank($model); ?></strong></li>
                                                <?php endif;?>
                                                
                                                <?php if (Listing::CanView($model, $ad_nb_scenario, 'hdb_town_estate')): ?>
                                                    <li><span>HDB Town/Estate:</span><strong><?php echo Listing::getViewDetailHdbtow($model); ?></strong></li>
                                                <?php endif;?>
                                                <?php if (Listing::CanView($model, $ad_nb_scenario, 'of_bedroom')): ?>
                                                    <li><span># of Bedrooms:</span> <strong><?php echo Listing::getViewDetailBedRoom($model); ?> </strong></li>
                                                <?php endif;?>
                                                <?php if (Listing::CanView($model, $ad_nb_scenario, 'floor_area')): ?>
                                                    <li><span>Floor Area:</span> <strong><?php echo Listing::getViewDetailFloorArea($model); ?> </strong></li>
                                                <?php endif;?>
                                                <?php if (Listing::CanView($model, $ad_nb_scenario, 'land_area')): ?>
                                                    <li><span>Land Area:</span> <strong><?php echo Listing::getViewDetailLandArea($model); ?> </strong></li>
                                                <?php endif;?>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="list-unstyled">
                                                <li><span><?php echo $model->getAttributeLabel('furnished');?>:</span><strong><?php echo $model->rFurnished?$model->rFurnished->name:''; ?></strong></li>
                                                <li><span>Developer:</span><strong><?php echo $model->developer; ?></strong></li>
                                                <li><span>Tenure:</span> <strong><?php echo Listing::getViewDetailTenure($model);?></strong></li>
                                                <?php if ($model->listing_type==Listing::FOR_RENT): ?>
                                                
                                                    <?php if ($model->rLeaseTerm): ?>
                                                        <li><span>Lease Term:</span><strong><?php echo $model->rLeaseTerm->name; ?></strong></li>
                                                    <?php endif;?>
                                                <?php endif;?>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- ico-bg -->

                                <?php
                                $model->special_feature_json = json_decode($model->special_feature_json);
                                $model->fixtures_fittings_json = json_decode($model->fixtures_fittings_json);
                                $model->outdoor_indoor_space_json = json_decode($model->outdoor_indoor_space_json);
                                $model->furnishing_included_json = json_decode($model->furnishing_included_json);
                                $special_feature_json = ProMasterSpecialFeatures::getListOption($model->special_feature_json);
                                $fixtures_fittings_json = ProMasterFixturesFittings::getListOption($model->fixtures_fittings_json);
                                
                                $aOutdoorIndoor = MyFormat::getListOption($model->outdoor_indoor_space_json, 'ProMasterOutdoorIndoorSpace');
                                $aFurnishingIncluded = MyFormat::getListOption($model->furnishing_included_json, 'ProMasterFurnishingIncluded');
                                ?>
                                
                                <?php if (count($special_feature_json)): ?>
                                <div class="ico-bg">
                                    <h3><?php echo $model->getAttributeLabel('special_feature_json');?></h3>
                                    <div class="info-list">
                                        <ul class="list-unstyled">
                                        <?php foreach($special_feature_json as $item): ?>
                                            <li><?php echo $item;?></li>
                                        <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif;?>
                                
                                <?php if (count($fixtures_fittings_json)): ?>
                                <div class="ico-bg">
                                    <h3><?php echo $model->getAttributeLabel('fixtures_fittings_json');?></h3>
                                    <div class="info-list">
                                        <ul class="list-unstyled">
                                        <?php foreach($fixtures_fittings_json as $item): ?>
                                            <li><?php echo $item;?></li>
                                        <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif;?>
                                
                                
                                <?php if (count($aOutdoorIndoor)): ?>
                                <div class="ico-bg">
                                    <h3><?php echo $model->getAttributeLabel('outdoor_indoor_space_json');?></h3>
                                    <div class="info-list">
                                        <ul class="list-unstyled">
                                        <?php foreach($aOutdoorIndoor as $item): ?>
                                            <li><?php echo $item;?></li>
                                        <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif;?>
                                
                                <?php if (count($aFurnishingIncluded)): ?>
                                <div class="ico-bg">
                                    <h3><?php echo $model->getAttributeLabel('furnishing_included_json');?></h3>
                                    <div class="info-list">
                                        <ul class="list-unstyled">
                                        <?php foreach($aFurnishingIncluded as $item): ?>
                                            <li><?php echo $item;?></li>
                                        <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif;?>
                            </div><!-- property info -->

                            <ul class="links-list list-unstyled">
                                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/addressListing', array('slug' => $model->slug)); ?>">
                                    View Other Listings In <?php echo $model->property_name_or_address; ?>&nbsp;<i class="fa fa-chevron-right"></i>
                                </a></li>
                            </ul>
                        </div><!-- box-3 -->


                        <?php $this->widget('EnquiryProperty', array(
                            'property_id' => $model->id, 
                            'position' => 'bottom',
                            'agent_id'=>$model->user_id
                        )); ?>
                    </div><!-- col-md-9 -->

                    <div class="col-md-3">
                        <?php $this->widget('EnquiryProperty', array(
                            'property_id' => $model->id, 
                            'position' => 'right',
                            'agent_id'=>$model->user_id
                        )); ?>

                        <!-- Map-->
                        <?php 
                        $titleAressMap = ($model->display_title !='') ? $model->display_title : Listing::GetAddressReal($model); // ANH DUNG FIX Listing::GetAddressReal($model) Mar 10, 2015
                        $this->widget('MapWidget', array('json_map' => $model->json_map, 'postal_code' => $model->postal_code_xy, 'title' =>$titleAressMap. ", Singapore $model->postal_code", 'model' => $model,'fullScreen'=>'menu')); 
                        ?>
                        <!-- End Map-->                        
                    </div><!-- col-md-3 -->
                </div>
            </div>
        </div><!-- tab-content -->
    </div><!-- green-tab -->
</div><!-- listing-detail -->