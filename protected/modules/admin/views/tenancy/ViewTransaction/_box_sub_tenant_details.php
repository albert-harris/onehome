<div class="box-5">
    <div class="title clearfix">
        <h4 class="f-left">Tenant’s Details</h4> 
    </div>
    <div class="tenant_reload">
    <?php if(count($mTransactions->rTenantAll)): ?>
        <?php foreach($mTransactions->rTenantAll as $key=>$item):?>
            <?php ProTransactionsVendorPurchaserDetail::OverideModel($item); ?>
            <?php include '_box_sub_tenant_details_view.php'; ?>
        <?php endforeach;?>
    <?php endif;?>
    </div>
</div> <!--  end  box-5 -->
