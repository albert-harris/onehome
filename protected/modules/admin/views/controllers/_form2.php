<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'controllers-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'controller_name'); ?>
		<?php echo $form->textField($model,'controller_name',array('size'=>60,'maxlength'=>63)); ?>
		<?php echo $form->error($model,'controller_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'module_name'); ?>
		<?php echo $form->dropDownList($model,'module_name',  CmsFormatter::$allModule); ?>
		<?php echo $form->error($model,'module_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'actions'); ?>
		<?php echo $form->textArea($model,'actions',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'actions'); ?>
	</div>

	<div class="row buttons" style="padding-left: 115px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript">
    $("input[name='Controllers[controller_name]']").change(getAction);
        
    $("select[name='Controllers[module_name]']").change(getAction);

    function getAction(){
        var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/getactions/getactionsname');?>";
        var request = $.ajax({
            type: "post",
            url: url,
            data: { controller: $("input[name='Controllers[controller_name]']").val(), module: $("select[name='Controllers[module_name]']").val()}
          }).done(function(msg) {
            $("textarea[name='Controllers[actions]']").html(msg);                
          });

          request.fail(function() {
            alert( "Wrong controller!");
          });            
    }
</script>
    

