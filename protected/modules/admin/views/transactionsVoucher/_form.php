<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-transactions-invoice-form',
	'enableAjaxValidation'=>false,
)); ?>
    <style>
        div.form .row label { width: 135px;}
    </style>
	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
    
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'voucher_pay_to')); ?>
		<?php echo $form->dropDownList($model,'voucher_pay_to', ProTransactionsSaveCommission::getListUserForVoucher($mTrans->id), array('empty'=>'Select','style'=>'width:385px;')); ?>
		<?php echo $form->error($model,'voucher_pay_to'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'voucher_no')); ?>
		<?php echo $form->textField($model,'voucher_no',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'voucher_no'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'voucher_cheque_no')); ?>
		<?php echo $form->textField($model,'voucher_cheque_no',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'voucher_cheque_no'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'voucher_ma_gross_comm')); ?>
		<?php echo $form->textField($model,'voucher_ma_gross_comm',array('size'=>60,'maxlength'=>16, 'class'=>'number_only')); ?>
		<?php echo $form->error($model,'voucher_ma_gross_comm'); ?>
	</div>
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'receipt_date_paid')); ?>
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,        
                    'attribute'=>'receipt_date_paid',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=> ActiveRecord::getDateFormatJquery(),
//                        'maxDate'=> '0',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showOn' => 'button',
                        'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                        'buttonImageOnly'=> true,                                
                    ),        
                    'htmlOptions'=>array(
                        'class'=>'',
                        'style'=>'width: 200px;margin-right:10px;',
                        'readonly'=>'readonly',
                    ),
                ));
            ?>
            <?php echo $form->error($model,'receipt_date_paid'); ?>
	</div>
    

	<div class="row buttons" style="padding-left: 135px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	
        <button class="iframe_close" type="button">Cancel</button>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/verz.js"></script>
<script>
    $(function(){
        $('.iframe_close').live('click', function(){
            parent.$.colorbox.close();
        });
    });
    
//     $(document).ready(function(){
//        $(".show-image").fancybox();
//     });
</script>