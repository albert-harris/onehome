<?php if($index%2==0): ?>
<div class="grid">
<?php endif;?>
    <?php $cmsFormater = new CmsFormatter();
        $mDefaultPhoto = Listing::getDefaultImgListing($data->id);
        $linkImage = ImageProcessing::bindImageByModel($mDefaultPhoto, '120', '96');
    ?>
    <div class="item">
        <div class="image">
            <div class="img-box"><img src="<?php echo $linkImage;?>" alt="image" /></div>
            <!--<p><a href="#" class="ico-check">Select to Enquire</a></p>-->
            <?php
                $urlReturn =  "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->requestUri;
                $link = Yii::app()->createAbsoluteUrl('site/login', array('returnUrl'=>$urlReturn));
                if(!(isset(Yii::app()->user->role_id)) || (Yii::app()->user->role_id == ROLE_REGISTER_MEMBER)): 
            ?>
            <p><a next="<?php echo $link ?>" href="javascript:void(0);" data-listing-id="<?php echo $data->id; ?>" class="ico-star shortlist">Shortlist</a></p>
            <?php endif; ?>
        </div>
        <div class="description">
            <h3><a href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail',array('slug'=>$data->slug));?>">
                    <?php echo Listing::FormatNameListingIndexGrid($data, array('not_type'=>1)); ?>
                </a>
            </h3>
            <p><?php echo $data->rPropertyType?$data->rPropertyType->name:'';?></p>
            <?php echo Listing::FormatShowBuildingOrStreet($data);?>
            <p><?php echo Listing::FormatSaleperson($data);?></p>
            <!--<p>376 Thomson Road</p>-->
            <p class="type"><?php echo Listing::FormatListedDate($data);?></p>
            <p class="price">S$<?php echo $cmsFormater->formatPrice($data->price); ?></p>
            <!--<p><?php // echo $cmsFormater->formatPrice($data->office_bkank_valuation); ?></p>-->
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
//                    $sqft  = MyFunctionCustom::convertData($data->floor_area,'sqm'); // ANH DUNG CLOSE SEP 18, 2014
//                    $sqm   = MyFunctionCustom::convertData($data->floor_area,'sqft');     
//                    $sqftcontent =  "$sqft sqft / $sqm sqm (built-up) ";              
                 }
                 
//                $sqf =MyFunctionCustom::convertData($data->price,'sqf',$sqft);// ANH DUNG CLOSE SEP 18, 2014
            ?>
            <p><?php echo $sqftcontent;?></p>
            <div class="ico-group clearfix">
                <p class="btn-4"><span class="ico-bed"><?php echo $data->of_bedroom;?></span></p>
                <p class="btn-4"><span class="ico-shower"><?php echo $data->of_bathrooms;?></span></p>
                <p class="info"><?php echo ProMasterFurnished::getInforFurnishedBYId($data->furnished);?></p>
            </div>
        </div>
    </div>
<?php if($index%2!=0 || ($index==($dataProvider->itemCount-1))): ?>
</div>
<?php endif;?>