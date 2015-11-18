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
    <?php echo $form->labelEx($model,'name'); ?>
    <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 100)); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>
<div class="row">
   <?php echo $form->labelEx($model,'percent'); ?>
    <?php echo $form->textField($model, 'percent', array('maxlength'=>5)); ?>
    <?php echo Yii::t('translation',$form->error($model, 'percent')); ?> 
</div>
<div class="row">
   <?php echo $form->labelEx($model,'first_tier'); ?>
    <?php echo $form->textField($model, 'first_tier', array('maxlength'=>5)); ?>
    <?php echo Yii::t('translation',$form->error($model, 'first_tier')); ?> 
</div>
<div class="row">
   <?php echo $form->labelEx($model,'second_tier'); ?>
    <?php echo $form->textField($model, 'second_tier', array('maxlength'=>5)); ?>
    <?php echo Yii::t('translation',$form->error($model, 'second_tier')); ?> 
</div>
<div class="row display_none">
   <?php echo $form->labelEx($model,'commission_received'); ?>
    <?php echo $form->textField($model, 'commission_received', array('maxlength'=>200)); ?>
    <?php echo Yii::t('translation',$form->error($model, 'commission_received')); ?> 
</div>
<div class="row buttons" style="padding-left:135px;">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>
<?php $this->endWidget(); ?>
</div>


<style>
  div.form .row label { width: 135px !important; }
    
</style>

