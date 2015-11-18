<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'our-service-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'short_description'); ?>
		<?php echo $form->textField($model,'short_description'); ?>
		<?php echo $form->error($model,'short_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
        <div style="float:left;">
			<?php
			$this->widget('ext.editMe.ExtEditMe', array(
				'model' => $model,
				'height' => '250px',
				'width' => '700px',
				'attribute' => 'description',
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
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->dropdownList($model,'parent_id', 
			CHtml::listData(ServiceCategory::getMainCategories(), 'id', 'name')); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row buttons" style="padding-left: 115px;">
		<a href="<?php $this->createUrl('index', array('cat'=>$model->parent_id)) ?>" class="btn">Back</a>
		<button type="submit" class="btn"><?= $model->isNewRecord ? 'Create' : 'Save' ?></button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
$("#back-button").click(function(){
    window.location.href = '<?php echo Yii::app()->createAbsoluteUrl("admin/packages/index"); ?>';
});
</script>

