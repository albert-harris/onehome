<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'AgentPurchaser-form',
            'enableAjaxValidation'=>false,
    )); ?>

    <?php if(Yii::app()->user->hasFlash('successUpdate')): ?>
        <div class="success_div"><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
    <?php endif; ?>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'name', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'name',array('maxlength'=>200, 'class'=>'text')); ?>
                <?php // echo $form->dropDownList($model,'province_id', GasProvince::getArrAll(),array('style'=>'width:385px;')); ?>
            </div>
            <?php echo $form->error($model,'name'); ?>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'nric_passportno_roc', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'nric_passportno_roc',array('maxlength'=>50, 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'nric_passportno_roc'); ?>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'contact_no', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'contact_no',array('maxlength'=>50, 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'contact_no'); ?>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'email', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'email',array('maxlength'=>100, 'class'=>'text')); ?>
                <?php // echo $form->dropDownList($model,'province_id', GasProvince::getArrAll(),array('style'=>'width:385px;')); ?>
            </div>
            <?php echo $form->error($model,'email'); ?>
        </div>        
        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'address', array('class'=>'lb')); ?>
            <div class="group-4">
                <?php echo $form->textField($model,'address',array('maxlength'=>50, 'class'=>'text')); ?>
            </div>
            <?php echo $form->error($model,'address'); ?>
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

<script>
    $(function(){
        $('.iframe_close').on('click', function(){
            parent.$.fancybox.close();
        });
    });
</script>