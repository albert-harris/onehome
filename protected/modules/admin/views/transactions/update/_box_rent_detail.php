<!-- box -->
<div class="box-1 space-3">
    <div class="title"><h3>RENT DETAILS</h3></div>
    <div class="form-type content"> 
        <div class="in-row clearfix">
            <div class="col-1"> 
                <?php echo $form->labelEx($mTransactions,'tenancy_agreement_date', array('class'=>'lb')); ?>
                <div class="group-4 ">
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model' => $mTransactions,
                                'attribute'=>'tenancy_agreement_date',
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
                                    'class'=>'text w-5',
                                ),
                        ));
                    ?>
                    <?php echo $form->error($mTransactions,'tenancy_agreement_date'); ?>
                    </div>
                    
            </div>
            <div class="col-2">
                <div class="in-row clearfix">
                    <?php echo $form->labelEx($mTransactions,'months_rent', array('class'=>'lb')); ?>
                    <div class="group-4">
                        <?php echo $form->textField($mTransactions,'months_rent',array('class'=>'text w-50 number_only', 'maxlength'=>2)); ?>&nbsp;&nbsp;&nbsp; months
                        <?php echo $form->error($mTransactions,'months_rent'); ?>
                    </div>                    
                </div>
            </div>
        </div>
        <script>
            $(function(){ });
        </script>
        
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'commencement_date', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'model' => $mTransactions,
                    'attribute'=>'commencement_date',
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
                <?php echo $form->error($mTransactions,'commencement_date'); ?>
            </div>
        </div>
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'expiring_date', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'model' => $mTransactions,
                    'attribute'=>'expiring_date',
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
                <?php echo $form->error($mTransactions,'expiring_date'); ?>
            </div>
        </div>
        
        <?php 
//        $mTransactions->tenancy_amount = str_replace(",", "", $mTransactions->tenancy_amount);
//        $mTransactions->deposit_payable = str_replace(",", "", $mTransactions->deposit_payable);
        ?>
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'tenancy_amount', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $form->textField($mTransactions,'tenancy_amount',array('maxlength'=>14, 'class'=>'text number_only ad_fix_currency')); ?>
                <?php echo $form->error($mTransactions,'tenancy_amount'); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'deposit_payable', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $form->textField($mTransactions,'deposit_payable',array('maxlength'=>14, 'class'=>'text number_only ad_fix_currency')); ?>
                <?php echo $form->error($mTransactions,'deposit_payable'); ?>
            </div>
        </div>
        
        <?php include_once '_box_sub_landlord_details.php'; ?>
        <?php include_once '_box_sub_tenant_details.php'; ?>
        
        <?php if( ProTransactions::IsTenancyTransaction($mTransactions) ):?>
            <?php include_once '_box_sub_sale_details_client_type.php'; ?>        
            <?php include_once '_box_internal_co_broke_details.php'; ?>
        <?php endif; // end if(isset($_GET['add_property']) ?>
    </div>
</div> 

