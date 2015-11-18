<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_name'); ?>
		<?php echo $form->textField($model,'category_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'category_name'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'parent_id'); ?>
		<?php // echo Categories::getDropDownList('Categories[parent_id]','Categories_parent_id',$model->parent_id,true); ?>
		<?php // echo $form->error($model,'parent_id'); ?>
	</div>

        <div class="row buttons" style="padding-left: 122px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">

</script>	
</div><!-- form -->