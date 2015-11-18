<h1 class="title-page">TENANT LOG IN</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'enableClientValidation'=>false,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions'=>array('class'=>'form-type login-form'),

)); ?>
    <div class="clearfix">

        <h2>Are you a tenant  of the OneHome Property? Please enter your FIN/NRIC and password below and Click login button.</h2>
        <p class="note"><em>Fields with <span class="require">*</span> are required. </em></p>
    </div>
    <div class="in-row clearfix">
        <!--<label class="lb-1"><span class="require">*</span> FIN / NRIC :</label>-->
        <label class="lb-1"><span class="require">*</span> Login ID :</label>
        
        <div class="group-1">
            <?php echo $form->textField($model,'nric', array('class'=>'text')); ?>
            <?php echo $form->error($model,'nric'); ?>
        </div>
    </div>
    <div class="in-row clearfix">
        <label class="lb-1"><span class="require">*</span> Password :</label>
        <div class="group-1">
            <?php echo $form->passwordField($model,'password', array('class'=>'text')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
    </div>
    <div class="in-row clearfix">
        <label class="lb-1"></label>
        <div class="group-1">
            <div class="f-left">
                <?php echo $form->checkBox($model,'rememberMe'); ?>
                <?php echo $form->label($model,'rememberMe', array('label'=>'Remember me', 'id'=>'label_right')); ?>
                <?php echo $form->error($model,'rememberMe'); ?>
                <p class="space-4"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/tenant_forgot_password') ?>">Forgot your password?</a></p>
            </div>
            <button type="submit" class="btn-3">Login</button>
        </div>
    </div>
<?php $this->endWidget(); ?>

