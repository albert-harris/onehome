<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//echo "Jason";
?>
<style>
    .form-type {
        border: none;
    }
    
    .box-3{
        margin-top: 0px;
    }
    
    .form-type .btn-3 {
        text-transform: uppercase;
        margin-left: 172px;
        float: left;
    }    
    
    p {
        line-height: 18px;
        text-align: justify;
        margin: 0 0 15px;
    }

    h4{
        float: left;
        color: #002d56;
        position: relative;
        font-size: 20px;
        width: 100%;
        font-weight: normal;
        padding: 0px 0px 5px !important;
        margin: 18px 0px 0px 0px;
        margin: 0px 0px 0px 0px;
        border-bottom: 1px dotted #e8e8e8;
    }


    .items{
        width: 100%;
    }   
    
    .sidebar ul li a, .sidebar1 ul li a {
        padding: 12px 20px;
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
        -o-transition: all 0.3s ease-out;
        -ms-transition: all 0.3s ease-out;
        transition: all 0.3s ease-out;
        overflow: hidden;
    }

    .sidebar{
        margin-right: 30px;
    }

    table.job-offer {
        width: 100%;
        height: 100%;
        color: #4d4d4d;
        margin-bottom: 40px !important;
    }
    
    .form-type .lb-5 {
        font-weight: bold;
        float: left;
        line-height: 1.2;
        margin-right: 10px;
        text-align: right;
        width: 160px;
    }    
    
    .form-type .lb-5 img{
        height: 30px;
        
    }
    
    #yw0_button{
        display: none !important;
    }
</style>

<aside class="sidebar">
    <div class="box-3">
        <div class="content">
            <ul class="nav-list">
                <li class="first "><a href="<?php echo Yii::app()->createAbsoluteUrl('site/career'); ?>">Job Opportunity</a></li>
                <li class="last current_page_item"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/resume'); ?>">Submit Resume</a></li>
            </ul>
        </div>
    </div>
</aside>
<div class="main-inner-2">
    <h4>Submit Resume</h4>
    <p>&nbsp;</p>
    
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'resume-form',
        'enableClientValidation' => true,
        'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ), 
    )); ?>



    <div class="box-3">
        <h3>Application Form</h3>
        <div class="clearfix" style="text-align:center;font-weight:bold;font-size:14px;">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
        
        <div class="form-type content" <?php if(isset($flag) && $flag): echo "style='display:none'"; endif; ?>>

            <div class="in-row clearfix">
                <label class="lb">Position Applied <span class="require">*</span> :</label>
                <div class="group-4">
                    <?php echo $form->textField($model,'position', array('class'=>'text span12', 'placeHolder'=>'Position Applied')); ?>
                    <?php echo $form->error($model,'position'); ?>
                </div>
            </div>
         
            <div class="in-row clearfix">
                <label class="lb">Name <span class="require">*</span> :</label>
                <div class="group-4">
                    <?php echo $form->textField($model,'name', array('class'=>'text span12','placeHolder'=>'Name')); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Email <span class="require">*</span> :</label>
                <div class="group-4">
                    <?php echo $form->textField($model,'email', array('class'=>'text span12','placeHolder'=>'Email')); ?>
                    <?php echo $form->error($model,'email'); ?>
                </div>
            </div>

            <div class="in-row clearfix">
                <label class="lb">Phone <span class="require">*</span> :</label>
                <div class="group-4">
                    <?php echo $form->textField($model,'phone',array('class'=>'text w-0','maxlength'=>100, 'placeHolder'=>'Phone')); ?>
                    <?php echo $form->error($model,'phone'); ?>
                </div>
            </div>

            <div class="in-row clearfix">
                <label class="lb">Comment <span class="require">*</span> :</label>
                <div class="group-4">
                    <?php echo $form->textArea($model,'comment',array('class'=>'text w-0', 'placeHolder'=>'Comment')); ?>
                    <?php echo $form->error($model,'comment'); ?>
                </div>
            </div>

            <div class="in-row clearfix scanned_employment_pass">
                <label class="lb">Attach your Resume:</label>
                <?php // echo $form->labelEx($model, 'file_resume', array('class'=>'lb')); ?>
                <div class="group-4">

                    <?php echo $form->fileField($model,'file_resume',array()); ?>
                    <span>Only <?php echo ProResume::$AllowFile ;?> are allowed</span>
                    <?php echo $form->error($model,'file_resume'); ?>
                </div>
            </div>

            <div class="in-row clearfix">
                <label class="lb-5">
                    <?php $this->widget('CCaptcha'); ?>
                </label>
                <div class="group-4">
                    <?php echo $form->textField($model,'verify_code',array('class'=>'text w-0','maxlength'=>100, 'placeHolder'=>'Verify Code')); ?>
                    <?php echo $form->error($model,'verify_code'); ?>
                </div>
            </div>
            
            <div class="w-51 clearfix">
                <button type="submit" class="btn-3">Submit</button>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>
