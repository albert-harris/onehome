<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));

$cAction = strtolower(Yii::app()->controller->action->id);
?>

	<div class="row">
		<?php echo $form->label($model,'invoice_no'); ?>
		<?php echo $form->textField($model,'invoice_no',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transactions_no'); ?>
		<?php echo $form->textField($model,'transactions_no',array('size'=>30,'maxlength'=>30)); ?>
	</div>
    
        <div class="row">
		<?php echo $form->label($model,'keyword'); ?>
		<?php echo $form->textField($model,'keyword',array('size'=>30,'maxlength'=>300)); ?>
	</div>

        <?php if($cAction != 'accountsreceivables'): ?>
	<div class="row">
            <?php echo $form->label($model,'status'); ?>
            <?php echo $form->dropDownList($model,'status', FiInvoice::$STA_STATUS, array("class"=>"", 'empty'=>'Select')); ?>
	</div>
        <?php endif;?>
    
        <div class="row more_col daily_col report_type_1">
            <div class="mycol1">
                    <?php echo Yii::t('translation', $form->label($model,'date_from')); ?>
                    <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model'=>$model,
                            'attribute'=>'date_from',
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=> ActiveRecord::getDateFormatSearch(),
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
                                'dateFormat'=> ActiveRecord::getDateFormatSearch(),
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
            'label'=>Yii::t('translation','Search'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->