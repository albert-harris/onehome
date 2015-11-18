<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-defect-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>

    
    <?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>

    <div class="row">
        <?php // echo $form->labelEx($model,'description'); ?>
        <?php // echo $form->textarea($model,'description',array('maxlength'=>500, 'rows'=>5)); ?>
        <?php // echo $form->error($model,'description'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'schedule_date', array('class'=>' w-200')); ?>
        <div class="">
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model' => $model,
                                'attribute'=>'schedule_date',
                                'options'=>array(
                                        'showAnim'=>'fold',
                                        'showButtonPanel'=>true,
                                        'autoSize'=>true,
//                                        'maxDate'=> '0',
                                        'changeMonth' => true,
                                        'changeYear' => true,
                                        'dateFormat'=>'dd/mm/yy',
                                        'separator'=>' ',
                                        'showOn' => 'button',
                                        'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                                        'buttonImageOnly'=> true,
                                ),
                                'htmlOptions'=>array(
    //                                'style'=>'height:20px;width:100px',
                                    'readonly'=>true,
                                    'class'=>'text w-200',
                                ),
                        ));
                    ?>
        </div>
        <?php echo $form->error($model,'schedule_date'); ?>
    </div>
        
    <div class="row">
        <?php echo $form->labelEx($model,'schedule_time', array('class'=>' w-200')); ?>
        <div class="">
            <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');?>
                <?php 
//                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                $this->widget('CJuiDateTimePicker',array(
                    'model'=>$model,        
                    'attribute'=>'schedule_time',
                    'mode'=>'time', //use "time","date" or "datetime" (default)
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=> ActiveRecord::getDateFormatJquery(),
//                        'maxDate'=> '0',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showOn' => 'button',
                        'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                        'buttonImageOnly'=> true,                                
                    ),        
                    'htmlOptions'=>array(
                        'class'=>'text w-200',                        
                        'readonly'=>true,
                    ),
                ));
            ?>
        </div>
        <?php echo $form->error($model,'schedule_time'); ?>
    </div>
       
    <div class="row buttons" style="padding-left: 190px;">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
        'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'small', // null, 'large', 'small' or 'mini'
        //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
    )); ?>	
        <button class="iframe_close" type="button">Cancel</button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script>
    $(function(){
        $('.iframe_close').live('click', function(){
            parent.$.colorbox.close();
        });
    });

</script>

<style>
    .btn-small{
        margin-left: 6px;
    }
    
    .img{
        width: 140px;
        height: 120px;
    }
</style>