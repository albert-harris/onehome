<div class="in-row clearfix">
    <?php echo $form->labelEx($mTransactions,'client_type_id', array('class'=>'lb')); ?>
    <div class="group-4 list-check-3">
        <?php echo $form->radioButtonList($mTransactions,'client_type_id', ProTransactions::$aClientSaleDetail,
                array(
                    'template'=>"<li>{input}{label}</li>",
                    'separator'=>'',
                    'container'=>'ul',
                    'class'=>'client_type_id',
                )
            );?>
    </div>
    <?php echo $form->error($mTransactions,'client_type_id'); ?>
</div>

<script>
    $(function(){
    });
</script>

<div class="in-row clearfix">
    <?php echo $form->labelEx($mTransactions->mBillTo,'bill_to_id', array('class'=>'lb')); ?>
    <div class="group-4 list-check-3">
        <?php echo $form->radioButtonList($mTransactions->mBillTo,'bill_to_id', ProTransactions::$aBillTo,
                array(
                    'template'=>"<li>{input}{label}</li>",
                    'separator'=>'',
                    'container'=>'ul',
                    'class'=>'bill_to_id',
                )
            );?>
    </div>
    <?php echo $form->error($mTransactions->mBillTo,'bill_to_id'); ?>
</div>

<div class="wrap_client_type_info display_none wrap_commission">
    <div class="in-row clearfix bill_to_company_name display_none">
        <?php echo $form->labelEx($mTransactions->mBillTo,'company_name', array('class'=>'lb', 'label'=>$mTransactions->mBillTo->getAttributeLabel('company_name').'<span class="required"> *</span><span class="x1"> :</span>')); ?>
        <?php // echo $form->labelEx($mTransactions->mBillTo,'company_name', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->textField($mTransactions->mBillTo,'company_name',array('class'=>'text')); ?>
            <?php echo $form->error($mTransactions->mBillTo,'company_name'); ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'attn_to', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->textField($mTransactions->mBillTo,'attn_to',array('class'=>'text')); ?>
            <?php echo $form->error($mTransactions->mBillTo,'attn_to'); ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'commission_amount', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->textField($mTransactions->mBillTo,'commission_amount',array('class'=>'text number_only commission_amount ad_fix_currency')); ?>
            <?php echo $form->error($mTransactions->mBillTo,'commission_amount'); ?>
        </div>        
    </div>

    <?php $cmsFormater = new CmsFormatter();?>
    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'commission_amount_gst', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->textField($mTransactions->mBillTo,'commission_amount_gst',array('class'=>'text number_only ad_fix_currency commission_amount_gst')); ?>
            <?php echo $form->error($mTransactions->mBillTo,'commission_amount_gst'); ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'contact_no', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->textField($mTransactions->mBillTo,'contact_no',array('class'=>'text')); ?>
            <?php echo $form->error($mTransactions->mBillTo,'contact_no'); ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'billing_address', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->textArea($mTransactions->mBillTo,'billing_address',array('class'=>'text')); ?>
            <?php echo $form->error($mTransactions->mBillTo,'billing_address'); ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'postal_code', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->textField($mTransactions->mBillTo,'postal_code',array('class'=>'text')); ?>
            <?php echo $form->error($mTransactions->mBillTo,'postal_code'); ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'paying_to_external_co_broke', array('class'=>'lb','style'=>'width:190px;')); ?>
        <div class="group-4 list-check-3">
            <?php echo $form->radioButtonList($mTransactions->mBillTo,'paying_to_external_co_broke', ProTransactionsPropertyDetail::$aYesNo,
                    array(
                        'template'=>"<li>{input}{label}</li>",
                        'separator'=>'',
                        'container'=>'ul',
                        'class'=>'paying_to_external_co_broke',
                    )
                );?>
        </div>
        <?php echo $form->error($mTransactions->mBillTo,'paying_to_external_co_broke'); ?>
    </div>
</div> <!--  end  wrap_client_type_info -->    

<div class="box-5 table_external_co_broke display_none">
    <div class="title clearfix">
        <h4 class="f-left">External Co-broke details</h4> <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentAddExternalCoBroke', array('transactions_id'=>$mTransactions->id, "add_property"=> $mTransactions->add_property)); ?>" class="btn-1 f-right AddVendorDetails">Add more</a>
    </div>
    <div class="content table_scroll padding_0 ">    
        <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'external-co-broke-grid',
                'dataProvider'=> ProTransactionsBillTo::searchByType($mTransactions->id, ProTransactionsBillTo::TYPE_EXTERNAL_CO_BROKE),
                'afterAjaxUpdate'=>'function(id, data){}',
                'template'=>'{items}{pager}', 
                'itemsCssClass'=>'tb-1 margin_0',
                'htmlOptions' => array('class' => 'grid-view padding_0'),
                'enableSorting' => false,
                'columns'=>array(
                    array(
                        'header' => '#',
                        'type' => 'raw',
                        'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                        'headerHtmlOptions' => array('width' => '10px','style' => 'text-align:center;'),
                        'htmlOptions' => array('style' => 'text-align:center;'),
                        'cssClassExpression'=>'"first"',
                    ),
                    'company_name',
                    'salesperson_name',
                    array(
                        'name' => 'nric_no',
                        'htmlOptions' => array('style' => 'text-align:center;'),
                        'headerHtmlOptions' => array('class' => 'item_c'),
                    ),
                    array(
                        'name' => 'contact_no',
                        'htmlOptions' => array('style' => 'text-align:center;'),                        
                        'headerHtmlOptions' => array('class' => 'item_c'),
                    ),
                    array(
                        'name' => 'commission_amount',
                        'type'=>'Price',
                        'htmlOptions' => array('style' => 'text-align:right;'),
                        'headerHtmlOptions' => array('class' => 'item_r'),
                    ),
                    array(
                        'name' => 'commission_amount_gst',
                        'type'=>'Price',
                        'htmlOptions' => array('style' => 'text-align:right;'),
                        'headerHtmlOptions' => array('class' => 'item_r'),
                    ),
                    'billing_address',
                    array(
                        'name' => 'postal_code',
                        'htmlOptions' => array('style' => 'text-align:center;'),
                        'headerHtmlOptions' => array('class' => 'item_c'),
                    ),
                    array(
                        'header' => 'Actions',
                        'class'=>'CButtonColumn',
                        'cssClassExpression'=>'"last"',
                        'template'=> '{update_item}{delete_item}',
                        'buttons'=>array(
                            'update_item'=>array(
                                'label'=>'Remove',
                                'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/update.png',
                                'options'=>array('class'=>'update_item', 'data-fancybox-type'=>'iframe'),
                                'url'=>'Yii::app()->createAbsoluteUrl("ajax/agentUpdateExternalCoBroke",
                                    array("id"=>$data->id,
                                    "add_property"=> '.$mTransactions->add_property.'
                                ))',
                            ),
                            'delete_item'=>array(
                                'label'=>'Remove',
                                'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/delete.png',
                                'options'=>array('class'=>'delete_item'),
                                'url'=>'Yii::app()->createAbsoluteUrl("member/member_profile/delete",
                                    array("id"=>$data->id))',
                            ),                                                    
                        ),    
                    ),
                ),
        )); ?>

    </div> <!--  end  content table_scroll -->
</div> <!--  end  box-5 -->
