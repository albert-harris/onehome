<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
            <?php echo $form->label($model, 'name'); ?>
            <?php echo $form->textField($model, 'name',array('size'=>60,'maxlength'=>100)); ?>
	</div>
        <div class="row buttons" style="margin-left: 50px;">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->


