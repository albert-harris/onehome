<?php
/*
 * DTOAN
 * Email : toan.pd@verzdesign.com.sg
 */
?>

<div id="Listing-releated" class="clearfix">
    
 <?php
        $widget = $this->widget('zii.widgets.CListView', array(
           'dataProvider' => $arrOrther['photo'],
            'emptyText'=>'<div style="margin-left:15px;">No results found.<div>', 
           'id' => 'manager_photo',
           'itemView' => 'step/_photo_item',
           //                   'pagerCssClass'=>'pager_appoitment',
           'template' => '{items} {pager}',
           'ajaxUpdate' => true,
           'ajaxUrl'=> Yii::app()->request->getUrl(),
           'enablePagination' => true,
       ));

 ?>   
    
    
    
    
    
    <?php if($model):  foreach ($model as $listing) : ?>
        <div class="item-releated">
            <div class="img">
             <?php
                $imgDefautl =Listing::getDefaultImgListing($listing->id, 'image');
                echo CHtml::image(Yii::app()->createAbsoluteUrl('upload/listing/'.$listing->id."/120x96/$imgDefautl"));
            ?>              
            </div>
           <div class="clear"></div>
           <input type="checkbox" name="releated[<?php echo $listing->id ?>]" value="<?php echo $listing->id ?>" <?php echo (isset($dataJson[$listing->id])) ? 'checked' : ''; ?> />
           Tick to display
        </div>             
    <?php endforeach;  endif;?>
</div>

<style>
    #Listing-releated {min-height: 150px;clear:both;}
    #Listing-releated .item-releated { float:left;width:127px;min-height: 96px;margin-right:15px;}
    #Listing-releated .item-releated .img  {height: 96px;width:120px;text-align: center;}
    #Listing-releated .item-releated  input {float:left;}
</style>