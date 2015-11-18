<div class="form-type content no_background no_border iframe_form">
<h1 class="title-page">Update Status Report Defect(s)</h1>

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

    <div class="in-row clearfix">
        <?php echo $form->labelEx($model,'created_date', array('class'=>'lb')); ?>
        <div class="group-4 top_5">
            <?php echo $cmsFormater->formatDateTimeReport($model->created_date);?>
        </div>        
    </div>
    
    
<!--    <div class="in-row clearfix">
        <?php echo $form->label($model,'created_date', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $cmsFormater->formatDateTimeReport($model->created_date);?>
        </div>        
    </div>-->
    
    <div class="in-row clearfix">
        <?php echo $form->labelEx($model,'description', array('class'=>'lb')); ?>
        <div class="group-4 top_5">
            <?php echo $model->description;?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->labelEx($model,'location_text', array('class'=>'lb')); ?>
        <div class="group-4 top_5">
            <?php echo $model->location_text;?>
            <?php // echo ProReportDefect::GetViewLocation($model);?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->labelEx($model,'status', array('class'=>'lb')); ?>
        <div class="group-4 top_5">
            <?php echo $form->dropDownList($model,'status', CmsFormatter::$statusReport, array('class'=>'status_report', 'style'=>'width:200px;')); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->labelEx($model,'approved_by_progess', array('class'=>'lb')); ?>
        <div class="group-4 top_5">
            <?php echo MyFormat::GetNameUserAdminLogin(Yii::app()->user->id);?>
        </div>        
    </div>
    <div class="in-row clearfix">
        <?php echo $form->labelEx($model,'description', array('class'=>'lb')); ?>
        <div class="group-4 top_5">
            <?php echo $model->description;?>
        </div>        
    </div>

    <div class="row in-row clearfix display_none addspan">
            <?php echo $form->labelEx($model,'approved_date', array('class'=>'lb')); ?>
            <div class="group-4 top_5">
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
                    'style'=>'width: 165px;margin-right:10px;',
                    'readonly'=>'readonly',
                ),
            ));
            ?>
            <?php echo $form->error($model,'approved_date'); ?>
            </div>
	</div>    
    
        <div class="row in-row clearfix display_none addspan">
            <?php echo $form->labelEx($model,'remark', array('class'=>'lb'));?>
            <div class="group-4 top_5">
                <?php echo $form->textarea($model,'remark',array('class'=>'w-300 empty_val','maxlength'=>500, 'rows'=>3)); ?>
		<?php echo $form->error($model,'remark'); ?>
            </div>
        </div>    

    <div class="clearfix output">
        <a href="javascript:void(0)" class="btn-2 iframe_close">Cancel</a>
        <input type="submit" class="btn-3" value="Submit" />
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script>
    $(function(){
         $('.iframe_close').on('click', function(){
             parent.$.fancybox.close();
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
    .iframe_form .errorMessage {  padding-left: 0 !important;}
/*    .btn-small{
        margin-left: 6px;
    }
    
    .img{
        width: 140px;
        height: 120px;
    }*/
</style>

</div>