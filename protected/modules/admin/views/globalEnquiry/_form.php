<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-global-enquiry-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'type_enquiry')); ?>
		<?php echo $form->textField($model,'type_enquiry',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'type_enquiry'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'property_type_id')); ?>
		<?php echo $form->textField($model,'property_type_id'); ?>
		<?php echo $form->error($model,'property_type_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'location_id')); ?>
		<?php echo $form->textField($model,'location_id'); ?>
		<?php echo $form->error($model,'location_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'price')); ?>
		<?php echo $form->textField($model,'price',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'bedrooms')); ?>
		<?php echo $form->textField($model,'bedrooms',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'bedrooms'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'floor_size')); ?>
		<?php echo $form->textField($model,'floor_size',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'floor_size'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'tenure')); ?>
		<?php echo $form->textField($model,'tenure',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'tenure'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'address')); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'postal_code')); ?>
		<?php echo $form->textField($model,'postal_code',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'postal_code'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'HDB_own_estate')); ?>
		<?php echo $form->textField($model,'HDB_own_estate',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'HDB_own_estate'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'unit')); ?>
		<?php echo $form->textField($model,'unit',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'unit'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'official_bank_val')); ?>
		<?php echo $form->textField($model,'official_bank_val',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'official_bank_val'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'floor_area')); ?>
		<?php echo $form->textField($model,'floor_area',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'floor_area'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'listing_description')); ?>
		<?php echo $form->textArea($model,'listing_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'listing_description'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'furnished')); ?>
		<?php echo $form->textField($model,'furnished',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'furnished'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'floor')); ?>
		<?php echo $form->textField($model,'floor',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'floor'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'lease_term')); ?>
		<?php echo $form->textField($model,'lease_term',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'lease_term'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'bathrooms')); ?>
		<?php echo $form->textField($model,'bathrooms',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bathrooms'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'special_features')); ?>
		<?php echo $form->textField($model,'special_features',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'special_features'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'rent_type')); ?>
		<?php echo $form->textField($model,'rent_type',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'rent_type'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'availability')); ?>
		<?php echo $form->textField($model,'availability',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'availability'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'name')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'email')); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'phone')); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'country_id')); ?>
		<?php echo $form->textField($model,'country_id'); ?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'created_date')); ?>
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
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