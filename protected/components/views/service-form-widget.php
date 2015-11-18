<?php
/* @var $model ServiceRegistrationForm */
$types = ProPropertyType::$ARR_TYPE_SEARCH;
unset($types[-1]);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-registration-form',
	'action' => array('service/quickRegister'),
	'enableClientValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true),
	'htmlOptions'=>array('class'=>'service-reg-form')
)); ?>
<div class="form-horizontal">
	<div class="form-group">
		<?php echo $form->labelEx($model, 'property_type', array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->dropDownList($model, 'property_type', $types, array(
				'empty' => 'Please Select', 'class'=>'form-control')); ?>
			<?php echo $form->error($model, 'property_type'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'room_type', array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->dropDownList($model, 'room_type', Listing::getListOptionsBedroom(), array(
				'empty' => 'Please Select', 'class'=>'form-control')); ?>
			<?php echo $form->error($model, 'room_type'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'room_size', array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($model, 'room_size', array(
				'class'=>'form-control number_only', 
				'placeholder'=>'enter text...', 
				'style'=>'width:92px;display: inline-block;',
				)) ?>
			<?php echo $form->error($model, 'room_size'); ?>
			<span class="help-block" style="display: inline-block">sqft</span>
		</div>
	</div>
	<hr/>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'salutation', array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->dropdownList($model, 'salutation', CmsFormatter::$TITLE_MR, array('class'=>'form-control')); ?>
			<?php echo $form->error($model, 'salutation'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'fullname', array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($model, 'fullname', array('class'=>'form-control')) ?>
			<?php echo $form->error($model, 'fullname'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'email', array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($model, 'email', array('class'=>'form-control')); ?>
			<?php echo $form->error($model, 'email'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'contact_no', array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($model, 'contact_no', array('class'=>'form-control number_only')); ?>
			<?php echo $form->error($model, 'contact_no'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'services', array('class'=>'control-label col-sm-4')); ?>
		<div class="col-sm-8">
			<div class="checkbox">
				<?php echo $form->checkboxList($model, 'services', 
					CHtml::listData(ServiceCategory::getMainCategories(), 'id', 'name'), 
					array('style'=>'margin-left: 0')); ?>
				<?php echo $form->error($model, 'services'); ?>
			</div>
		</div>
	</div>
</div>

	<hr/>
<div class="form-group">
	<?php echo $form->labelEx($model, 'remark', array('class'=>'control-label')); ?>
	<?php echo $form->textArea($model, 'remark', array('class'=>'form-control', 'rows'=>5)); ?>
	<?php echo $form->error($model, 'remark'); ?>
</div>
<div class="form-group text-center">
	<button type="submit" class="btn btn-9">Submit Now</button>
</div>
<?php $this->endWidget(); ?>		
