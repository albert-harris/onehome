<?php $form=$this->beginWidget('CActiveForm', array(
            'action'=> Yii::app()->getRequest()->getHostInfo().Yii::app()->getRequest()->getUrl(),
            'method'=>'get',
    )); ?>
    <div class="search-view clearfix">
        <div class="box-3 form-type">
            <div class="in-row clearfix">
                <div class="col-1 w-500 DivClosest">
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($model,'property_name_or_address', array('class'=>'lb')); ?>
                        <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                'name'=>'ProTransactionsVendorPurchaserDetail[property_name_or_address]',
                                'model'=> $model,
//                                'value'=> CHtml::encode($model->property_name_or_address),
                                'value'=> $model->property_name_or_address,
                                'source'=> Yii::app()->createAbsoluteUrl('ajax/searchPropertyName'),
                                'htmlOptions'=>array(
                                    'class'=>"autocomplete_name_error text w-300",
//                                    'style'=>"float:left;$width",
                                ),
                            'options'=>array(
                                        'minLength'=>MIN_LENGTH_AUTOCOMPLETE,
                                        'multiple'=> true,
                                'search'=>"js:function( event, ui ) {} ",
                                'response'=>"js:function( event, ui ) {
                                        var json = $.map(ui, function (value, key) { return value; });
                                        var DivClosest = $(this).closest('.DivClosest');
                                        if(json.length<1){
                                            DivClosest.find('.errorMessage').show();
                                        }else
                                            DivClosest.find('.errorMessage').hide();
                                    } ",
                                    'select'=>"js:function(event, ui) {
                                        
                                    }",
                                ),
                            ));
                        ?>
                        <div class="errorMessage display_none" style="padding-left: 113px; padding-top: 5px;">No data found</div>
                        <?php echo $form->hiddenField($model,'listing_id'); ?>
                    </div>
                </div>
                <div class="col-2 w-150">
                    <div class="in-row clearfix">
                        <?php echo CHtml::submitButton('Search', array('class'=>'btn-3 f-right', 'style'=>'')); ?>
                    </div>
                </div>
            </div>
        </div>	
        <a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/record_existing_tenancy',array('add_property'=> ProTransactions::ADD_UNLISTED));?>" class="btn-2 btn-new">Record Existing Tenancy</a>
    </div>
<?php $this->endWidget(); ?> 