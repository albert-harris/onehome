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

<div class="main-inner-2 T_custom_Step_2 ">
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
                                                                      'class'=>'text',
                                                                      'separator'=>'',
                                                                      'template'=>' <li ><div class="radio"><span>{input}</span></div>{label}</li>',
//                                                                      'template'=>'{input}{label}',
                                                                     )
                                   );?>                           
                            </ul>
                            
                        </div>
                        <div class="clearfix"></div>
                         <?php echo $form->error($model,'furnished',array('style'=>'margin-left:170px;')); ?>
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
                    
                    <?php /* ?>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'of_bathrooms',array('class'=>'lb')); ?>
                        <div class="group-4">
                                <?php // echo $form->dropDownlist($model,'of_bathrooms', Listing::getDropdownlistWithTableName('ProMasterLeaseTerm','id','name'),array('empty'=>'Select','class'=>'text'));?>
                                <?php echo $form->textField($model,'of_bathrooms',array('class'=>'text'));?>
                             <?php echo $form->error($model,'of_bathrooms'); ?>
                        </div>
                    </div>
                    <?php */ ?>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'special_feature_json',array('class'=>'lb')); ?>
						<div class="toggle-chk">
							<input type="checkbox" id="t1"/> <label for="t1"><strong>Check/Uncheck all</strong></label>
						</div>
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
                            <div class="clearfix"></div>
                             <?php echo $form->error($model,'special_feature_json'); ?>
                        </div>
                    </div>
                    
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'fixtures_fittings_json',array('class'=>'lb')); ?>
						<div class="toggle-chk">
							<input type="checkbox" id="t2"/> <label for="t2"><strong>Check/Uncheck all</strong></label>
						</div>
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
                            <div class="clearfix"></div>
                             <?php echo $form->error($model,'fixtures_fittings_json'); ?>                            
                        </div>
                    </div>
                    
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'outdoor_indoor_space_json',array('class'=>'lb')); ?>
						<div class="toggle-chk">
							<input type="checkbox" id="t3"/> <label for="t3"><strong>Check/Uncheck all</strong></label>
						</div>
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
                            <div class="clearfix"></div>
                             <?php echo $form->error($model,'outdoor_indoor_space_json'); ?>                            
                        </div>
                    </div>
                    
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'furnishing_included_json',array('class'=>'lb')); ?>
						<div class="toggle-chk">
							<input type="checkbox" id="t4"/> <label for="t4"><strong>Check/Uncheck all</strong></label>
						</div>
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
                            <div class="clearfix"></div>
                             <?php echo $form->error($model,'furnishing_included_json'); ?>                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
       <div class="w-2 clearfix T_step_1_custom_btn" style="margin-left:10px;">
           <input type ='button' onclick="window.location.href='<?php echo Yii::app()->createAbsoluteUrl('member/listing/create',array('id'=>$model->id)) ?>'" name="back" class='btn-3' value="Back" />&nbsp;&nbsp;&nbsp;
            <input type ='submit' name="save_exit" class='btn-3' value="Save & Exit" />&nbsp;&nbsp;&nbsp;
            <input type ='submit' name="next"  class='btn-3' value="Next" />
        </div>    
    
</div>
<style>
    .col-1 input {width:auto;}
    .T_row_checkbox_step2 label { font-weight: normal;margin-left:3px;margin-top:1px;}
	.toggle-chk { margin-top: 10px }
	.toggle-chk label { margin-bottom: 0 }
	.toggle-chk input { margin-top: 0 }
</style>
<script type="text/javascript">
//<![CDATA[
$('.toggle-chk input[type="checkbox"]').click(function () {
	var others = $(this).closest('.in-row').find('.type-check');
	others.prop('checked',$(this).is(':checked'));
});
//]]>
</script> 