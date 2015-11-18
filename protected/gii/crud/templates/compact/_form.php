<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<?php echo "<?php echo Yii::t('translation', '<p class=\"note\">Fields with <span class=\"required\">*</span> are required.</p>'); ?>"; ?>

	<?php /*echo "<?php echo \$form->errorSummary(\$model); ?>\n"; */?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<div class="row">
		<?php echo "<?php echo Yii::t('translation', ".$this->generateActiveLabel($this->modelClass,$column)."); ?>\n"; ?>
		<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
		<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
	</div>

<?php
}
?>
	<div class="row buttons" style="padding-left: 115px;">
		<?php //echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save')); ?>
        <?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>\$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->