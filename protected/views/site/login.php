<?php if($role == ROLE_AGENT): ?>
    <h1 class="title-page">AGENT LOG IN</h1>
<?php elseif($role == ROLE_TENANT): ?>
    <h1 class="title-page">TENANT LOG IN</h1>
<?php elseif($role == ROLE_LANDLORD): ?>
    <h1 class="title-page">LANDLORD LOG IN</h1>
<?php else: ?>
    <h1 class="title-page">USER LOG IN</h1>
<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'enableClientValidation'=>false,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions'=>array('class'=>'form-type login-form'),

)); ?>

    <div class="clearfix">
        <?php if($role == ROLE_AGENT): ?>
            <h2>Are you an agent  of the PropertyInfologic? Please enter your FIN/NRIC and password below and Click login button.</h2>
        <?php elseif($role == ROLE_TENANT): ?>
            <h2>Are you an tanent  of the PropertyInfologic? Please enter your FIN/NRIC and password below and Click login button.</h2>
        <?php elseif($role == ROLE_LANDLORD): ?>
            <h2>Are you an landlord  of the PropertyInfologic? Please enter your FIN/NRIC and password below and Click login button.</h2>
        <?php else: ?>
            <h2>Are you an user  of the PropertyInfologic? Please enter your email and password below and Click login button.</h2>
        <?php endif; ?>

        <p class="note"><em>Fields with <span class="require">*</span> are required.</em></p>
    </div>
    <div class="in-row clearfix">
        <?php if($role == ROLE_AGENT || $role == ROLE_TENANT || $role == ROLE_LANDLORD): ?>
            <label class="lb-1"><span class="require">*</span> FIN / NRIC :</label>
        <?php else: ?>
            <label class="lb-1"><span class="require">*</span> Email :</label>
        <?php endif; ?>
        <div class="group-1">
            <?php if($role == ROLE_AGENT || $role == ROLE_TENANT || $role == ROLE_LANDLORD): ?>
                <?php echo $form->textField($model,'nric', array('class'=>'text')); ?>
                <?php echo $form->error($model,'nric'); ?>
            <?php else: ?>
                <?php echo $form->textField($model,'email', array('class'=>'text')); ?>
                <?php echo $form->error($model,'email'); ?>
            <?php endif; ?>

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
                <p class="space-4"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/forgot_password', array('role'=>$role)) ?>">Forgot your password?</a></p>
            </div>
            <button type="submit" class="btn-3">Login</button>
        </div>
    </div>
<?php $this->endWidget(); ?>

