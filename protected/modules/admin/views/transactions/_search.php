<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
        <div class="row">
		<?php echo $form->label($model,'keyword'); ?>
		<?php echo $form->textField($model,'keyword',array('size'=>30,'maxlength'=>30)); ?>
	</div>
<!--	<div class="row">
		<?php echo $form->label($model,'transactions_no'); ?>
		<?php echo $form->textField($model,'transactions_no',array('size'=>30,'maxlength'=>30)); ?>
	</div>-->
	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', Listing::$aTextSaleRent, array('empty'=>'All', 'class'=>'')); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'ext_listing_type_id'); ?>
		<?php echo $form->dropDownList($model,'ext_listing_type_id', ProTransactionsPropertyDetail::$aListingType, array('empty'=>'All', 'class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_date'); ?>
		<?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,        
                        'attribute'=>'created_date',
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=> ActiveRecord::getDateFormatSearch(),
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showOn' => 'button',
                            'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                            'buttonImageOnly'=> true,                                
                        ),        
                        'htmlOptions'=>array(
//                            'class'=>'text w-7',
                            'style'=>'width: 200px;margin-right:10px;',
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