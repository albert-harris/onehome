<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'first_name')); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'first_name'); ?>
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
		<?php echo Yii::t('translation', $form->labelEx($model,'id_type')); ?>
		<?php echo $form->dropDownList($model,'id_type', Users::$aIdType, array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'id_type'); ?>
	</div>
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'email_not_login')); ?>
		<?php echo $form->textField($model,'email_not_login',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email_not_login'); ?>
	</div>    

        <div class="row display_none">
		<?php echo Yii::t('translation', $form->labelEx($model,'avatar')); ?>
		<?php echo $form->fileField($model,'avatar',array()); ?>
                <span>Only <?php echo Users::$AllowFileAvatar ;?> are allow</span>
                <?php if (!$model->isNewRecord && $model->avatar != ''): ?>
                    <p style="text-align: left;padding-left: 126px;">
                        <img src="<?php echo ImageProcessing::bindImageByModel($model, 100, 100, array('avatar'=>1)); ?>">                            
                        <br/> 
        <!--                <input type="checkbox" name="delete_current_image" class="delete_current_image">
                        Delete Current Image-->
                    </p>
                    <script>
                        $('.delete_current_image').click(function() {
                            if ($(this).is(':checked')) {
                                $(this).parent('p').parent('div').find('input:file').hide().val('');
                            } else
                                $(this).parent('p').parent('div').find('input:file').show();
                        });



                    </script>
                <?php endif ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>    
    
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'contact_no')); ?>
		<?php echo $form->textField($model,'contact_no',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_no'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'postal_code')); ?>
		<?php echo $form->textField($model,'postal_code',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'postal_code'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'address')); ?>
		<?php echo $form->textArea($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
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