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
		<?php echo Yii::t('translation', $form->labelEx($model,'ic_number')); ?>
		<?php echo $form->textField($model,'ic_number',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ic_number'); ?>
	</div>
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'id_type')); ?>
		<?php echo $form->dropDownList($model,'id_type', Users::$aIdType, array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'id_type'); ?>
	</div>
    
        <div class="row pass_expiry_date">
		<?php echo Yii::t('translation', $form->labelEx($model,'pass_expiry_date')); ?>
                <?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,        
                        'attribute'=>'pass_expiry_date',
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
                            'class'=>'w-16',
                            'style'=>'height:20px;width:166px;',
                                'readonly'=>'readonly',
                        ),
                    ));
                ?>     		
		<?php echo $form->error($model,'pass_expiry_date'); ?>
	</div>     
    
        <div class="row scanned_employment_pass">
		<?php echo Yii::t('translation', $form->labelEx($model,'upload_employment_pass_passport')); ?>
		<?php echo $form->fileField($model,'upload_employment_pass_passport',array()); ?>
                <span>Only <?php echo Users::$AllowFile ;?> are allow</span>
                <?php if(!$model->isNewRecord && $model->upload_employment_pass_passport!=''):?>
                <p style="text-align: left;padding-left: 126px;">
                    <br>
                    <span>Current File <?php echo $model->upload_employment_pass_passport;?></span>
                    <br/> 
                    <input type="checkbox" name="delete_current_pass_passport" class="delete_current_image">
                    Delete Current File
                </p>
                <?php endif;?>
		<?php echo $form->error($model,'upload_employment_pass_passport'); ?>
	</div>    
    
        <div class="row scanned_passport">
		<?php echo Yii::t('translation', $form->labelEx($model,'scanned_passport')); ?>
		<?php echo $form->fileField($model,'scanned_passport',array()); ?>
                <span>Only <?php echo Users::$AllowFile ;?> are allow</span>
                <?php if(!$model->isNewRecord && $model->scanned_passport!=''):?>
                <p style="text-align: left;padding-left: 126px;">
                    <br>
                    <span>Current File <?php echo $model->scanned_passport;?></span>
                    <br/> 
                    <input type="checkbox" name="delete_scanned_passport" class="delete_current_image">
                    Delete Current File
                </p>
                <?php endif;?>
		<?php echo $form->error($model,'scanned_passport'); ?>
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
                        <input type="checkbox" name="delete_current_image" class="delete_current_image">
                        Delete Current Avatar
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
    
        <div class="row ">
		<?php echo Yii::t('translation', $form->labelEx($model,'expiration_date')); ?>
                <?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,        
                        'attribute'=>'expiration_date',
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=> ActiveRecord::getDateFormatJquery(),
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showOn' => 'button',
                            'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                            'buttonImageOnly'=> true,                                
                        ),        
                        'htmlOptions'=>array(
                            'class'=>'w-16',
                            'style'=>'height:20px;width:166px;',
                                'readonly'=>'readonly',
                        ),
                    ));
                ?>     		
		<?php echo $form->error($model,'expiration_date'); ?>
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


<script>
    $(document).ready(function() {
//        $('#Users_id_type').change(function(){
//            if($(this).val() == <?php // echo Users::ID_TYPE_EP;?> || $(this).val() == <?php // echo Users::ID_TYPE_SPASS;?>){
//                if($('.pass_expiry_date').find('label:first').find('span').size()<1){
//                    $('.pass_expiry_date').find('label:first').append('<span class="required"> *</span>');
//                }
//                if($('.scanned_passport').find('label:first').find('span').size()<1){
//                    $('.scanned_passport').find('label:first').append('<span class="required"> *</span>');
//                }
//                if($('.scanned_employment_pass').find('label:first').find('span').size()<1){
//                    $('.scanned_employment_pass').find('label:first').append('<span class="required"> *</span>');
//                }
//            }else{
//                $('.pass_expiry_date').find('label:first').find('span').remove();
//                $('.scanned_passport').find('label:first').find('span').remove();
//                $('.scanned_employment_pass').find('label:first').find('span').remove();
//            }
//        });
        
        <?php // if($model->id_type==Users::ID_TYPE_EP || $model->id_type==Users::ID_TYPE_SPASS):?>
//            $('#Users_id_type').trigger('change');
        <?php // endif;?>
       
       
       // From Jan 16, 2015
       $('#Users_id_type').change(function(){
            if($(this).val() !== '<?php echo Users::ID_TYPE_CITIZENSHIP;?>' && 
                    $(this).val() !== '<?php echo Users::ID_TYPE_SPR;?>'){
                if($('.pass_expiry_date').find('label:first').find('span').size()<1){
                    $('.pass_expiry_date').find('label:first').append('<span class="required"> *</span>');
                }
                if($('.scanned_passport').find('label:first').find('span').size()<1){
                    $('.scanned_passport').find('label:first').append('<span class="required"> *</span>');
                }
                if($('.scanned_employment_pass').find('label:first').find('span').size()<1){
                    $('.scanned_employment_pass').find('label:first').append('<span class="required"> *</span>');
                }
            }else{
                $('.pass_expiry_date').find('label:first').find('span').remove();
                $('.scanned_passport').find('label:first').find('span').remove();
                $('.scanned_employment_pass').find('label:first').find('span').remove();
            }
        });
        
        <?php if( $model->id_type!='' && ( $model->id_type!==Users::ID_TYPE_CITIZENSHIP 
                || $model->id_type!==Users::ID_TYPE_SPR) ):?>
            $('#Users_id_type').trigger('change');
        <?php endif;?>
       // From Jan 16, 2015
       
    });
    
</script>