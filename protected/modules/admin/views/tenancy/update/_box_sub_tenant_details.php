<div class="box-5">
    <div class="title clearfix">
        <div class="f-left w-2 fixErrorSummary">
            <h4 class="">Tenant’s Details</h4> 
            <?php echo $form->errorSummary($mTransactions->mTenant); ?>
        </div> 
        <?php if( ProTransactions::IsTenancyTransaction($mTransactions) ):?>
            <!--<a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentAddTenant', array('from_transactions'=>1,'transactions_id'=>$mTransactions->id, 'listing_id'=>(isset($_GET['listing_id'])?$_GET['listing_id']:'' ))); ?>" class="btn-1 f-right TenantDetails">Add Tenant</a>-->
        <?php else: ?>
            <!--<a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentAddTenant', array('transactions_id'=>$mTransactions->id, 'listing_id'=>(isset($_GET['listing_id'])?$_GET['listing_id']:'' ))); ?>" class="btn-1 f-right TenantDetails">Add Tenant</a>-->
        <?php endif; // end if(isset($_GET['add_property']) ?>
    </div>
    
    <div class="box_tenant_detail">
        <div class="form-type content">
            
            <div class="in-row clearfix">
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'user_id', array('class'=>'lb', 'label'=>'Search Tenant In System')); ?>                
                <div class="group-4 w-2">
                    <?php echo $form->hiddenField($mTransactions->mTenatDefault,'user_id'); ?>
                    <?php 
                        $url = Yii::app()->createAbsoluteUrl('ajax/searchLandlordTenant', array('role'=>ROLE_TENANT));
                        // widget auto complete search user customer and supplier
                        $aData = array(
                            'model'=>$mTransactions->mTenatDefault,
                            'name_relation_user'=>'relation_user',
                            'width'=>'width:280px',
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
                <?php echo $form->error($mTransactions->mTenatDefault,'user_id'); ?>
            </div>  
            
            <div class="in-row clearfix">
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'email', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($mTransactions->mTenatDefault,'email',array('maxlength'=>100, 'class'=>'text')); ?>
                    <?php echo $form->error($mTransactions->mTenatDefault,'email'); ?>
                </div>
            </div>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'name', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($mTransactions->mTenatDefault,'name',array('maxlength'=>200, 'class'=>'text')); ?>
                    <?php echo $form->error($mTransactions->mTenatDefault,'name'); ?>
                </div>
            </div>

            <div class="in-row clearfix">
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'nric_passportno_roc', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($mTransactions->mTenatDefault,'nric_passportno_roc',array('maxlength'=>50, 'class'=>'text')); ?>
                    <?php echo $form->error($mTransactions->mTenatDefault,'nric_passportno_roc'); ?>
                </div>
                
            </div>

            <div class="in-row clearfix">
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'id_type', array('class'=>'lb')); ?>
                <div class="group-4">
                    <!--<span class="id_type_text"><?php // echo isset(Users::$aIdType[$mTransactions->mTenatDefault->id_type])?Users::$aIdType[$mTransactions->mTenatDefault->id_type]:''; ?></span>-->
                    <?php echo $form->dropDownList($mTransactions->mTenatDefault,'id_type', Users::$aIdType, array('empty'=>'Select', 'class'=>'text')); ?>
                    <?php echo $form->error($mTransactions->mTenatDefault,'id_type'); ?>
                </div>
                
            </div>

            <div class="in-row clearfix pass_expiry_date">
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'pass_expiry_date', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model'=>$mTransactions->mTenatDefault,        
                            'attribute'=>'pass_expiry_date',
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=> ActiveRecord::getDateFormatJquery(),
                                'changeMonth' => true,
                                'changeYear' => true,
                                'showOn' => 'button',
                                'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                                'buttonImageOnly'=> true,                                
                            ),        
                            'htmlOptions'=>array(
                                'class'=>'text',
                                'style'=>'width:166px;',
//                                    'readonly'=>'readonly',
                            ),
                        ));
                    ?>
                    <?php echo $form->error($mTransactions->mTenatDefault,'pass_expiry_date'); ?>
                </div>                
            </div>        

            <div class="in-row clearfix scanned_employment_pass">
                <?php 
                    $display = 'display_none'; 
                        $scanned_employment_pass = $mTransactions->mTenatDefault->scanned_employment_pass;
                        $mUserRelation = $mTransactions->mTenatDefault->rUser;
//                        if($mUserRelation){
//                            $scanned_employment_pass = $mUserRelation->upload_employment_pass_passport;
//                        }
                        if(!empty($scanned_employment_pass)){
                            $display = '';
                        }
                    ?> 
                
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'scanned_employment_pass', array('class'=>'lb')); ?>
                <div class="group-4">
                    <span class="help_file_type">Only <?php echo Users::$AllowFile ;?> are allow</span>
                    <?php echo $form->fileField($mTransactions->mTenatDefault,'scanned_employment_pass',array()); ?>
                                       
                    <p class="<?php echo $display;?> p_scanned_employment_pass clr" style="text-align: left;">
                        Current File: <span class="span_scanned_employment_pass">
                            <?php 
                            $aData = array('model'=>$mTransactions->mTenatDefault, 'fieldName'=>'scanned_employment_pass');
                            echo $cmsFormater->formatViewUploadFile($aData); 
                            ?>
                        </span>
                    </p>
                    <?php echo $form->error($mTransactions->mTenatDefault,'scanned_employment_pass'); ?>
                </div>                
            </div>
            <div class="in-row clearfix scanned_passport">
                <?php 
                    $display2 = 'display_none';
                        $scanned_passport = $mTransactions->mTenatDefault->scanned_passport;
//                        if($mUserRelation){
//                            $scanned_passport = $mUserRelation->scanned_passport;
//                        }
                        if(!empty($scanned_passport)){
                            $display2 = ''; 
                        }
                    ?>
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'scanned_passport', array('class'=>'lb')); ?>
                <div class="group-4">
                    <span class="help_file_type">Only <?php echo Users::$AllowFile ;?> are allow</span>
                    <?php echo $form->fileField($mTransactions->mTenatDefault,'scanned_passport', array('class'=>'')); ?>
                    
                    <p class="<?php echo $display2;?> p_scanned_passport clr" style="text-align: left;">
                        Current File: 
                        <span class="span_scanned_passport"> 
                            <?php 
                            $aData2 = array('model'=>$mTransactions->mTenatDefault, 'fieldName'=>'scanned_passport');
                            echo $cmsFormater->formatViewUploadFile($aData2); 
                            ?>
                        </span>
                    </p>
                    
                    <?php echo $form->error($mTransactions->mTenatDefault,'scanned_passport'); ?>
                </div>                
            </div>

            <div class="in-row clearfix">
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'contact_no', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($mTransactions->mTenatDefault,'contact_no',array('maxlength'=>50, 'class'=>'text')); ?>
                    <?php echo $form->error($mTransactions->mTenatDefault,'contact_no'); ?>
                </div>
                
            </div>

            <div class="in-row clearfix">
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'address', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($mTransactions->mTenatDefault,'address',array('maxlength'=>50, 'class'=>'text')); ?>
                    <?php echo $form->error($mTransactions->mTenatDefault,'address'); ?>
                </div>
                
            </div>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($mTransactions->mTenatDefault,'postal_code', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($mTransactions->mTenatDefault,'postal_code',array('maxlength'=>50, 'class'=>'text')); ?>
                    <?php echo $form->error($mTransactions->mTenatDefault,'postal_code'); ?>
                </div>                
            </div>

        </div>
    
    <div class="title clearfix">
        <div class="f-left w-2 fixErrorSummary">
            <h4 class="">&nbsp;</h4>
        </div> 
        <?php if( ProTransactions::IsTenancyTransaction($mTransactions) ):?>
            <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentAddTenant', array('from_transactions'=>1,'transactions_id'=>$mTransactions->id, 'listing_id'=>(isset($_GET['listing_id'])?$_GET['listing_id']:'' ))); ?>" class="btn-1 f-right TenantDetails">Add More Tenant</a>
        <?php else: ?>
            <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentAddTenant', array('transactions_id'=>$mTransactions->id, 'listing_id'=>(isset($_GET['listing_id'])?$_GET['listing_id']:'' ))); ?>" class="btn-1 f-right TenantDetails">Add More Tenant</a>
        <?php endif; // end if(isset($_GET['add_property']) ?>
    </div>
        
    </div><!--  end   <div class="box_tenant_detail"> -->
    
    <div class="tenant_reload">
    <?php if(count($mTransactions->rTenantAddMore)): ?>
        <?php foreach($mTransactions->rTenantAddMore as $key=>$item):?>
            <?php // ProTransactionsVendorPurchaserDetail::OverideModel($item); ?>
            <?php include '_box_sub_tenant_details_view.php'; ?>
        <?php endforeach;?>
    <?php endif;?>
    </div>
    
</div> <!--  end  box-5 -->

<!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>-->    
<script>
    $(document).ready(function() {
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
        
        <?php // if($mTransactions->mTenatDefault->id_type==Users::ID_TYPE_EP || $mTransactions->mTenatDefault->id_type==Users::ID_TYPE_SPASS):?>
//            $('#ProTransactionsVendorPurchaserDetail_id_type').trigger('change');
        <?php // endif;?>
        
        // ANH DUNG JAN 12, 2015
        $('#ProTransactionsVendorPurchaserDetail_id_type').change(function(){ 
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

        <?php // if($mTransactions->mTenatDefault->id_type != '' &&  ( $mTransactions->mTenatDefault->id_type == Users::ID_TYPE_OTHER) ):?>
        <?php if($mTransactions->mTenatDefault->id_type != ''):?>    
            $('#ProTransactionsVendorPurchaserDetail_id_type').trigger('change');
        <?php endif;?>            

            
    });
    
    $(window).load(function(){
        <?php if( ($mTransactions->mTenatDefault->user_id && $mTransactions->mTenatDefault->is_new_user==0 )|| (!$mTransactions->mTenatDefault->isNewRecord&&$mTransactions->mTenatDefault->is_new_user==0)): ?>
            fnReadonlyInput();
        <?php endif; ?>
        
    });
    
    


</script>