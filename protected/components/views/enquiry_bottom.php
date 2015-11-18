<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createAbsoluteUrl('/enquiry/addPropertyItem',array('id'=>$property_id)),
    'method'=>'post',
    'enableClientValidation' => true,
    'enableAjaxValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions'=>array(
        'class'=>'form-type box-3'
    ),
)); ?>

    <?php
	/* agent detail */
	require( $dir);
    ?>

    <h3 class="title-2">Enquiry</h3>
    <div class="row">
        <div class="form-group col-sm-6">
            <?php echo $form->labelEx($model,'name',array('label'=>'My name is...','class'=>'control-label')); ?>
            <?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'Full Name')); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $form->labelEx($model,'email',array('label'=>'Email Address','class'=>'control-label')); ?>
            <?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>'Email address')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <?php echo $form->labelEx($model,'phone',array('label'=>'Phone (mobile preferred)','class'=>'control-label')); ?>
            <?php echo $form->textField($model,'phone',array('class'=>'form-control number_only','placeholder'=>'Contact No')); ?>
            <?php echo $form->error($model,'phone'); ?>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $form->labelEx($model,'country_id',array('label'=>'I live in the following country','class'=>'control-label')); ?>
            <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('empty'=>'Select Country','class'=>'form-control'));?>
            <?php echo $form->error($model,'country_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->textArea($model,'description',array(
            'class' => 'note-box-2 form-control',
            'placeholder'=> 'Message',
            'rows' => 4
        )); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>
    <div class="form-group">
        <button type="submit" class="btn-3 btn-type">SEND ENQUIRY</button>
    </div>
<?php $this->endWidget(); ?>
<p class="note text-center">
    <em>Legal Disclaimer: The advertiser assumes all responsibility for the advertisement details</em>
</p>

