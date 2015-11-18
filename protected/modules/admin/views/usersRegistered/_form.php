<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
        <div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->dropDownList($model,'title', CmsFormatter::$TITLE_MR, array('empty'=>'Select')); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>    

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'first_name')); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'last_name')); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'nric_passportno_roc')); ?>
		<?php echo $form->textField($model,'nric_passportno_roc',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nric_passportno_roc'); ?>
	</div>
    

	<div class="row">
                <?php if (!$model->isNewRecord):?>
                    <div style="width: 100%;float: left;padding-bottom: 5px;padding-left: 120px;">
                        <label style="color: red;width: auto; ">Leave this blank if you don't want to change current password</label>
                    </div>
                <?php endif?>                        
		<?php echo Yii::t('translation', $form->labelEx($model,'password_hash')); ?>
		<?php echo $form->passwordField($model,'password_hash',array('size'=>60,'maxlength'=>100, 'value'=>'')); ?>
		<?php echo $form->error($model,'password_hash'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'password_confirm')); ?>
		<?php echo $form->passwordField($model,'password_confirm',array('size'=>30,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'email')); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>    
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'phone')); ?>
		<?php echo $form->dropDownList($model,'area_code_id', AreaCode::getAreaCode(), array('style'=>'width:200px;' , 'empty'=>'Select')); ?>
		<?php echo $form->textField($model,'phone',array('style'=>'width:200px;','maxlength'=>50)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>    

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'address')); ?>
		<?php echo $form->textArea($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>    

        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'postal_code')); ?>
		<?php echo $form->textField($model,'postal_code',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'postal_code'); ?>
	</div>        
    
        <div class="row">
            <?php echo $form->labelEx($model,'country_id'); ?>
            <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('empty'=>'Select')); ?>
            <?php echo $form->error($model,'country_id'); ?>
        </div>    
    
        <div class="row">
            <?php echo $form->labelEx($model,'is_subscriber'); ?>
            <?php echo $form->dropDownList($model,'is_subscriber', CmsFormatter::$yesNoFormat, array()); ?>
            <?php echo $form->error($model,'is_subscriber'); ?>
        </div>    
    
        <div class="row">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->dropDownList($model,'status', CmsFormatter::$statusVar, array()); ?>
            <?php echo $form->error($model,'status'); ?>
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