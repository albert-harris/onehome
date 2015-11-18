<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'status',array('label' => Yii::t('translation','Status'))); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_admin_created',array('label' => Yii::t('translation','Is_admin_created'))); ?>
		<?php echo $form->textField($model,'is_admin_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by',array('label' => Yii::t('translation','Created_by'))); ?>
		<?php echo $form->textField($model,'created_by',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'add_property',array('label' => Yii::t('translation','Add_property'))); ?>
		<?php echo $form->textField($model,'add_property'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transactions_no',array('label' => Yii::t('translation','Transactions_no'))); ?>
		<?php echo $form->textField($model,'transactions_no',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'listing_id',array('label' => Yii::t('translation','Listing_id'))); ?>
		<?php echo $form->textField($model,'listing_id',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_approved',array('label' => Yii::t('translation','Admin_approved'))); ?>
		<?php echo $form->textField($model,'admin_approved'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id',array('label' => Yii::t('translation','User_id'))); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type',array('label' => Yii::t('translation','Type'))); ?>
		<?php echo $form->textField($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otp_contract_date',array('label' => Yii::t('translation','Otp_contract_date'))); ?>
		<?php echo $form->textField($model,'otp_contract_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tenancy_agreement_date',array('label' => Yii::t('translation','Tenancy_agreement_date'))); ?>
		<?php echo $form->textField($model,'tenancy_agreement_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'months_rent',array('label' => Yii::t('translation','Months_rent'))); ?>
		<?php echo $form->textField($model,'months_rent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'with_tenancy',array('label' => Yii::t('translation','With_tenancy'))); ?>
		<?php echo $form->textField($model,'with_tenancy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'commencement_date',array('label' => Yii::t('translation','Commencement_date'))); ?>
		<?php echo $form->textField($model,'commencement_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expiring_date',array('label' => Yii::t('translation','Expiring_date'))); ?>
		<?php echo $form->textField($model,'expiring_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tenancy_amount',array('label' => Yii::t('translation','Tenancy_amount'))); ?>
		<?php echo $form->textField($model,'tenancy_amount',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deposit_payable',array('label' => Yii::t('translation','Deposit_payable'))); ?>
		<?php echo $form->textField($model,'deposit_payable',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'appointment_date_hdb_only',array('label' => Yii::t('translation','Appointment_date_hdb_only'))); ?>
		<?php echo $form->textField($model,'appointment_date_hdb_only'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transacted_price',array('label' => Yii::t('translation','Transacted_price'))); ?>
		<?php echo $form->textField($model,'transacted_price',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valuation_price',array('label' => Yii::t('translation','Valuation_price'))); ?>
		<?php echo $form->textField($model,'valuation_price',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'internal_co_broke_consultant',array('label' => Yii::t('translation','Internal_co_broke_consultant'))); ?>
		<?php echo $form->textField($model,'internal_co_broke_consultant'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_broke_agreement',array('label' => Yii::t('translation','Co_broke_agreement'))); ?>
		<?php echo $form->textField($model,'co_broke_agreement',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purchaser_user_id',array('label' => Yii::t('translation','Purchaser_user_id'))); ?>
		<?php echo $form->textField($model,'purchaser_user_id',array('size'=>11,'maxlength'=>11)); ?>
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