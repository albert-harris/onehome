<?php $cmsFormater = new CmsFormatter();?>
<div class="item" style="width: 350px !important;">
    <div class="image">
        <?php 
           $mDefaultPhoto = Listing::getDefaultImgListing($data->id);
           $linkImage = ImageProcessing::bindImageByModel($mDefaultPhoto, '120', '96');
       ?>       
        <div class="img-box"><img src="<?php echo $linkImage ?>" alt="image" /></div>
        <p><a class="ico-check" href="#">Select to Enquire</a></p>
        <p><a class="ico-star" href="#">Shortlist</a></p>
    </div>
    <div class="description">
        <h3>
            <a href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail',array('slug'=>$data->slug));?>">
                <?php echo $data->property_name_or_address; ?>
            </a>
        </h3>
        <p><?php echo $data->rPropertyType?$data->rPropertyType->name:'';?></p>
        <p class="type">Re-listed on <?php echo MyFormat::dateConverYmdToDmy($data->date_listed, MyFormat::$sDateIndexListing); ?></p>
        <p class="price">S$<?php echo $cmsFormater->formatPrice($data->price); ?></p>
        <p><?php echo $cmsFormater->formatPrice($data->office_bkank_valuation); ?></p>
        <p><?php echo $data->floor_area;?> sqft</p>
        <div class="ico-group clearfix">
            <p class="btn-4"><span class="ico-bed"><?php echo $data->of_bedroom;?></span></p>
            <p class="btn-4"><span class="ico-shower"><?php echo $data->of_bathrooms;?></span></p>
            <p class="info" style="max-width: 65px;"><?php echo ProMasterFurnished::getInforFurnishedBYId($data->furnished);?></p>
        </div>
    </div>
</div>