<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'static-block-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>100,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
        <div style="float:left;">
			<?php
			$this->widget('ext.editMe.ExtEditMe', array(
				'model' => $model,
				'height' => '250px',
				'width' => '700px',
				'attribute' => 'content',
				'toolbar' => Yii::app()->params['ckeditor_editMe'],
				'filebrowserBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html',
				'filebrowserImageBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html?type=Images',
				'filebrowserFlashBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html?type=Flash',
				'filebrowserUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				'filebrowserImageUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				'filebrowserFlashUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			));
			?>
        </div>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row buttons" style="padding-left: 115px;">
        <button type="button" style="width: 72px; margin-right: 80px; padding-bottom: 2px;" id="back-button">Back</button>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
$("#back-button").click(function(){
    window.location.href = '<?php echo Yii::app()->createAbsoluteUrl("admin/packages/index"); ?>';
});
</script>

