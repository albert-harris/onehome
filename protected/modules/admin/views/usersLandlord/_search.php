<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'nric_passportno_roc'); ?>
		<?php echo $form->textField($model,'nric_passportno_roc',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_type'); ?>
		<?php echo $form->dropDownList($model,'id_type', Users::$aIdType, array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'id_type'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'email_not_login'); ?>
		<?php echo $form->textField($model,'email_not_login',array('size'=>60,'maxlength'=>100)); ?>
	</div>    
    
	<div class="row">
		<?php // echo $form->label($model,'contact_no'); ?>
		<?php // echo $form->textField($model,'contact_no',array('size'=>60,'maxlength'=>100)); ?>
	</div>    
    
	<div class="row">
		<?php // echo $form->label($model,'address'); ?>
		<?php // echo $form->textField($model,'address',array('size'=>60,'maxlength'=>100)); ?>
	</div>    
    
	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', CmsFormatter::$statusVar, array('empty'=>'Select')); ?>
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