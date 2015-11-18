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

<div class="clearfix" style="text-align:center;font-weight:bold;font-size:14px;">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<div class="box-1 space-3">
    <div class="title"><h3>Login Information</h3></div>
    <div class="form-type content">

        <div class="in-row clearfix">
            <!--<label class="lb">NRIC/FIN/PP No <span class="require">*</span> :</label>-->
            <?php echo $form->labelEx($model, 'nric_passportno_roc', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'nric_passportno_roc', array('class'=>'text span12', 'readonly'=>'readonly')); ?>
                <?php echo $form->error($model,'nric_passportno_roc'); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <label class="lb remove_dot"> </label>
            <div class="group-4">
                <span class="required">Leave it blank if you don’t want to change the password.</span>
            </div>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'newpassword', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->passwordField($model,'newpassword', array('class'=>'text span12')); ?>
                <?php echo $form->error($model,'newpassword'); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'password_confirm', array('class'=>'lb')); ?>
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
                    <?php echo $form->labelEx($model, 'first_name', array('class'=>'lb')); ?>
                    <div class="group-4">
                        <?php echo $form->textField($model,'first_name',array('class'=>'text w-0','maxlength'=>100, 'placeHolder'=>'First Name')); ?>
                        <?php echo $form->error($model,'first_name'); ?>
                    </div>
                </div>
                <div class="in-row clearfix">
                    <?php echo $form->labelEx($model, 'id_type', array('class'=>'lb')); ?>
                    <div class="group-4">
                        <?php echo $form->dropDownList($model,'id_type', Users::$aIdType, array('empty'=>'Select')); ?>
                        <?php echo $form->error($model,'id_type'); ?>
                    </div>
                </div>

                <div class="in-row clearfix pass_expiry_date">
                    <!--<label class="lb">Pass Expiry Date <span class="require">*</span> :</label>-->
                    <?php echo $form->labelEx($model, 'pass_expiry_date', array('class'=>'lb')); ?>
                    <?php
                        if($model->pass_expiry_date != ''){
                            $model->pass_expiry_date = DateHelper::toDateFormat($model->pass_expiry_date);
                        }
                    ?>
                    <div class="group-4">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model'=>$model,
                            'attribute'=>'pass_expiry_date',
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=> ActiveRecord::getDateFormatJquery(),
                                'changeMonth' => true,
                                'changeYear' => true,
                                'showOn' => 'button',
                                'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                                'buttonImageOnly'=> true,
                            ),
                            'htmlOptions'=>array(
                                'class'=>'w-16',
                                'style'=>'height:20px;width:166px;margin-left:3px;',
//                                'readonly'=>'readonly',
                            ),
                        ));
                        ?>
                        <?php echo $form->error($model,'pass_expiry_date'); ?>
                    </div>
                </div>

                <div class="in-row clearfix scanned_employment_pass">
                    <!--<label class="lb">Upload Employment Pass/Passport <span class="require"></span> :</label>-->
                    <?php echo $form->labelEx($model, 'scanned_employment_pass', array('class'=>'lb')); ?>
                    <div class="group-upload f-left w-500">
                        <?php echo $form->fileField($model,'upload_employment_pass_passport',array()); ?>
                        <span>Only <?php echo Users::$AllowFile ;?> are allow</span>
                        <?php if(!$model->isNewRecord && $model->upload_employment_pass_passport):
                            $res='';
                            $file = ROOT."/".Users::$folderUpload."/"."$model->id/".$model->upload_employment_pass_passport;
                            if(file_exists($file) && !empty($model->upload_employment_pass_passport)){
                                $link = Yii::app()->createAbsoluteUrl(Users::$folderUpload."/$model->id/".$model->upload_employment_pass_passport);
                                $res="<a href='$link' class='show-image' target='_blank'>$model->upload_employment_pass_passport</a>";
                            }

                            ?>
                            <p style="text-align: left;">
                                <br>
                                <span>Current File: <?php echo $res;?></span>
                            </p>
                            
<!--                            <p style="text-align: left;padding-left: 222px;">
                                <br/> <input type="checkbox" name="delete_current_file" class="delete_current_file">
                                Delete current file
                            </p>                            -->
                        <?php endif;?>
                        <?php echo $form->error($model,'upload_employment_pass_passport'); ?>
                    </div>
                </div>
                
                <div class="in-row clearfix scanned_passport">
                    <!--<label class="lb">Upload Employment Pass/Passport <span class="require"></span> :</label>-->
                    <?php echo $form->labelEx($model, 'scanned_passport', array('class'=>'lb')); ?>
                    <div class="group-upload f-left w-500">

                        <?php echo $form->fileField($model,'scanned_passport',array()); ?>
                        <span>Only <?php echo Users::$AllowFile ;?> are allow</span>
                        <?php if(!$model->isNewRecord && $model->scanned_passport):
                            $res='';
                            $file = ROOT."/".Users::$folderUpload."/"."$model->id/".$model->scanned_passport;
                            if(file_exists($file) && !empty($model->scanned_passport)){
                                $link = Yii::app()->createAbsoluteUrl(Users::$folderUpload."/$model->id/".$model->scanned_passport);
                                $res="<a href='$link' class='show-image' target='_blank'>$model->scanned_passport</a>";
                            }

                            ?>
                            <p style="text-align: left;">
                                <br>
                                <span>Current File: <?php echo $res;?></span>
                            </p>
                            
<!--                            <p style="text-align: left;padding-left: 222px;">
                                <br/> <input type="checkbox" name="delete_scanned_passport" class="delete_current_file">
                                Delete current file
                            </p>                            -->
                        <?php endif;?>
                        <?php echo $form->error($model,'scanned_passport'); ?>
                    </div>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->labelEx($model, 'email_not_login', array('class'=>'lb')); ?>
                    <div class="group-4">
                        <?php echo $form->textField($model,'email_not_login',array('class'=>'text w-0','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'email_not_login'); ?>
                    </div>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->labelEx($model, 'contact_no', array('class'=>'lb')); ?>
                    <div class="group-4">
                        <?php echo $form->textField($model,'contact_no',array('class'=>'text w-0','maxlength'=>100)); ?>
                        <?php echo $form->error($model,'contact_no'); ?>
                    </div>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->labelEx($model, 'address', array('class'=>'lb')); ?>
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


<script type="text/javascript">
    $(document).ready(function() {
//        $('#Users_id_type').change(function(){
//            if($(this).val() === '<?php // echo Users::ID_TYPE_EP;?>' || $(this).val() === '<?php // echo Users::ID_TYPE_SPASS;?>'){
//                if($('.pass_expiry_date').find('label:first').find('span').size()<1){
//                    $('.pass_expiry_date').find('label:first').append('<span class="required"> *</span>');
//                }
//                if($('.scanned_passport').find('label:first').find('span').size()<1){
//                    $('.scanned_passport').find('label:first').append('<span class="required"> *</span>');
//                }
//                if($('.scanned_employment_pass').find('label:first').find('span').size()<1){
//                    $('.scanned_employment_pass').find('label:first').append('<span class="required"> *</span>');
//                }
//            }else{
//                $('.pass_expiry_date').find('label:first').find('span').remove();
//                $('.scanned_passport').find('label:first').find('span').remove();
//                $('.scanned_employment_pass').find('label:first').find('span').remove();
//            }
//        });
        
        <?php // if($model->id_type==Users::ID_TYPE_SPASS || $model->id_type==Users::ID_TYPE_EP):?>
//            $('#Users_id_type').trigger('change');
        <?php // endif;?>    
        
        $('.in-row').find('label:first').append(" :");
        $('.remove_dot').html("");
    });
</script>


<style>
    .form-type .group-upload {
        width: 100%;
        font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;
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
        margin-left: 6px !important;
    }

    div.checker {
        margin-left:3px !important;
    }

    .errorMessage {
        margin-left:3px;
    }
</style>
