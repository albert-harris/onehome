<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-transactions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'date')); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');?>
                <?php 
//                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                $this->widget('CJuiDateTimePicker',array(
                    'model'=>$model,        
                    'attribute'=>'date',
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
            <?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'received_by')); ?>
		<?php echo $form->textField($model,'received_by',array('class'=>'w-400','maxlength'=>150)); ?>
		<?php echo $form->error($model,'received_by'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'description')); ?>
		<?php echo $form->textarea($model,'description',array('class'=>'w-400','maxlength'=>500, 'rows'=>5)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
        <div class="row">
            <?php echo $form->labelEx($model,'person_call_type'); ?>
            <?php echo $form->dropDownList($model,'person_call_type', ProCallLog::$ARR_PERSON_CALL_TYPE, array('class'=>'w-400','empty'=>'Select')); ?>
            <?php echo $form->error($model,'person_call_type'); ?>
        </div>     
    	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'person_called')); ?>
		<?php echo $form->textField($model,'person_called',array('class'=>'w-400','maxlength'=>150)); ?>
		<?php echo $form->error($model,'person_called'); ?>
	</div>
    	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'phone')); ?>
		<?php echo $form->textField($model,'phone',array('class'=>'w-400','maxlength'=>50)); ?>
		<?php echo $form->error($model,'phone'); ?>
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
    $(window).load(function(){ // không dùng dc cho popup
//        $('.materials_table').floatThead();
        fnResizeColorbox();
    });    
    function fnResizeColorbox(){
//        var y = $('body').height()+100;
        var y = $('#main_box').height()+100;
        parent.$.colorbox.resize({innerHeight:y});        
    }    
</script>