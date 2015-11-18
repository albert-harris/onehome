<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createAbsoluteUrl('/enquiry/sendGlobal'),
    'method' => 'post',
    'enableClientValidation' => true,
    'enableAjaxValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'afterValidate'=>'js:function(form, attribute,hasError){ return fnAnhDungCheckSell(hasError); }',
    ),
    'htmlOptions' => array(
        'class' => 'search-form',
        'enctype' => 'multipart/form-data',
    ),
    ));
?>
<?php echo $form->hiddenField($model, 'type_enquiry', array('value' => 'Sell')); ?>
<div id="engageSell" class="sub-content">
    
    
    <?php echo $form->labelEx($model, 'address', array('label' => 'Property Name or Address', 'class' => 'lb')); ?>
    <?php echo $form->textField($model, 'address', array('class' => 'text AddressSell')); ?>
    
    <?php echo $form->labelEx($model, 'unit', array('label' => 'Unit#', 'class' => 'lb')); ?>
    <div class="clearfix">
        <div class="col-3">
            <?php echo $form->textField($model, 'min_unit', array('class' => 'text', 'placeholder' => '')); ?>
        </div>
        <div class="col-4">-</div>
        <div class="col-5">
            <?php echo $form->textField($model, 'max_unit', array('class' => 'text', 'placeholder' => '')); ?>
        </div>
        <?php echo $form->error($model, 'unit'); ?>
    </div>

    <?php echo $form->labelEx($model, 'postal_code', array('label' => 'Postal code', 'class' => 'lb')); ?>
    <?php echo $form->textField($model, 'postal_code', array('class' => 'text')); ?>
    <?php echo $form->error($model, 'postal_code'); ?>

 
    <?php echo $form->labelEx($model, 'location_id', array('label' => 'Location', 'class' => 'lb')); ?>
    <?php echo $form->dropDownList($model, 'location_id', ProLocation::getListDataLocation(), array('empty' => 'All locations in Singapore','style'=>'width:')); ?>
    <?php echo $form->error($model, 'location_id'); ?>   
     
    <?php echo $form->labelEx($model, 'property_type_id', array('label' => 'Property Type', 'class' => 'lb')); ?>
    <?php // echo ProPropertyType::getDropDownSelectGroup('ProGlobalEnquiry[property_type_id]', 'ProGlobalEnquiry_property_type_id', $model->property_type_id, 'All property types','Propety_type_sell'); ?>
    <?php $aData = array();
        $aData['zonechoosetype'] = 'type_engage_us_sell';
        $aData['radio_id'] = 'EngageUsSellRadioId';
        $aData['checkbox_id'] = 'EngageUsSellCheckboxId';
        $aData['model'] = $model;
        $this->widget('ext.ProPropertyTypeExt.ProPropertyTypeExt',
                            array('data'=>$aData));
    ?> 

    <?php echo $form->labelEx($model, 'tenure', array('class' => 'lb')); ?>
    <?php echo $form->textField($model, 'tenure', array('class' => 'text')); ?>
    <?php echo $form->error($model, 'tenure'); ?>  
    
    <div class="floor_area_hide" >
       <?php echo $form->labelEx($model, 'floor_area', array( 'class' => 'lb')); ?>
       <?php echo $form->textField($model, 'floor_area', array('class' => 'text floor_area_sell')); ?>
       <?php echo $form->error($model, 'floor_area'); ?>           
    </div>
    
 
    <?php echo $form->labelEx($model, 'bedrooms', array('label' => '# of Bedrooms', 'class' => 'lb')); ?>
    <?php echo $form->textField($model, 'bedrooms', array('class' => 'text')); ?>
    <?php echo $form->error($model, 'bedrooms'); ?>
   
 
    <?php echo $form->labelEx($model, 'bathrooms', array('label' => '# of bathrooms', 'class' => 'lb')); ?>
    <?php echo $form->textField($model, 'bathrooms', array('class' => 'text',)); ?>
    <?php echo $form->error($model, 'bathrooms'); ?>   
    
    <ul class="list-check clearfix">
        <?php
            $model->type_selling = 'Tenancy';
            echo $form->radioButtonList($model, 'type_selling', array('Tenancy' => 'Tenancy', 'Vacant possession' => 'Vacant possession', 'Both' => 'Both'), array(
                'separator' => '',
                'template' => '<li>{input}{label}</li>'
            ));
        ?>
    </ul>   
    
    <div class="clearfix" style="" id="tenancy-content">

        <?php echo $form->labelEx($model, 'tenancy_expiry_date', array('label' => 'Tenancy expiry date', 'class' => 'lb')); ?>
        <?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			 'language' => 'en-GB',
			 'model'=>$model,
			 'attribute'=>'tenancy_expiry_datepicker',
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
        <div class="clr"></div>
        <label class="float_l">To Renew</label>
        <ul class="list-check clearfix float_l l_padding_5">
            <?php
                echo $form->radioButtonList($model, 'tenancy_expiry_date', array('Yes' => 'Yes', 'No' => 'No'), array(
                    'separator' => '',
                    'template' => '<li>{input}{label}</li>'
                ));
            ?>
        </ul>         
        <div class="clr"></div>
        <?php echo $form->error($model, 'tenancy_expiry_date'); ?>

        <?php echo $form->labelEx($model, 'monthly_rental_amount', array('label' => 'Monthly rental amount', 'class' => 'lb')); ?>
        <?php echo $form->textField($model, 'monthly_rental_amount', array('class' => 'text')); ?>
        <?php echo $form->error($model, 'monthly_rental_amount'); ?>

        <?php echo $form->labelEx($model, 'furnished', array('class' => 'lb')); ?>
        <?php echo $form->dropDownList($model,'furnished',ProMasterFurnished::getListData('enquiry'),array('empty'=>'Select Furnished '));?>
        <?php echo $form->error($model, 'furnished'); ?>     
 
        <?php echo $form->labelEx($model, 'price', array( 'class' => 'lb')); ?>
        <?php echo $form->textField($model, 'price', array('class' => 'text')); ?>
        <?php echo $form->error($model, 'price'); ?> 
        
        <?php echo $form->labelEx($model, 'official_bank_val', array('label' => 'Official/BankValuation $', 'class' => 'lb')); ?>
        <?php echo $form->textField($model, 'official_bank_val', array('class' => 'text')); ?>
        <?php echo $form->error($model, 'official_bank_val'); ?>                  
        
        <?php // echo $form->labelEx($model, 'remark', array('label' => 'Remark', 'class' => 'lb')); ?>
        <?php // echo $form->textArea($model, 'remark', array('class' => 'text', 'rows' => 3, 'cols' => 30)); ?>
        <?php // echo $form->error($model, 'remark'); ?>       
        
    </div> 
    
    
    <?php // echo $form->labelEx($model, 'floor', array('label' => 'Floor', 'class' => 'lb')); ?>
    <?php // echo $form->dropDownList($model, 'floor', ProMasterFloorType::getListData("enquiry")); ?>
    <?php // echo $form->error($model, 'floor'); ?>


     <?php // echo $form->labelEx($model,'special_features',array('class'=>'lb')); ?>
     <?php // echo $form->dropDownList($model,'special_features', ProMasterSpecialFeatures::getDropdownList('name','name'),array('class'=>'multiselect-special','multiple'=>'multiple') );?>  
     <?php // echo $form->error($model,'special_features'); ?>      
    
    <div class="in-row clearfix">        
        <label class="lb">Enquiry</label>
        <?php echo $form->textField($model, 'name', array('class' => 'text', 'placeholder' => 'Full Name')); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    
    <div class="in-row clearfix">
        <?php echo $form->textField($model, 'nric', array('class' => 'text', 'placeholder' => 'NRIC')); ?>
        <?php echo $form->error($model, 'nric'); ?>
    </div>

    
    <div class="in-row clearfix">
        <?php echo $form->textField($model, 'email', array('class' => 'text', 'placeholder' => 'Email address')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    
    <div class="in-row clearfix">
        <?php echo $form->textField($model, 'phone', array('class' => 'text', 'placeholder' => 'Contact No')); ?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>

    <div class="in-row clearfix">
        <?php echo $form->dropDownList($model, 'country_id', AreaCode::loadArrArea(), array('empty' => 'Country')); ?>
        <?php echo $form->error($model, 'country_id'); ?>
    </div>

    <div class="in-row clearfix">
        <?php // echo $form->labelEx($model, 'remark', array('class' => 'lb')); ?>
        <?php echo $form->textArea($model, 'remark', array('rows'=>1, 'class' => 'text', 'maxlength' => 600, 'placeholder'=>'Remark')); ?>
    </div>
    
    <div class="in-row clearfix">
        <?php echo $form->textArea($model, 'description', array('class' => 'note-box-2', 'placeholder' => trim(strip_tags($box->content)), 'style' => 'width:100%;')); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    
    <?php include "_file_upload.php";?>
    
    <div class="in-row check-wrap clearfix">
        <?php 
            $model->addError('get_update', ProGlobalEnquiry::MESSAGE_TERM);
        ?>
        <?php echo $form->checkBox($model, 'get_update', array('class' => 'term_agree')); ?>
        <label class="lb-3">I agree <a href="javascript:;" data-target="#myModal" class="click-tearm-condition">Terms & Conditions.</a></label>
         <?php echo $form->error($model, 'get_update'); ?>
    </div>
    
    
    <div class="a-center clearfix">
        <button type="submit" class="btn-3 GlobalEnquirySell">SEND ENQUIRY</button>
    </div>
</div>
<script type="text/javascript">
    $('#ProGlobalEnquiry_type_selling input').change(function() {
        $('#tenancy-content').hide();
        if ($(this).val() == 'Tenancy') {
            $('#tenancy-content').show();
            $('#tenancy-content input').each(function() {
                $(this).attr('checked', false);
                $(this).parent('span').removeClass('checked');
            });
        }
    });
    
    $('.Propety_type_sell').change(function(){
        var option = $('option:selected', this).attr('parent');
        var value  = $(this).val();
        if(option==28 || value ==28 || option==2 || value==2 || option==48 || value==48 ){
             $('.floor_area_sell').val('').hide();
             $('.floor_area_hide').hide();
        }else{
           $('.floor_area_sell').show();
           $('.floor_area_hide').show();
        }
    });

    /** Jan 29, 2015 ANH DUNG add for check Terms & Conditions- applies to Seller and Landlord only. 
     *  to validate form client
     * @param {boolean} hasError true neu co loi, false neu OK
     * @returns {Boolean}
     */
    function fnAnhDungCheckSell(hasError){
        var form = $('.GlobalEnquirySell').closest('form');
        var term_check = form.find('.term_agree').is(':checked');
        if( !term_check ){
            form.find('.term_agree').closest('div').find('.errorMessage').show();
        }else{
            form.find('.term_agree').closest('div').find('.errorMessage').hide();
        }
        if( !hasError && term_check ){
            return true;
        }
        return false;
    }
    
</script>    

<?php $this->endWidget(); ?>