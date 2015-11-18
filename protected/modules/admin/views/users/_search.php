<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
  
<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>47,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'full_name'); ?>
		<?php echo $form->textField($model,'full_name',array('size'=>47,'maxlength'=>250)); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'hand_phone'); ?>
        <?php echo $form->textField($model,'hand_phone',array('size'=>20,'maxlength'=>20)); ?>
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

<style>
    div .buttons input{
        margin-left: 50px;
    }
</style>