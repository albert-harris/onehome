<?php 
$display_none_s2 = 'display_none';
$display_none_s3 = 'display_none';
if($model->listing_type==Listing::FOR_RENT){
    $display_none_s2 = '';
    $display_none_s3 = '';
}
// ANH DUNG MAR 13, 2015
$TypeFurnished = ProMasterFurnished::TYPE_NORMAL;
if(in_array($model->property_type_2, ProPropertyType::$ARR_TYPE_COMMERCIAL) ){
    $TypeFurnished = ProMasterFurnished::TYPE_INDUSTRIAL;
}
$aOptionFurnished = ProMasterFurnished::getListOption( $TypeFurnished );
// ANH DUNG MAR 13, 2015
?>
<!--<div class="main-inner-2 T_custom_Step_2">-->
    <div class="box-1 space-3">
        <div class="title"><h3>Details information</h3></div>
        <div class="form-type content"> 
            <div class="in-row clearfix">
                <div class="col-1">
                    <div class="in-row clearfix">
                         <?php echo $form->labelEx($model,'listing_description',array('class'=>'lb')); ?>
                        <div class="group-4">
                        <?php
                              $this->widget('ext.niceditor.nicEditorWidget',array(
                                           "model"=>$model,                
                                           "attribute"=>'listing_description',          
                                           "defaultValue"=>'',
                                           "config"=>array(
                                                  "maxHeight"=>"200px",
                                                  "buttonList"=>Yii::app()->params['niceditor_v_2'],
                                               ),
                                           "width"=>"700px",					
                                           "height"=>"200px",					
                                   ));                        
                          ?>
                            <?php echo $form->error($model,'listing_description'); ?>
                        </div>
                    </div>
                    <br/>
                    <div class="display_none in-row clearfix <?php echo $display_none_s3; ?>">
                        <?php echo $form->labelEx($model,'vacant_position',array('class'=>'lb')); ?>
                        <div class="group-4">
                               <?php echo $form->textField($model, 'vacant_position', array('class' => 'text',)); ?>
                              <?php echo $form->error($model,'vacant_position'); ?>
                        </div>
                    </div>
                    <div class="display_none in-row clearfix <?php echo $display_none_s3; ?>">
                        <?php echo $form->labelEx($model,'flexible',array('class'=>'lb')); ?>
                        <div class="group-4">
                               <?php echo $form->dropDownlist($model,'flexible', CmsFormatter::$yesNoFormat,array('empty'=>'Select','class'=>'text'));?>
                              <?php echo $form->error($model,'flexible'); ?>
                        </div>
                    </div>
                    
                    <div class="in-row clearfix <?php echo $display_none_s2; ?>">
                        <?php echo $form->labelEx($model,'furnished',array('class'=>'lb')); ?>
                        <div class="group-4" style="width:100%;">
                            <ul class="list-check-3 clearfix" style="width:100%;margin-left: 170px;margin-top:-20px;">
                                <?php echo $form->radioButtonlist($model,'furnished', $aOptionFurnished,
                                                                array(
//                                                                      'class'=>'text',
                                                                      'separator'=>'',
                                                                      'template'=>' <li >{input}{label}</li>',
//                                                                      'template'=>'{input}{label}',
                                                                     )
                                   );?>                           
                            </ul>
                             <?php echo $form->error($model,'furnished',array('style'=>'margin-left:170px;')); ?>
                        </div>
                    </div>
                    
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'floor',array('class'=>'lb')); ?>
                        <div class="group-4">
                               <?php echo $form->dropDownlist($model,'floor', Listing::getDropdownlistWithTableName('ProMasterFloorType','id','name'),array('empty'=>'Select','class'=>'text'));?>
                              <?php echo $form->error($model,'floor'); ?>
                        </div>
                    </div>
                    
                    <div class="in-row clearfix <?php echo $display_none_s2; ?>">
                        <?php echo $form->labelEx($model,'lease_term',array('class'=>'lb')); ?>
                        <div class="group-4">
                               <?php echo $form->dropDownlist($model,'lease_term',Listing::getDropdownlistWithTableName('ProMasterLeaseTerm','id','name'),array('empty'=>'Select','class'=>'text'));?>
                             <?php echo $form->error($model,'lease_term'); ?>
                        </div>
                    </div>
                    
                    <div class="in-row clearfix display_none">
                        <?php echo $form->labelEx($model,'of_bathrooms',array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php // echo $form->dropDownlist($model,'of_bathrooms', Listing::getDropdownlistWithTableName('ProMasterLeaseTerm','id','name'),array('empty'=>'Select','class'=>'text'));?>
                            <?php // ANH DUNG CLOSE Aug 12, 2014 echo $form->textField($model,'of_bathrooms',array('class'=>'text','style'=>'height:25px;'));?> 
                            <?php echo $form->error($model,'of_bathrooms'); ?>
                        </div>
                    </div>
                    
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'special_feature_json',array('class'=>'lb')); ?>
                        <div class="group-4 T_row_checkbox_step2">
                            <div>
                                <?php echo $form->checkboxList($model,'special_feature_json', ProMasterSpecialFeatures::getDropdownList(),
                                                        array(
//                                                                'class'=>'text',
                                                                 'separator'=>'',
                                                                'template'=>'<div class="T_checkbox_list_step2">{input}{label}</div>',
                                                            )
                               );?>                              
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <?php echo $form->error($model,'special_feature_json',array('class'=>'class-error')); ?>
                    </div>
                    
                    
                    
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'fixtures_fittings_json',array('class'=>'lb')); ?>
                        <div class="group-4 T_row_checkbox_step2">
                            <div>
                                <?php echo $form->checkboxList($model,'fixtures_fittings_json', ProMasterFixturesFittings::getDropdownList(),
                                                        array(
//                                                                'class'=>'text',
                                                                 'separator'=>'',
                                                                'template'=>'<div class="T_checkbox_list_step2">{input}{label}</div>',
                                                            )
                               );?>                              
                            </div>
                      
                        </div>
                        <div class="clearfix"></div>
                        <?php echo $form->error($model,'fixtures_fittings_json',array('class'=>'class-error')); ?>
                    </div>
                    
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'outdoor_indoor_space_json',array('class'=>'lb')); ?>
                        <div class="group-4 T_row_checkbox_step2">
                            <div>
                                <?php echo $form->checkboxList($model,'outdoor_indoor_space_json', ProMasterOutdoorIndoorSpace::getDropdownList(),
                                                        array(
//                                                                'class'=>'text',
                                                                 'separator'=>'',
                                                                'template'=>'<div class="T_checkbox_list_step2">{input}{label}</div>',
                                                            )
                               );?>                              
                            </div>
                        </div>
                         <div class="clearfix"></div>
                        <?php echo $form->error($model,'outdoor_indoor_space_json',array('class'=>'class-error')); ?>                       
                    </div>
                    
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'furnishing_included_json',array('class'=>'lb')); ?>
                        <div class="group-4 T_row_checkbox_step2">
                            <div>
                                <?php echo $form->checkboxList($model,'furnishing_included_json', ProMasterFurnishingIncluded::getDropdownList(),
                                                        array(
//                                                                'class'=>'text',
                                                                 'separator'=>'',
                                                                'template'=>'<div class="T_checkbox_list_step2">{input}{label}</div>',
                                                            )
                               );?>                              
                            </div>
                        </div>
                          <div class="clearfix"></div>
                        <?php echo $form->error($model,'furnishing_included_json',array('class'=>'class-error')); ?>                           
                    </div>

                </div>
            </div>
        </div>
    </div>
    
       <div class="w-2 clearfix T_step_1_custom_btn" style="margin-left:10px;">
           <input type ='button' onclick="window.location.href='<?php echo Yii::app()->createAbsoluteUrl('admin/listing/create',array('id'=>$model->id)) ?>'" name="back" class='btn-3' value="Back" />&nbsp;&nbsp;&nbsp;
            <input type ='submit' name="save_exit" class='btn-3' value="Save & Exit" />&nbsp;&nbsp;&nbsp;
            <input type ='submit' name="next"  class='btn-3' value="Next" />
        </div>    
    
<!--</div>-->

<style>
    .T_checkbox_list_step2 {float:left;width:300px;}
    .T_checkbox_list_step2 input { width:20px !important;float:left;width:250px;margin-right:3px;}
    .T_row_checkbox_step2 { width:650px !important;margin-left:170px;max-height: 150px;min-height: 150px;overflow-y: scroll;border: 1px solid #DDDDDD;padding:2px 2px 2px 5px;}
      label, input, button, select, textarea {font-size: 11px;}
     .form-type {border: none !important;}
     
     /*#Listing_furnished li { float:left;width:120px;}*/
     #Listing_furnished li input { float:left;width:20px;margin-right:3px;}
     #Listing_furnished label { float:left;}
     .class-error {margin-left:170px;color:red;}
</style>
<?php
    if (isset($_SERVER['HTTP_USER_AGENT']) && 
    (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)):
?>
<style>
    input, textarea, select, .uneditable-input {height: 30px;line-height: 25px;}
    .list_type_custom input {float:left;padding:0px;width:20px !important; margin-right:3px;height: 16px;}
    label, input, button, select, textarea {font-size: 11px;}
    .T_btn_reset_user ,.T_btn_reset {line-height: 16px !important;}
    .form-type .text {padding-right: 0px !important;border: none !important;padding-top:0px !important;}
</style>
<?php    endif;?>