<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-testimonial-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	<div class="row display_none">
		<?php echo Yii::t('translation', $form->labelEx($model,'title')); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
    
        <div class="row">
            <?php echo Yii::t('translation', $form->labelEx($model,'name')); ?>
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>256)); ?>
            <?php echo $form->error($model,'name'); ?>
	</div>    
	
         <div class="row">
            <?php echo $form->labelEx($model, 'description', array()); ?>
             <?php echo $form->textArea($model,'description',array('class'=>'w-600','rows'=>10)); ?>
            <!--<div style="float:left;">-->
                <?php
//                $this->widget('ext.ckeditor.CKEditorWidget', array(
//                    "model" => $model,
//                    "attribute" => 'description',
//                    "config" => array(
//                        "height" => "200px",
//                        "width" => "500px",
//                        "toolbar" => Yii::app()->params['ckeditor']
//                    )
//                ));
                ?>
            <!--</div>-->	
            <!--<div class="clr"></div>-->    
            
            
            
            <?php echo $form->error($model, 'description'); ?>
        </div>  
        
	 <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model, 'status')); ?>
        <?php echo $form->dropDownList($model, 'status', array(1 => 'Active', 0 => 'Inactive')); ?>
        <?php echo Yii::t('translation', $form->error($model, 'status')); ?>
    </div>

	<div class="row buttons" style="padding-left: 115px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->