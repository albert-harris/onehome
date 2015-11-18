<?php $item->scenario = 'view_only';?>
<div class="box_tenant_detail">
    <div class="title clearfix">
        <h4 class="f-left">Tenant <span class="tenant_no"><?php echo ($key+1);?></span></h4>
    </div>

    <div class="in-row clearfix">
        <?php echo $form->label($item,'name', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $item->name; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'nric_passportno_roc', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $item->nric_passportno_roc; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'pass_expiry_date', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $cmsFormater->formatDate($item->pass_expiry_date);?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'scanned_employment_pass', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php 
            $cmsFormater = new CmsFormatter();
            $aData = array('model'=>$item, 'fieldName'=>'scanned_employment_pass');
            echo $cmsFormater->formatViewUploadFile($aData);            
            ?>
        </div>
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'scanned_passport', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php
                $aData = array('model'=>$item, 'fieldName'=>'scanned_passport');
                echo $cmsFormater->formatViewUploadFile($aData);            
            ?>
        </div> 
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'contact_no', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $item->contact_no; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'address', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $item->address; ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->label($item,'postal_code', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $item->postal_code; ?>
        </div>        
    </div>
</div>    
    
    
