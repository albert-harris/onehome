<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));

$cAction = strtolower(Yii::app()->controller->action->id);
?>

	<div class="row">
		<?php echo $form->label($model,'voucher_no'); ?>
		<?php echo $form->textField($model,'voucher_no'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'pay_to'); ?>
		<?php echo $form->dropDownlist($model,'pay_to',FiPaymentVoucher::$STATUS_PAY_TO,array('empty'=>'Select')); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'user_billing_address'); ?>
		<?php echo $form->textField($model,'user_billing_address'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'user_postal_code'); ?>
		<?php echo $form->textField($model,'user_postal_code'); ?>
	</div>
	<?php if(Yii::app()->controller->action->id=='paymentvouchers'): ?>
	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownlist($model,'status',array(STATUS_ACTIVE=>'Paid',STATUS_INACTIVE=>'UnPaid'),array('empty'=>'Select')); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons" style="padding-left: 159px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>Yii::t('translation','Search'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->