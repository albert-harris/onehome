<div class="box-5">
    <div class="title clearfix">
        <h4 class="f-left">Internal Co-broke Details</h4>
    </div>
    <div class="content table_scroll padding_0 ">    
        <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'internal-co-broke-grid',
                'dataProvider'=>  ProTransactionsInternalCoBroke::searchByTransaction($mTransactions->id),
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
                        'header' => 'Name',
                        'value' => '$data->relation_user?$data->relation_user->first_name:""',
//                        'htmlOptions' => array('style' => 'text-align:center;'),
//                        'headerHtmlOptions' => array('class' => 'item_c'),
                    ),                    
                    array(
                        'header' => 'NRIC No',
                        'value' => '$data->relation_user?$data->relation_user->nric_passportno_roc:""',
                    ),                    
                    array(
                        'name' => 'gross_commission_amount',
                        'type'=>'NumberOnly',
                        'htmlOptions' => array('style' => 'text-align:left;'),
                    ),                    
                ),
        )); ?>

    </div> <!--  end  content table_scroll -->
</div> <!--  end  box-5 --> 