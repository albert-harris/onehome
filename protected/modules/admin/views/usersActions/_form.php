<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-actions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<label class="required" for="UsersActions_user_id">Username<span class="required">*</span></label>
		<?php echo CHtml::textField('Username', $model ? $model->user->username : '', array('size' => 31)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'module'); ?>		
                <?php echo $form->dropDownList($model,'module',array(null => 'Front End', 'admin' => 'Admin', 'member' => 'Member','auditTrail' => 'Audit Trail')); ?>
		<?php echo $form->error($model,'module'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'controller'); ?>
		<?php echo $form->textField($model,'controller',array('size'=>31,'maxlength'=>31)); ?>
		<?php echo $form->error($model,'controller'); ?>
	</div>

	<div class="row">
                <?php echo $form->labelEx($model,'actions'); ?>
		<?php echo $form->textArea($model,'actions',array('class'=>'rolepermission', 'style' => 'height: 125px; width: 202px;')); ?>
		<?php echo $form->error($model,'actions'); ?>      
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>		
                <?php echo $form->dropDownList($model,'type',array('allow' => 'Yes', 'deny' => 'No')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row buttons" style="margin-left: -62px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $("input[name='UsersActions[controller]']").change(getAction);
        
    $("select[name='UsersActions[module]']").change(getAction);

    function getAction(){
        var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/getactions/getactionsname');?>";
        var request = $.ajax({
            type: "post",
            url: url,
            data: { controller: $("input[name='UsersActions[controller]']").val(), module: $("select[name='UsersActions[module]']").val()}
          }).done(function(msg) {
            $("textarea[name='UsersActions[actions]']").html(msg);                
          });

          request.fail(function() {
            alert( "Wrong controller!");
          });            
    }
</script>