<div class="box-login block">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
	'enableClientValidation' => true,
    'enableAjaxValidation'=>false,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
    <div class="row">
        <?php echo $form->textField($model,'email', array('placeholder'=>'Email')); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->passwordField($model,'password', array('placeholder'=>'Password')); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row rememberMe">
        <?php echo $form->checkBox($model,'rememberMe'); ?>
        <?php echo $form->label($model,'rememberMe'); ?>
        <?php echo $form->error($model,'rememberMe'); ?>
    </div>

    <input type="submit" value="Login"/>
    <ul>
        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/member/site/forgot_password') ?>">Forgot Password?</a></li>
        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/member/site/info_register'); ?>">Join Now!</a></li>
    </ul>
<?php $this->endWidget(); ?>
</div>