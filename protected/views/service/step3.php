<?php
/* @var $model ServiceRegistrationForm */
$f = Yii::app()->format;
?>
<?php $this->renderPartial('reg-step-navigator', array('current'=>3)) ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-registration-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true),
	'htmlOptions'=>array('class'=>'form-horizontal service-reg-form')
)); ?>
<div class="row">
	<div class="col-sm-6" style="float: none; margin: 0 auto;">
		<h3>Your Property Information</h3>
		<div class="form-group">
			<?php echo $form->labelEx($model, 'property_type', array('class'=>'control-label col-xs-5')); ?>
			<div class="col-xs-7">
				<p class="form-control-static"><?= $model->propertyTypeText ?></p>
			</div>
		</div>
		<div class="form-group">
			<?php echo $form->labelEx($model, 'room_type', array('class'=>'control-label col-xs-5')); ?>
			<div class="col-xs-7">
				<p class="form-control-static"><?= $model->roomTypeText ?></p>
			</div>
		</div>
		<div class="form-group">
			<?php echo $form->labelEx($model, 'room_size', array('class'=>'control-label col-xs-5')); ?>
			<div class="col-xs-7">
				<p class="form-control-static"><?= $model->room_size ?></p>
				<span class="help-block">sqft</span>
			</div>
		</div>
		<h3>Profile Registration</h3>
		<div class="form-group">
			<label for="" class="control-label col-xs-5">Your Name</label>
			<div class="col-xs-7">
				<p class="form-control-static"><?= $model->salutation ?>. <?= $model->fullname ?></p>
			</div>
		</div>
		<div class="form-group">
			<?php echo $form->labelEx($model, 'email', array('class'=>'control-label col-xs-5')); ?>
			<div class="col-xs-7">
				<p class="form-control-static"><?= $model->email ?></p>
			</div>
		</div>
		<div class="form-group">
			<?php echo $form->labelEx($model, 'contact_no', array('class'=>'control-label col-xs-5')); ?>
			<div class="col-xs-7">
				<p class="form-control-static"><?= $model->contact_no ?></p>
			</div>
		</div>
		<div class="form-group">
			<?php echo $form->labelEx($model, 'time_contact', array('class'=>'control-label col-xs-5')); ?>
			<div class="col-xs-7">
				<p class="form-control-static"><?= $model->preferedTimeText ?></p>
			</div>
		</div>
		<div class="form-group">
			<?php echo $form->labelEx($model, 'know_by', array('class'=>'control-label col-xs-5')); ?>
			<div class="col-xs-7">
				<p class="form-control-static"><?= $model->knowByText ?></p>
			</div>
		</div>
		<h3>Services</h3>
		<?php foreach($model->getRegisteredServiceData() as $group): ?>
			<h4><?= $group['model']->name ?></h4>
			<ul>
			<?php foreach($group['childs'] as $item): ?>
			<li><?= $item->name ?></li>
			<?php endforeach ?>
			</ul>
		<?php endforeach ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-4 text-left"><p><a href="<?= $this->createUrl('step2') ?>" class="btn btn-9">Back</a></p></div>
	<div class="col-xs-8 text-right"><p><button class="btn btn-9" type="submit">Submit Now</button></p></div>
</div>
<?php $this->endWidget(); ?>

<?php $pageTerm = Pages::model()->findByPk(PAGE_TERMS_CONDITION); ?>
<div class="modal fade" id="term-modal" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3 class="modal-title"><?php if (isset($pageTerm->title)) echo $pageTerm->title; ?></h3>
			</div>
			<div class="modal-body">
				<?php if (isset($pageTerm->content)) echo $pageTerm->content; ?>
				<?php
				$text_date = '';
				$date_now = date('d',strtotime(date('Y-m-d'))).'th of '.date('F Y',strtotime(date('Y-m-d')));
				?>
				<p>&nbsp;</p>
			</div>
		</div>
	</div>
</div>