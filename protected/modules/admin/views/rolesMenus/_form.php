<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'roles-menus-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'role_id'); ?>
                <?php echo $form->dropDownList($model,'role_id',Roles::loadItems()); ?>
		<?php echo $form->error($model,'role_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_id'); ?>
                <?php echo Menus::getDropDownList('RolesMenus[menu_id]','RolesMenus_menu_id',$model->menu_id,true); ?>
		<?php echo $form->error($model,'menu_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->