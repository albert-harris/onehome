
<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createAbsoluteUrl('/enquiry/sendGlobal'),
    'method'=>'post',
    'enableClientValidation' => true,
    'enableAjaxValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
         'afterValidate'=>'js:function(form, attribute,hasError){ return fnAnhDungCheck(hasError); }',
    ),    
    'htmlOptions'=>array(
        'class'=>'search-form',
        'enctype' => 'multipart/form-data',
    ),
)); ?>
    <?php echo $form->hiddenField($model,'type_enquiry',array('value'=>'Rent')); ?>
    <div id="engageRent" class="sub-content">
        <label class="lb">I am a...</label>
        <ul class="list-check list clearfix anhdung_RadioLandlordTenant">
            <?php
            echo $form->radioButtonList($model, 'rent_type',
                ProGlobalEnquiry::$raRentType,
                array(
                    'separator'=>'  ',
                ) );
            ?>
        </ul>
        
        <!--<div id="renttype1" class="renttype1" class="rent-content" style="display:none;">-->
            <div class="anhdung_Landlord">
                <?php echo $form->labelEx($model,'address',array('label'=>'Property Name or Address','class'=>'lb')); ?>
                <?php echo $form->textField($model,'address',array('class'=>'text AddressRent')); ?>   
                <?php echo $form->error($model,'address'); ?>
            </div>            
        <!--</div>-->
            
        <!--<div id="renttype1" class="renttype1" class="rent-content" style="display:none;">-->
            <div class="anhdung_Landlord">
                <?php echo $form->labelEx($model,'unit',array('label'=>'Unit#','class'=>'lb')); ?>
                <div class="clearfix">
                    <div class="col-3">
                        <?php echo $form->textField($model,'min_unit',array('class'=>'text','placeholder'=>'')); ?>
                        <?php // echo $form->textField($model,'min_unit',array('class'=>'text','placeholder'=>'12')); ?>
                    </div>
                    <div class="col-4">-</div>
                    <div class="col-5">
                        <?php echo $form->textField($model,'max_unit',array('class'=>'text','placeholder'=>'')); ?>
                        <?php // echo $form->textField($model,'max_unit',array('class'=>'text','placeholder'=>'58')); ?>
                    </div>
                    <?php echo $form->error($model,'unit'); ?>
                </div>
            </div>
            <div class="anhdung_Landlord">
                <?php echo $form->labelEx($model,'postal_code',array('label'=>'Postal code','class'=>'lb')); ?>
                <?php echo $form->textField($model,'postal_code',array('class'=>'text')); ?>
                <?php echo $form->error($model,'postal_code'); ?>           
            </div>
            
            <div class="anhdung_Tenant_anhdung_Landlord">
                <?php echo $form->labelEx($model,'property_type_id'); ?>
                <?php // echo ProPropertyType::getDropDownSelectGroup('ProGlobalEnquiry[property_type_id]', 'ProGlobalEnquiry_property_type_id', $model->property_type_id,  'All property types','propety_type_rent'); ?>
                <?php $aData = array();
                    $aData['zonechoosetype'] = 'type_engage_us_rent';
                    $aData['radio_id'] = 'EngageUsRentRadioId';
                    $aData['checkbox_id'] = 'EngageUsRentCheckboxId';
                    $aData['model'] = $model;
                    $this->widget('ext.ProPropertyTypeExt.ProPropertyTypeExt',
                                        array('data'=>$aData));
                ?>
            </div>
        
            <div class="anhdung_Tenant anhdung_Landlord">
                <?php echo $form->labelEx($model,'location_id',array('label'=>'Location','class'=>'lb')); ?>
                <?php // echo $form->dropDownList($model,'location_id', ProLocation::getListDataLocation(), array('empty'=>'All locations in Singapore'));?>
                <div class="wrap_multiselect_location display_none">
                    <?php                
                        echo CHtml::dropDownList('location_list_id', '',
                            ProLocation::getListDataLocation(), 
                            array('class'=>'multiselect_location_rent','multiple'=>'multiple', 'id'=>'location_list_id_rent')); 
                    ?>
                </div>
                <?php echo $form->error($model,'location_id'); ?>
            </div>        
        
            <div class="anhdung_Landlord">
                <div class="floor_area_rent_hide" >
                  <?php echo $form->labelEx($model, 'floor_area', array( 'class' => 'lb')); ?>
                  <?php echo $form->textField($model, 'floor_area', array('class' => 'text floor_area_rent')); ?>
                  <?php echo $form->error($model, 'floor_area'); ?>           
                </div>
            </div>
        
            <div class="anhdung_Landlord">
                  <?php echo $form->labelEx($model, 'tenure', array( 'class' => 'lb')); ?>
                  <?php echo $form->textField($model, 'tenure', array('class' => 'text ')); ?>
                  <?php echo $form->error($model, 'tenure'); ?>           
            </div>
            
            <div class="anhdung_Landlord">
                <?php // echo $form->labelEx($model,'price',array('class'=>'lb')); ?>
                <?php // echo $form->textField($model,'price',array('class'=>'text')); ?>
                <?php // echo $form->error($model,'price'); ?>
            </div>
            
            <div class="anhdung_Landlord">
                <?php // echo $form->labelEx($model, 'lease_term', array('label' => 'Lease Term', 'class' => 'lb')); ?>
                <?php // echo $form->dropDownList($model, 'lease_term', ProMasterLeaseTerm::getListData("enquiry")); ?>
                <?php // echo $form->error($model, 'lease_term'); ?>
            </div>
            
            <div class="anhdung_Landlord">
                <?php echo $form->labelEx($model, 'bedrooms', array('label' => '# of Bedrooms', 'class' => 'lb')); ?>
                <?php echo $form->textField($model, 'bedrooms', array('class' => 'text')); ?>
                <?php echo $form->error($model, 'bedrooms'); ?>
            </div>

            <div class="anhdung_Landlord">
                <?php echo $form->labelEx($model, 'bathrooms', array('label' => '# of bathrooms', 'class' => 'lb')); ?>
                <?php echo $form->textField($model, 'bathrooms', array('class' => 'text',)); ?>
                <?php echo $form->error($model, 'bathrooms'); ?>
            </div>
            
            <div class="anhdung_Landlord">
                <?php echo $form->labelEx($model,'availability',array('label'=>'Availability','class'=>'lb')); ?>
                <ul class="list-check list clearfix rd_availability_date">
                   <?php
                   echo $form->radioButtonList($model, 'availability',
                       array('Date'=>'Date','Immediate'=>'Immediate'),
                       array(
                           'separator'=>'',
                           'template'=>'<li>{input}{label}</li>'
                       ) );
                   ?>
                </ul>             
                <?php echo $form->error($model,'availability'); ?>
                <div class="availability_date display_none">
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
                                              'buttonImage'=> Yii::app()->theme->baseUrl.'/img/ico-calendar.png',
                                              'buttonImageOnly'=> true,
                                              'yearRange'=>'1900',
                                  ), // jquery plugin options
                              'htmlOptions' => array(
                                  'readonly' => 'true',
                                  'id' => 'anhdung_fix_datepicker',
                                  'style'=>'width:195px;',
                                  'class'=>'text w-6'
                              ),
                      ));
                  ?>
                </div>
            </div>

            <div class="anhdung_Landlord">
                <?php echo $form->labelEx($model,'furnished',array('class'=>'lb')); ?>
                <?php echo $form->dropDownList($model,'furnished',ProMasterFurnished::getListData('enquiry'), array('empty'=>'All Furnished'));?>
                <?php echo $form->error($model,'furnished'); ?>                   
            </div>

        <!--</div>-->
        
        <!--<div id="renttype2" class="rent-content-tenant" style="display:none;">-->

            <div class="anhdung_Tenant">
                <?php echo $form->labelEx($model, 'price', array('label'=>'Price','class' => 'lb')); ?>
                <div class="clearfix">
                    <div class="col-1">
                        <?php echo $form->dropDownList($model, 'min_price', ProMasterPrice::getListOption(ProMasterPrice::PRICE_FOR_RENT), array('empty' => 'Minimum', 'id'=>'minimum_price_engage_rent')); ?>
                    </div>
                    <div class="col-2">
                        <?php echo $form->dropDownList($model, 'max_price', ProMasterPrice::getListOption(ProMasterPrice::PRICE_FOR_RENT), array('empty' => 'Maximum', 'id'=>'maximum_price_engage_rent')); ?>
                    </div>
                    <?php echo $form->error($model, 'min_price'); ?>
                    <?php echo $form->error($model, 'max_price'); ?>
                </div>
            </div>

            <div class="anhdung_Tenant">
                <?php echo $form->labelEx($model, 'bedrooms', array('label' => 'Bedrooms', 'class' => 'lb')); ?>
                <div class="clearfix">
                    <div class="col-1">
                        <?php echo $form->dropDownList($model, 'min_bedroom', Listing::getListOptionsBedroom(), array('empty' => 'Minimum', 'id'=>'minimum_bedroom_engage_rent')); ?>
                    </div>
                    <div class="col-2">
                        <?php echo $form->dropDownList($model, 'max_bedroom', Listing::getListOptionsBedroom(), array('empty' => 'Maximum', 'id'=>'maximum_bedroom_engage_rent')); ?>                         
                    </div>
                    <?php echo $form->error($model, 'min_bedroom'); ?>
                    <?php echo $form->error($model, 'max_bedroom'); ?>
                </div>
            </div>

            <div class="anhdung_Tenant">
                <?php echo $form->labelEx($model, 'floor_size', array('label' => 'Floor Size', 'class' => 'lb')); ?>
                <div class="clearfix">
                    <div class="col-1">
                        <?php echo $form->dropDownList($model, 'min_floor_size', ProMasterFloor::getListOption(), array('empty' => 'Minimum', 'id'=>'minimum_floor_engage_rent')); ?>
                    </div>
                    <div class="col-2">
                        <?php echo $form->dropDownList($model, 'max_floor_size', ProMasterFloor::getListOption(), array('empty' => 'Maximum', 'id'=>'maximum_floor_engage_rent')); ?>
                    </div>
                    <?php echo $form->error($model, 'min_floor_size'); ?>
                    <?php echo $form->error($model, 'max_floor_size'); ?>
                </div>
            </div>

            <div class="anhdung_Tenant">
                <?php // echo $form->labelEx($model,'furnishing_include',array('label'=>'Furnishing ','class'=>'lb')); ?>
                <?php // echo $form->dropDownList($model,'furnishing_include', ProMasterFurnishingIncluded::getDropdownList('id','name'),array('class'=>'multiselect','multiple'=>'multiple') );?>  
                <?php // echo $form->error($model,'furnishing_include'); ?>  
            </div>
       
            <div class="anhdung_Tenant">
                <?php echo $form->labelEx($model,'move_in_date',array('class'=>'lb')); ?>
                <div class="">
                <?php
                    Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                          $this->widget('CJuiDateTimePicker',array(
                              'language' => 'en-GB',
                              'model'=>$model,
                              'attribute'=>'move_in_date',
                              'mode'=>'date',
                              'options'=>array('dateFormat'=>'d-M-yy',
                                              'regional' => 'en_us',
                                              'changeMonth'=>true,
                                              'changeYear'=>true,
                                              'showOn' => 'button',
                                              'buttonImage'=> Yii::app()->theme->baseUrl.'/img/ico-calendar.png',
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
                </div>
                <?php echo $form->error($model,'move_in_date'); ?>                
            </div>
       
            <div class="anhdung_Tenant">
                <?php echo $form->labelEx($model,'of_persons_staying',array('class'=>'lb')); ?>
                <?php echo $form->textField($model,'of_persons_staying',array('class'=>'text')); ?>
                <?php echo $form->error($model,'of_persons_staying'); ?>                
            </div>
            
        <!--</div>-->
        
        <?php // echo $form->labelEx($model,'remark',array('label'=>'Remark','class'=>'lb')); ?>
        <?php // echo $form->textArea($model,'remark',array('class'=>'text','rows'=>3,'cols'=>30)); ?>
        <?php // echo $form->error($model,'remark'); ?>                     
       

        <div class="in-row clearfix">
            <label class="lb">Enquiry</label>
            <?php echo $form->textField($model,'name',array('class'=>'text','placeholder'=>'Full Name')); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->textField($model,'email',array('class'=>'text','placeholder'=>'Email address')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="in-row clearfix nric">
            <?php echo $form->textField($model,'nric',array('class'=>'text','placeholder'=>'NRIC')); ?>
            <?php 
                $model->addError('nric','Nric cannot be blank.');
            ?>
            <?php echo $form->error($model,'nric'); ?>
        </div>
        
        <div class="in-row clearfix occupation" style='display: none;' >
            <?php echo $form->textField($model,'occupation',array('class'=>'text','placeholder'=>'Occupation')); ?>
            <?php echo $form->error($model,'occupation'); ?>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->textField($model,'phone',array('class'=>'text','placeholder'=>'Contact No')); ?>
            <?php echo $form->error($model,'phone'); ?>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('empty'=>'Country'));?>
            <?php echo $form->error($model,'country_id'); ?>
        </div>
        
        <div class="in-row clearfix">
            <?php // echo $form->labelEx($model, 'remark', array('class' => 'lb')); ?>
            <?php echo $form->textArea($model, 'remark', array('rows'=>1, 'class' => 'text', 'maxlength' => 600, 'placeholder'=>'Remark')); ?>
        </div>
        
        <div class="in-row clearfix">
            <?php echo $form->textArea($model,'description',array('class'=>'note-box-2','placeholder'=>trim(strip_tags($box->content)),'style'=>'width:100%;'));?>
            <?php echo $form->error($model, 'description'); ?>
        </div>
        
        <?php include "_file_upload.php";?>
        
        <div class="in-row check-wrap clearfix">
            <?php echo $form->checkBox($model,'get_update',array('class' => 'term_agree')); ?>
            <label class="lb-3">I agree <a href="javascript:;" data-target="#myModal" class="click-tearm-condition">Terms & Conditions.</a></label>
            <?php echo $form->error($model, 'get_update'); ?>
        </div>
        
        
        <div class="a-center clearfix">
            <button type="submit" class="btn-3 GlobalEnquiryrent">SEND ENQUIRY</button>
        </div>
    </div>

<script type="text/javascript">
$('#rent2').click(function(){
    $('#engageRent #ProGlobalEnquiry_rent_type #ProGlobalEnquiry_rent_type_1').attr('checked',false).parent('span').removeClass('checked');
    $('#engageRent #ProGlobalEnquiry_rent_type #ProGlobalEnquiry_rent_type_0').attr('checked',true).parent('span').addClass('checked');
   
//    $('.renttype1').show();
    $('.anhdung_Tenant').hide();
    $('.anhdung_Landlord').show();
});
    
$('#engageRent #ProGlobalEnquiry_rent_type input').click(function(){
    $('#engageRent #ProGlobalEnquiry_rent_type input').attr('checked',false);
    $(this).attr('checked',true);
    if($(this).val()=='Tenant'){ // Tenant
//        anhdung_Tenant
//        anhdung_Landlord
        $('.anhdung_Landlord').hide();
        $('.anhdung_'+$(this).val()).show();
        
//        $('#renttype2').show();
//        $('.renttype1').hide();
        $('.occupation').show();
        $('.nric').hide();
//        $('.anhdung_Landlord input').each(function(){
//            $(this).val('');
//        });
        
    }else{
        $('.anhdung_Tenant').hide();        
        $('.anhdung_'+$(this).val()).show();        
        $('.occupation').hide();
        $('.nric').show();
//        $('.renttype1').show();
//        $('#renttype2').hide();
    }
    
});

//    $('.propety_type_rent').change(function(){
//        var optionRent = $('option:selected', this).attr('parent');
//        var valueRent  = $(this).val();
//        if(optionRent==28 || valueRent ==28 || optionRent==2 || valueRent==2 || optionRent==48 || valueRent==48 ){
//             $('.floor_area_rent').val('').hide();
//             $('.floor_area_rent_hide').hide();
//        }else{
//           $('.floor_area_rent').show();
//           $('.floor_area_rent_hide').show();
//        }
//    });
    
    $(function(){
        $('.nric .errorMessage').hide();
        $('.term_agree').closest('div').find('.errorMessage').hide();
        $('.rd_availability_date input:radio').each(function(){
            $(this).click(function(){
                if($(this).val()=='Date'){
                    $('.availability_date').show();
                }else{
                    $('.availability_date').hide();
                    $('.availability_date input').val('');
                }
                
            });
        }); // END $('.rd_availability_date input:radio
        
        
    });
    
    function fnGetRentCheckLandlordOrTenant(){
        var res = '';
        $('.anhdung_RadioLandlordTenant input:radio').each(function(){
            if($(this).is(":checked")){
                res = $(this).val();
                return false;
            }
        }); // END $('.anhdung_RadioLandlordTenant input:radio
        return res;
    }
    
    function fnAnhDungCheck(hasError){
        var ok = true;
        var form = $('.GlobalEnquiryrent').closest('form');
        var nric = form.find('.nric input').val();
        var type = fnGetRentCheckLandlordOrTenant();
        if($.trim(nric) == '' && type=='Landlord'){
            $('.nric .errorMessage').show();
            ok =  false;
        }else{
            $('.nric .errorMessage').hide();
        }
        
        // Jan 29, 2015 ANH DUNG add for check Terms & Conditions- applies to Seller and Landlord only.
        var term_check = form.find('.term_agree').is(':checked');
        if( !term_check  && type=='Landlord' ){
            form.find('.term_agree').closest('div').find('.errorMessage').show();
        }else{
            term_check = true;
            form.find('.term_agree').closest('div').find('.errorMessage').hide();
        }
        
        if( !hasError && term_check && ok){
            return true;
        }
        return false;
        // Jan 29, 2015 ANH DUNG add for check Terms & Conditions- applies to Seller and Landlord only.
        
        return ok;
    }
    
</script>
<?php $this->endWidget(); ?>