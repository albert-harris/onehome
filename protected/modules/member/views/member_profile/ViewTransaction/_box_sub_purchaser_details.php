
<div class="box-5">
    <div class="title clearfix">
        <h4 class="f-left">Purchaser’s Details</h4>
    </div>
    <div class="content table_scroll padding_0">    
        <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'purchaser-grid',
                'dataProvider'=>  ProTransactionsVendorPurchaserDetail::searchByType($mTransactions->id, Users::USER_PURCHASER),
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
                    array(
                        'name' => 'name',
                        'value' => '$data->getField("name")',
                    ),
                    array(
                        'name' => 'nric_passportno_roc',
                        'value' => '$data->getField("nric_passportno_roc")',
                    ),
                    array(
                        'name' => 'contact_no',
                        'value' => '$data->getField("contact_no")',
                        'htmlOptions' => array('style' => 'text-align:center;'),
                        'headerHtmlOptions' => array('class' => 'item_c'),
                    ),
                    array(
                        'name' => 'address',
                        'value' => '$data->getField("address")',
                    ),
                    array(
                        'name' => 'postal_code',
                        'value' => '$data->getField("postal_code")',
                        'htmlOptions' => array('style' => 'text-align:center;'),
                        'headerHtmlOptions' => array('class' => 'item_c'),
                    ),
                                
                ),
        )); ?>
    </div> <!--  end  content table_scroll -->    
</div><!--  end  box-5 -->