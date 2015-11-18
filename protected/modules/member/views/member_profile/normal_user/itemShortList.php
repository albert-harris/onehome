<?php $cmsFormater = new CmsFormatter();?>
<?php if($index%2==0): ?>
<div class="grid">
<?php endif;?>
    <div class="item">
        <div style="margin-bottom: 7px">
            <span style="margin-right: 5px">Select to Enquire </span>
            <input type="checkbox" class="cke_short_list" value="<?php echo $data->id;?>" name="chkList[]">
        </div>
        
            <div class="image">
                <?php 
                    $mDefaultPhoto = Listing::getDefaultImgListing($data->id);
                    $linkImage = ImageProcessing::bindImageByModel($mDefaultPhoto, '120', '96');
                ?>
                <div class="img-box"><img src="<?php echo $linkImage ?>" alt="image" /></div>
                <a data-listing-id="<?php echo $data->id; ?>" href="javascript: void(0);" class="delete_shortlist ico-check">Remove</a>
            </div>

            <h3><a href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail',array('slug'=>$data->slug));?>">
                    <?php echo $data->property_name_or_address; ?>
                </a>
            </h3>
            <p><?php echo $data->rPropertyType?$data->rPropertyType->name:'';?></p>
            <p class="type">Re-listed on <?php echo MyFormat::dateConverYmdToDmy($data->date_listed, MyFormat::$sDateIndexListing); ?></p>
            <p class="price">S$<?php echo $cmsFormater->formatPrice($data->price); ?></p>
            <!-- <p><?php /*echo $cmsFormater->formatPrice($data->office_bkank_valuation);*/ ?></p> -->
            <?php
                if($data->property_type_2 ==42){//property type land
                     $sqft = MyFunctionCustom::convertData($data->land_area,'sqm');
                     $sqftcontent = "$sqft sqft";
                 }else{
                    $sqft  = MyFunctionCustom::convertData($data->floor_area,'sqm');
                    $sqm   = MyFunctionCustom::convertData($data->floor_area,'sqft');     
                    $sqftcontent =  "$sqft sqft / $sqm sqm (built-up) ";              
                 }    
                $sqf =MyFunctionCustom::convertData($data->price,'sqf',$sqft);
            ?>
            
            <p><?php echo $sqftcontent; ?></p>
            <p><?php echo "$sqf psf (built-up)"; ?></p>

            <div class="ico-group clearfix">
                <p class="btn-4"><span class="ico-bed"><?php echo $data->of_bedroom;?></span></p>
                <p class="btn-4"><span class="ico-shower"><?php echo $data->of_bathrooms;?></span></p>
                <p class="info"><?php echo ProMasterFurnished::getInforFurnishedBYId($data->furnished);?></p>
            </div>
        </div>
<?php if($index%2!=0 || ($index==($dataProvider->itemCount-1))): ?>
</div>
<?php endif;?>
<style>
    div.checker {
        float: none;
        position: relative;
    }
    
    .grid .image {
        width: 140px;
    }
</style>