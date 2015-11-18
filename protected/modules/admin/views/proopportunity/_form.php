<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-opportunity-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'title')); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'country_id')); ?>
		<?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('prompt'=>'Select a country', 'options' => array(DEFAULT_AREA_CODE=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'department')); ?>
		<?php echo $form->textField($model,'department',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'department'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'posted')); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model' => $model,
                            'attribute'=>'posted',
                            'options'=>array(
                                    'showAnim'=>'fold',
                                    'showButtonPanel'=>true,
                                    'autoSize'=>true,
                                    'dateFormat'=>'dd/mm/yy',
                                    'width'=>'120',
                                    'separator'=>' ',
                                    'showOn' => 'button',
                                    'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                                    'buttonImageOnly'=> true,
                                    'changeMonth'=> true,
                                    'changeYear'=> true,
                                    'yearRange'=> "c-100:c+0",
//                                    'maxDate'=>0
                            ),
                            'htmlOptions'=>array(
                                    'readonly'=>true,
                                    'class'=>'in-text w-1'
                            ),
                    ));
            ?>
		<?php echo $form->error($model,'posted'); ?>
	</div>
    
        <div class="row">
            <?php echo Yii::t('translation', $form->labelEx($model,'job_description')); ?>
            <div class="group-4 f-left">
            <?php
                $this->widget('ext.niceditor.nicEditorWidget',array(
                             "model"=>$model,                
                             "attribute"=>'job_description',          
                             "defaultValue"=>'',
                             "config"=>array(
                                    "maxHeight"=>"200px",
                                    "buttonList"=>Yii::app()->params['niceditor_v_2'],
                                 ),
                             "width"=>"700px",					
                             "height"=>"200px",					
                     ));                        
            ?>
            <?php echo $form->error($model,'job_description'); ?>
            </div>            
	</div>
    
        <div class="row">
            <?php echo Yii::t('translation', $form->labelEx($model,'requirements')); ?>
            <div class="group-4 f-left">
            <?php
                $this->widget('ext.niceditor.nicEditorWidget',array(
                            "model"=>$model,                
                            "attribute"=>'requirements',          
                            "defaultValue"=>'',
                            "config"=>array(
                               "maxHeight"=>"200px",
                               "buttonList"=>Yii::app()->params['niceditor_v_2'],
                            ),
                            "width"=>"700px",					
                            "height"=>"200px",					
                     ));                        
            ?>
            <?php echo $form->error($model,'requirements'); ?>
            </div>            
	</div>

	<div class="row buttons" style="padding-left: 121px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->