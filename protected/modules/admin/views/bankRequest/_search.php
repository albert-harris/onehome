<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'property_name_or_address'); ?>
		<?php echo $form->textField($model,'property_name_or_address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'postal_code'); ?>
		<?php echo $form->textField($model,'postal_code',array('size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'location_id'); ?>
		<?php echo $form->dropDownList($model, 'location_id', ProLocation::getListDataLocation(),array('empty' => 'Select District', 'class'=>"select_bank")); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'property_type_id'); ?>
		<?php echo ProPropertyType::getDropDownSelectGroup('BankRequest[property_type_id]', 'BankRequest_property_type_id', $model->property_type_id,  'Select Property Type', 'select_bank'); ?>
	</div>

	<div class="row buttons" style="padding-left: 211px;">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>Yii::t('translation','Search'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<style>
    div.wide.form  label { width: 200px; }
    div.wide.form .select_bank { width: 500px; }
</style>