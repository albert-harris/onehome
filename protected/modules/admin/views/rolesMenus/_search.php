<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('admin/rolesMenus/addRoles'),
	'method'=>'post',
    'id'=>'add_roles',
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
)); ?>


    <div class="row">
        <?php echo $form->labelEx($model,'role_id',array('label'=>'Choose a role for the link')); ?><br/>
        <?php echo $form->dropDownList($model,'role_id',Roles::loadItems(1)); ?>
        <?php echo $form->error($model,'role_id'); ?>

    </div>
    <?php echo $form->hiddenField($model, 'menu_id',array('value'=>$id)); ?>


	<div class="row buttons2">
		<?php echo CHtml::submitButton('Add'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->