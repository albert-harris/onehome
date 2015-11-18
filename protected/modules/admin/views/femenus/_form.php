<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fe-menus-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row" id="link">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255,'value'=>'/')); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>
        
        <div class="row" id="page_id">
		<?php echo $form->labelEx($model,'page_id'); ?>
		<?php echo $form->dropDownList($model,'page_id', Pages::getDropDownList()); ?>
		<?php echo $form->error($model,'page_id'); ?>
	</div>
        <?php
            $tmp_ = array();
            for($i=1;$i<10;$i++)
                $tmp_[$i]=$i;
        ?>
	<div class="row">
		<?php echo $form->labelEx($model,'order'); ?>
		<?php echo $form->dropDownList($model,'order', $tmp_); ?>
		<?php echo $form->error($model,'order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'required_login'); ?>
		<?php echo $form->dropDownList($model,'required_login', array(1=>'Yes', 0=>'No')); ?>
		<?php echo $form->error($model,'required_login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', array(1=>'Active', 0=>'Inactive')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',array("page"=>"Page", "url"=>"Custom URL")); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
                <?php echo FeMenus::getDropDownList('FeMenus[parent_id]','FeMenus_parent_id',$model->parent_id,true); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'place_holder_id'); ?>
		<?php echo $form->dropDownList($model,'place_holder_id',PlaceHolders::loadItems()); ?>
		<?php echo $form->error($model,'place_holder_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$(document).ready(function() {
    if($('#FeMenus_type').val() == 'page')
    {
        $('#page_id').show();
        $('#link').hide();
    }
    else
    {
        $('#page_id').hide();
        $('#link').show();
    }
});
$("#FeMenus_type").change(function() {
    if($('#FeMenus_type').val() == 'page')
    {
        $('#page_id').show();
        $('#link').hide();
    }
    else
    {
        $('#page_id').hide();
        $('#link').show();
    }
});
</script>