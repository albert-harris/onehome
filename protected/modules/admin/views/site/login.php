<?php $this->pageTitle=Yii::app()->name . ' - Login';?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admin-login-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username'); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row_align rememberMe">
        <?php echo $form->checkBox($model,'rememberMe'); ?>
        <?php echo $form->label($model,'rememberMe'); ?>
        <?php echo $form->error($model,'rememberMe'); ?>
    </div>

    <div class="row_align">
        <label>
            <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/site/ForgotPassword');?>" target="_blank">Forgot Password ?</a>
        </label>
    </div>

    <div class="row buttons" style="padding-left: 110px;padding-top: 10px;">
        <button type="submit">Login</button>
    </div>
    
    <?php $this->endWidget(); ?>
</div><!-- form -->
