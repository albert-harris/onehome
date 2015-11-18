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
    'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),    
)); ?>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="ad-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

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
                    <div class="f-left">
                        <?php echo $form->dropDownList($model,'title', CmsFormatter::$TITLE_MR, array('class'=>'text w-6','empty'=>'Select Title'));?>
                    </div>

                    <?php echo $form->textField($model,'first_name',array('class'=>'text w-name','maxlength'=>100, 'placeHolder'=>'First Name')); ?>
                    <?php echo $form->textField($model,'last_name',array('class'=>'text w-5','maxlength'=>100, 'placeHolder'=>'Last Name')); ?>

                    <div>
                        <div>
                            <?php echo $form->error($model,'title'); ?>
                        </div>
                        <div style="margin-left: 329px;">
                            <?php echo $form->error($model,'first_name'); ?>
                            <?php echo $form->error($model,'last_name'); ?>                            
                        </div>
                    </div>

                </div>
                <div class="in-row clearfix">
                    <label class="lb">Mobile <span class="require">*</span> :</label>
                    <div class="group-4">
                        <?php echo $form->textField($model,'phone',array('class'=>'text span12','maxlength'=>100)); ?>
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
                    <label class="lb">Postal Code :</label>
                    <div class="group-4">
                        <?php echo $form->textField($model,'postal_code',array('class'=>'text span12','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'postal_code'); ?>
                    </div>
                </div>             
                
                <div class="in-row clearfix">
                    <label class="lb">CEA :</label>
                    <div class="group-4">
                        <?php echo $form->textField($model,'agent_cea',array('class'=>'text span12','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'agent_cea'); ?>
                    </div>
                </div>             
                
                <div class="in-row clearfix">
                    <label class="lb">Company Name :</label>
                    <div class="group-4">
                        <?php echo $form->textField($model,'agent_company_name',array('class'=>'text span12','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'agent_company_name'); ?>
                    </div>
                </div>             

                <div class="in-row clearfix">
                    <label class="lb">Company Logo :</label>
                    <div class="group-upload">

                        <?php echo $form->fileField($model,'agent_company_logo',array()); ?>
                        <span>Only <?php echo Users::$AllowFileAvatar ;?> are allow. Recommended Dimension:  86 px x 75 px</span>
                        <?php if(!$model->isNewRecord && $model->agent_company_logo != ''):
                            $res='';
                                $link = ImageProcessing::bindImageByModel($model, 106 ,75, array('agent_company_logo'=>1));
                                $res="<a href='$link' class='show-image' target='_blank'>$model->agent_company_logo</a>";
                            ?>
                            <p style="text-align: left;padding-left: 222px;">
                                <br>
                                <span>Current File: <?php echo $res;?></span>
                            </p>
                            <p style="text-align: left;padding-left: 222px;">
                                <br/> <input type="checkbox" name="delete_current_logo" class="delete_current_logo">
                                &nbsp;&nbsp;&nbsp;Delete current Logo
                            </p>
            
                        <?php endif;?>
                        <?php echo $form->error($model,'agent_company_logo'); ?>
                    </div>
                </div>
                
                <div class="in-row clearfix">
                    <label class="lb">Avatar :</label>
                    <div class="group-upload">

                        <?php echo $form->fileField($model,'avatar',array()); ?>
                        <span>Only <?php echo Users::$AllowFileAvatar ;?> are allow. Recommended Dimension:  66 px x 65 px</span>
                        <?php if(!$model->isNewRecord && $model->avatar != ''):
                            $res='';
//                            $file = ROOT."/".Users::$folderUpload."/"."$model->id/".$model->avatar;
//                            if(file_exists($file) && !empty($model->avatar)){
                                $link = ImageProcessing::bindImageByModel($model, null, null, array('avatar'=>1));
                                $res="<a href='$link' class='show-image' target='_blank'>$model->avatar</a>";
//                            }

                            ?>
                            <p style="text-align: left;padding-left: 222px;">
                                <br>
                                <span>Current File: <?php echo $res;?></span>
                            </p>
                            <p style="text-align: left;padding-left: 222px;">
                                <br/> <input type="checkbox" name="delete_current_image" class="delete_current_image">
                                &nbsp;&nbsp;&nbsp;Delete current avartar
                            </p>
            
                        <?php endif;?>
                        <?php echo $form->error($model,'avatar'); ?>
                    </div>
                </div>

                <div class="in-row clearfix">
                    <label class="lb">Email <span class="require">*</span> :</label>
                    <div class="group-4">
                        <?php echo $form->textField($model,'email_not_login',array('class'=>'text span12','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'email_not_login'); ?>
                    </div>
                </div>

                <div class="in-row clearfix">
                    <label class="lb">Address :</label>
                    <div class="group-4">
                        <?php echo $form->textArea($model,'address',array('class'=>'text span12','size'=>60,'maxlength'=>255)); ?>
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
    div.uploader
    {
        width: 17% !important;
    }
    
    #uniform-Users_title {
        width: 106px !important;
    }
    
    #Users_title_em_{
        width: 106px;
        margin-left: 224px;
        float: left;        
    }    
    
    #Users_first_name_em_{
        /*margin-left:232px;*/
        width:190px;
        float: left;
    }

    #Users_last_name_em_{
        margin-left:236px;
        width:140px;
    }
    
    #uniform-Users_country_id{
        width: 277px !important;
    }
    
    .form-type .group-upload {
        /*float: left;*/
        width: 100%;
        font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;
        /*font-size:11px;*/
    }

    .group-4{
        font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;
        /*font-size:11px;*/
    }

    .form-type .btn-3 {
        float: left;
        margin: 10px 0 10px 223px;
        text-transform: uppercase;
    }

    /*-----*/
    .form-type .lb {
        width: 210px;
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
        margin-left: 3px !important;
    }

    div.checker {
        margin-left:3px !important;
    }

    .errorMessage {
        margin-left:3px;
    }
</style>
