<style>#ProGlobalEnquiry_location_id {width:220px;}</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createAbsoluteUrl('/enquiry/sendGlobal'),
    'method' => 'post',
    'enableClientValidation' => true,
    'enableAjaxValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'class' => 'search-form',
        'enctype' => 'multipart/form-data',
    ),
        ));
?>
<?php echo $form->hiddenField($model, 'type_enquiry', array('value' => 'Buy')); ?>
<div id="engageBuy" class="sub-content" style="display:block">
    
    <?php /* echo $form->labelEx($model, 'listing_type', array('class' => 'lb')); ?>
    <ul class="list-check clearfix">
        <?php
        echo $form->radioButtonList($model, 'listing_type', array('Sale' => 'Sale', 'Rent' => 'Rent'), array(
            'separator' => '',
            'template' => '<li>{input}{label}</li>'
        ));
        ?>
    </ul>
    <?php */ ?>
    
    <?php echo $form->labelEx($model, 'property_type_id', array('label' => 'Type', 'class' => 'lb')); ?>    
    <?php // echo ProPropertyType::getDropDownSelectGroup('ProGlobalEnquiry[property_type_id]', 'ProGlobalEnquiry_property_type_id', $model->property_type_id, 'All property types'); ?>
    <?php $aData = array();
        $aData['zonechoosetype'] = 'type_engage_us';
        $aData['radio_id'] = 'EngageUsBuyRadioId';
        $aData['checkbox_id'] = 'EngageUsBuyCheckboxId';
        $aData['model'] = $model;
        $this->widget('ext.ProPropertyTypeExt.ProPropertyTypeExt',
                            array('data'=>$aData));
    ?>
    

    <?php echo $form->labelEx($model, 'location_id', array('label' => 'Location', 'class' => 'lb')); ?>
    <?php // echo $form->dropDownList($model, 'location_id', ProLocation::getListDataLocation(), array('empty' => 'All locations in Singapore')); ?>
    <div class="wrap_multiselect_location display_none">
        <?php                
            echo CHtml::dropDownList('location_list_id[]', '',
                ProLocation::getListDataLocation(), 
                array('class'=>'multiselect_location_buy','multiple'=>'multiple')); 
        ?>
    </div>    
    <?php echo $form->error($model, 'location_id'); ?>

    <?php echo $form->labelEx($model, 'price', array('label'=>'Price','class' => 'lb')); ?>
    <div class="clearfix">
        <div class="col-1">
            <?php echo $form->dropDownList($model, 'min_price', ProMasterPrice::getListOption(ProMasterPrice::PRICE_FOR_SALE), array('empty' => 'Minimum', 'id'=>'minimum_price_engage', 'class'=>'enquiry_minimum_price')); ?>
        </div>
        <div class="col-2">
            <?php echo $form->dropDownList($model, 'max_price', ProMasterPrice::getListOption(ProMasterPrice::PRICE_FOR_SALE), array('empty' => 'Maximum', 'id'=>'maximum_price_engage', 'class'=>'enquiry_maximum_price')); ?>
        </div>
        <?php echo $form->error($model, 'min_price'); ?>
        <?php echo $form->error($model, 'max_price'); ?>
    </div>

    <?php echo $form->labelEx($model, 'bedrooms', array('label' => 'Bedrooms', 'class' => 'lb')); ?>
    <div class="clearfix">
        <div class="col-1">
             <?php // echo $form->dropDownList($model, 'min_bedroom', Listing::getDropdownlistWithTableName('ProMasterBedroom','value','value'), array('empty' => 'Minimum')); ?>
             <?php echo $form->dropDownList($model, 'min_bedroom', Listing::getListOptionsBedroom(), array('empty' => 'Minimum', 'id'=>'minimum_bedroom_engage')); ?>
        </div>
        <div class="col-2">
             <?php // echo $form->dropDownList($model, 'max_bedroom', Listing::getDropdownlistWithTableName('ProMasterBedroom','value','value'), array('empty' => 'Maximum')); ?>
             <?php echo $form->dropDownList($model, 'max_bedroom', Listing::getListOptionsBedroom(), array('empty' => 'Maximum', 'id'=>'maximum_bedroom_engage')); ?>
        </div>
        <?php echo $form->error($model, 'min_bedroom'); ?>
        <?php echo $form->error($model, 'max_bedroom'); ?>
    </div>

    <?php echo $form->labelEx($model, 'floor_size', array('label' => 'Floor Size', 'class' => 'lb')); ?>
    <div class="clearfix">
        <div class="col-1">
             <?php echo $form->dropDownList($model, 'min_floor_size', ProMasterFloor::getListOption(), array('empty' => 'Minimum', 'id'=>'minimum_floor_engage')); ?>
        </div>
        <div class="col-2">
             <?php echo $form->dropDownList($model, 'max_floor_size', ProMasterFloor::getListOption(), array('empty' => 'Maximum', 'id'=>'maximum_floor_engage')); ?>
        </div>
        <?php echo $form->error($model, 'min_floor_size'); ?>
        <?php echo $form->error($model, 'max_floor_size'); ?>
    </div>
    
    <?php echo $form->labelEx($model, 'furnished', array( 'class' => 'lb')); ?>
    <?php echo $form->dropDownList($model,'furnished',ProMasterFurnished::getListData('enquiry'),array('empty'=>'Select Furnished '));?>
    <?php echo $form->error($model, 'furnished'); ?>     
    <?php // echo $form->labelEx($model,'furnishing_include',array('label'=>'Furnishing ','class'=>'lb')); ?>
    <?php // echo $form->dropDownList($model,'furnishing_include', ProMasterFurnishingIncluded::getDropdownList('id','name'),array('class'=>'multiselect','multiple'=>'multiple') );?>  
    <?php // echo $form->error($model,'furnishing_include'); ?>  
    
    <?php // echo $form->labelEx($model, 'remark', array('class' => 'lb')); ?>
    <?php // echo $form->textArea($model, 'remark', array('rows'=>1, 'class' => 'text', 'maxlength' => 500)); ?>
    
    <div class="in-row clearfix">
        <!--<label class="lb">Enquiry <span class="require">*</span></label>-->
        <label class="lb">Enquiry</label>
        <?php echo $form->textField($model, 'name', array('class' => 'text', 'placeholder' => 'Full Name')); ?>
        <?php echo $form->error($model, 'name'); ?>
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
        <?php echo $form->checkBox($model, 'get_update', array('class' => 'term_agree')); ?>
        <label class="lb-3">I agree <a href="javascript:;" data-target="#myModal" class="click-tearm-condition">Terms & Conditions.</a></label>
        <?php echo $form->error($model, 'get_update'); ?>
    </div>
    
    
    
    <div class="a-center clearfix">
        <button type="submit" class="btn-3">SEND ENQUIRY</button>
    </div>
</div>
<?php $this->endWidget(); ?>