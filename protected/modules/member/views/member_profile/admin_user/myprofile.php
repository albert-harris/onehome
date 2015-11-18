<?php
/**
 * Created by PhpStorm.
 * User: JasonHai
 * Date: 4/3/14
 * Time: 1:30 PM
 */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'changepwd-form',
    'enableClientValidation' => true,
//        'enableAjaxValidation' => false,
//        'clientOptions' => array(
//                  'validateOnSubmit' => true,
//                ),
)); ?>

<div class="clearfix" style="text-align:center;font-weight:bold;font-size:14px;">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<div class="box-1 space-3">
    <div class="title"><h3>Login Information</h3></div>
    <div class="form-type content">

        <div class="in-row clearfix">
            <label class="lb">NRIC/FIN/PP No <span class="require">*</span> :</label>
            <div class="group-4">
                <?php echo $form->textField($model,'nric_passportno_roc', array('class'=>'text span12', 'readonly'=>'readonly')); ?>
                <?php echo $form->error($model,'nric_passportno_roc'); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <label class="lb"> </label>
            <div class="group-4">
                <span class="required">Leave it blank if you don’t want to change the password.</span>
            </div>
        </div>
        <div class="in-row clearfix">
            <label class="lb">Password <span class="require">*</span> :</label>
            <div class="group-4">
                <?php echo $form->passwordField($model,'newpassword', array('class'=>'text span12')); ?>
                <?php echo $form->error($model,'newpassword'); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <label class="lb">Confirm Password <span class="require">*</span> :</label>
            <div class="group-4">
                <?php echo $form->passwordField($model,'password_confirm', array('class'=>'text span12')); ?>
                <?php echo $form->error($model,'password_confirm'); ?>
            </div>
        </div>
    </div>
</div>

<div class="box-1 space-3">
    <div class="title"><h3>Personal Information</h3></div>
    <div class="form-type content">
        <div class="in-row clearfix">
            <div class="">
                <div class="in-row clearfix">
                    <label class="lb">Name <span class="require">*</span> :</label>
                    <?php echo $form->textField($model,'first_name',array('class'=>'text w-0','maxlength'=>100, 'placeHolder'=>'First Name')); ?>
                    <?php echo $form->error($model,'first_name'); ?>

                </div>
                <div class="in-row clearfix">
                    <label class="lb">ID Type <span class="require">*</span> :</label>
                    <div class="group-4">
                        <?php echo $form->dropDownList($model,'id_type', Users::$aIdType, array('empty'=>'Select')); ?>
                        <?php echo $form->error($model,'id_type'); ?>
                    </div>
                </div>

                <div class="in-row clearfix">
                    <label class="lb">Email <span class="require">*</span> :</label>
                    <div class="group-4">
                        <?php echo $form->textField($model,'email_not_login',array('class'=>'text w-0','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'email_not_login'); ?>
                    </div>
                </div>

                <div class="in-row clearfix">
                    <label class="lb">Contact <span class="require">*</span> :</label>
                    <div class="group-4">
                        <?php echo $form->textField($model,'contact_no',array('class'=>'text w-0','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'contact_no'); ?>
                    </div>
                </div>

                <div class="in-row clearfix">
                    <label class="lb">Correspondence Address :</label>
                    <div class="group-4">
                        <?php echo $form->textArea($model,'address',array('class'=>'text w-0','size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'address'); ?>
                    </div>
                </div>

                <div class="w-51 clearfix">
                    <button type="submit" class="btn-3">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<style>
    #Users_first_name_em_{
        margin-left:268px;
        width:180px;
    }

    #Users_last_name_em_{
        margin-left:502px;
        width:107px;
    }

    .group-4 .selector{
        width:230px !important;
    }

    .selector{
        margin-left:3px;
    }

    .form-type .w-5 {
        width:230px !important;
    }

    .form-type .w-51 {
        width:278px !important;
    }

    .form-type .group-2 {
        width:60px !important;
    }
    .form-type .group-0 {
        width:63px !important;
    }

    .form-type .w-0 {
        width:230px !important;
        margin-left: 3px;
    }

    .form-type .w-name {
        width:230px !important;
        margin-left: 6px !important;
    }

    div.checker {
        margin-left:3px !important;
    }

    .errorMessage {
        margin-left:3px;
    }
</style>
