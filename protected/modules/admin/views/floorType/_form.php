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
<!--<div class="row">
    <label for="Pages_title">Name<span class="required">*</span></label>
    <?php // echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 63)); ?>
    <?php // echo $form->error($model, 'name'); ?>
</div>-->
<div class="row">
    <label for="Pages_title">Value<span class="required">*</span></label>
    <?php echo $form->textField($model, 'value', array('size' => 60, 'maxlength' => 63)); ?>
    <?php echo $form->error($model, 'value'); ?>
</div>
<div class="row buttons" style="padding-left:121px;">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>
<?php $this->endWidget(); ?>
</div>



