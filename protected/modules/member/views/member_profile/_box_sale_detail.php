<!-- box -->
<div class="box-1 space-3">
    <div class="title"><h3>SALE DETAILS</h3></div>
    <div class="form-type content"> 
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'otp_contract_date', array('class'=>'lb')); ?>
            <div class="group-4 ">
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model' => $mTransactions,
                            'attribute'=>'otp_contract_date',
                            'options'=>array(
                                    'showAnim'=>'fold',
                                    'showButtonPanel'=>true,
                                    'autoSize'=>true,
//                                    'maxDate'=> '0',
                                    'changeMonth' => true,
                                    'changeYear' => true,
                                    'dateFormat'=>'dd/mm/yy',
                                    'separator'=>' ',
                                    'showOn' => 'button',
                                    'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                                    'buttonImageOnly'=> true,
                            ),
                            'htmlOptions'=>array(
//                                'style'=>'height:20px;width:100px',
                                'readonly'=>true,
                                'class'=>'text w-5',
                            ),
                    ));
		?>
                </div>
            <?php echo $form->error($mTransactions,'otp_contract_date'); ?>
        </div>
        <script>
            $(function(){

                
            });
            
        </script>
        
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'with_tenancy', array('class'=>'lb')); ?>
            <div class="f-left">   
                <div class="list-check-3 clearfix">
                    <?php echo $form->radioButtonList($mTransactions,'with_tenancy', ProTransactionsPropertyDetail::$aYesNo,
                            array(
                                'template'=>"<li>{input}{label}</li>",
                                'separator'=>'',
                                'container'=>'ul',
                                'class'=>'with_tenancy',
                            )
                            ); ?>
                </div>
                <?php echo $form->error($mTransactions,'with_tenancy'); ?>            

                <div class="box-3 with_tenancy_yes display_none">
                    <div class="in-row clearfix">
                        <?php echo $form->label($mTransactions,'commencement_date', array('class'=>'lb', 'label'=>$mTransactions->getAttributeLabel('commencement_date').'<span class="required"> *</span> :')); ?>
                        <div class="group-4">
                            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model' => $mTransactions,
                                'attribute'=>'commencement_date',
                                'options'=>array(
                                        'showAnim'=>'fold',
                                        'showButtonPanel'=>true,
                                        'autoSize'=>true,
//                                        'maxDate'=> '0',
                                        'changeMonth' => true,
                                        'changeYear' => true,
                                        'dateFormat'=>'dd/mm/yy',
                                        'separator'=>' ',
                                        'showOn' => 'button',
                                        'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                                        'buttonImageOnly'=> true,
                                ),
                                'htmlOptions'=>array(
    //                                'style'=>'height:20px;width:100px',
                                    'readonly'=>true,
                                    'class'=>'text w-1',
                                ),
                                ));
                            ?>
                            <?php echo $form->error($mTransactions,'commencement_date'); ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->label($mTransactions,'expiring_date', array('class'=>'lb', 'label'=>$mTransactions->getAttributeLabel('expiring_date').'<span class="required"> *</span> :')); ?>
                        <div class="group-4">
                            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model' => $mTransactions,
                                'attribute'=>'expiring_date',
                                'options'=>array(
                                        'showAnim'=>'fold',
                                        'showButtonPanel'=>true,
                                        'autoSize'=>true,
//                                        'maxDate'=> '0',
                                        'changeMonth' => true,
                                        'changeYear' => true,
                                        'dateFormat'=>'dd/mm/yy',
                                        'separator'=>' ',
                                        'showOn' => 'button',
                                        'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                                        'buttonImageOnly'=> true,
                                ),
                                'htmlOptions'=>array(
    //                                'style'=>'height:20px;width:100px',
                                    'readonly'=>true,
                                    'class'=>'text w-1',
                                ),
                                ));
                            ?>
                            <?php echo $form->error($mTransactions,'expiring_date'); ?>
                        </div>
                    </div>
                    
                    <div class="in-row clearfix">
                        <?php // echo $form->labelEx($mTransactions,'tenancy_amount', array('class'=>'lb', 'label'=>$mTransactions->getAttributeLabel('tenancy_amount').'<span class="required"> *</span> :')); ?>
                        <?php echo $form->label($mTransactions,'tenancy_amount', array('class'=>'lb', 'label'=>$mTransactions->getAttributeLabel('tenancy_amount').'<span class="required"> *</span> :')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions,'tenancy_amount',array('maxlength'=>14, 'class'=>'text number_only ad_fix_currency')); ?>
                            <?php echo $form->error($mTransactions,'tenancy_amount'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'appointment_date_hdb_only', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'model' => $mTransactions,
                    'attribute'=>'appointment_date_hdb_only',
                    'options'=>array(
                            'showAnim'=>'fold',
                            'showButtonPanel'=>true,
                            'autoSize'=>true,
//                            'maxDate'=> '0',
                            'changeMonth' => true,
                            'changeYear' => true,
                            'dateFormat'=>'dd/mm/yy',
                            'separator'=>' ',
                            'showOn' => 'button',
                            'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                            'buttonImageOnly'=> true,
                    ),
                    'htmlOptions'=>array(
//                                'style'=>'height:20px;width:100px',
                        'readonly'=>true,
                        'class'=>'text w-5',
                    ),
                    ));
                ?>
                <?php echo $form->error($mTransactions,'appointment_date_hdb_only'); ?>
            </div>
        </div>
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'transacted_price', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $form->textField($mTransactions,'transacted_price',array('maxlength'=>14, 'class'=>'text number_only ad_fix_currency')); ?>
                <?php echo $form->error($mTransactions,'transacted_price'); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'valuation_price', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $form->textField($mTransactions,'valuation_price',array('maxlength'=>14, 'class'=>'text number_only ad_fix_currency')); ?>
                <?php echo $form->error($mTransactions,'valuation_price'); ?>
            </div>
        </div>
        
        <?php include_once '_box_sub_vendor_details.php'; ?>
        <?php include_once '_box_sub_purchaser_details.php'; ?>        
        <?php include_once '_box_sub_sale_details_client_type.php'; ?>        
        <?php include_once '_box_internal_co_broke_details.php'; ?>        
    </div>
</div> 

