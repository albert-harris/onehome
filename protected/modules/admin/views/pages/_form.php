<div class="form">
    <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'pages-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
        ));
    ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <div class="row">
        <label for="Pages_title">Title<span class="required">*</span></label>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 63)); ?>
        <?php echo $form->error($model, 'title'); ?>
   </div>
<!--    <div class="row">
        <?php echo $form->labelEx($model,'banner'); ?>
		<?php echo $form->fileField($model, 'banner'); ?>
		<p style="padding-left: 120px"><i>Should >= 1280x223px</i></p>
		<?php echo $form->error($model,'banner'); ?>
		<?php if (!$model->isNewRecord): ?>
			<p style="padding-left: 120px"><img src="<?php echo $model->getBannerUrl(300) ?>" alt="" /></p>
		<?php endif ?>
    </div>-->
    <div class="clr"></div>
    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <div style="float:left;">
                <?php
                $this->widget('ext.editMe.ExtEditMe', array(
                    'model' => $model,
                    'height' => '250px',
                    'width' => '700px',
                    'attribute' => 'content',
                    'toolbar' => Yii::app()->params['ckeditor_editMe'],
                    'filebrowserBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html',
                    'filebrowserImageBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html?type=Images',
                    'filebrowserFlashBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html?type=Flash',
                    'filebrowserUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    'filebrowserImageUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    'filebrowserFlashUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                ));
                ?>
        </div>
        <?php echo $form->error($model, 'content'); ?>
    </div>
    <div class="row">
        <label for="Pages_parent_id">Parent Pages</label>    
        <?php echo $form->dropDownList($model, 'parent_id', Pages::getDropDownList()); ?>
        <?php echo $form->error($model, 'parent_id'); ?>
    </div>   
    
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model, 'order')); ?>
        <?php echo $form->dropDownList($model, 'order',ActiveRecord::getValueOrder()); ?>
        <?php echo Yii::t('translation', $form->error($model, 'order')); ?>
    </div>    

<!--    <div class="row">
        <label class="required" >Position</label>
        <?php // echo $form->dropDownList($model, 'show_footer', array(1 => 'Footer', 0 => 'Top',2=>'All')); ?>
        <?php // echo Yii::t('translation', $form->error($model, 'show_footer')); ?>
    </div> -->
    <div class="row">
            <label class="required" >Show in Homepage</label>
           <?php echo $form->dropDownList($model,'show_home_page',array(1=>'Show',0=>'Unshow')); ?>
           <?php echo Yii::t('translation',$form->error($model,'show_home_page')); ?>
   </div>
    <div class="row">
            <label class="required" >Show in footer</label>
           <?php echo $form->dropDownList($model,'show_footer',array(1=>'Show',0=>'Unshow')); ?>
           <?php echo Yii::t('translation',$form->error($model,'show_footer')); ?>
   </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', CmsFormatter::$statusVar, array()); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'external_link'); ?>
        <div style="float:left; font-size: 10px">
            Put any URL to here if you want this CMS link to other page <br />
             <?php echo $form->textField($model, 'external_link', array('size' => 60)); ?>
             <?php echo $form->error($model, 'external_link'); ?>
        </div>
        <div class="clr"></div>
    </div>    
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model, 'title_tag')); ?>
        <?php echo $form->textArea($model, 'title_tag', array('style' => 'width:'.EDITOR_WIDTH.';height:100px;')); ?>
        <?php echo Yii::t('translation', $form->error($model, 'title_tag')); ?>
    </div>

    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model, 'meta_keywords')); ?>
        <?php echo $form->textArea($model, 'meta_keywords', array('style' => 'width:'.EDITOR_WIDTH.';height:100px;')); ?>
        <?php echo Yii::t('translation', $form->error($model, 'meta_keywords')); ?>
    </div>
    
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model, 'meta_desc')); ?>
        <?php echo $form->textArea($model, 'meta_desc', array('style' => 'width:'.EDITOR_WIDTH.';height:100px;')); ?>
        <?php echo Yii::t('translation', $form->error($model, 'meta_desc')); ?>
    </div>

    <div class="row buttons" style="padding-left:121px;">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui-1.8.21.custom/js/jquery-ui-1.8.21.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui-1.8.21.custom/css/smoothness/jquery-ui-1.8.21.custom.css" />

<style>
    #ck{
        margin-left: 5px;
    }

    #Pages_external_link ,.row select{
        width: 411px;
    }

    .home_page{
        display: none;
    }
</style>