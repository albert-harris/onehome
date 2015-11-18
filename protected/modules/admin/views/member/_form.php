<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row_align">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row_align">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>30,'maxlength'=>50, 'value'=>'')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

    <div class="row_align">
        <?php echo $form->labelEx($model,'password_repeat'); ?>
        <?php echo $form->passwordField($model,'password_repeat',array('size'=>30,'maxlength'=>50, 'value'=>'')); ?>
        <?php echo $form->error($model,'password_repeat'); ?>
    </div>

	<div class="row_align">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>50,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row_align">
		<?php echo $form->labelEx($model,'birthday'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'Member[birthday]',
            'model'=>$model,
            'value'=>($model->birthday !='')? date('Y/m/d', strtotime($model->birthday)):$model->birthday,
            // additional javascript options for the date picker plugin
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy/mm/dd',
            ),
            'htmlOptions'=>array(
                'style'=>'height:20px;',
            ),
        ));
        ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="row_align">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->dropDownList($model,'gender', ActiveRecord::getGenders()); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row_align">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', Yii::app()->format->getStatusFormat()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
    <div class="row_align">
        <?php echo $form->labelEx($model,'first_name', array('label'=>'Name')); ?>
        <?php echo $form->dropDownList($model,'title', ActiveRecord::getTiles(),array('class'=>'text-3')); ?>
        <?php echo $form->textField($model,'first_name',array('size'=>15,'maxlength'=>50,'class'=>'text-1','placeholder'=>'First Name')); ?>
        <?php echo $form->textField($model,'last_name',array('size'=>15,'maxlength'=>50,'class'=>'text-1','placeholder'=>'Last Name')); ?>
        <?php echo $form->error($model,'title'); ?>
        <?php echo $form->error($model,'first_name'); ?>
        <?php echo $form->error($model,'last_name'); ?>
    </div>

	<div class="row_align">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row_align">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>30,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row_align">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>

	<div class="row buttons">
        <button type="submit">Save</button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->