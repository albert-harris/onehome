<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'date',array('label' => Yii::t('translation','Date'))); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time_of_call',array('label' => Yii::t('translation','Time_of_call'))); ?>
		<?php echo $form->textField($model,'time_of_call'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'received_by',array('label' => Yii::t('translation','Received_by'))); ?>
		<?php echo $form->textField($model,'received_by',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description',array('label' => Yii::t('translation','Description'))); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'person_called',array('label' => Yii::t('translation','Person_called'))); ?>
		<?php echo $form->textField($model,'person_called',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transaction_id',array('label' => Yii::t('translation','Transaction_id'))); ?>
		<?php echo $form->textField($model,'transaction_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status',array('label' => Yii::t('translation','Status'))); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'person_call_type',array('label' => Yii::t('translation','Person_call_type'))); ?>
		<?php echo $form->textField($model,'person_call_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone',array('label' => Yii::t('translation','Phone'))); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons" style="padding-left: 159px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>Yii::t('translation','Search'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->