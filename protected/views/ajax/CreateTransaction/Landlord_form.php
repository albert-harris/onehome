<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'AgentPurchaser-form',
            'enableAjaxValidation'=>false,
    )); ?>

    <?php if(Yii::app()->user->hasFlash('successUpdate')): ?>
        <div class="success_div"><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
    <?php endif; ?>
        
        <?php if($model->isNewRecord || (!$model->isNewRecord && $model->is_new_user==0) ):?>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'user_id', array('class'=>'lb', 'label'=>'Search Landlord In System')); ?>
            <div class="group-4">
                <?php echo $form->hiddenField($model,'user_id'); ?>
                <?php 
                    $url = Yii::app()->createAbsoluteUrl('ajax/searchLandlordTenant', array('role'=>ROLE_LANDLORD));
                    // widget auto complete search user customer and supplier
                    $aData = array(
                        'model'=>$model,
                        'name_relation_user'=>'relation_user',
//                        'width'=>'width:210px',
                        'placeHolder'=>'Type Name or NRIC of Landlord',
                        'NotShowTableInfo'=>1,
                        'TriggerReadonlyInput'=>1,
                        'CallFunctionLandLord'=>'fnSelectLandlord',
                        'FunctionRemoveUid'=>'fnRemoveUidSelect',
                        'url'=> $url,
                    );
                    $this->widget('ext.ProAutocompleteUser.ProAutocompleteUser',
                        array('data'=>$aData));                                        

                ?>
            </div>
            <?php echo $form->error($model,'user_id'); ?>
        </div>         
        <?php endif;?>
        
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'name', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'name',array('maxlength'=>200, 'class'=>'text')); ?>
                <?php // echo $form->dropDownList($model,'province_id', GasProvince::getArrAll(),array('style'=>'width:385px;')); ?>
            </div>
            <?php echo $form->error($model,'name'); ?>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'nric_passportno_roc', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'nric_passportno_roc',array('maxlength'=>50, 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'nric_passportno_roc'); ?>
        </div>
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'contact_no', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'contact_no',array('maxlength'=>50, 'class'=>'text number_only')); ?>
            </div>
            <?php echo $form->error($model,'contact_no'); ?>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'address', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'address',array('maxlength'=>250, 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'address'); ?>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'postal_code', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'postal_code',array('maxlength'=>50, 'class'=>'text number_only')); ?>
            </div>
            <?php echo $form->error($model,'postal_code'); ?>
        </div>
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'email', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'email',array('maxlength'=>100, 'class'=>'text')); ?>
                <?php // echo $form->dropDownList($model,'province_id', GasProvince::getArrAll(),array('style'=>'width:385px;')); ?>
            </div>
            <?php echo $form->error($model,'email'); ?>
        </div>
        
        
        <div class="in-row clearfix display_none">
            <?php echo $form->labelEx($model,'invoice_bill_to', array('class'=>'lb')); ?>
            <div class="group-4 list-check-3">
                <?php echo $form->radioButtonList($model,'invoice_bill_to', CmsFormatter::$yesNoFormat,
                        array(
                            'template'=>"<li>{input}{label}</li>",
                            'separator'=>'',
                            'container'=>'ul',
                            'class'=>'invoice_bill_to',
                        )
                        ); ?>
            </div>
            <?php echo $form->error($model,'invoice_bill_to'); ?>
        </div>
        
        <div class="in-row clearfix display_none div_billing_address">
            <?php echo $form->labelEx($model,'billing_address', array('class'=>'lb', 'label'=>$model->getAttributeLabel('billing_address').'<span class="required"> *</span> :')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'billing_address',array('maxlength'=>250, 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'billing_address'); ?>
        </div>
        

        <div class="clearfix output">
            <a href="javascript:void(0)" class="btn-2 iframe_close">Cancel</a>
            <input type="submit" class="btn-3" value="Submit" />
        </div>

<?php $this->endWidget(); ?>

<script>
    $(function(){
        $('.iframe_close').on('click', function(){
            parent.$.fancybox.close();
        });
        
        $('.invoice_bill_to').on('click', function(){
            $('.div_billing_address').hide();
            if($(this).val()==1){
                $('.div_billing_address').show();
            }else{
                $('.div_billing_address').find('input').val('');
            }
        });
        
        <?php if($model->billing_address): ?>
            $('.div_billing_address').show();
        <?php endif; ?>
            
        <?php if( ($model->user_id && $model->is_new_user==0 )|| (!$model->isNewRecord&&$model->is_new_user==0)): ?>
            fnReadonlyInput();
        <?php endif; ?>
    });
    
    function fnSelectLandlord(item, idField){
        $('#ProTransactionsVendorPurchaserDetail_email').attr('readonly',true).val(item.email);
        $('#ProTransactionsVendorPurchaserDetail_name').attr('readonly',true).val(item.full_name);
        $('#ProTransactionsVendorPurchaserDetail_nric_passportno_roc').attr('readonly',true).val(item.nric_passportno_roc);
        $('#ProTransactionsVendorPurchaserDetail_id_type').attr('readonly',true).val(item.id_type);
        $('#ProTransactionsVendorPurchaserDetail_contact_no').attr('readonly',true).val(item.contact_no);
        $('#ProTransactionsVendorPurchaserDetail_address').attr('readonly',true).val(item.address);
        $('#ProTransactionsVendorPurchaserDetail_postal_code').attr('readonly',true).val(item.postal_code);
    }
    
    function fnRemoveUidSelect(this_, idField, idFieldCustomer){
        $('#ProTransactionsVendorPurchaserDetail_email').attr('readonly',false).val("");
        $('#ProTransactionsVendorPurchaserDetail_name').attr('readonly',false).val("");
        $('#ProTransactionsVendorPurchaserDetail_nric_passportno_roc').attr('readonly',false).val("");
        $('#ProTransactionsVendorPurchaserDetail_id_type').attr('readonly',false).val("");
        $('#ProTransactionsVendorPurchaserDetail_contact_no').attr('readonly',false).val("");
        $('#ProTransactionsVendorPurchaserDetail_address').attr('readonly',false).val("");
        $('#ProTransactionsVendorPurchaserDetail_postal_code').attr('readonly',false).val("");        
    }
    
    function fnReadonlyInput(){
        $('#ProTransactionsVendorPurchaserDetail_email').attr('readonly',true);
        $('#ProTransactionsVendorPurchaserDetail_name').attr('readonly',true);
        $('#ProTransactionsVendorPurchaserDetail_nric_passportno_roc').attr('readonly',true);
        $('#ProTransactionsVendorPurchaserDetail_id_type').attr('readonly',true);
        $('#ProTransactionsVendorPurchaserDetail_contact_no').attr('readonly',true);
        $('#ProTransactionsVendorPurchaserDetail_address').attr('readonly',true);
        $('#ProTransactionsVendorPurchaserDetail_postal_code').attr('readonly',true);
    }
    
    
    
</script>