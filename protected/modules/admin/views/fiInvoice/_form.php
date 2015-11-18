<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fi-invoice-form',
	'enableAjaxValidation'=>false,   
)); 
$cmsFormater = new CmsFormatter();
?>
<?php // echo $form->errorSummary($model); ?>
	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
        <?php if(!$model->isNewRecord):?>
	<div class="row more_col">
            <div class="mycol1">
                <?php echo Yii::t('translation', $form->labelEx($model,'invoice_no')); ?>
                <?php echo $model->invoice_no; ?>
            </div>
            <div class="mycol1">
                <?php echo Yii::t('translation', $form->labelEx($model,'transactions_no')); ?>
                <?php echo $model->transactions_no; ?>
            </div>
            <div class="mycol1">
                <?php echo Yii::t('translation', $form->labelEx($model,'created_date')); ?>
                <?php echo $cmsFormater->formatDate($model->created_date);?>
            </div>
	</div>
        <?php endif; ?>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'bill_to')); ?>
		<?php echo $form->dropDownList($model,'bill_to', FiInvoice::getListOptionBillTo(), array("class"=>"w-350", 'empty'=>'Select')); ?>
		<?php echo $form->error($model,'bill_to'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'user_name')); ?>
                <div class="f-left">
                <?php
                    // ANH DUNG Sep 11, 2014 widget auto complete search user customer and supplier
                    $url = Yii::app()->createAbsoluteUrl('ajax/search_user_financial');
                    $aData = array(
                        'model'=>$model,
                        'name_relation_user'=>'rUser', // relation of field
                        'field_customer_id'=>'user_id',// hidden field need update 
                        'field_autocomplete_name'=>'user_name',
                        'placeHolder'=>'Type Full Name to search',
                        'divClosest'=>'unique_wrap_autocomplete',                        
                        'CallFunctionLandLord'=>"InvoiceSelectUser",// name function define
                        'NotShowTableInfo'=>1,
                        'CustomClass'=>"w-350",
                        'ShowNoDataFound'=> 0,
                        'url'=> $url,
                    );
                    $this->widget('ext.ProAutocompleteUser.ProAutocompleteUser',
                        array('data'=>$aData));

                ?>
                </div>
                <?php echo $form->hiddenField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'user_name', array('class'=>'errorMessage clr')); ?>
	</div>

	
	<div class="row">
            <?php echo Yii::t('translation', $form->labelEx($model,'nric')); ?>
            <?php echo $form->textField($model,'nric',array("class"=>"w-350",'maxlength'=>300)); ?>
            <?php echo $form->error($model,'nric'); ?>
	</div>
    
        <div class="row">
            <?php echo Yii::t('translation', $form->labelEx($model,'user_billing_address')); ?>
            <?php echo $form->textField($model,'user_billing_address',array("class"=>"w-350",'maxlength'=>300)); ?>
            <?php echo $form->error($model,'user_billing_address'); ?>
	</div>    

	<div class="row">
            <?php echo Yii::t('translation', $form->labelEx($model,'user_postal_code')); ?>
            <?php echo $form->textField($model,'user_postal_code',array("class"=>"w-350",'maxlength'=>100)); ?>
            <?php echo $form->error($model,'user_postal_code'); ?>
	</div>
    
        <!--anh dung Oct 31, 2014--> 
        <div class="row listing_type_radio_list display_none">
            <?php echo $form->labelEx($model,'payment_mode'); ?>
            <?php
                echo $form->radioButtonList($model, 'payment_mode', FiPaymentVoucher::$ARR_PAYMENT_MODE, array(
                    'separator' => '',
                    'class' => 'listing_type_rd',
                ));
            ?>
            <div class="clr"></div>
            <?php echo $form->error($model,'payment_mode'); ?>
        </div>
        
        <div class="display_none row cheque_number_1 cheque_number_div <?php echo $model->payment_mode==FiPaymentVoucher::PAYMENT_MODE_CHEQUE?"":'display_none'; ?>">
            <?php echo $form->labelEx($model,'cheque_number'); ?>
            <?php echo $form->textField($model,'cheque_number',array('class'=>'w-350')); ?>
            <?php echo $form->error($model,'cheque_number'); ?>
  	</div>

        <!--anh dung Oct 31, 2014--> 
    
        <?php include "_form_detail.php";?>

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

<script> 
    // function update after select from autocomplete
    function InvoiceSelectUser(item, idField){
        $('#FiInvoice_user_billing_address').val(item.address);
        $('#FiInvoice_user_postal_code').val(item.postal_code);
        $('#FiInvoice_nric').val(item.nric_passportno_roc);
    }
    
    // ANH DUNG OCT 24, 2014
    $(function(){
       bindRadioPaymentMode();
    });
    
    function bindRadioPaymentMode(){
        $('.listing_type_rd').click(function(){
           if($(this).val()==2){
               $('.cheque_number_div').show();
           }else{
               $('.cheque_number_div').hide();
               $('.cheque_number_div input').val('');
           }
       });
    }
    // ANH DUNG OCT 24, 2014
    
</script>