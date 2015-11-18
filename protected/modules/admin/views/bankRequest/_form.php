<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bank-request-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'property_name_or_address')); ?>
		<?php echo $form->textField($model,'property_name_or_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'property_name_or_address'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'postal_code')); ?>
		<?php echo $form->textField($model,'postal_code',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'postal_code'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'unit_from')); ?>
		<?php echo $form->textField($model,'unit_from'); ?>
		<?php echo $form->error($model,'unit_from'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'unit_to')); ?>
		<?php echo $form->textField($model,'unit_to'); ?>
		<?php echo $form->error($model,'unit_to'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'location_id')); ?>
		<?php echo $form->textField($model,'location_id'); ?>
		<?php echo $form->error($model,'location_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'property_type_id')); ?>
		<?php echo $form->textField($model,'property_type_id'); ?>
		<?php echo $form->error($model,'property_type_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'tenure')); ?>
		<?php echo $form->textField($model,'tenure',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tenure'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'furnished')); ?>
		<?php echo $form->textField($model,'furnished'); ?>
		<?php echo $form->error($model,'furnished'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'of_bathrooms')); ?>
		<?php echo $form->textField($model,'of_bathrooms'); ?>
		<?php echo $form->error($model,'of_bathrooms'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'of_bedroom')); ?>
		<?php echo $form->textField($model,'of_bedroom'); ?>
		<?php echo $form->error($model,'of_bedroom'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'type_selling')); ?>
		<?php echo $form->textField($model,'type_selling',array('size'=>17,'maxlength'=>17)); ?>
		<?php echo $form->error($model,'type_selling'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'floor_area')); ?>
		<?php echo $form->textField($model,'floor_area',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'floor_area'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'tenancy_expiry_date')); ?>
		<?php echo $form->textField($model,'tenancy_expiry_date',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'tenancy_expiry_date'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'monthly_rental_amount')); ?>
		<?php echo $form->textField($model,'monthly_rental_amount'); ?>
		<?php echo $form->error($model,'monthly_rental_amount'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'remark')); ?>
		<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'nric')); ?>
		<?php echo $form->textField($model,'nric',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nric'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'owner_particular')); ?>
		<?php echo $form->textField($model,'owner_particular',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'owner_particular'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'fullname')); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fullname'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'contact_no')); ?>
		<?php echo $form->textField($model,'contact_no',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_no'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'email')); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'target_price')); ?>
		<?php echo $form->textField($model,'target_price',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'target_price'); ?>
	</div>

	<div class="row buttons" style="padding-left: 115px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->