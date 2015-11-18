<div class="in-row clearfix">
    <?php echo $form->labelEx($mTransactions,'client_type_id', array('class'=>'lb')); ?>
    <div class="group top_5">
        <?php echo isset(ProTransactions::$aClientSaleDetail[$mTransactions->client_type_id])?ProTransactions::$aClientSaleDetail[$mTransactions->client_type_id]:""; ?>
    </div>
</div>

<div class="in-row clearfix">
    <?php echo $form->labelEx($mTransactions->mBillTo,'bill_to_id', array('class'=>'lb')); ?>
    <div class="group top_5">
        <?php echo isset(ProTransactions::$aBillTo[$mTransactions->mBillTo->bill_to_id])?
        ProTransactions::$aBillTo[$mTransactions->mBillTo->bill_to_id]
                :""; ?>
    </div>
</div>

<div class="wrap_client_type_info display_none">
    <div class="in-row clearfix bill_to_company_name display_none">
        <?php echo $form->labelEx($mTransactions->mBillTo,'company_name', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $mTransactions->mBillTo->company_name; ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'attn_to', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $mTransactions->mBillTo->attn_to; ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'commission_amount', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $cmsFormater->formatPrice($mTransactions->mBillTo->commission_amount); ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'commission_amount_gst', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $cmsFormater->formatPrice($mTransactions->mBillTo->commission_amount_gst); ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'contact_no', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $mTransactions->mBillTo->contact_no; ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'billing_address', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $mTransactions->mBillTo->billing_address; ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'postal_code', array('class'=>'lb')); ?>
        <div class="group top_5">
            <?php echo $mTransactions->mBillTo->postal_code; ?>
        </div>        
    </div>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions->mBillTo,'paying_to_external_co_broke', array('class'=>'lb','style'=>'width:190px;')); ?>
        <div class="group top_5">
            <?php echo isset(ProTransactionsPropertyDetail::$aYesNo[$mTransactions->mBillTo->paying_to_external_co_broke])?
                ProTransactionsPropertyDetail::$aYesNo[$mTransactions->mBillTo->paying_to_external_co_broke]
                        :""; ?>
        </div>
        
    </div>
</div> <!--  end  wrap_client_type_info -->    

<div class="box-5 table_external_co_broke display_none">
    <div class="title clearfix">
        <h4 class="f-left">External Co-broke details</h4>
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
                        'type'=>'NumberOnly',
                        'htmlOptions' => array('style' => 'text-align:right;'),
                        'headerHtmlOptions' => array('class' => 'item_r'),
                    ),
                    array(
                        'name' => 'commission_amount_gst',
                        'type'=>'NumberOnly',
                        'htmlOptions' => array('style' => 'text-align:right;'),
                        'headerHtmlOptions' => array('class' => 'item_r'),
                    ),
                    'billing_address',
                    array(
                        'name' => 'postal_code',
                        'htmlOptions' => array('style' => 'text-align:center;'),
                        'headerHtmlOptions' => array('class' => 'item_c'),
                    ),                
                ),
        )); ?>

    </div> <!--  end  content table_scroll -->
</div> <!--  end  box-5 -->
