<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'transactions_id',array('label' => Yii::t('translation','Transactions_id'))); ?>
		<?php echo $form->textField($model,'transactions_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_number',array('label' => Yii::t('translation','Invoice_number'))); ?>
		<?php echo $form->textField($model,'invoice_number',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_type',array('label' => Yii::t('translation','Invoice_type'))); ?>
		<?php echo $form->textField($model,'invoice_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_template',array('label' => Yii::t('translation','Invoice_template'))); ?>
		<?php echo $form->textField($model,'invoice_template'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_bill_to_id',array('label' => Yii::t('translation','Trans_bill_to_id'))); ?>
		<?php echo $form->textField($model,'trans_bill_to_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type',array('label' => Yii::t('translation','Type'))); ?>
		<?php echo $form->textField($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_type_id',array('label' => Yii::t('translation','Client_type_id'))); ?>
		<?php echo $form->textField($model,'client_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_bill_to',array('label' => Yii::t('translation','Invoice_bill_to'))); ?>
		<?php echo $form->textField($model,'invoice_bill_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_date',array('label' => Yii::t('translation','Created_date'))); ?>
		<?php echo $form->textField($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receipt_name',array('label' => Yii::t('translation','Receipt_name'))); ?>
		<?php echo $form->textField($model,'receipt_name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receipt_nric',array('label' => Yii::t('translation','Receipt_nric'))); ?>
		<?php echo $form->textField($model,'receipt_nric',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receipt_contact_no',array('label' => Yii::t('translation','Receipt_contact_no'))); ?>
		<?php echo $form->textField($model,'receipt_contact_no',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receipt_date_paid',array('label' => Yii::t('translation','Receipt_date_paid'))); ?>
		<?php echo $form->textField($model,'receipt_date_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voucher_pay_to',array('label' => Yii::t('translation','Voucher_pay_to'))); ?>
		<?php echo $form->textField($model,'voucher_pay_to',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voucher_no',array('label' => Yii::t('translation','Voucher_no'))); ?>
		<?php echo $form->textField($model,'voucher_no',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voucher_cheque_no',array('label' => Yii::t('translation','Voucher_cheque_no'))); ?>
		<?php echo $form->textField($model,'voucher_cheque_no',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voucher_ma_gross_comm',array('label' => Yii::t('translation','Voucher_ma_gross_comm'))); ?>
		<?php echo $form->textField($model,'voucher_ma_gross_comm',array('size'=>16,'maxlength'=>16)); ?>
	</div>

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