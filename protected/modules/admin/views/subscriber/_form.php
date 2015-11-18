<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscriber-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
        <div class="row hidden">
		<?php echo $form->labelEx($model,'subscriber_group_id'); ?>
		<?php echo $form->textField($model,'subscriber_group_id',array('size'=>40,'maxlength'=>128,'value'=>1)); ?>
		<?php echo $form->error($model,'subscriber_group_id'); ?>
	</div>
<!--	<div class="row">
		<?php // echo $form->labelEx($model,'subscriber_group_id'); ?>
		<?php // echo $form->dropDownList($model,'subscriber_group_id', SubscriberGroup::loadItems(),array('empty'=>'Non Group')); ?>
		<?php // echo $form->error($model,'subscriber_group_id'); ?>
	</div>-->
        

	<div class="row buttons" style="margin-left: 60px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->