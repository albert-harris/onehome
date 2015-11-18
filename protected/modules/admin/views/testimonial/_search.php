<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>256)); ?>
	</div>
    
	<div class="row">
		<?php echo Yii::t('translation',$form->label($model,'type')); ?>
		<?php echo $form->dropDownList($model,'type', ProTestimonial::$ARR_TYPE, array('empty'=>'Select')); ?>
	</div>
	<div class="row">
		<?php echo Yii::t('translation',$form->label($model,'status')); ?>
		<?php echo $form->dropDownList($model,'status',array(null=>'All',1=>'Active',0=>'Inactive')); ?>
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