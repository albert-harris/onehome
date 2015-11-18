<!-- box -->
<div class="box-1 space-3">
    <div class="title"><h3>RENT DETAILS</h3></div>
    <div class="form-type content"> 
        <div class="in-row clearfix">
            <div class="col-1"> 
                <?php echo $form->labelEx($mTransactions,'tenancy_agreement_date', array('class'=>'lb')); ?>
                <div class="group top_5">
                    <?php echo $cmsFormater->formatDate($mTransactions->tenancy_agreement_date); ?>
                </div>
            </div>
            <div class="col-2">
                <div class="in-row clearfix">
                    <?php echo $form->labelEx($mTransactions,'months_rent', array('class'=>'lb')); ?>
                    <div class="group top_5">
                        <?php echo $mTransactions->months_rent; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'commencement_date', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $cmsFormater->formatDate($mTransactions->commencement_date); ?>
            </div>
        </div>
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'expiring_date', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $cmsFormater->formatDate($mTransactions->expiring_date); ?>
            </div>
        </div>
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'tenancy_amount', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $cmsFormater->formatPrice($mTransactions->tenancy_amount); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($mTransactions,'deposit_payable', array('class'=>'lb lb-no-space')); ?>
            <div class="f-left">
                <?php echo $cmsFormater->formatPrice($mTransactions->deposit_payable); ?>
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

