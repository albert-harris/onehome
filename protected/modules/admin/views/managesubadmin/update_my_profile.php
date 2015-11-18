<?php
$this->breadcrumbs=array(
	'Update my profile',
);
?>

<h1>Update My Profile</h1>

<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>

<?php if(Yii::app()->user->hasFlash('successUpdateMyProfile')):?>
    <div class="info" style="widows:600px;height:50px; color:#FF0000;font-weight:bold;text-align:center; font-size:24px;margin-top:30px;">
        <?php echo Yii::app()->user->getFlash('successUpdateMyProfile'); ?>
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
                <?php //echo $form->labelEx($model,'currentpassword'); ?>
		<?php //echo $form->passwordField($model,'currentpassword',array('size'=>38,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>38,'maxlength'=>250)); ?>
	</div>

        <div class="row">
            <?php echo $form->labelEx($model,'first_name', array('label'=>'Full Name')); ?>
            <?php echo $form->textField($model,'first_name',array('size'=>20,'maxlength'=>50,'placeholder'=>'First Name')); ?>
            <?php echo $form->textField($model,'last_name',array('size'=>20,'maxlength'=>50,'placeholder'=>'Last Name')); ?>
            <?php echo $form->error($model,'first_name'); ?>
            <?php echo $form->error($model,'last_name'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'phone'); ?>
            <?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
            <?php echo $form->error($model,'phone'); ?>
        </div>
	<div class="row buttons">
        <span class="btn-submit"> <?php echo CHtml::submitButton('Save'); ?></span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->