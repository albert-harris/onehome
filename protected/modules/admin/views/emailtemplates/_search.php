<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: _search.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'email_subject'); ?>
		<?php echo $form->textField($model,'email_subject',array('size'=>60,'maxlength'=>255)); ?>
	</div>
<!-- 
	<div class="row">
		<?php echo $form->label($model,'email_body'); ?>
		<?php echo $form->textField($model,'email_body',array('size'=>60,'maxlength'=>255)); ?>
	</div>
 -->
	<div class="row">
		<?php echo $form->label($model,'parameter_description'); ?>
		<?php echo $form->textField($model,'parameter_description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons btn-submit">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->