<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>63)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'show_footer'); ?>
		<?php echo $form->dropDownList($model,'show_footer',  array(''=>'Select', 1 =>'Show',0 => 'Unshow')); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', array(''=>'Select', 1 =>'Active',0 => 'Inactive')); ?>
	</div>

    <div class="row buttons" style="margin-left: 50px;">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->