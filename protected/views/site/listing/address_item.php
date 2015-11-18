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
            <p><a href="#" class="ico-check">Select to Enquire</a></p>
            <p><a href="javascript:void(0);" data-listing-id="<?php echo $data->id; ?>" class="ico-star shortlist">Shortlist</a></p>
        </div>
        <div class="description">
            <h3><a href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail',array('slug'=>$data->slug));?>">
                    <?php echo $data->property_name_or_address; ?>
                </a>
            </h3>
            <p><?php echo $data->rPropertyType?$data->rPropertyType->name:'';?></p>
            <!--<p>376 Thomson Road</p>-->
            <p class="type">Listed on <?php echo MyFormat::dateConverYmdToDmy($data->date_listed, MyFormat::$sDateIndexListing); ?></p>
            <p class="price"><?php echo $cmsFormater->formatPrice($data->price); ?></p>
            <p><?php echo $cmsFormater->formatPrice($data->office_bkank_valuation); ?></p>
            <p><?php echo $data->floor_area;?> sqft</p>
            <div class="ico-group clearfix">
                <p class="btn-4"><span class="ico-bed"><?php echo $data->rBedroom?$data->rBedroom->value:'';?></span></p>
                <p class="btn-4"><span class="ico-shower"><?php echo $data->rBathroom?$data->rBathroom->value:'';?></span></p>
                <p class="info">Partially Furnished</p>
            </div>
        </div>
    </div>
<?php if($index%2!=0 || ($index==($dataProvider->itemCount-1))): ?>
</div>
<?php endif;?>

