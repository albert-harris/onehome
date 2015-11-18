<div class="form">
<?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'floor-type-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    ));
?>
<p class="note">Fields with <span class="required">*</span> are required.</p>
<div class="row">
    <?php echo Yii::t('translation', $form->labelEx($model,'name')); ?>
    <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 63)); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>
<div class="row">
    <?php echo Yii::t('translation', $form->labelEx($model,'value')); ?>
    <?php echo $form->textField($model, 'value', array('size' => 60, 'maxlength' => 63)); ?>
    <?php echo $form->error($model, 'value'); ?>
</div>
<div class="row buttons" style="padding-left:121px;">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>
<?php $this->endWidget(); ?>
</div>



