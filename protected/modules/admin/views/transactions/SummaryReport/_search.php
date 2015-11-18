<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
));

$cAction = strtolower(Yii::app()->controller->action->id);
?>
    
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
                            'maxDate'=> '0',
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
                            'maxDate'=> '0',
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
            $link = Yii::app()->createAbsoluteUrl('admin/transactions/summaryReport', array('to_excel'=>1));
        ?>        
        <a href="<?php echo $link;?>" class="btn btn-small">Export Excel</a>
        <?php // endif; ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

<style>
.ui-datepicker-trigger {
    display: inline;
    padding:0px;
    padding-left:3px;
    vertical-align:baseline;
    position:relative;
}
</style>
