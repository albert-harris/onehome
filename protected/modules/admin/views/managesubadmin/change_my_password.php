<?php
$this->breadcrumbs=array(
	'Change my password',
);
?>

<h1>Change My Password</h1>

<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>

<?php if(Yii::app()->user->hasFlash('successChangeMyPassword')):?>
    <div class="info" style="widows:600px;height:50px; color:#FF0000;font-weight:bold;text-align:center; font-size:24px;margin-top:30px;">
        <?php echo Yii::app()->user->getFlash('successChangeMyPassword'); ?>
    </div>
<?php endif; ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-model-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'currentpassword',array('style'=>'width:180px;')); ?>
		<?php echo $form->passwordField($model,'currentpassword',array('size'=>38,'maxlength'=>250)); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model,'newpassword',array('style'=>'width:180px;')); ?>
		<?php echo $form->passwordField($model,'newpassword',array('size'=>38,'maxlength'=>250)); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'password_confirm',array('label'=>'Confirm New Password','style'=>'width:180px;')); ?>
		<?php echo $form->passwordField($model,'password_confirm',array('size'=>38,'maxlength'=>250)); ?>
	</div>

        <div class="row buttons" style="padding-left: 135px;padding-top: 15px;">
            <span class="btn-submit"> <?php echo CHtml::submitButton('Save'); ?></span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->