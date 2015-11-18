<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com
 */
?>
<?php $ad_nb_scenario = Listing::getScenarioOfListing($model);?>
<div class="main-inner-2 T_custom_Step_2">

    <div class="box-1 space-3">
        <div class="title"><h3>Confirmations</h3></div>
        
        <div class="content space-5 tempt"> 
            <div class="row clearfix">
                <div class="lb-1">Current Status :</div> <?php echo Yii::app()->format->CurrentStatusListing($model->status_listing); ?> 
            </div>
            <div class="row clearfix">
                <div class="lb-1">Listing Type :</div> <?php echo  Listing::getListType($model->listing_type); ?> 
            </div>
            <div class="row clearfix">
                <div class="lb-1">Property Type :</div><?php echo Listing::getViewDetailPropertyType($model);?>
            </div>
            <div class="row clearfix">
                <div class="lb-1">Property Name :</div> <?php echo ($model->display_title !='' ) ? $model->display_title :  $model->property_name_or_address ?> 
            </div>
            <div class="row clearfix">
                <div class="lb-1">Address :</div><?php echo ($model->display_address !='' ) ? $model->display_address :  $model->property_name_or_address ?>  
            </div>
            <div class="row clearfix">
                <div class="lb-1">Postal Code  :</div> <?php echo $model->postal_code ?> 
            </div>
            
            <?php if(Listing::CanView($model, $ad_nb_scenario, 'floor_area')): ?>
            <div class="row clearfix">
                <div class="lb-1">Floor Area :</div> <?php echo Listing::getViewDetailFloorArea($model);?>
            </div>
            <?php endif;?>
            
            <?php if($model->status_listing==STATUS_LISTING_ACTIVE): ?>
            <div class="row clearfix">
                <div class="lb-1">Date Listed :</div> <?php echo date('M d,Y',  strtotime($model->date_listed)) ?> 
            </div>
            <?php endif; ?>
            <div class="row clearfix">
                <div class="lb-1">Price :</div> S$ <?php echo Listing::getViewDetailPrice($model); ?>
            </div>

        </div>
    </div>  


    <div class="box-1 space-3">
        <div class="title"><h3>Activate Listing options</h3></div>
        <div class="form-type content"> 
            <p style="color:red;"><i>Note: This listing is not yet active - please click 'Activate' to publish it. Or click 'Save as Draft' if you want to activate it later.</i></p>
            <p>Before you can activate your listing, you must comply with CEA advertising regulations:</p>
            <div class="ad_nb_chkbox">
                <?php echo $form->checkboxList($model, 'activate_listing_options',  Listing::activeLisingOptions(), array('empty' => 'Select')); ?>
            </div>
            <div class='clearfix'></div>
            <?php echo $form->error($model,'activate_listing_options'); ?>
        </div>
         
    </div>

    <div class="box-1 space-3">
         <div class="title"><h3>Preview</h3></div>
        <div class="form-type content"> 
            <div style="float:left;">
                   <?php
                      if(isset($arrOrther['imageDefault']) && $arrOrther['imageDefault'] !='' ):
                            echo CHtml::image(Yii::app()->createAbsoluteUrl('upload/listing/'.$model->id."/120x96/".$arrOrther['imageDefault']),  strip_tags($model->property_name_or_address));
                       endif;
                   ?> 
            </div>
            <!--<div style="float:right;margin-left:20px;">-->
            <div style="float:right;">
                <h4 style="color:#34739B !important;font-weight: bold;font-size: 16px !important;"><?php echo strip_tags($model->property_name_or_address) ?></h4>
                            <div style="float:left; width: 400px;">
                                    <ul class="list-2">
                                        <li class="first"><?php echo Listing::getViewDetailPropertyType($model);?></li>
                                        <li><?php echo ($model->display_title !="") ? $model->display_title : $model->property_name_or_address ?> </li>
                                        <li>Marketed by <?php if(isset($model->user->first_name)) echo $model->user->first_name ?>
                                            <?php if(isset($model->user->phone)) echo "- Call : " .$model->user->phone; ?>
                                        </li>
                                       <li class="last">Listed on <?php  if($model->status_listing==STATUS_LISTING_ACTIVE) : echo date('M d,Y',  strtotime($model->date_listed));  endif; ?></li>
                                    </ul>               
                            </div>
                            <div style="float:right; width: 400px;">
                                    <ul class="list-2">
                                        <li class="first" style="color:#E2BE3F;font-weight: bold;"><?php echo "S$".Yii::app()->format->Price($model->price);  ?></li>
                                        <li><?php echo ActiveRecord::getInfoRecord('ProMasterFloor', $model->floor_area,'name');?></li>
                                        <li>
                                            <?php 
                                                if(!empty($model->of_bedroom))
                                                    echo '<span class="ico-bed">'.$model->of_bedroom.'</span> ';
                                                if(!empty($model->of_bathrooms))
                                                    echo '<span class="ico-shower">'.$model->of_bathrooms.'</span> ';
                                            ?>
                                        </li>
                                        <li class="last"><a target='_blank' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail',array('slug'=>$model->slug, 'draft'=>1)) ?>">View detail</a></li>
                                    </ul>
                            </div>
            </div>
            <div class='clearfix'></div>
        </div>
    </div>
    

    <div class="box-1 space-3">
        <div class="title"><h3>Remarks / Notes for your personal use</h3></div>
        <div class="form-type content"> 
                <?php echo $form->textArea($model,'remark',array('style'=>'width:700px;height:150px;max-height:150px;')) ?>
                <?php echo $form->error($model,'remark'); ?>
        </div>
    </div>
    
    


    <div class="w-2 clearfix T_step_1_custom_btn" style="margin-left:10px;">
        <input type ='button' onclick="window.location.href='<?php echo Yii::app()->createAbsoluteUrl('member/listing/managephotos',array('id'=>$model->id)) ?>'" name="back" class='btn-3' value="Back" />&nbsp;&nbsp;&nbsp;
        <input type ='submit' name="save_exit" class='btn-3' value="Save as Draft" />&nbsp;&nbsp;&nbsp;
        <input type ='submit' name="next"  class='btn-3' value="Submit" />
    </div>    

</div>