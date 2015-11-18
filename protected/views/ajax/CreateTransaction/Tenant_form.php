<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'AgentPurchaser-form',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
    )); ?>

    <?php if(Yii::app()->user->hasFlash('successUpdate')): ?>
        <div class="success_div"><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
    <?php endif; ?>
        
    <?php if($model->isNewRecord):?>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'user_id', array('class'=>'lb', 'label'=>'Search Tenant In System')); ?>
            <div class="group-4">
                <?php echo $form->hiddenField($model,'user_id'); ?>
                <?php 
                    $url = Yii::app()->createAbsoluteUrl('ajax/searchLandlordTenant', array('role'=>ROLE_TENANT));
                    // widget auto complete search user customer and supplier
                    $aData = array(
                        'model'=>$model,
                        'name_relation_user'=>'relation_user',
//                        'width'=>'width:210px',
                        'placeHolder'=>'Type Name or NRIC of Tenant',
                        'NotShowTableInfo'=>1,
                        'TriggerReadonlyInput'=>1,
                        'CallFunctionLandLord'=>'fnSelectTeant',
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
            <?php echo $form->labelEx($model,'email', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'email',array('maxlength'=>100, 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'email'); ?>
        </div>
        
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
            <?php echo $form->labelEx($model,'id_type', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->dropDownList($model,'id_type', Users::$aIdType, array('empty'=>'Select', 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'id_type'); ?>
        </div>
        
        <div class="in-row clearfix pass_expiry_date">
            <?php echo $form->labelEx($model,'pass_expiry_date', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,        
                        'attribute'=>'pass_expiry_date',
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=> ActiveRecord::getDateFormatJquery(),
//                            'minDate'=> '0',
//                            'maxDate'=> '0',
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showOn' => 'button',
                            'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                            'buttonImageOnly'=> true,                                
                        ),        
                        'htmlOptions'=>array(
                            'class'=>'text',
                            'style'=>'width:166px;',
//                                'readonly'=>'readonly',
                        ),
                    ));
                ?>     		
            </div>
            <?php echo $form->error($model,'pass_expiry_date'); ?>
        </div>        
        
        
        <div class="in-row clearfix scanned_employment_pass">
            <?php echo $form->labelEx($model,'scanned_employment_pass', array('class'=>'lb')); ?>
            <?php $scanned_employment_pass = $model->scanned_employment_pass;?>
            <div class="group-4">
                <span class="help_file_type">Only <?php echo Users::$AllowFile ;?> are allow</span>
                <?php echo $form->fileField($model,'scanned_employment_pass',array()); ?>
                <?php $display = 'display_none'; 
                    if( !$model->isNewRecord){                    
                        if( $model->scanned_employment_pass || !$model->is_new_user){
                            $display = ''; 
                            if(!$model->is_new_user){
                                $scanned_employment_pass = $model->rUser->upload_employment_pass_passport;
                            }
                        }
                    }
                ?>                    
                <p class="<?php echo $display;?> p_scanned_employment_pass clr" style="text-align: left;">
                    <br>
                    Current File: <span class="span_scanned_employment_pass">
                        <?php echo $scanned_employment_pass;?>
                    </span>
                </p>
            </div>                
            <?php echo $form->error($model,'scanned_employment_pass'); ?>
        </div>
        
        <div class="in-row clearfix scanned_passport">
            <?php echo $form->labelEx($model,'scanned_passport', array('class'=>'lb')); ?>
            <?php $scanned_passport = $model->scanned_passport;?>
            <div class="group-4">
                <?php // echo $model->scanned_passport;?>
                <span class="help_file_type">Only <?php echo Users::$AllowFile ;?> are allow</span>
                <?php echo $form->fileField($model,'scanned_passport', array('class'=>'')); ?>
                <?php $display = 'display_none'; 
                if( !$model->isNewRecord){                    
                    if( $model->scanned_passport || !$model->is_new_user){
                        $display = ''; 
                        if(!$model->is_new_user){
                            $scanned_passport = $model->rUser->scanned_passport;
                        }
                    }
                }
                ?>
                <p class="<?php echo $display;?> p_scanned_passport clr" style="text-align: left;">
                    <br>
                    Current File: 
                    <span class="span_scanned_passport"> 
                        <?php echo $scanned_passport;?>
                    </span>
                </p>
            </div>                
            <?php echo $form->error($model,'scanned_passport'); ?>
        </div>
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'contact_no', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'contact_no',array('maxlength'=>50, 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'contact_no'); ?>
        </div>
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'address', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'address',array('maxlength'=>50, 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'address'); ?>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'postal_code', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'postal_code',array('maxlength'=>50, 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'postal_code'); ?>
        </div>

        <div class="clearfix output">
            <a href="javascript:void(0)" class="btn-2 iframe_close">Cancel</a>
            <input type="submit" class="btn-3 submit_trans" value="Submit" />
        </div>

<?php $this->endWidget(); ?>

<script>
    $(function(){
        $('.submit_trans').click(function(){
            $('.wrap_commission select').attr('disabled',false);
        });
        
        $('.iframe_close').on('click', function(){
            parent.$.fancybox.close();
        });
        
        // ANH DUNG RE-OPEN JAN 12, 2015
        $('#ProTransactionsVendorPurchaserDetail_id_type').change(function(){
            // ANH DUNG May 06, 2015
            <?php if( $model->scenario == 'AgentAddTenantFromTenancy' 
                || $model->scenario == 'AgentUpdateTenantFromTenancy'
                ): ?>
                //return ;
            <?php endif;?>
            // ANH DUNG May 06, 2015
            
            // if($(this).val() != <?php echo Users::ID_TYPE_CITIZENSHIP;?> &&
            //         $(this).val() != <?php echo Users::ID_TYPE_SPR;?>){
            if($(this).val() == <?php echo Users::ID_TYPE_OTHER;?>){
                //HTram 21 08 2015
                $('.pass_expiry_date').show();
                $('.scanned_passport').show();
                //
                if($('.pass_expiry_date').find('label:first').find('span').size()<1){
                    $('.pass_expiry_date').find('label:first').append('<span class="required"> *</span>');
                }
                if($('.scanned_passport').find('label:first').find('span').size()<1){
                    $('.scanned_passport').find('label:first').append('<span class="required"> *</span>');
                }
                
                if($('.scanned_employment_pass').find('label:first').find('span.required').size()<1){
                    $('.scanned_employment_pass').find('label:first').append('<span class="required"> *</span>');
                }
                $('.scanned_employment_pass').find('label:first').find('span.label_span_first').html('<?php echo ProTransactions::TENANT_NOT_SINGAPOREAN;?>');
            }else{
                //HTram 21 08 2015
                //If Citizenship or SPR, Remove Pass Expiry Date and Scanned Passport. Only “Upload Scanned IC” will be there. 
                if(($(this).val() == <?php echo Users::ID_TYPE_CITIZENSHIP;?>) || ($(this).val() == <?php echo Users::ID_TYPE_SPR;?> )){
                    $('.pass_expiry_date').hide();
                    $('.scanned_passport').hide();
                    $('.scanned_employment_pass').find('label:first').find('span.required').remove();
                    $('.scanned_employment_pass').find('label:first').find('span.label_span_first').html('<?php echo ProTransactions::TENANT_IS_SINGAPOREAN;?>');
                }else{
                    $('.pass_expiry_date').show();
                    $('.scanned_passport').show();
                    
                    $('.pass_expiry_date').find('label:first').find('span').remove();
                    $('.scanned_passport').find('label:first').find('span').remove();
                    $('.scanned_employment_pass').find('label:first').find('span.required').remove();
                    $('.scanned_employment_pass').find('label:first').find('span.label_span_first').html('<?php echo ProTransactions::TENANT_IS_SINGAPOREAN;?>');
                }
            }
        });
        <?php //if($model->id_type != '' &&  ( $model->id_type != Users::ID_TYPE_CITIZENSHIP || $model->id_type != Users::ID_TYPE_SPR) ):?>
            //$('#ProTransactionsVendorPurchaserDetail_id_type').trigger('change');
        <?php //endif;?>   

        <?php // if($model->id_type != '' &&  ( $model->id_type == Users::ID_TYPE_OTHER ) ):?>
        <?php if($model->id_type != ''):?>    
            $('#ProTransactionsVendorPurchaserDetail_id_type').trigger('change');
        <?php endif;?>        

        
        
//        $('#ProTransactionsVendorPurchaserDetail_id_type').change(function(){
//            if($(this).val() == <?php // echo Users::ID_TYPE_EP;?> || $(this).val() == <?php // echo Users::ID_TYPE_SPASS;?>){
//                if($('.pass_expiry_date').find('label:first').find('span').size()<1){
//                    $('.pass_expiry_date').find('label:first').append('<span class="required"> *</span>');
//                }
//                if($('.scanned_passport').find('label:first').find('span').size()<1){
//                    $('.scanned_passport').find('label:first').append('<span class="required"> *</span>');
//                }
//                if($('.scanned_employment_pass').find('label:first').find('span').size()<1){
//                    $('.scanned_employment_pass').find('label:first').append('<span class="required"> *</span>');
//                }
//            }else{
//                $('.pass_expiry_date').find('label:first').find('span').remove();
//                $('.scanned_passport').find('label:first').find('span').remove();
//                $('.scanned_employment_pass').find('label:first').find('span').remove();
//            }
//        });
        
        <?php // if($model->id_type==Users::ID_TYPE_EP || $model->id_type==Users::ID_TYPE_SPASS):?>
//            $('#ProTransactionsVendorPurchaserDetail_id_type').trigger('change');
        <?php // endif;?>
        
    });
    
    
    $(window).load(function(){
        <?php if( ($model->user_id && $model->is_new_user==0 )|| (!$model->isNewRecord&&$model->is_new_user==0)): ?>
            fnReadonlyInput();
        <?php endif; ?>
        
    });
</script>