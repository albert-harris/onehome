<div class="box_tenant_detail">
    <div class="title clearfix">
        <h4 class="f-left">Tenant <span class="tenant_no"><?php echo ($key+1);?></span></h4>
        <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/ajax/deleteVendorPurchaser',array('id'=>$item->id));?>" class="btn-1 f-right DeleteTenantBox">Delete</a>
        <?php if( ProTransactions::IsTenancyTransaction($mTransactions) ):?>
            <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentUpdateTenant',array('id'=>$item->id, "from_transactions"=>1, "add_property"=> $mTransactions->add_property));?>" class="btn-1 f-right TenantDetails r_margin_20">Edit</a>
        <?php else: ?>
            <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentUpdateTenant',array('id'=>$item->id));?>" class="btn-1 f-right TenantDetails r_margin_20">Edit</a>
        <?php endif; ?>
    </div>

    <div class="in-row clearfix">
        <?php echo $form->label($item,'email', array('class'=>'lb', 'for'=>"")); ?>
        <div class="group top_5">
            <?php echo $item->email; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'name', array('class'=>'lb', 'for'=>"")); ?>
        <div class="group top_5">
            <?php echo $item->name; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'nric_passportno_roc', array('class'=>'lb', 'for'=>"")); ?>
        <div class="group top_5">
            <?php echo $item->nric_passportno_roc; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'id_type', array('class'=>'lb', 'for'=>"")); ?>
        <div class="group top_5">
            <?php echo Users::$aIdType[$item->id_type] ; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'pass_expiry_date', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $cmsFormater->formatDate($item->pass_expiry_date);?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'scanned_employment_pass', array('class'=>'lb', 'for'=>"")); ?>
        <div class="group top_5">
            <?php echo $item->scanned_employment_pass; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'scanned_passport', array('class'=>'lb', 'for'=>"")); ?>
        <div class="group top_5">
            <?php echo $item->scanned_passport; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'contact_no', array('class'=>'lb', 'for'=>"")); ?>
        <div class="group top_5">
            <?php echo $item->contact_no; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'address', array('class'=>'lb', 'for'=>"")); ?>
        <div class="group top_5">
            <?php echo $item->address; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'postal_code', array('class'=>'lb', 'for'=>"")); ?>
        <div class="group top_5">
            <?php echo $item->postal_code; ?>
        </div>        
    </div>
</div>    
    
    
