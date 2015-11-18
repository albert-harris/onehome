<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
	</div>


    <div class="row">
        <?php echo $form->label($model,'first_name'); ?>
        <?php echo $form->textField($model,'first_name',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'last_name'); ?>
        <?php echo $form->textField($model,'last_name',array('size'=>50,'maxlength'=>50)); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->dropDownList($model,'gender', ActiveRecord::getGenders()); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->dropDownList($model,'title', ActiveRecord::getTiles()); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', Yii::app()->format->getStatusFormat()); ?>
    </div>

	<div class="row buttons">
		<button type="submit">Search</button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->