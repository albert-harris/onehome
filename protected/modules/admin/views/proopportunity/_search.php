<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'title',array('label' => Yii::t('translation','Title'))); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_id',array('label' => Yii::t('translation','Country'))); ?>
		<?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('prompt'=>'Select a country', 'options' => array(DEFAULT_AREA_CODE=>array('selected'=>true)))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'department',array('label' => Yii::t('translation','Department'))); ?>
		<?php echo $form->textField($model,'department',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'posted',array('label' => Yii::t('translation','Posted'))); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model' => $model,
                            'attribute'=>'posted',
                            'options'=>array(
                                    'showAnim'=>'fold',
                                    'showButtonPanel'=>true,
                                    'autoSize'=>true,
                                    'dateFormat'=>'dd-mm-yy',
                                    'width'=>'120',
                                    'separator'=>' ',
                                    'showOn' => 'button',
                                    'buttonImage'=> Yii::app()->theme->baseUrl.'/admin/images/icon_calendar_r.gif',
                                    'buttonImageOnly'=> true,
                                    'changeMonth'=> true,
                                    'changeYear'=> true,
                                    'yearRange'=> "c-100:c+0",
//                                    'maxDate'=>0
                            ),
                            'htmlOptions'=>array(
                                    'readonly'=>true,
                                    'class'=>'in-text w-1'
                            ),
                    ));
            ?>
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