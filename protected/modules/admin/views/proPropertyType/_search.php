<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'name',array('label' => Yii::t('translation','Name'))); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row hide_type display_none">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', ProPropertyType::$TYPE_GURU,array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'status',array('label' => Yii::t('translation','Status'))); ?>
		<?php echo $form->dropDownList($model,'status', CmsFormatter::$statusVar,array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parent_id'); ?>
		<?php echo ProPropertyType::getDropDownList('ProPropertyType[parent_id]','ProPropertyType_parent_id',$model->parent_id,true); ?>
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