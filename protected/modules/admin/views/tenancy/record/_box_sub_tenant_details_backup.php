<div class="box-5">
    <div class="title clearfix">
        <h4 class="f-left">Tenant’s Details</h4> <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentAddTenant', array('transactions_id'=>$mTransactions->id, 'listing_id'=>(isset($_GET['listing_id'])?$_GET['listing_id']:'' ))); ?>" class="btn-1 f-right AddVendorDetails">Add more</a>
    </div>
    <div class="content table_scroll padding_0 ">    
        <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'tenant-grid',
                'dataProvider'=>  ProTransactionsVendorPurchaserDetail::searchByType($mTransactions->id, Users::USER_TENANT),
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
                    'name',
                    'nric_passportno_roc',
                    array(
                        'name' => 'contact_no',
                        'htmlOptions' => array('style' => 'text-align:center;'),
                        'headerHtmlOptions' => array('class' => 'item_c'),
                    ),
                    'address',
                    array(
                        'name' => 'postal_code',
                        'htmlOptions' => array('style' => 'text-align:center;'),
                        'headerHtmlOptions' => array('class' => 'item_c'),
                    ),
                    array(
                        'name' => 'id_type',
                        'type'=>'LandLorIdType',
                        'value'=>'$data',
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
                                'url'=>'Yii::app()->createAbsoluteUrl("ajax/agentUpdateTenant",
                                    array("id"=>$data->id))',
                            ),
                            'delete_item'=>array(
                                'label'=>'Remove',
                                'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/delete.png',
                                'options'=>array('class'=>'delete_item'),
                                'url'=>'Yii::app()->createAbsoluteUrl("admin/ajax/deleteVendorPurchaser",
                                    array("id"=>$data->id))',
                            ),                                                    
                        ),    
                    ),
                ),
        )); ?>

    </div> <!--  end  content table_scroll -->
</div> <!--  end  box-5 -->



<!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>-->    
<script>
    $(document).ready(function() {
//        fnInitFancybox('.AddVendorDetails');
//        fnInitFancybox('.update_item');
//        fnBindDelete();
    });


</script>