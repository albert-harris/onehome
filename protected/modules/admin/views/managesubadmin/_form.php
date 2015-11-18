<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php 
	// echo str_replace('<li>Salutation cannot be blank.</li>','', $form->errorSummary($model));
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>47,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>47,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="row">
                <?php if ($model->scenario == 'editAdmin'):?>
                    <div style="width: 100%;float: left;padding-bottom: 5px;padding-left: 120px;">
                        <label style="color: red;width: auto; ">Leave this blank if you don't want to change current password</label>
                    </div>
                <?php endif?>
		<?php echo $form->labelEx($model,'password_hash'); ?>
		<?php echo $form->passwordField($model,'password_hash',array('size'=>47,'maxlength'=>50,'value'=>'')); ?>
		<?php echo $form->error($model,'password_hash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_confirm'); ?>
		<?php echo $form->passwordField($model,'password_confirm',array('size'=>47,'maxlength'=>50,'value'=>'')); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>

    <div class="clr"></div>
    
    <div class="row">
            <?php echo $form->labelEx($model,'role_id'); ?>
            <?php echo $form->dropDownList($model,'role_id', Roles::loadItems(), array('empty'=>'Select')); ?>
            <?php echo $form->error($model,'role_id'); ?>
    </div>     
    
    <div class="row">
        <?php echo $form->labelEx($model,'first_name', array('label'=>'Full Name')); ?>
        <?php echo $form->textField($model,'first_name',array('size'=>20,'maxlength'=>50,'placeholder'=>'First Name')); ?>
        <?php echo $form->textField($model,'last_name',array('size'=>20,'maxlength'=>50,'placeholder'=>'Last Name')); ?>
        <?php //echo $form->error($model,'first_name'); ?>
        <?php echo $form->error($model,'last_name'); ?>
    </div>
    <div class="clr"></div>

    <div class="row">
        <?php echo $form->labelEx($model,'gender'); ?>
        <?php echo $form->dropDownList($model,'gender', Users::$gender); ?>
        <?php echo $form->error($model,'gender'); ?>
    </div>
	<div class="clr"></div>

    <div class="row">
        <?php echo $form->labelEx($model,'phone'); ?>
        <?php echo $form->textField($model,'phone',array('size'=>18,'maxlength'=>20)); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>
     <?php if(Yii::app()->controller->action->id == 'update'): ?>
    <?php if(Yii::app()->user->id != $_GET['id']): ?>
    <div class="row">
            <?php $status = Users::$requestStatus;unset($status[2]); echo $form->labelEx($model,'status'); ?>
            <?php echo $form->dropDownList($model,'status', $status); ?>
            <?php echo $form->error($model,'status'); ?>
    </div>
     <?php endif;?>
         <?php endif;?>
        
             <?php if(Yii::app()->controller->action->id == 'create'): ?>

    <div class="row">
            <?php $status = Users::$requestStatus;unset($status[2]); echo $form->labelEx($model,'status'); ?>
            <?php echo $form->dropDownList($model,'status', $status); ?>
            <?php echo $form->error($model,'status'); ?>
    </div>
     <?php endif;?>
        
    <div class="clr"></div>

	<div class="row buttons" style='margin-left: 60px;'>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->