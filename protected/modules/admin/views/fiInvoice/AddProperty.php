<h2>Add Property</h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-defect-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); 
?>
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model,'property_type_id')); ?>
        <?php echo ProPropertyType::getDropDownSelectGroup('FiInvoiceDetail[property_type_id]', 'FiInvoiceDetail_property_type_id', $model->property_type_id, 'All property types', 'w-250'); ?>
        <?php echo $form->error($model,'property_type_id'); ?>
    </div>
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model,'unit_from')); ?>
        <div class="group-1">
            <?php echo $form->textField($model, 'unit_from', array('class' => ' number_only w-60', 'placeholder' => '','style'=>'')); ?>
            -
             <?php echo $form->textField($model, 'unit_to', array('class' => ' number_only  w-60', 'placeholder' => '','style'=>'')); ?>
            <!--<span style="color:gray;"><i>Unit number will not be showed in your details.</i> </span>-->
        </div>
        <div class="clear" style='clear: both;'></div>
        <?php echo $form->error($model, 'unit_from'); ?>   
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'house_blk_no'); ?>
        <?php echo $form->textField($model,'house_blk_no',array('class'=>'w-250','maxlength'=>250)); ?>
        <?php echo $form->error($model,'house_blk_no'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'street_name'); ?>
        <?php echo $form->textField($model,'street_name',array('class'=>'w-250','maxlength'=>250)); ?>
        <?php echo $form->error($model,'street_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'buiding_name'); ?>
        <?php echo $form->textField($model,'buiding_name',array('class'=>'w-250','maxlength'=>250)); ?>
        <?php echo $form->error($model,'buiding_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'postal_code'); ?>
        <?php echo $form->textField($model,'postal_code',array('class'=>'w-250','maxlength'=>250)); ?>
        <?php echo $form->error($model,'postal_code'); ?>
    </div>
    

    <div class="row buttons" style="padding-left: 115px;">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
        'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'small', // null, 'large', 'small' or 'mini'
        //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
    )); ?>	
        <button class="iframe_close" type="button">Cancel</button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    $(function(){
        $('.iframe_close').live('click', function(){
            parent.$.colorbox.close();
        });
    });
</script>