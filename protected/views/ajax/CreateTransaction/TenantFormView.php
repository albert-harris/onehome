<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'transaction-form',
'enableAjaxValidation'=>false,
'htmlOptions' => array(
    'enctype' => 'multipart/form-data',
),
)); 
$cmsFormater = new CmsFormatter();
?>
<div class="box_tenant">    
    <div class="box_tenant_detail">
        <div class="title clearfix">
            <h4 class="f-left">Tenant <span class="tenant_no">2</span></h4>
            <a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/delete',array('id'=>$model->id));?>" class="btn-1 f-right DeleteTenantBox">Delete</a>
            <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentUpdateTenant',array('id'=>$model->id));?>" class="btn-1 f-right TenantDetails r_margin_20">Edit</a>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->label($model,'name', array('class'=>'lb')); ?>
            <div class="group top_5">
                <?php echo $model->name; ?>
            </div>        
        </div>
        <div class="in-row clearfix">
            <?php echo $form->label($model,'nric_passportno_roc', array('class'=>'lb')); ?>
            <div class="group top_5">
                <?php echo $model->nric_passportno_roc; ?>
            </div>        
        </div>
        <div class="in-row clearfix">
            <?php echo $form->label($model,'id_type', array('class'=>'lb')); ?>
            <div class="group top_5">
                <?php echo Users::$aIdType[$model->id_type] ; ?>
            </div>        
        </div>
        <div class="in-row clearfix">
            <?php echo $form->label($model,'pass_expiry_date', array('class'=>'lb')); ?>
            <div class="group top_5">
                <?php echo $cmsFormater->formatDate($model->pass_expiry_date); ?>
            </div>        
        </div>
        <div class="in-row clearfix">
            <?php echo $form->label($model,'scanned_employment_pass', array('class'=>'lb')); ?>
            <div class="group top_5">
                <?php echo $model->scanned_employment_pass; ?>
            </div>        
        </div>
        <div class="in-row clearfix">
            <?php echo $form->label($model,'scanned_passport', array('class'=>'lb')); ?>
            <div class="group top_5">
                <?php echo $model->scanned_passport; ?>
            </div>        
        </div>
        <div class="in-row clearfix">
            <?php echo $form->label($model,'contact_no', array('class'=>'lb')); ?>
            <div class="group top_5">
                <?php echo $model->contact_no; ?>
            </div>        
        </div>
        <div class="in-row clearfix">
            <?php echo $form->label($model,'address', array('class'=>'lb')); ?>
            <div class="group top_5">
                <?php echo $model->address; ?>
            </div>        
        </div>
        <div class="in-row clearfix">
            <?php echo $form->label($model,'postal_code', array('class'=>'lb')); ?>
            <div class="group top_5">
                <?php echo $model->postal_code; ?>
            </div>        
        </div>
    </div>    
</div>    

<?php $this->endWidget(); ?>
    
    
