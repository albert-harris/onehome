<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-upload-document-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),    
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	


	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'title')); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'file_name')); ?>
		<?php echo $form->fileField($model,'file_name',array('size'=>60,'maxlength'=>300)); ?>
        <?php if(!$model->isNewRecord && $model->file_name != ''):
            $res='';
            $file = ROOT."/". ProUploadDocument::$folderUpload."/"."$model->user_id/".$model->file_name;
            if(file_exists($file) && !empty($model->file_name)){
                $link = Yii::app()->createAbsoluteUrl(ProUploadDocument::$folderUpload."/$model->user_id/".$model->file_name);
                $res="<a class='show-image' href='$link' >".$model->file_name."</a>";
            }            
            ?>
            <p style="text-align: left;padding-left: 121px;">
                <br>
                <span>Current File: <?php echo $res;?></span>
            </p>

        <?php endif;?>
                            
		<?php echo $form->error($model,'file_name'); ?>
	</div>

	<div class="row display_none">
		<?php echo Yii::t('translation', $form->labelEx($model,'order_no')); ?>
        <?php
             for($i=1;$i<=100;$i++){
                 $arr_num[$i]=$i;
             }
         echo $form->dropDownList($model,'order_no', $arr_num); ?>
		<?php echo $form->error($model,'order_no'); ?>
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