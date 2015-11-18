<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'banners-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
    <?php $action = Yii::app()->controller->action->id; ?>
    <p class="note"><?php echo Yii::t('translation', 'Fields with <span class="required">*</span> are required.'); ?></p>

    <?php //echo $form->errorSummary($model);  ?>

    <div class="row" style="clear: both;">
        <?php echo Yii::t('translation', $form->labelEx($model, 'banner_title')); ?>
        <?php echo $form->textField($model, 'banner_title', array('cols' => 54, 'rows' => 3, 'style' => 'width:400px;')); ?>
        <?php echo Yii::t('translation', $form->error($model, 'banner_title')); ?>
    </div>
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model, 'banner_type')); ?>
        <?php echo $form->dropDownList($model, 'banner_type', Banners::$bannerType); ?>
        <?php echo Yii::t('translation', $form->error($model, 'banner_type')); ?>
    </div>
    <!----image---->
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model, 'imageFile')); ?>
        <?php echo $form->fileField($model, 'imageFile'); ?>
        <?php echo Yii::t('translation', $form->error($model, 'imageFile')); ?>
    </div>
    <?php 
    if ($action == "update") {
        $href_img = $model->getImageUrl();
     ?>
    <?php
        if($href_img){?>
            <div class="row">
                    <label for="image_top"></label>
                    <img src="<?php echo $href_img; ?>" style="height: 70px;"/>
                </div>         
                <div class="row">
                    <label for="delete image"></label>
                    <input type="checkbox" name="delete_current_image" class="delete_current_image">
                    Delete Current Image
                </div>
    <?php
        }
    }
    ?>
    <!----end image------------->
    <div class="row">
        <?php echo $form->labelEx($model, 'banner_description', array()); ?>
        <div style="float:left;">
            <?php
            $this->widget('ext.ckeditor.CKEditorWidget', array(
                "model" => $model,
                "attribute" => 'banner_description',
                "config" => array(
                    "height" => "100px",
                    "width" => "380px",
                    "toolbar" => Yii::app()->params['ckeditor_simple']
                )
            ));
            ?>
        </div>	
        <div class="clr"></div>            
        <?php echo $form->error($model, 'banner_description'); ?>
    </div>    
    
    <div class="row" style="clear: both;padding-top: 10px">
        <?php echo Yii::t('translation', $form->labelEx($model, 'link')); ?>
        <?php echo $form->textField($model, 'link', array('cols' => 54, 'rows' => 3, 'style' => 'width:400px;')); ?>
        <?php echo Yii::t('translation', $form->error($model, 'link')); ?>
    </div>
    <div class='clr'></div>

<!--      <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model, 'order_by')); ?>
        <?php echo $form->dropDownList($model, 'order_by',ActiveRecord::getValueOrder()); ?>
        <?php echo Yii::t('translation', $form->error($model, 'order_by')); ?>
    </div>-->
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model, 'status')); ?>
        <?php echo $form->dropDownList($model, 'status', array(1 => 'Active', 0 => 'Inactive')); ?>
        <?php echo Yii::t('translation', $form->error($model, 'status')); ?>
    </div>

    <div class="row buttons">
        <span class="btn-submit"><?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save') ); ?></span>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->

