<div class="box-5">
    <div class="title clearfix">
        <h4 class="f-left">Internal Co-broke Details</h4> <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentAddInternalCoBroke', array('transactions_id'=>$mTransactions->id)); ?>" class="btn-1 f-right AddVendorDetails">Add more</a>
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
                        'value'=>'MyFormat::formatPrice($data->gross_commission_amount)." %"',
                        'htmlOptions' => array('style' => 'text-align:center;'),
                    ),  

                    array(
                        'header' => 'Actions',
                        'class'=>'CButtonColumn',
                        'cssClassExpression'=>'"last"',
                        'template'=> '{delete_item}',
                        'buttons'=>array(
                            'delete_item'=>array(
                                'label'=>'Remove',
                                'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/delete.png',
                                'options'=>array('class'=>'delete_item'),
                                'url'=>'Yii::app()->createAbsoluteUrl("member/member_profile/delete_internal",
                                    array("id"=>$data->id))',
                            ),
                        ),    
                    ),
                ),
        )); ?>

    </div> <!--  end  content table_scroll -->
</div> <!--  end  box-5 --> 