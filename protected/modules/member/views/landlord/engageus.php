<?php
/**
 * Created by PhpStorm.
 * User: JasonHai
 * Date: 4/4/14
 * Time: 5:11 PM
 */
?>

<div class="form-type content no_background no_border iframe_form">
    <h1 class="title-page">To Sale</h1>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'engage-us-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <?php if(Yii::app()->user->hasFlash('success')): ?>
        <div class="success_div"><?php echo Yii::app()->user->getFlash('success');?></div>
    <?php endif; ?>

    <div class="in-row clearfix">
        <label class="lb">Price <span class="require">*</span> :</label>
        <div class="group-4">
            <?php echo $form->textField($model,'price',array('maxlength'=>200, 'class'=>'text number_only')); ?>
        </div>
        <?php echo $form->error($model,'price'); ?>
    </div>

    <div class="in-row clearfix">
        <label class="lb">Remark :</label>
        <div class="group-4">
            <?php echo $form->textArea($model,'remark',array('class'=>'text w-0','size'=>60,'maxlength'=>255)); ?>
        </div>
        <?php echo $form->error($model,'remark'); ?>
    </div>

    <div class="in-row clearfix">
        <label class="lb"></label>
        <div class="group-engage">
            <?php echo $form->checkBox($model,'termandcondition'); ?>
            <p><strong style="line-height: 1.9">I agree for Terms & Conditions</strong></p>
            <?php echo $form->error($model,'termandcondition'); ?>
        </div>
    </div>

    <div class="clearfix output">
        <a href="javascript:void(0)" class="btn-2 iframe_close">Cancel</a>
        <input type="submit" class="btn-3" value="Submit" />
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form-type content -->

<style>
    .form-type .group-engage {
        width: 397px;
    }

    .form-type .group-engage input {
        float: left;
    }

    .success_div{
        color: #778899;
        font-size: 14px;
        margin: 5px 0;
        text-align: center;
    }
</style>

<script>

    function validateNumber(){
        $(".number_only").each(function(){
            $(this).unbind("keydown");
            $(this).bind("keydown",function(event){
                if( !(event.keyCode == 8                                // backspace
                    || event.keyCode == 46                              // delete
                    || event.keyCode == 9							// tab
//			        || (event.keyCode == 190 || event.keyCode == 110 )							// dấu chấm (point)
                    || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
                    || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
                    || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
                    ) {
                    event.preventDefault();     // Prevent character input
                }
            });
        });
    }

    $(function(){
        $('.iframe_close').on('click', function(){
            parent.$.fancybox.close();
        });
        validateNumber();
    });

</script>