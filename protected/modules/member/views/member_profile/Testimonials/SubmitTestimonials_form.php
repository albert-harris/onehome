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
    'clientOptions' => array(
        'validateOnSubmit' => true,
      ),
)); ?>

<div class="box-1 space-3">
    <div class="title"><h3>Submit Testimonials</h3></div>
    <div class="form-type content">
        <?php if(Yii::app()->user->hasFlash('SuccessSubmit')):?>
        <div class="clearfix" style="text-align:center;font-weight:bold;font-size:14px;">
            <?php echo Yii::app()->user->getFlash('SuccessSubmit'); ?>
        </div>
        <?php else: ?>
            <div class="in-row clearfix">
                <div class="">
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model, 'description', array('class'=>'lb w-100')); ?>
                        <div class="group-4">
                            <?php echo $form->textArea($model,'description',array('class'=>'w-400','rows'=>7,'maxlength'=>600)); ?>
                            <?php echo $form->error($model,'description'); ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model, 'type', array('class'=>'lb w-100')); ?>
                        <div class="group-4">
                            <?php echo $form->dropDownList($model, 'type', ProTestimonial::$ARR_TYPE, array('empty'=>'Select')); ?>
                            <?php echo $form->error($model,'type'); ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model, 'name', array('class'=>'lb w-100')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($model,'name',array('class'=>'text w-0','maxlength'=>100)); ?>
                            <?php echo $form->error($model,'name'); ?>
                        </div>
                        <div class="clr"></div>
                        <em class="SubmitTestimonials">If you didn't put the display name, system will show the your name</em>
                    </div>

                    <div class="w-220 clearfix">
                        <button type="submit" class="btn-3">Submit</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->endWidget(); ?>


<style>
    .SubmitTestimonials { margin-left:110px; }
    .form-type .w-51 {
        width:278px !important;
    }
    .errorMessage {
        margin-left:3px;
    }
</style>
