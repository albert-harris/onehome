<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-defect-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>

    
	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
	<div class="row display_none">
		<?php echo Yii::t('translation', $form->labelEx($model,'created_date')); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');?>
                <?php 
//                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                $this->widget('CJuiDateTimePicker',array(
                    'model'=>$model,        
                    'attribute'=>'created_date',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=> ActiveRecord::getDateFormatJquery(),
                        'maxDate'=> '0',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showOn' => 'button',
                        'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                        'buttonImageOnly'=> true,                                
                    ),        
                    'htmlOptions'=>array(
                        'class'=>'',
                        'style'=>'width: 200px;margin-right:10px;',
                        'readonly'=>'readonly',
                    ),
                ));
            ?>
            <?php echo $form->error($model,'created_date'); ?>
	</div>

	<div class="row">
                <?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textarea($model,'description',array('maxlength'=>500, 'rows'=>5)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'location_text'); ?>
        <?php echo $form->textField($model,'location_text',array('class'=>'w-400','maxlength'=>250)); ?>
        <?php echo $form->error($model,'location_text'); ?>
    </div>

    <div class="row">
        <!--<label class="lb">Uploaded Photos <span class="require">*</span> :</label>-->
        <?php echo $form->labelEx($model,'photo'); ?>
        <?php echo $form->fileField($model,'photo'); ?>
        <?php echo $form->error($model,'photo', array('style'=>'padding-left: 0px;')); ?>
        <?php if(!$model->isNewRecord && $model->photo):
            $link='';
            $file = ROOT."/".ProReportDefect::$folderUpload."/"."$model->id/".$model->photo;
            if(file_exists($file) && !empty($model->photo)){
                $link = Yii::app()->createAbsoluteUrl(ProReportDefect::$folderUpload."/$model->id/".$model->photo);
            }
            ?>
            <p style="text-align: left;padding-left: 121px;">
                <br>
                <span>Current File: <?php echo CHtml::image($link, "Photo",array('class'=>'img')); ?></span>
            </p>
        <?php endif;?>
    </div>
    
	<div class="row buttons" style="padding-left: 115px;">
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
    
//     $(document).ready(function(){
//        $(".show-image").fancybox();
//     });
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