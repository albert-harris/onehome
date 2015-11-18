<?php
/**
 * Created by PhpStorm.
 * User: JasonHai
 * Date: 4/4/14
 * Time: 5:11 PM
 */
?>

<div class="form-type content no_background no_border iframe_form">
    <!--<h1 class="title-page">Update Status Aircon Service</h1>-->
    <h1 class="title-page">Upload Service Documents</h1>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'engage-us-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    )); ?>

    <?php if(Yii::app()->user->hasFlash('success')): ?>
        <div class="success_div"><?php echo Yii::app()->user->getFlash('success');?></div>
    <?php endif; ?>


    <div class="in-row clearfix display_none">
        <?php echo $form->labelEx($model,'status', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->dropDownList($model,'status', ProAirconService::$STATUS_AIRCON, array('class'=>'text')); ?>
        </div>
        <?php echo $form->error($model,'status'); ?>
    </div>
        
    <div class="in-row clearfix">
        <?php echo $form->labelEx($model,'upload_service_documents', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->fileField($model,'upload_service_documents'); ?>
            <br>
            <span>Only <?php echo ProAirconService::$AllowFile ;?> is allow</span>
            <?php echo $form->error($model,'upload_service_documents', array('style'=>'padding-left: 0px;')); ?>
        </div>
    </div>

    <div class="clearfix output">
        <a href="javascript:void(0)" class="btn-2 iframe_close">Cancel</a>
        <input type="submit" class="btn-3" value="Submit" />
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form-type content -->

<style>
</style>

<script>
$(function(){
    $('.iframe_close').on('click', function(){
        parent.$.fancybox.close();
    });
    
    $('.in-row').find('label:first').append(" :");
    
});

</script>