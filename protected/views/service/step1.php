<?php
/* @var $model ServiceRegistrationForm */
$types = ProPropertyType::$ARR_TYPE_SEARCH;
unset($types[-1]);
?>
<?php $this->renderPartial('reg-step-navigator', array('current'=>1)) ?>

<div class="row">
	<div class="col-md-10">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'service-registration-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array('validateOnSubmit'=>true),
			'htmlOptions'=>array('class'=>'form-horizontal service-reg-form')
		)); ?>
			<h3>Property Information</h3>
			<div class="form-group">
				<?php echo $form->labelEx($model, 'property_type', array('class'=>'control-label col-sm-3')); ?>
				<div class="col-sm-9">
					<?php echo $form->dropDownList($model, 'property_type', $types, array(
						'empty' => 'Please Select', 'class'=>'form-control')); ?>
					<?php echo $form->error($model, 'property_type'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model, 'room_type', array('class'=>'control-label col-sm-3')); ?>
				<div class="col-sm-9">
					<?php echo $form->dropDownList($model, 'room_type', Listing::getListOptionsBedroom(), array(
						'empty' => 'Please Select', 'class'=>'form-control')); ?>
					<?php echo $form->error($model, 'room_type'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model, 'room_size', array('class'=>'control-label col-sm-3')); ?>
				<div class="col-sm-9">
					<?php echo $form->textField($model, 'room_size', array(
						'class'=>'form-control number_only', 
						'placeholder'=>'enter text...', 
						'style'=>'width:92px;display: inline-block;',
						)) ?>
					<?php echo $form->error($model, 'room_size'); ?>
					<span class="help-block" style="display: inline-block">sqft</span>
				</div>
			</div>
			<h3>Quick Registration</h3>
			<div class="form-group">
				<label for="" class="control-label col-sm-3">Your Name <span class="required">*</span></label>
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-6">
							<?php echo $form->dropdownList($model, 'salutation', CmsFormatter::$TITLE_MR, array('class'=>'form-control')); ?>
						</div>
						<div class="col-sm-6">
							<?php echo $form->textField($model, 'fullname', array('class'=>'form-control')) ?>
						</div>
					</div>
					<?php echo $form->error($model, 'salutation'); ?>
					<?php echo $form->error($model, 'fullname'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model, 'email', array('class'=>'control-label col-sm-3')); ?>
				<div class="col-sm-9">
					<?php echo $form->textField($model, 'email', array('class'=>'form-control')); ?>
					<?php echo $form->error($model, 'email'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model, 'contact_no', array('class'=>'control-label col-sm-3')); ?>
				<div class="col-sm-9">
					<?php echo $form->textField($model, 'contact_no', array('class'=>'form-control')); ?>
					<?php echo $form->error($model, 'contact_no'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model, 'address', array('class'=>'control-label col-sm-3')); ?>
				<div class="col-sm-9">
					<p><?php echo $form->textField($model, 'address', array('class'=>'form-control')) ?></p>
					<p><?php echo $form->textField($model, 'address2', array('class'=>'form-control')) ?></p>
					<?php echo $form->error($model, 'address'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model, 'time_contact', array('class'=>'control-label col-sm-3')); ?>
				<div class="col-sm-9">
					<?php echo $form->dropDownList($model, 'time_contact', ServiceRegistration::$TIME_LIST, array(
						'empty' => 'Please Select', 'class'=>'form-control')); ?>
					<?php echo $form->error($model, 'time_contact'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model, 'know_by', array('class'=>'control-label col-sm-3')); ?>
				<div class="col-sm-9">
					<?php echo $form->dropDownList($model, 'know_by', ServiceRegistration::$KNOW_BY_LIST, array(
						'empty' => 'Please Select', 'class'=>'form-control')); ?>
					<?php echo $form->error($model, 'know_by'); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12 text-right">
					<button class="btn btn-9" type="submit">Next</button>
				</div>
			</div>	
		<?php $this->endWidget(); ?>		
	</div>
</div>

