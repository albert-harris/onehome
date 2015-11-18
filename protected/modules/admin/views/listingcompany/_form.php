<div class="form company_2c">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'listing-company-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); 
$cmsFormater = new CmsFormatter();
?>

    <?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
    <style>
        .company_2c .c1, .company_2c .c2 { float: left; width: 50% }
    </style>    
    
        <?php include '_form_c1.php';?>
        <?php include '_form_c2.php';?>
        <div class="clr"></div>
	<div class="row buttons" style="padding-left: 115px;">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
                'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'small', // null, 'large', 'small' or 'mini'
                //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
            )); ?>	
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>.errorMessage {margin-left: 120px;}</style>