<h2>Generate Receipt</h2>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-defect-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>

    
	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	<div class="row">
            <?php echo $form->labelEx($model,'receipt_name'); ?>
            <?php echo $form->textField($model,'receipt_name',array('class'=>'w-350')); ?>
            <?php echo $form->error($model,'receipt_name'); ?>
	</div>
	<div class="row">
            <?php echo $form->labelEx($model,'receipt_nric'); ?>
            <?php echo $form->textField($model,'receipt_nric',array('class'=>'w-350')); ?>
            <?php echo $form->error($model,'receipt_nric'); ?>
	</div>
	<div class="row">
            <?php echo $form->labelEx($model,'receipt_contact_no'); ?>
            <?php echo $form->textField($model,'receipt_contact_no',array('class'=>'w-350')); ?>
            <?php echo $form->error($model,'receipt_contact_no'); ?>
	</div>
    
        <!--anh dung Oct 31, 2014--> 
        <div class="row listing_type_radio_list">
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
        
        <div class="row cheque_number_1 cheque_number_div <?php echo $model->payment_mode==FiPaymentVoucher::PAYMENT_MODE_CHEQUE?"":'display_none'; ?>">
            <?php echo $form->labelEx($model,'cheque_number'); ?>
            <?php echo $form->textField($model,'cheque_number',array('class'=>'w-350')); ?>
            <?php echo $form->error($model,'cheque_number'); ?>
  	</div>

        <!--anh dung Oct 31, 2014--> 
    
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
    
	<div class="row buttons" style="padding-left: 138px;">
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

<style>
    div.form .row label { width:  138px; }
    
</style>

<script>
    $(function(){
        $('.iframe_close').live('click', function(){
            parent.$.colorbox.close();
        });
    });
    
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