<div class="c1">
    <?php include '_form_c1_address.php';?>
    
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model,'property_type_1')); ?>
        <?php echo ProPropertyType::getDropDownSelectGroup('Listing[property_type_1]', 'Listing_property_type_1', $model->property_type_1, 'All property types', 'w-250'); ?>
        <?php echo $form->error($model,'property_type_1'); ?>
    </div>
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model,'unit_from')); ?>
        <div class="group-1">
            <?php echo $form->textField($model, 'unit_from', array('class' => '  w-60', 'placeholder' => '','style'=>'')); ?>
            -
             <?php echo $form->textField($model, 'unit_to', array('class' => '   w-60', 'placeholder' => '','style'=>'')); ?>
            <!--<span style="color:gray;"><i>Unit number will not be showed in your details.</i> </span>-->
        </div>
        <div class="clear" style='clear: both;'></div>
        <?php echo $form->error($model, 'unit_from'); ?>   
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'house_blk_no'); ?>
        <?php echo $form->textField($model,'house_blk_no',array('class'=>'w-250 ad_blk_no','maxlength'=>250)); ?>
        <?php echo $form->error($model,'house_blk_no'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'building_name'); ?>
        <?php echo $form->textField($model,'building_name',array('class'=>'w-250 ad_building_name','maxlength'=>250)); ?>
        <?php echo $form->error($model,'building_name'); ?>
    </div>
    <div class="row listing_type">
        <?php echo $form->labelEx($model,'listing_type'); ?>
        <?php
            echo $form->radioButtonList($model, 'listing_type', Listing::$aTextSaleRentNormal, array(
                'separator' => '',
                'class' => 'listing_type_rd',
            ));
        ?>
        <div class="clr"></div>
        <?php echo $form->error($model,'listing_type'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'company_owner_name'); ?>
        <?php echo $form->textField($model,'company_owner_name',array('class'=>'w-250','maxlength'=>250)); ?>
        <?php echo $form->error($model,'company_owner_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'contact_name_no'); ?>
        <?php echo $form->textField($model,'contact_name_no',array('class'=>'w-250','maxlength'=>250)); ?>
        <?php echo $form->error($model,'contact_name_no'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'company_email'); ?>
        <?php echo $form->textField($model,'company_email',array('class'=>'w-250','maxlength'=>250)); ?>
        <?php echo $form->error($model,'company_email'); ?>
    </div>        
    
    <style>
        .listing_type  input {float:left; margin-right: 10px;}
    </style>
    
    <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'dnc_expiry_date')); ?>
                <?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,        
                        'attribute'=>'dnc_expiry_date',
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=> ActiveRecord::getDateFormatJquery(),
//                            'minDate'=> '0',
//                            'maxDate'=> '0',
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showOn' => 'button',
                            'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                            'buttonImageOnly'=> true,                                
                        ),        
                        'htmlOptions'=>array(
                            'class'=>'w-100',
                            'style'=>'height:20px;',                                
                        ),
                    ));
                    ?>
                <?php echo $form->textField($model,'dnc_expiry_date_text',array('class'=>'w-120','maxlength'=>200)); ?>
		<?php echo $form->error($model,'dnc_expiry_date'); ?>
	</div> 

        <div class="row">
            <?php echo $form->labelEx($model,'remark'); ?>
            <?php echo $form->textArea($model,'remark',array('class'=>'w-250','maxlength'=>350)); ?>
            <?php echo $form->error($model,'remark'); ?>
        </div>
</div>