<div class="form">
<?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pages-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    ));
?>
<p class="note">Fields with <span class="required">*</span> are required.</p>
<div class="row">
    <label for="Pages_title">Name<span class="required">*</span></label>
    <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 100)); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>
<div class="row">
   <label class="required" >First Tier(%)<span class="required">*</span></label>
    <?php echo $form->textField($model, 'first_tier'); ?>
    <?php echo Yii::t('translation',$form->error($model, 'first_tier')); ?> 
</div>
<div class="row">
   <label class="required" >Second Tier(%)<span class="required">*</span></label>
    <?php echo $form->textField($model, 'second_tier'); ?>
    <?php echo Yii::t('translation',$form->error($model, 'second_tier')); ?> 
</div>
<div class="row buttons" style="padding-left:121px;">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>
<?php $this->endWidget(); ?>
</div>



