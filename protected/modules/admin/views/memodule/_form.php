<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-group-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
        'method'=>'post',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),    
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
    <?php $action=Yii::app()->controller->action->id;?>
    
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'name')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model,'short_description')); ?>
        <div style="float:left;">
            <div class="tab-pane active" id="pagecontent">
                <?php
                $this->widget('ext.ckeditor.CKEditorWidget',array(
                    "model"=>$model,
                    "attribute"=>'short_description',
                    "config" => array(
                        "height"=>"150px",
                        "width"=>"400px",
                        "toolbar"=>Yii::app()->params['ckeditor_simple']
                    )
                ));
                ?>
            </div>
        </div>
        <div class="clr"></div>
        <?php echo $form->error($model,'short_description'); ?>
    </div>
    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model,'description')); ?>
        <div style="float:left;">
            <div class="tab-pane active" id="pagecontent">
                <?php
                $this->widget('ext.ckeditor.CKEditorWidget',array(
                    "model"=>$model,
                    "attribute"=>'description',
                    "config" => array(
                        "height"=>"150px",
                        "width"=>"400px",
                        "toolbar"=>Yii::app()->params['ckeditor_simple']
                    )
                ));
                ?>
            </div>
        </div>
        <div class="clr"></div>
        <?php echo $form->error($model,'description'); ?>
    </div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'course_id'); ?>
		<?php echo $form->dropDownList($model, 'course_id', Mecourse::getDropdownList()); ?>
		<?php echo $form->error($model,'course_id'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'cover'); ?>
        <?php echo $form->fileField($model, 'imageFile'); ?>
        <span class='errorMessage'>( *.jpg , *.gif , *.png )( MaxSize : 3M )(width: 217px,height: 194px)</span>
        <?php echo Yii::t('translation',$form->error($model,'imageFile')); ?>
	</div>
    <?php if($action=='update'){ ?>
        <div class="column" style="width: 98%; padding:15px 0 15px 0;">
            <img src="<?php echo ImageProcessing::bindImageByModel($model, 217, 194, 'cover') ?>"  style="width:110px;margin-left: 118px;";/>
            <!--<img src="<?php echo Yii::app()->createAbsoluteUrl('/upload/admin/module/'.$model->id.'/'.$model->cover);?>"  style="width:110px;margin-left: 118px;";/>-->
        </div>
    <?php }?>    
    
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'status')); ?>
		<?php echo $form->dropDownList($model,'status',array(0=>'Inactive',1=>'Active')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
    
<?php
        $tmp_ = array();
        for($i=1;$i<100;$i++)
            $tmp_[$i]=$i;
        ?>
	<div class="row">
		<?php echo $form->labelEx($model,'order_at'); ?>
                <?php echo $form->dropDownList($model,'order_at',$tmp_); ?>
		<?php echo $form->error($model,'order_at'); ?>
	</div>
    
	<div class="row buttons" style="padding-left: 121px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->