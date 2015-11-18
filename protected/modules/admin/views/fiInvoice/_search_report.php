<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
));

$cAction = strtolower(Yii::app()->controller->action->id);
?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'report_type'); ?>
        <?php echo $form->dropDownList($model,'report_type', FiInvoice::$STA_REPORT_TYPE, array("class"=>"")); ?>
    </div>

    <div class="row more_col daily_col report_type_1">
        <div class="mycol1">
                <?php echo Yii::t('translation', $form->label($model,'date_from')); ?>
                <?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,        
                        'attribute'=>'date_from',
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=> ActiveRecord::getDateFormatJquery(),
//                            'minDate'=> '0',
//                            'maxDate'=> '0',
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showOn' => 'button',
                            'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                            'buttonImageOnly'=> true,
                            'showButtonPanel' => true,
                        ),        
                        'htmlOptions'=>array(
                            'class'=>'w-16',
                            'size'=>'16',
                            'readonly'=>'readonly',
                            'style'=>'float:left;margin-right: 10px;',                               
                        ),
                    ));
                ?>     		
        </div>
        <div class="mycol2">
                <?php echo Yii::t('translation', $form->label($model,'date_to')); ?>
                <?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,        
                        'attribute'=>'date_to',
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=> ActiveRecord::getDateFormatJquery(),
    //                            'minDate'=> '0',
//                            'maxDate'=> '0',
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showOn' => 'button',
                            'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
    //                                'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                            'buttonImageOnly'=> true,
                            'showButtonPanel' => true,
                        ),        
                        'htmlOptions'=>array(
                            'readonly'=>'readonly',
                            'class'=>'w-16',
                            'size'=>'16',
                            'style'=>'float:left;margin-right: 10px;',
                        ),
                    ));
                ?>     		
        </div>
    </div>
    
    <!--array('date_from,date_to,report_type,month_from,month_to,year_from,year_to-->
    <div class="row more_col month_col report_type_2 display_none">
        <div class="mycol1">
                <?php echo Yii::t('translation', $form->label($model,'month_from')); ?>
                <?php 
//                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                        'model'=>$model,        
//                        'attribute'=>'month_from',
//                        'options'=>array(
//                            'showAnim'=>'fold',
//                            'dateFormat'=> 'mm/yy',
////                            'minDate'=> '0',
//                            'maxDate'=> '0',
//                            'changeMonth' => true,
//                            'changeYear' => true,
//                            'showOn' => 'button',
//                            'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
//                            'buttonImageOnly'=> true,
//                            'showButtonPanel' => true,
//                            'beforeShow'=> "js:function(e, t){
//                                 if ((selDate = $(this).val()).length > 0) 
//                                 {
//                                    iYear = selDate.substring(selDate.length - 4, selDate.length);
//                                    iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5),
//                                                        $(this).datepicker('option', 'monthNames'));
//                                    $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
//                                    $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
//                                }                                 
//                              }",
//                            "onClose"=> 'js:function(dateText, inst) { 
//                                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
//                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
//                                $(this).datepicker("setDate", new Date(year, month, 1));
//                            }',
////                            "change"=> 'js:function(dateText, inst) { 
////                                $(".ui-datepicker-calendar").hide();
////                            }',
//                        ),        
//                        'htmlOptions'=>array(
//                            'class'=>'w-16',
//                            'size'=>'16',
//                            'readonly'=>'readonly',
//                            'style'=>'float:left;margin-right: 10px;',                               
//                        ),
//                    ));
                ?>     		
        </div>
        <div class="mycol2">
                <?php echo Yii::t('translation', $form->label($model,'month_to')); ?>
                <?php 
//                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                        'model'=>$model,        
//                        'attribute'=>'month_to',
//                        'options'=>array(
//                            'showAnim'=>'fold',
//                            'dateFormat'=> "mm/yy",
//    //                            'minDate'=> '0',
//                            'maxDate'=> '0',
//                            'changeMonth' => true,
//                            'changeYear' => true,
//                            'showOn' => 'button',
//                            'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
//    //                                'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
//                            'buttonImageOnly'=> true,
//                            'showButtonPanel' => true,
//                            "onClose"=> 'js:function(dateText, inst) { 
//                                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
//                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
//                                $(this).datepicker("setDate", new Date(year, month, 1));
//                            }',
//                        ),        
//                        'htmlOptions'=>array(
//                            'readonly'=>'readonly',
//                            'class'=>'w-16',
//                            'size'=>'16',
//                            'style'=>'float:left;margin-right: 10px;',
//                        ),
//                    ));
                ?>     		
        </div>
    </div>
    
    <div class="row more_col month_col report_type_3 display_none">
        <div class="mycol1">
            <?php echo $form->labelEx($model,'year_from'); ?>
            <?php echo $form->dropDownList($model,'year_from', MyFormat::getRangeYear(), array("class"=>"", )); ?>
        </div>
        <div class="mycol2">
            <?php echo $form->labelEx($model,'year_to'); ?>
            <?php echo $form->dropDownList($model,'year_to', MyFormat::getRangeYear(), array("class"=>"", )); ?>
        </div>
    </div>

    <div class="row buttons" style="padding-left: 159px;">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'label'=>Yii::t('translation','Show Report'),
        'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'small', // null, 'large', 'small' or 'mini'
        //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
    )); ?>	
        <?php // if(isset($_SESSION['REPORT_DATA']['COUNT_TRANS'])): 
            $cAction = strtolower(Yii::app()->controller->action->id);
            $link = Yii::app()->createAbsoluteUrl('admin/FiInvoice/report', array('to_excel'=>1));
            if($cAction == 'report_transaction'){
                $link = Yii::app()->createAbsoluteUrl('admin/FiInvoice/report_transaction', array('to_excel'=>1));
            }
        ?>        
        <a href="<?php echo $link;?>" class="btn btn-small">Export Excel</a>
        <?php // endif; ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

<style>
/*    .ui-datepicker-calendar {
        display: none;
    }*/

.ui-datepicker-trigger {
    display: inline;
    padding:0px;
    padding-left:3px;
    vertical-align:baseline;
    position:relative;
}
</style>

<script>
    $(window).load(function(){
//        $('.month_col').find('.ui-datepicker-trigger').live('click', function(){
//        $('.month_col .ui-datepicker-trigger').click(function(){
//            $(".ui-datepicker-calendar").hide();
//        });
//        $('.daily_col .ui-datepicker-trigger').click(function(){
//            $(".ui-datepicker-calendar").show();
//        });
//        fnBindChangeType();
    });
    
    function fnBindChangeType(){
        $('.more_col').hide();
        $('.report_type_<?php echo $model->report_type;?>').show();
        $('#FiInvoice_report_type').change(function(){
            $('.more_col').hide();
            var type = $(this).val();
            $('.report_type_'+type).show();
//            if(type==<?php echo FiInvoice::REPORT_DAILY;?>){
////                $(".ui-datepicker-calendar").css({display:'none'});
//            }else if(type==<?php echo FiInvoice::REPORT_MONTHLY;?>){
//                $(".ui-datepicker-calendar").css({display:'none'});
////                alert(1);
//            }
//            
        });
    }
    
</script>