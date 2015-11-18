<?php
/**
 * Created by PhpStorm.
 * User: JasonHai
 * Date: 4/4/14
 * Time: 5:11 PM
 */
?>

<div class="form-type content no_background no_border  popup_iframe" >
    <h1 class="title-page">Request Bank Evaluation</h1>
    <?php $form=$this->beginWidget('CActiveForm', array(
//                    'action'=>Yii::app()->createAbsoluteUrl('BankRequest/index'),
                    'method'=>'post',
                    'id'=>'BankRequest',
//                    'enableClientValidation' => true,
                    'enableAjaxValidation' => false,
                    'clientOptions' => array(
//                        'validateOnSubmit' => true,
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-type'
                    ),
                )); 
        ?>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model, 'property_name_or_address', array('class' => 'lb')); ?>
                <div class="group">
                    <?php echo $form->textField($model, 'property_name_or_address', array('class' => 'text')); ?>
                    <?php echo $form->error($model, 'property_name_or_address'); ?>
                </div>
            </div>
        
            <div class="in-row clearfix">
                 <?php echo $form->labelEx($model, 'unit_from', array('class' => 'lb')); ?>
                <div class="group">
                    <div class="col-1">
                        <?php echo $form->textField($model, 'unit_from', array('class' => 'text', 'placeholder' => '',)); ?>
                    </div>
                    <div class="col-3">-</div>
                    <div class="col-2">
                        <?php echo $form->textField($model, 'unit_to', array('class' => 'text', 'placeholder' => '')); ?>
                        <?php echo $form->error($model, 'unit_to'); ?> 
                    </div>
                     <?php echo $form->error($model, 'unit_from'); ?> 
                </div>
            </div>
        
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model, 'postal_code', array('class' => 'lb')); ?>
                <div class="group">                                 
                    <?php echo $form->textField($model, 'postal_code', array('class' => 'text')); ?>
                    <?php echo $form->error($model, 'postal_code'); ?>
                </div>
            </div>
        
            <div class="in-row clearfix">
                 <?php echo $form->labelEx($model, 'location_id', array('class' => 'lb')); ?>
                <div class="group">    
                   <?php echo $form->dropDownList($model, 'location_id', ProLocation::getListDataLocation(),array('empty' => 'Select District', 'class'=>'text')); ?>
                    <?php echo $form->error($model, 'location_id'); ?>
                </div>
            </div>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model, 'choosetype', array('class' => 'lb')); ?>
                <div class="group">
                  <?php // echo ProPropertyType::getDropDownSelectGroup('BankRequest[property_type_id]', 'BankRequest_property_type_id', $model->property_type_id,  'Select Property Type', 'text'); ?>
                    <?php 
//                        $aData = array();
//                        $aData['zonechoosetype'] = 'type_bank_request';
//                        $aData['radio_id'] = 'BankRadioId';
//                        $aData['checkbox_id'] = 'BankCheckboxId';
//                        $aData['select_all'] = 1;
//                        $aData['model'] = $model;
//                        $this->widget('ext.ProPropertyTypeExt.ProPropertyTypeExt',
//                                            array('data'=>$aData));
                    ?>
                    
                    <?php $aData = array();
                        $aData['zonechoosetype'] = 'zone_list_listing';
                        $aData['radio_id'] = 'BankRadioId';
                        $aData['checkbox_id'] = 'BankCheckboxId';
                        $aData['search_var'] = 1;
                        $aData['not_hompage'] = 1;
                        $aData['select_all'] = 1;
                        $aData['model'] = $model;
                        $this->widget('ext.ProPropertyTypeExt.ProPropertyTypeExt',
                                            array('data'=>$aData));
                    ?>
                    <?php echo $form->error($model, 'choosetype'); ?>                  
                </div>
            </div>
            
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model, 'tenure', array('class' => 'lb')); ?>
                <div class="group">                                 
                    <?php echo $form->textField($model, 'tenure', array('class' => 'text')); ?>
                    <?php echo $form->error($model, 'tenure'); ?>
                </div>
            </div>
        
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model, 'floor_area', array('class' => 'lb')); ?>
                <div class="group">
                     <?php echo $form->textField($model, 'floor_area', array('class' => 'text',)); ?>
                     <?php echo $form->error($model, 'floor_area'); ?> 
                </div>
            </div>

            <div class="in-row clearfix">
                 <?php echo $form->labelEx($model, 'of_bedroom_from', array('class' => 'lb','label'=>'# of Bedrooms')); ?>
                <div class="group">
                    <!--<div class="col-1">-->
                        <?php echo $form->textField($model, 'of_bedroom_from', array('class' => 'text', 'placeholder' => '',)); ?>
                        <?php // echo $form->dropDownList($model, 'of_bedroom_from',Listing::getDropdownlistWithTableName('ProMasterBedroom','value','value'), array('empty' => 'Minimum')); ?>
                    <!--</div>-->
                    <!--<div class="col-3">-</div>-->
                    <div class="col-2">
                        <?php // echo $form->textField($model, 'of_bedroom_to', array('class' => 'text', 'placeholder' => 'To')); ?>
                        <?php // echo $form->dropDownList($model, 'of_bedroom_to',Listing::getDropdownlistWithTableName('ProMasterBedroom','value','value'), array('empty' => 'Maximum')); ?>
                        <?php // echo $form->error($model, 'of_bedroom_to'); ?> 
                    </div>
                    <div class="clr"></div>
                     <?php echo $form->error($model, 'of_bedroom_from'); ?> 
                </div>
            </div>
        
            <div class="in-row clearfix">
                 <?php echo $form->labelEx($model, 'of_bathrooms_from', array('class' => 'lb', 'label'=>'# of Bathrooms')); ?>
                <div class="group">
                    <!--<div class="col-1">-->
                        <?php echo $form->textField($model, 'of_bathrooms_from', array('class' => 'text', 'placeholder' => '',)); ?>
                        <?php // echo $form->dropDownList($model, 'of_bathrooms_from',Listing::getDropdownlistWithTableName('ProMasterBathroom','value','value'), array('empty' => 'Minimum')); ?>
                    <!--</div>-->
                    <!--<div class="col-3">-</div>-->
                    <div class="col-2">
                        <?php // echo $form->textField($model, 'of_bathrooms_to', array('class' => 'text', 'placeholder' => 'To')); ?>
                        <?php // echo $form->dropDownList($model, 'of_bathrooms_to',Listing::getDropdownlistWithTableName('ProMasterBathroom','value','value'), array('empty' => 'Maximum')); ?>
                        <?php // echo $form->error($model, 'of_bathrooms_to'); ?> 
                    </div>
                    <div class="clr"></div>
                    <?php echo $form->error($model, 'of_bathrooms_from'); ?> 
                </div>
            </div>
       
            <div class="in-row clearfix">
                    <?php echo $form->labelEx($model,'type_selling',array('class'=>'lb')); ?>
                    <div class="group">
                        <ul class="list-check list-check-2 clearfix">
                            <?php echo $form->radioButtonlist($model, 'type_selling', array('Tenancy' => 'Tenancy', 'Vacant possession' => 'Vacant possession', 'Both' => 'Both'), array(
                                    'separator' => '',
                                    'template' => '<li>{input}{label}</li>'
                                ));
                            ?>                       

                        </ul>
                        <?php echo $form->error($model, 'type_selling'); ?> 
                    </div>
            </div>
        
            <div class="clearfix" style="display: none;" id="tenancy-content-bankrequest">
                
                <div class="in-row clearfix box-search">
                    <?php echo $form->labelEx($model, 'tenancy_expiry_date', array('label' => 'Tenancy expiry date', 'class' => 'lb')); ?>
                    <div class="group">
                        <?php
                           Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                                 $this->widget('CJuiDateTimePicker',array(
                                     'language' => 'en-GB',
                                     'model'=>$model,
                                     'attribute'=>'tenancy_expiry_datepicker',
                                     'mode'=>'date',
                                     'options'=>array('dateFormat'=>'d-M-yy',
                                                     'regional' => 'en_us',
                                                     'changeMonth'=>true,
                                                     'changeYear'=>true,
                                                     'showOn' => 'button',
                                                     'buttonImage'=> Yii::app()->createAbsoluteUrl('themes/property/img/ico-calendar.png'),
                                                     'buttonImageOnly'=> true,
                                                     'yearRange'=>'1900',
                                         ), // jquery plugin options
                                     'htmlOptions' => array(
                                         'readonly' => 'true',
                                         'style'=>'width:195px;',
                                         'class'=>'text w-6'
                                     ),
                             ));
                      ?>        
                        <ul class="list-check clearfix">
                            <?php
                                echo $form->radioButtonList($model, 'tenancy_expiry_date', array('Yes' => 'Yes', 'No' => 'No'), array(
                                    'separator' => '',
                                    'class' => 'tenancy_expiry_date',
                                    'template' => '<li>{input}{label}</li>'
                                ));
                            ?>
                        </ul>                                                  
                        <?php echo $form->error($model, 'tenancy_expiry_date'); ?>
                    </div>
                </div>
                
                <div class="in-row clearfix">
                    <?php echo $form->labelEx($model, 'monthly_rental_amount', array('label' => 'Monthly rental amount', 'class' => 'lb')); ?>
                    <div class="group">
                        <?php echo $form->textField($model, 'monthly_rental_amount', array('class' => 'text number_only')); ?>
                        <?php echo $form->error($model, 'monthly_rental_amount'); ?>
                    </div>
                </div>
                
                <div class="in-row clearfix">
                    <?php echo $form->labelEx($model, 'furnished', array('label' => 'Furnished', 'class' => 'lb')); ?>
                    <div class="group">
                        <?php echo $form->dropDownList($model,'furnished',ProMasterFurnished::getListData('enquiry'), array('class'=>'text'));?>
                        <?php echo $form->error($model, 'furnished'); ?>       
                    </div>
                </div>
                
                <div class="in-row clearfix">
                    <?php echo $form->labelEx($model, 'target_price', array( 'class' => 'lb')); ?>
                    <div class="group">
                        <?php echo $form->textField($model, 'target_price', array('class' => 'text number_only')); ?>
                        <?php echo $form->error($model, 'target_price'); ?> 
                    </div>
                </div>
                
                <div class="in-row clearfix">
                    <?php echo $form->labelEx($model, 'remark', array('label' => 'Remark', 'class' => 'lb')); ?>
                    <div class="group">
                        <?php echo $form->textArea($model, 'remark', array('class' => 'text', 'rows' => 3, 'cols' => 30)); ?>
                        <?php echo $form->error($model, 'remark'); ?>                   
                    </div>
                </div>
            </div> 

            <div class="in-row clearfix display_none">
                <?php echo $form->labelEx($model, 'owner_particular', array( 'class' => 'lb')); ?>
                    <div class="group">
                        <?php echo $form->textField($model, 'owner_particular', array('class' => 'text')); ?>
                    <?php echo $form->error($model, 'owner_particular'); ?>                   
                </div>
            </div>
        
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model, 'fullname', array( 'class' => 'lb')); ?>
                    <div class="group">
                        <?php echo $form->textField($model, 'fullname', array('class' => 'text')); ?>
                    <?php echo $form->error($model, 'fullname'); ?>                   
                </div>
            </div>
        
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model, 'nric', array( 'class' => 'lb')); ?>
                    <div class="group">
                        <?php echo $form->textField($model, 'nric', array('class' => 'text')); ?>
                    <?php echo $form->error($model, 'nric'); ?>                   
                </div>
            </div>
        
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model, 'contact_no', array( 'class' => 'lb')); ?>
                    <div class="group">
                        <?php echo $form->textField($model, 'contact_no', array('class' => 'text')); ?>
                    <?php echo $form->error($model, 'contact_no'); ?>                   
                </div>
            </div>
        
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model, 'email', array( 'class' => 'lb')); ?>
                    <div class="group">
                        <?php echo $form->textField($model, 'email', array('class' => 'text')); ?>
                    <?php echo $form->error($model, 'email'); ?>                   
                </div>
            </div>
        
            <div class="in-row check-wrap clearfix">
                
                <div class="group">
                    <?php echo $form->checkBox($model, 'termandcondition', array('checked' => true)); ?>
                    <?php
                        $pageTerm = Pages::model()->findByPk(PAGE_TERMS_CONDITION);
                        if (isset($pageTerm)) {
                            if($pageTerm->external_link != "") {
                                $link = $pageTerm->external_link;
                            } else {
                                $link = Yii::app()->createAbsoluteUrl('page/index',array('slug'=>$pageTerm->slug));
                            }
                        }
                        else{
                            $link = '';
                        }
                     ?>
                    <label class="lb-3" style="display: inline; margin-left: 10px;">I agree <a target="_blank" href="<?php echo $link ?>" >Terms & Conditions.</a></label>
                    <?php echo $form->error($model,'termandcondition'); ?>
                </div>
                
            </div>

            <div class="clearfix output">
                <a href="javascript:void(0)" class="btn-2 iframe_close">Cancel</a>
                <input type="submit" class="btn-3" value="Submit" />
            </div>
  <?php $this->endWidget(); ?>   
</div><!-- form-type content -->

<style>
</style>

<script type="text/javascript">
    $('#BankRequest_type_selling input').change(function() {
        $('#tenancy-content-bankrequest').hide();
        if ($(this).val() === 'Tenancy') {
            $('#tenancy-content-bankrequest').show();
            $('#tenancy-content-bankrequest input').each(function() {
                $(this).attr('checked', false);
                $(this).parent('span').removeClass('checked');
            });
        }
    });
    
    $('#BankRequest_property_type_id').change(function() {
        var params = {};
        params["id"] = $(this).val();;   
        var url = '<?php echo Yii::app()->createAbsoluteUrl('BankRequest/CheckPropertyType'); ?>';

        $.ajax({
            url: url,
            data:params,
            type:'POST',
            dataType : 'JSON',
            success : function(data) {
                if(data.msg === 'ok'){
                    $("#BankRequest_floor_area").attr("readOnly", true);
                }
                else{
                    $("#BankRequest_floor_area").removeAttr("readOnly");
                }
            },
            error: function(error) {
                alert('There was an error.');
            }
        }); 
    });
    
    $('#BankRequest_tenancy_expiry_date_1').change(function() {
       var div = $(this).closest('div.group');
       div.find('.hasDatepicker').val('');
    });
    
    $('#BankRequest_tenancy_expiry_datepicker').change(function() {
        $('#BankRequest_tenancy_expiry_date_0').attr('checked', true);
        $('#BankRequest_tenancy_expiry_date_0').parent('span').addClass('checked');
        $('#BankRequest_tenancy_expiry_date_1').attr('checked', false);
        $('#BankRequest_tenancy_expiry_date_1').parent('span').removeClass('checked');
    });
    
    $('#BankRequest_type_selling_1, #BankRequest_type_selling_2').change(function() {
        var divTenancy = $('#tenancy-content-bankrequest');
        $('#tenancy-content-bankrequest input:radio').each(function() {
            $(this).attr('checked', false);
            $(this).parent('span').removeClass('checked');
        });
        $('#tenancy-content-bankrequest input').val('');
        $('#tenancy-content-bankrequest textarea').val('');
        $('#tenancy-content-bankrequest select').val('Unfurnished').trigger('change');
    });
    

</script>  

<script>

    function validateNumber(){
        $(".number_only").each(function(){
            $(this).unbind("keydown");
            $(this).bind("keydown",function(event){
                if( !(event.keyCode == 8                                // backspace
                    || event.keyCode == 46                              // delete
                    || event.keyCode == 9							// tab
//			        || (event.keyCode == 190 || event.keyCode == 110 )							// dấu chấm (point)
                    || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
                    || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
                    || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
                    ) {
                    event.preventDefault();     // Prevent character input
                }
            });
        });
    }

    $(function(){
        $('.iframe_close').on('click', function(){
            parent.$.fancybox.close();
        });
        validateNumber();
    });

</script>