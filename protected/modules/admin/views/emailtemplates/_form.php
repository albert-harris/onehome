<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: _form.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'email-templates-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email_subject'); ?>
		<?php echo $form->textField($model,'email_subject',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parameter_description'); ?>
		<?php echo $form->textArea($model,'parameter_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'parameter_description'); ?>
	</div>	
	
	<div class="row">
		<?php echo $form->labelEx($model,'email_body'); ?>
		<div style="float:left;">
		 <?php 
			$this->widget('ext.ckeditor.CKEditorWidget',array(
				"model"=>$model,
				"attribute"=>'email_body',
				
				"config" => array(
					"height"=>"250px",
					"width"=>"700px",
					"toolbar"=>Yii::app()->params['ckeditor']
				)
			));  
		?>
		</div>
		<?php echo $form->error($model,'email_body'); ?>
	</div>
	<div class='clr'></div>

        <div class="row" style="display: none;">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<style>
    .buttons input{
        margin-left: 61px;
    }
</style>