<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-defect-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>

    
	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	<div class="row">
            <?php echo $form->labelEx($model,'receipt_name'); ?>
            <?php echo $form->textField($model,'receipt_name',array('size'=>60,)); ?>
            <?php echo $form->error($model,'receipt_name'); ?>
	</div>
	<div class="row">
            <?php echo $form->labelEx($model,'receipt_nric'); ?>
            <?php echo $form->textField($model,'receipt_nric',array('size'=>60,)); ?>
            <?php echo $form->error($model,'receipt_nric'); ?>
	</div>
	<div class="row">
            <?php echo $form->labelEx($model,'receipt_contact_no'); ?>
            <?php echo $form->textField($model,'receipt_contact_no',array('size'=>60,)); ?>
            <?php echo $form->error($model,'receipt_contact_no'); ?>
	</div>
	<div class="row">
            <?php echo $form->labelEx($model,'cheque_no'); ?>
            <?php echo $form->textField($model,'cheque_no',array('size'=>60,)); ?>
            <?php echo $form->error($model,'cheque_no'); ?>
	</div>
	<div class="row">
            <?php echo $form->labelEx($model,'bank_no'); ?>
            <?php echo $form->textField($model,'bank_no',array('size'=>60,)); ?>
            <?php echo $form->error($model,'bank_no'); ?>
	</div>
	
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'receipt_date_paid')); ?>
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,        
                    'attribute'=>'receipt_date_paid',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=> ActiveRecord::getDateFormatJquery(),
//                        'maxDate'=> '0',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showOn' => 'button',
                        'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                        'buttonImageOnly'=> true,                                
                    ),        
                    'htmlOptions'=>array(
                        'class'=>'',
                        'style'=>'width: 200px;margin-right:10px;',
                        'readonly'=>'readonly',
                    ),
                ));
            ?>
            <?php echo $form->error($model,'receipt_date_paid'); ?>
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
    
//     $(document).ready(function(){
//        $(".show-image").fancybox();
//     });
</script>

<style>
    .btn-small{
        margin-left: 6px;
    }
    
    .img{
        width: 140px;
        height: 120px;
    }
</style>