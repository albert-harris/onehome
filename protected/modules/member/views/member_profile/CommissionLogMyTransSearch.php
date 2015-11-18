<?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>Yii::app()->createUrl($this->route),
            'method'=>'get',
    )); ?>

        <div class="search-trans clearfix">
            <div class="box-3 form-type padding_0 margin_0" >
                <div class="in-row clearfix">
                    <div class="col-1">
                        <div class="in-row clearfix">
                            <?php echo $form->label($model,'submitted_date', array('class'=>'lb')); ?>
                            <?php 
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model'=>$model,        
                                    'attribute'=>'submitted_date',
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
                                        'class'=>'text w-7',
                                        'style'=>'float:left',
                                    ),
                                ));
                            ?> 
                            
                        </div>
                        <div class="in-row clearfix">
                            <?php echo $form->label($model,'property_type_id', array('class'=>'lb')); ?>
                            <div class="group-5">
                                <?php echo ProPropertyType::getDropDownSelectGroup('ProTransactionsSaveCommission[property_type_id]','ProTransactionsSaveCommission', '',  'Select'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="in-row clearfix">
                            <?php echo $form->labelEx($model,'transactions_no', array('class'=>'lb')); ?>
                            <div class="group-5">
                                <?php echo $form->textField($model,'transactions_no',array('class'=>'text')); ?>
                            </div>
                        </div>
                        
                        <div class="in-row clearfix r_margin_20">
                            <?php echo CHtml::submitButton('Search', array('class'=>'btn-3 f-right submit_search_trans', 'style'=>'')); ?>
                        </div>
                    </div>
                </div>
            </div>	            
        </div>
<?php $this->endWidget(); ?> 