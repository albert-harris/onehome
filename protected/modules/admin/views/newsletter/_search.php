<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
<!--		<button type="submit">Search</button>-->
                <span class="btn-submit"><?php echo CHtml::submitButton(Yii::t('translation','Search')); ?></span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->