<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-property-type-form',
	'enableAjaxValidation'=>false,
)); 
    $hide_type = '';
    $hide_type = 'hide_type';
?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'name')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

<!--	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'display_order')); ?>
		<?php echo $form->textField($model,'display_order',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'display_order'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo ProPropertyType::getDropDownList('ProPropertyType[parent_id]','ProPropertyType_parent_id',$model->parent_id,true); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'price_min')); ?>
		<?php echo $form->textField($model,'price_min',array('size'=>60,'maxlength'=>20, 'class'=>'number_only')); ?>
		<?php // echo $form->textField($model,'price_min',array('size'=>60,'maxlength'=>20, 'class'=>'')); ?>
		<?php echo $form->error($model,'price_min'); ?>
	</div>
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'price_max')); ?>
		<?php echo $form->textField($model,'price_max',array('size'=>60,'maxlength'=>20, 'class'=>'number_only')); ?>
		<?php // echo $form->textField($model,'price_max',array('size'=>60,'maxlength'=>20, 'class'=>'')); ?>
		<?php echo $form->error($model,'price_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_sign'); ?>
		<?php echo $form->dropDownList($model,'price_sign', ProPropertyType::getListOptionPriceSign() ,array()); ?>
		<?php echo $form->error($model,'price_sign'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'price_sign_position'); ?>
		<?php echo $form->dropDownList($model,'price_sign_position', ProPropertyType::getListOptionPriceSignPosition() ,array()); ?>
		<?php echo $form->error($model,'price_sign_position'); ?>
	</div>


	<div class="row <?php echo $hide_type;?>">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', ProPropertyType::$TYPE_GURU,array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

        <div class="row <?php echo $hide_type;?>">
                <?php echo $form->labelEx($model,'group_show'); ?>
		<?php echo $form->dropDownList($model,'group_show', ProPropertyType::$A_GROUP_SHOW,array('empty'=>'Select','class'=>'w-600')); ?>
		<?php echo $form->error($model,'group_show'); ?>
	</div>

	<div class="row">
            <?php echo Yii::t('translation', $form->labelEx($model,'status')); ?>
            <?php echo $form->dropDownList($model,'status', CmsFormatter::$statusVar,array()); ?>
            <?php echo $form->error($model,'status'); ?>
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

<style>
    .hide_type { display: none; }
</style>

<script>
    $(function(){
        $('#ProPropertyType_parent_id').change(function(){
            
            if($(this).val()!=''){
                $('.hide_type').hide();
                $('#ProPropertyType_type').val('');
            }else{
                <?php if($hide_type==''): ?>
                $('.hide_type').show();
                <?php endif;?>
            }
        });
        $('#ProPropertyType_parent_id').trigger('change');
        
    });
    
</script>