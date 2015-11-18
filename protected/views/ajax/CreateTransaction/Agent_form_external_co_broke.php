<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'Agent-form-external-co-broke',
            'enableAjaxValidation'=>false,
    )); ?>

    <?php if(Yii::app()->user->hasFlash('successUpdate')): ?>
        <div class="success_div"><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
    <?php endif; ?>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model,'company_name', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($model,'company_name',array('maxlength'=>200, 'class'=>'text')); ?>
                    <?php // echo $form->dropDownList($model,'province_id', GasProvince::getArrAll(),array('style'=>'width:385px;')); ?>
                </div>
                <?php echo $form->error($model,'company_name'); ?>
            </div>

            <div class="in-row clearfix">
                <?php echo $form->labelEx($model,'salesperson_name', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($model,'salesperson_name',array('maxlength'=>100, 'class'=>'text')); ?>
                </div>
                <?php echo $form->error($model,'salesperson_name'); ?>
            </div>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model,'nric_no', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($model,'nric_no',array('maxlength'=>50, 'class'=>'text')); ?>
                </div>
                <?php echo $form->error($model,'nric_no'); ?>
            </div>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model,'contact_no', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($model,'contact_no',array('maxlength'=>50, 'class'=>'text')); ?>
                </div>
                <?php echo $form->error($model,'contact_no'); ?>
            </div>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model,'commission_amount', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($model,'commission_amount',array('maxlength'=>14, 'class'=>'text number_only commission_amount ad_fix_currency')); ?>
                </div>
                <?php echo $form->error($model,'commission_amount'); ?>
            </div>
        
            <?php $cmsFormater = new CmsFormatter(); //ANH DUNG FIX 03 Nov, 2014?>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model,'commission_amount_gst', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($model,'commission_amount_gst',array('maxlength'=>14, 'class'=>'text number_only commission_amount_gst ad_fix_currency')); ?>
                </div>
                <?php echo $form->error($model,'commission_amount_gst'); ?>
            </div>
            <div class="in-row clearfix">
                <?php echo $form->labelEx($model,'billing_address', array('class'=>'lb')); ?>
                <div class="group-4">
                    <?php echo $form->textField($model,'billing_address',array('maxlength'=>50, 'class'=>'text')); ?>
                </div>
                <?php echo $form->error($model,'billing_address'); ?>
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
                <input type="submit" class="btn-3" value="Submit" />
            </div>

<?php $this->endWidget(); ?>

<?php
    // Feb 03,2015 for calc gst at BE when update trans or tenancy
    $sUidGst = 0;
    if( $model->transactions_id ){
        $mTransactions = ProTransactions::model()->findByPk($model->transactions_id);
        $sUidGst = $mTransactions->user_id;
    }    
?>        
        
<script>
    $(function(){
        $('.iframe_close').on('click', function(){
            parent.$.fancybox.close();
        });
    });
</script>