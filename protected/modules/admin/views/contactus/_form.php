<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-contact-us-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'enquiry_type')); ?>
		<?php echo $form->textField($model,'enquiry_type'); ?>
		<?php echo $form->error($model,'enquiry_type'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'name')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'position')); ?>
		<?php echo $form->textField($model,'position',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'company')); ?>
		<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'telephone')); ?>
		<?php echo $form->textField($model,'telephone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'email_adress')); ?>
		<?php echo $form->textField($model,'email_adress',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_adress'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'message')); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message'); ?>
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