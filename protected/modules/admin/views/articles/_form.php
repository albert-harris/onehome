<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articles-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>90,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

        <div class="row" style="display: none;" >
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>80,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<div style="float:left;">
		 <?php 
			$this->widget('ext.ckeditor.CKEditorWidget',array(
				"model"=>$model,
				"attribute"=>'content',
				"config" => array(
					"height"=>"150px",
					"width"=>"700px",
					"toolbar"=>Yii::app()->params['ckeditor']
				)
			));  
		?>
		</div>
		<?php echo $form->error($model,'short_content'); ?>
	</div>
	<div class='clr'></div>
        
	<div class="row" style="display: none;" >
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>90,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
                <?php echo $form->dropDownList($model,'user_id', Articles::loadUsers(),array('prompt'=>'Select an author','style'=>'width:250px')); ?>   
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', Articles::$articleStatus); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.stringToSlug.js"></script>
<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.stringToSlug.min.js"></script>
<script type="text/javascript">
    
	jQuery(document).ready(function(){
                $("#Articles_title").stringToSlug({
			setEvents: 'keyup keydown blur',
			getPut: '#Articles_slug',
			space: '-'
		});                
	});    
    
</script>