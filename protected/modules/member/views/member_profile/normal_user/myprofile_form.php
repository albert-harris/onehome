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


<!--    <p><em>Fields with <span class="required">*</span> are required.</em></p>-->
        <div class="in-row clearfix">
            <label class="lb">User email <span class="require">*</span> :</label>
            <div class="group-4">
                <?php echo $form->textField($model,'email', array('class'=>'text span12', 'readonly'=>'readonly')); ?>
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
                    <div class="f-left">
                        <?php echo $form->dropDownList($model,'title', CmsFormatter::$TITLE_MR, array('class'=>'text w-6','empty'=>'Select Title'));?>
                    </div>

                    <?php echo $form->textField($model,'first_name',array('class'=>'text w-150 ','maxlength'=>100, 'placeHolder'=>'First Name')); ?>
                    <?php echo $form->textField($model,'last_name',array('class'=>'text w-150','maxlength'=>100, 'placeHolder'=>'Last Name')); ?>

                    <div>
                        <div>
                            <?php echo $form->error($model,'title'); ?>
                        </div>
                        <div style="margin-left: 282px;">
                            <?php echo $form->error($model,'first_name'); ?>
                            <?php echo $form->error($model,'last_name'); ?>                            
                        </div>
                    </div>

                </div>
                <div class="in-row clearfix">
                    <label class="lb">NRIC/FIN <span class="require">*</span> :</label>
                    <div class="group-4">
                        <?php echo $form->textField($model,'nric_passportno_roc',array('class'=>'text w-0','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'nric_passportno_roc'); ?>
                    </div>
                </div>
                <div class="in-row clearfix">
                    <label class="lb">Mobile <span class="require">*</span> :</label>
                    <div class="group-4">
                        <?php echo $form->textField($model,'phone',array('class'=>'text w-0','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'phone'); ?>
                    </div>
                </div>
                <div class="in-row clearfix">
                    <label class="lb">Country <span class="require">*</span> :</label>
                    <div class="group-4">
                        <?php if($model->country_id): ?>
                            <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('style'=>'width:244px;','class'=>'text' ));?>
                        <?php else: ?>
                            <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('options' => array(DEFAULT_AREA_CODE=>array('selected'=>true)), 'style'=>'width:244px;','class'=>'text' ));?>
                        <?php endif; ?>
                        <?php echo $form->error($model,'country_id'); ?>
                    </div>
                </div>
                <div class="in-row clearfix">
                    <label class="lb">Address :</label>
                    <div class="group-4">
                        <?php echo $form->textArea($model,'address',array('class'=>'text w-0','size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'address'); ?>
                    </div>
                </div>
<!--                <div class="in-row clearfix">-->
<!--                    <label class="lb"></label>-->
<!--                    <div class="group-4">-->
<!--                        --><?php //echo $form->textField($model,'address2',array('class'=>'text w-0','maxlength'=>100)); ?>
<!--                        --><?php //echo $form->error($model,'address2'); ?>
<!--                    </div>-->
<!--                </div>-->
                <div class="in-row clearfix">
                    <label class="lb">Postal Code :</label>
                    <div class="group-4">
                        <?php echo $form->textField($model,'postal_code',array('class'=>'text w-0','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'postal_code'); ?>
                    </div>
                </div>
                <div class="row clearfix">
                    <label class="lb"></label>
                    <div class="group-1">
                        <?php echo $form->checkBox($model,'is_subscriber'); ?>
                        <p><strong>&nbsp;&nbsp;Please send me updates, monthly newsletter and partner offers</strong></p>
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
    
    #uniform-Users_title {
        width: 106px !important;
    }    
    #Users_title_em_{
        width: 106px;
        margin-left: 174px;
        float: left;        
    }    
    
    #Users_first_name_em_{
        /*margin-left:232px;*/
        width:150px;
        float: left;
    }

    #Users_last_name_em_{
        margin-left: 164px;
        width:140px;
    }

    .group-4 .selector{
        width:280px !important;/*width:230px*/
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
        width:280px !important;/*width:230px*/
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
