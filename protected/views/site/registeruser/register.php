<?php
/**
 * Created by PhpStorm.
 * User: JasonHai
 * Date: 4/1/14
 * Time: 2:02 PM
 */
?>

    <h1 class="title-page">OneHome Property Member Registration</h1>

    <!--  main container -->
    <div class="main-inner-2">
        <div class="note-box-1">
            <?php $LinkContactUs = Yii::app()->createAbsoluteUrl('site/contact'); ?>
            <strong>Disclaimer:</strong> If you are a Property Agent and want to register as an agent, please <a href="<?php echo $LinkContactUs;?>">click here</a>.
        </div>
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'member-form',
//                'enableAjaxValidation'=>true,
//                'enableClientValidation'=>true, // ANH DUNG 12-11-2013 need close to do something at beforeValidate of model Users
            'htmlOptions'=>array('class'=>'form-type'),
            'clientOptions' => array(
                'validationDelay'=>100000, // trên ie8 (firefox+chrom ko sao) nó tự động trigger validate ajax, nên khi mới load
                'validateOnSubmit' => true,
            ),

        )); ?>
            <div class="clearfix" style="text-align:center;font-weight:bold;font-size:14px;">
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
            <div class="clearfix">
                <h2 class="f-left">Enter your details to join now!</h2>
                <p class="note f-right"><span class="require">*</span> <em>Indicates required field</em></p>
            </div>



            <div style="display:none" class="errorSummary" id="member-form_es_"><p>Please fix the following input errors:</p>
                <ul><li>dummy</li></ul></div>
            <div class="in-row clearfix">
                <label class="lb-1"><span class="require">*</span> Title :</label>
                <div class="group-1">
                <div class="group-2">
                    <?php echo $form->dropDownList($model,'title', CmsFormatter::$TITLE_MR, array('class'=>'text-4','empty'=>'Select Title'));?>
                    <?php echo $form->error($model,'title'); ?>
                </div>
                </div>

            </div>

            <div class="in-row clearfix">
                <label class="lb-1"><span class="require">*</span> First Name :</label>
                <div class="group-1">
                    <?php echo $form->textField($model,'first_name',array('class'=>'text','maxlength'=>100)); ?>
                    <?php echo $form->error($model,'first_name'); ?>
                </div>

            </div>
            <div class="in-row clearfix">
                <label class="lb-1"><span class="require">*</span> Last Name :</label>
                <div class="group-1">
                    <?php echo $form->textField($model,'last_name',array('class'=>'text','maxlength'=>100)); ?>
                    <?php echo $form->error($model,'last_name'); ?>
                </div>
            </div>

            <div class="in-row clearfix">
                <label class="lb-1"><span class="require">*</span> Mobile Phone :</label>
                <div class="group-1">
                    <div class="group-2">
                        <?php echo $form->dropDownList($model,'area_code_id', AreaCode::getAreaCode(), array('style'=>'width:244px;','class'=>'text','options' => array(DEFAULT_AREA_CODE=>array('selected'=>true)) ));?>
<!--                        --><?php //echo $form->error($model,'area_code_id'); ?>
                    </div>
                    <?php echo $form->textField($model,'phone',array('class'=>'text  w-1','maxlength'=>PHONE_LENGTH_MAX)); ?>
                    <?php echo $form->error($model,'phone', array('class'=>'phone errorMessage')); ?>

                </div>
            </div>

            <div class="in-row clearfix">
                <label class="lb-1"><span class="require">*</span> Email Address :</label>
                <div class="group-1">
                    <?php echo $form->textField($model,'email',array('class'=>'text','maxlength'=>MAX_LIMIT_EMAIL_ACCOUNT)); ?>
                    <?php echo $form->error($model,'email'); ?>
                </div>

            </div>

            <div class="in-row clearfix">
                <label class="lb-1"><span class="require">*</span> Password :</label>
                <div class="group-1">
                    <?php echo $form->passwordField($model,'password_hash',array('class'=>'text','maxlength'=>PASSW_LENGTH_MAX)); ?>
                    <?php echo $form->error($model,'password_hash'); ?>
                </div>


            </div>
            <div class="row clearfix">
                <label class="lb-1"><span class="require">*</span> Confirm Password :</label>
                <div class="group-1">
                    <?php echo $form->passwordField($model,'password_confirm',array('class'=>'text','maxlength'=>PASSW_LENGTH_MAX)); ?>
                    <?php echo $form->error($model,'password_confirm'); ?>
                    <p class="note"><em>Minimum 6 letters and/or numbers</em></p>
                </div>

            </div>
            <div class="row clearfix">
                <label class="lb-1"></label>
                <div class="group-1">
                    <?php echo $form->checkBox($model,'is_subscriber'); ?>
                    <p><strong>Please send me updates, monthly newsletter and partner offers</strong></p>
                </div>
            </div>
            <?php
                $link_PAGE_Terms_Of_Service = Yii::app()->createAbsoluteUrl('site/view_page', array('slug' => Pages::getSlugById(PAGE_Terms_Of_Service)));
                $link_PAGE_Privacy_Policy = Yii::app()->createAbsoluteUrl('site/view_page', array('slug' => Pages::getSlugById(PAGE_Privacy_Policy)));
            ?>


            <div class="w-2 clearfix">
                <button type="submit" class="btn-3">Register</button>
            </div>
        <p class="note space-1">By registering your account you agree to OneHome Infologic’s <a href="<?php echo $link_PAGE_Terms_Of_Service;?>" target="_blank">Terms of Service</a> and <a  href="<?php echo $link_PAGE_Privacy_Policy;?>" target="_blank">Privacy Policy</a>.</p>

            <?php $this->endWidget(); ?>
    </div>

     <!------ads banner----->
    <?php $this->widget('AdsBannerMiddleWidget'); ?>


<style>
    .phone{
        float:right;
        margin-right:113px;
    }
</style>