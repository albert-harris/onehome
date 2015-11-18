<?php
/* @var $model ProAgent */
Yii::app()->clientScript->registerScript(time(), "
	app.setupAgentRegisterPage();
", CClientScript::POS_LOAD);
?>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'sidebar')); ?>
	<div class="paper">
		<img src="<?= Yii::app()->theme->baseUrl ?>/img/paper-top.jpg" alt="" class="img-responsive">
		<div class="content clearfix">
			<?= StaticBlock::getBlockContent('unique-features') ?>
		</div>	
		<img src="<?= Yii::app()->theme->baseUrl ?>/img/paper-bottom.jpg" alt="" class="img-responsive">
	</div>
<?php $this->endWidget();?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-registration-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true),
	'htmlOptions'=>array('enctype' => 'multipart/form-data', 'class'=>'box-2 white-form', 'style'=>'padding: 8px')
)); ?>
	<h1 class="green-pane">Agent Account Registration</h1>
	<p><span class="errorMessage">*</span> Indicates required fields</p>
	
	<div style="padding: 10px">
		<div class="form-group">
			<?php echo $form->labelEx($model, 'title', array('class'=>'control-label')); ?>
			<div>
			<?php echo $form->radioButtonList($model, 'title', CmsFormatter::$TITLE_MR, array(
				'separator' => '',
				'container' => 'span',
				'template' => '<span class="radio-inline">{input}{label}</span>',
			)); ?>
			</div>
			<?php echo $form->error($model, 'title'); ?>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model, 'name_for_slug', array('class'=>'control-label')); ?>
					<?php echo $form->textField($model, 'name_for_slug', array('class'=>'form-control')) ?>
					<?php echo $form->error($model, 'name_for_slug'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model, 'phone', array('class'=>'control-label')); ?>
					<?php echo $form->textField($model, 'phone', array('class'=>'form-control number_only')) ?>
					<?php echo $form->error($model, 'phone'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model, 'email_not_login', array('class'=>'control-label')); ?>
					<?php echo $form->emailField($model, 'email_not_login', array('class'=>'form-control')) ?>
					<?php echo $form->error($model, 'email_not_login'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model, 'agent_cea', array('class'=>'control-label')); ?>
					<?php echo $form->textField($model, 'agent_cea', array('class'=>'form-control')) ?>
					<?php echo $form->error($model, 'agent_cea'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model, 'uploadPhoto', array('class'=>'control-label')); ?>
					<?php echo $form->fileField($model, 'uploadPhoto', array('class'=>'')) ?>
					<?php echo $form->error($model, 'uploadPhoto'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model, 'uploadNricFront', array('class'=>'control-label')); ?>
					<?php echo $form->fileField($model, 'uploadNricFront', array('class'=>'')) ?>
					<?php echo $form->error($model, 'uploadNricFront'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model, 'uploadNricBack', array('class'=>'control-label')); ?>
					<?php echo $form->fileField($model, 'uploadNricBack', array('class'=>'')) ?>
					<?php echo $form->error($model, 'uploadNricBack'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model, 'uploadCertification', array('class'=>'control-label')); ?>
					<?php echo $form->fileField($model, 'uploadCertification', array('class'=>'')) ?>
					<?php echo $form->error($model, 'uploadCertification'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model, 'location_id', array('class'=>'control-label')); ?>
					<?php echo $form->dropDownList($model, 'location_id', ProLocation::getListDataLocation(), array('class'=>'form-control', 'empty'=>'Select')) ?>
					<?php echo $form->error($model, 'location_id'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="checkbox">
					<label><?php echo $form->checkbox($model, 'updatedCea') ?> Updated in CEA Website</label>
					<?php echo $form->error($model, 'updatedCea'); ?>
				</div>
				<div class="checkbox">
					<label><?php echo $form->checkbox($model, 'agreeTerm') ?> I agree Terms and conditions</label>
					<?php echo $form->error($model, 'agreeTerm'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<br/>
					<?php echo $form->textField($model,'verifyCode', array('class'=>'form-control', 'placeHolder'=>'Enter the code below')); ?>
					<?php $this->widget('CCaptcha'); ?>
					<?php echo $form->error($model, 'verifyCode'); ?>
				</div>		
			</div>
		</div>
	</div>

	<div class="form-group"><button type="submit" class="green-pane"
		style="font-weight: bold;font-size: 20px; margin-bottom: 180px;">SIGN UP</button>
	</div>
<?php $this->endWidget(); ?>		
<style>
/*
 * green pane
 */
.green-pane {
  background-color: #8bc63e;
  border-radius: 6px;
  color: #fff;
  display: block;
  font-size: 18px;
  margin: 0 0 10px;
  padding: 14px 0;
  text-align: center;
  width: 100%;
  border: none;
}



</style>