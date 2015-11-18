<h2>Update Status Report Defect(s)</h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-defect-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); 

$statusReport = CmsFormatter::$statusReport;
unset($statusReport[0]);
$cmsFormater = new CmsFormatter();
?>


    <div class="row">
        <?php echo $form->label($model,'created_date'); ?>
        <div class="l_padding_140">
            <?php echo $cmsFormater->formatDateTimeReport($model->created_date);?>
        </div>
    </div>
    
    <div class="row">
        <?php echo $form->label($model,'description'); ?>
        <div class="l_padding_140">
            <?php echo $model->description;?>
        </div>
    </div>
    
    <div class="row">
        <?php echo $form->label($model,'location_text'); ?>
        <div class="l_padding_140">
            <?php echo $model->location_text;?>
            <?php // echo ProReportDefect::GetViewLocation($model);;?>
        </div>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <div class="l_padding_140">
            <?php echo $form->dropDownList($model,'status', CmsFormatter::$statusReport, array('class'=>'status_report', 'style'=>'width:200px;')); ?>
            <?php echo $form->error($model,'status'); ?>
            </div>
    </div>
    <div class="row">
        <?php echo $form->label($model,'approved_by_progess'); ?>
        <div class="l_padding_140">
            <?php echo MyFormat::GetNameUserAdminLogin(Yii::app()->user->id);?>
        </div>
    </div>
    
    <div class="row display_none addspan">
            <?php echo Yii::t('translation', $form->labelEx($model,'approved_date')); ?>
            <div class="l_padding_140">        
            <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,        
                'attribute'=>'approved_date',
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=> ActiveRecord::getDateFormatJquery(),
                    'maxDate'=> '0',
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showOn' => 'button',
                    'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                    'buttonImageOnly'=> true,                                
                ),        
                'htmlOptions'=>array(
                    'class'=>'empty_val',
                    'style'=>'width: 200px;margin-right:10px;',
                    'readonly'=>'readonly',
                ),
            ));
            ?>
            <?php echo $form->error($model,'approved_date'); ?>
            </div>
	</div>    
    
        <div class="row display_none addspan">
            <?php echo Yii::t('translation', $form->labelEx($model,'remark')); ?>
            <div class="l_padding_140">
                <?php echo $form->textarea($model,'remark',array('class'=>'w-400 empty_val','maxlength'=>500, 'rows'=>5)); ?>
		<?php echo $form->error($model,'remark'); ?>
            </div>
        </div>    

    <div class="row buttons" style="padding-left: 140px;">
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
        
        $('.status_report').change(function(){
            var select = $(this).val();
            if(select==<?php echo CmsFormatter::COMPLETE_REPORT;?>){
                $('.empty_val').each(function(){
                   $(this).closest('.row').show();
                });
            }else{
                $('.empty_val').each(function(){
                   $(this).val('');
                   $(this).closest('.row').hide();
                });
            }
            
        });
        
        $('.status_report').trigger('change');
        
        $('.addspan').each(function(){
            var span = '<span class="required"> *</span>';
            var label = $(this).find('label:first');
            if(label.find('span').size()<1){
                label.append(span);
            }
        });
    });
    
    
    
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