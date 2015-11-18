<div class="form">
        
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-model-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
<?php if (Yii::app()->user->hasFlash('msg')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('msg'); ?>
        </div>
    <?php endif; ?>

	<?php 
//	 echo str_replace('<li>Salutation cannot be blank.</li>','', $form->errorSummary($model));
	?>

	
	<div class="row">
		<?php echo $form->labelEx($model,'affiliate_code'); ?>
                <?php echo $form->textField($model,'affiliate_code',array('class'=>'in-text w-1','readonly'=>'readonly')); ?>
                <!--<span class="refresh-code"><a href="<?php // echo Yii::app()->createAbsoluteUrl('site/ajaxRefreshAffiliateCode') ?>" class="underline" id="refresh-code">Refresh</a></span>-->
                <?php echo $form->error($model,'affiliate_code'); ?>
	</div>	
        <div class="row">
            <?php $status = Users::$requestStatus;unset($status[2]); echo $form->labelEx($model,'status'); ?>
            <?php echo $form->dropDownList($model,'status', $status); ?>
            <?php echo $form->error($model,'status'); ?>
    </div>
             <div class="row">
                            <?php echo $form->labelEx($model,'payment_type'); ?>
                            <?php echo $form->dropDownList($model,'payment_type', SpTransactions::$aPaymentTypes,array('class'=>'in-text w-3')); ?>
                            <?php echo $form->error($model,'payment_type'); ?>
                        </div>
                        <div class="row">                            
                            <?php echo $form->labelEx($model,'payment_status'); ?>
                            <?php if($model->payment_status == PAYMENT_STATUS_PENDING): ?>
                                <?php echo $form->dropDownList($model,'payment_status', SpTransactions::$aPaymentStatus,array('class'=>'in-text w-3')); ?>
                            <?php else: ?>
                            <label><?php echo SpTransactions::$aPaymentStatus[$model->payment_status] ?></label>
                                <?php // echo $form->dropDownList($model,'payment_status', SpTransactions::$aPaymentStatus,array('class'=>'in-text w-3','readonly'=>'readonly')); ?>
                            <?php endif; ?>
                            <?php echo $form->error($model,'payment_status'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->labelEx($model,'coins_balance'); ?>
                            <?php echo $form->textField($model,'coins_balance', array('class'=>'in-text w-3', 'maxlength' => 4)); ?>
                            <?php echo $form->error($model,'coins_balance'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->labelEx($model,'commission_amount'); ?>
                            <?php echo $form->textField($model,'commission_amount', array('class'=>'in-text w-3', 'disabled'=>'disabled')); ?>
                            <?php echo $form->error($model,'commission_amount'); ?>
                        </div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'membership_fee', array('label'=>'Membership Fee (S$)')); ?>
                <?php echo $form->textField($model,'membership_fee',array('class'=>'in-text w-1','readonly'=>'readonly')); ?>
                <?php echo $form->error($model,'membership_fee'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>47,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="row">
                <?php if ($model->scenario == 'editUser'):?>
                    <div style="width: 100%;float: left;padding-bottom: 5px;padding-left: 120px;">
                        <label style="color: red;width: auto; ">Leave this blank if you don't want to change current password</label>
                    </div>
                <?php endif?>
		<?php echo $form->labelEx($model,'password_hash'); ?>
		<?php echo $form->passwordField($model,'password_hash',array('size'=>47,'maxlength'=>50,'value'=>'')); ?>
                <!--<span class="note note-4 w-4">*Minimum <?php // echo PASSW_LENGTH_MIN;?> characters with at least 1 number. Be Tricky!</span>-->
		<?php echo $form->error($model,'password_hash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_confirm'); ?>
		<?php echo $form->passwordField($model,'password_confirm',array('size'=>47,'maxlength'=>50,'value'=>'')); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>

<!--	add-->
        <div class="row">
            <?php echo $form->labelEx($model,'first_name',array('label'=>'First Name')); ?>
            <?php echo $form->textField($model,'first_name',array('class'=>'in-text w-1')); ?>
            <?php echo $form->error($model,'first_name'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'last_name',array('label'=>'Last Name')); ?>
            <?php echo $form->textField($model,'last_name',array('class'=>'in-text w-1')); ?>
            <?php echo $form->error($model,'last_name'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'gender',array('label'=>'Gender')); ?>
            <?php echo $form->dropdownList($model,'gender', array('Male'=>'Male','Female'=>'Female'), array('class'=>'w-1')); ?>
            <?php echo $form->error($model,'gender'); ?>
        </div>
                            
        <div class="row">
            <?php echo $form->labelEx($model,'dob'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model' => $model,
                                'attribute'=>'dob',
                                'options'=>array(
                                        'showAnim'=>'fold',
                                        'showButtonPanel'=>true,
                                        'autoSize'=>true,
                                        'dateFormat'=>'dd/mm/yy',
                                        'width'=>'120',
                                        'separator'=>' ',
                                        'showOn' => 'button',
                                        'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                                        'buttonImageOnly'=> true,
                                        'changeMonth'=> true,
                                        'changeYear'=> true,
                                        'yearRange'=> "c-100:c+0",
                                        'maxDate'=>0
                                ),
                                'htmlOptions'=>array(
                                        'readonly'=>true,
                                        'class'=>'in-text w-1'
                                ),
                        ));
                ?>
                <?php echo $form->error($model,'dob'); ?>
        </div>    
        <div class="row">
            <?php echo $form->labelEx($model,'secret_question_id'); ?>
            <?php echo $form->dropdownList($model,'secret_question_id', SpSecretQuestion::getDropdownListData(1), array('class'=>'w-1')); ?>
            <?php echo $form->error($model,'secret_question_id'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'answer_secret_question'); ?>
            <?php echo $form->textField($model,'answer_secret_question',array('class'=>'in-text w-1')); ?>
            <?php echo $form->error($model,'answer_secret_question'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'hand_phone'); ?>
            <?php echo $form->textField($model,'hand_phone',array('class'=>'in-text w-1', 'maxlength' => 12)); ?>
            <?php echo $form->error($model,'hand_phone'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'home_phone'); ?>
            <?php echo $form->textField($model,'home_phone',array('class'=>'in-text w-1', 'maxlength' => 12)); ?>
            <?php echo $form->error($model,'home_phone'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'office_phone'); ?>
            <?php echo $form->textField($model,'office_phone',array('class'=>'in-text w-1', 'maxlength' => 12)); ?>
            <?php echo $form->error($model,'office_phone'); ?>
        </div>
        
<h2>Mailing Address</h2>
                        <div class="row">
                            <?php echo $form->labelEx($model,'mailing_address1'); ?>
                            <?php echo $form->textField($model,'mailing_address1',array('class'=>'in-text w-3')); ?>
                            <?php echo $form->error($model,'mailing_address1'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->labelEx($model,'mailing_address2'); ?>
                            <?php echo $form->textField($model,'mailing_address2',array('class'=>'in-text w-3')); ?>
                            <?php echo $form->error($model,'mailing_address2'); ?>
                        </div>
                        <div class="row">
                            <div class="in-row-block">
                            <?php echo $form->labelEx($model,'mailing_country_id'); ?>
                            <?php echo $form->dropdownList($model,'mailing_country_id', AreaCode::loadArrArea(), array('class'=>'w-1 space-1')); ?>
                            <?php echo $form->error($model,'mailing_country_id'); ?>
                            </div>
                            <div class="in-row-block">
                            <?php echo $form->labelEx($model,'mailing_city', array('class'=>'no-w')); ?>
                            <?php echo $form->textField($model,'mailing_city',array('class'=>'in-text w-5 space-1')); ?>
                            <?php echo $form->error($model,'mailing_city'); ?>
                            </div>
                            <div class="in-row-block">
                            <?php echo $form->labelEx($model,'mailing_postal_code', array('class'=>'no-w')); ?>
                            <?php echo $form->textField($model,'mailing_postal_code',array('class'=>'in-text w-5', 'maxlength' => 10)); ?>
                            <?php echo $form->error($model,'mailing_postal_code'); ?>
                            </div>
                        </div>
                        
                        <h2>Shipping Address</h2>
                    	<div class="row">
                        	<label>Same as mailing address :</label>
                                <input id="ckb-same-address" type="checkbox">
                        </div>
                    	<div class="row">
                            <?php echo $form->labelEx($model,'shipping_address1'); ?>
                            <?php echo $form->textField($model,'shipping_address1',array('class'=>'in-text w-3')); ?>
                            <?php echo $form->error($model,'shipping_address1'); ?>
                        </div>
                    	<div class="row">
                            <?php echo $form->labelEx($model,'shipping_address2'); ?>
                            <?php echo $form->textField($model,'shipping_address2',array('class'=>'in-text w-3')); ?>
                            <?php echo $form->error($model,'shipping_address2'); ?>
                        </div>
                    	<div class="row">
                            <div class="in-row-block">
                            <?php echo $form->labelEx($model,'shipping_country_id'); ?>
                            <?php echo $form->dropdownList($model,'shipping_country_id', AreaCode::loadArrArea(), array('class'=>'w-1 space-1')); ?>
                            <?php echo $form->error($model,'shipping_country_id'); ?>
                            </div>
                            <div class="in-row-block">
                            <?php echo $form->labelEx($model,'shipping_city', array('class'=>'no-w')); ?>
                            <?php echo $form->textField($model,'shipping_city',array('class'=>'in-text w-5 space-1')); ?>
                            <?php echo $form->error($model,'shipping_city'); ?>
                            </div>
                             <div class="in-row-block">
                            <?php echo $form->labelEx($model,'shipping_postal_code', array('class'=>'no-w')); ?>
                            <?php echo $form->textField($model,'shipping_postal_code',array('class'=>'in-text w-5',  'maxlength' => 10)); ?>
                            <?php echo $form->error($model,'shipping_postal_code'); ?>
                            </div>
                        </div>
                        <!--<h2>Payment Information</h2>-->                     
                   

        
    <!--<div class="clr"></div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<style>
    div .buttons input{
        margin-left: 62px;
    }
    .form select {width: 218px;}
</style>
<script type="text/javascript">
    
    $('#refresh-code').live('click',function(){
        $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            success: function( data ) {                
                $('#Users_affiliate_code').val(data);
          }
        });
        
        return false;
    });
    
    $(document).ready(function(){
    
        $('#ckb-same-address').click(function(){
            
            if($('#ckb-same-address').is(':checked') == true)
            {
                $('#Users_shipping_address1').val($('#Users_mailing_address1').val());
                $('#Users_shipping_address2').val($('#Users_mailing_address2').val());
                $('#Users_shipping_country_id').val($('#Users_mailing_country_id').val());
                $('#Users_shipping_city').val($('#Users_mailing_city').val());
                $('#Users_shipping_postal_code').val($('#Users_mailing_postal_code').val());
            }
            else
            {
                $('#Users_shipping_address1').val('');
                $('#Users_shipping_address2').val('');
                $('#Users_shipping_country_id').val('229');
                $('#Users_shipping_city').val('');
                $('#Users_shipping_postal_code').val('');
            }
            
        });
    
    });
    
</script>