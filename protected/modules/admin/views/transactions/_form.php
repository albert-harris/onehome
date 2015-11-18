<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-transactions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'transactions_no')); ?>
		<?php echo $form->textField($model,'transactions_no',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'transactions_no'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'listing_id')); ?>
		<?php echo $form->textField($model,'listing_id',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'listing_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'user_id')); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'type')); ?>
		<?php echo $form->textField($model,'type'); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'otp_contract_date')); ?>
		<?php echo $form->textField($model,'otp_contract_date'); ?>
		<?php echo $form->error($model,'otp_contract_date'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'tenancy_agreement_date')); ?>
		<?php echo $form->textField($model,'tenancy_agreement_date'); ?>
		<?php echo $form->error($model,'tenancy_agreement_date'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'months_rent')); ?>
		<?php echo $form->textField($model,'months_rent'); ?>
		<?php echo $form->error($model,'months_rent'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'with_tenancy')); ?>
		<?php echo $form->textField($model,'with_tenancy'); ?>
		<?php echo $form->error($model,'with_tenancy'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'commencement_date')); ?>
		<?php echo $form->textField($model,'commencement_date'); ?>
		<?php echo $form->error($model,'commencement_date'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'expiring_date')); ?>
		<?php echo $form->textField($model,'expiring_date'); ?>
		<?php echo $form->error($model,'expiring_date'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'tenancy_amount')); ?>
		<?php echo $form->textField($model,'tenancy_amount',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'tenancy_amount'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'deposit_payable')); ?>
		<?php echo $form->textField($model,'deposit_payable',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'deposit_payable'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'appointment_date_hdb_only')); ?>
		<?php echo $form->textField($model,'appointment_date_hdb_only'); ?>
		<?php echo $form->error($model,'appointment_date_hdb_only'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'transacted_price')); ?>
		<?php echo $form->textField($model,'transacted_price',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'transacted_price'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'valuation_price')); ?>
		<?php echo $form->textField($model,'valuation_price',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'valuation_price'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'internal_co_broke_consultant')); ?>
		<?php echo $form->textField($model,'internal_co_broke_consultant'); ?>
		<?php echo $form->error($model,'internal_co_broke_consultant'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'co_broke_agreement')); ?>
		<?php echo $form->textField($model,'co_broke_agreement',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'co_broke_agreement'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'purchaser_user_id')); ?>
		<?php echo $form->textField($model,'purchaser_user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'purchaser_user_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'client_type_id')); ?>
		<?php echo $form->textField($model,'client_type_id'); ?>
		<?php echo $form->error($model,'client_type_id'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'invoice_bill_to')); ?>
		<?php echo $form->textField($model,'invoice_bill_to'); ?>
		<?php echo $form->error($model,'invoice_bill_to'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'created_date')); ?>
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'status')); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons" style="padding-left: 115px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->