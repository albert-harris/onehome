<!-- box -->
<div class="box-1 space-3">
    <div class="title"><h3>SALE DETAILS</h3></div>
    <div class="form-type content"> 
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'otp_contract_date', array('class'=>'lb')); ?>
            <div class="group top_5">
                <?php echo $cmsFormater->formatDate($mTransactions->otp_contract_date); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'with_tenancy', array('class'=>'lb')); ?>
            <div class="f-left">   
                <div class="group top_5">
                    <?php echo isset(ProTransactionsPropertyDetail::$aYesNo[$mTransactions->with_tenancy])?
                ProTransactionsPropertyDetail::$aYesNo[$mTransactions->with_tenancy]
                        :""; ?>
                </div>
            </div>
        </div>
        
        <div class="with_tenancy_yes display_none">
            <div class="in-row clearfix">
                <?php echo $form->labelEx($mTransactions,'commencement_date', array('class'=>'lb')); ?>
                <div class="group top_5">
                    <?php echo $cmsFormater->formatDate($mTransactions->commencement_date); ?>
                </div>
            </div>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($mTransactions,'expiring_date', array('class'=>'lb')); ?>
                <div class="group top_5">
                    <?php echo $cmsFormater->formatDate($mTransactions->expiring_date); ?>
                </div>
            </div>

        </div>        
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'appointment_date_hdb_only', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $cmsFormater->formatDate($mTransactions->appointment_date_hdb_only); ?>
            </div>
        </div>
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'transacted_price', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $cmsFormater->formatPrice($mTransactions->transacted_price); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'valuation_price', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $cmsFormater->formatPrice($mTransactions->valuation_price); ?>
            </div>
        </div>
        
        <?php include_once '_box_sub_vendor_details.php'; ?>
        <?php include_once '_box_sub_purchaser_details.php'; ?>        
        <?php include_once '_box_sub_sale_details_client_type.php'; ?>        
        <?php include_once '_box_internal_co_broke_details.php'; ?>        
    </div>
</div> 

