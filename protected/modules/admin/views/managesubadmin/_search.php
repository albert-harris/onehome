<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


        <div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>47,'maxlength'=>250)); ?>
	</div>
    
	<div class="row">
            <?php echo $form->label($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>47,'maxlength'=>250)); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model,'first_name', array('label'=>'Full Name')); ?>
        <?php echo $form->textField($model,'first_name',array('size'=>20,'maxlength'=>50,'placeholder'=>'First Name')); ?>
        <?php echo $form->textField($model,'last_name',array('size'=>20,'maxlength'=>50,'placeholder'=>'Last Name')); ?>
        <?php echo $form->error($model,'first_name'); ?>
        <?php echo $form->error($model,'last_name'); ?>
	</div>

<!--    <div class="row">
        <?php echo $form->label($model,'phone'); ?>
        <?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
    </div>-->

    <div class="row">
        <?php echo $form->label($model,'role_id'); ?>
        <?php echo $form->dropDownList($model,'role_id', Roles::loadItems(), array('empty'=>'Select')); ?>
    </div>     

    <div class="row status">
        <?php echo $form->label($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',array(''=>'Select status',1=>'Active',0=>'Inactive' ));?>
    </div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->