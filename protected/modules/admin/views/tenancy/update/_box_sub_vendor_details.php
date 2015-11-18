<div class="box-5">
    <div class="title clearfix">
        <!--<h4 class="f-left">Vendor’s Details</h4>--> 
        <div class="f-left w-2 fixErrorSummary">
            <h4>Vendor’s Details</h4>
            <?php echo $form->errorSummary($mTransactions->mVendor); ?>
        </div> 
        <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentAddVendor', array('transactions_id'=>$mTransactions->id)); ?>" class="btn-1 f-right AddVendorDetails">Add more
        </a>
    </div>
    <div class="content table_scroll padding_0 ">    
        <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'vendor-grid',
                'dataProvider'=>  ProTransactionsVendorPurchaserDetail::searchByType($mTransactions->id, Users::USER_VENDOR),
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
                    'email',
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
                    array(
                        'header' => 'Actions',
                        'class'=>'CButtonColumn',
                        'cssClassExpression'=>'"last"',
                        'template'=> '{update_item}{delete_item}',
                        'buttons'=>array(
                            'update_item'=>array(
                                'label'=>'Update',
                                'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/update.png',
                                'options'=>array('class'=>'update_item', 'data-fancybox-type'=>'iframe'),
                                'url'=>'Yii::app()->createAbsoluteUrl("ajax/agentUpdateVendor",
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



<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>    
<script>
    $(document).ready(function() {
        fnInitFancybox('.AddVendorDetails');
        fnInitFancybox('.update_item');
        fnBindDelete();
    });

    function fnInitFancybox(class_name){
        //http://fancyapps.com/fancybox/
        $(class_name).fancybox({
            fitToView:true,
            width: 600,
            autoSize:false,autoHeight:true,scrolling : false,
            title:"",
            helpers: { overlay : {
                    closeClick : false,  // if true, fancyBox will be closed when user clicks on the overlay
                }
            }
        });    
    }

    function fnBindDelete(){
        $('.delete_item').live('click', function (){
            if(!confirm('Are you sure you want to delete this item?')) return false;
            var th = $(this);
            $.ajax({
                type: 'POST',
                url: jQuery(this).attr('href'),
                success: function(data) {
                    th.closest('tr').remove();
                    fnRefreshOrderRow();
                }
            });
            return false;
        });
    }

    // sau khi add new hay update thì cập nhật lại grid view
    function fnUpdateGridView(IdGrid){
         var url_ = '<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->getRequest()->getUrl();?>';
         $.ajax({
            type: 'POST',
            url: url_,
            beforeSend: function( xhr ) {
                $.blockUI({ message: null });
            },
            success: function(data) {
                $(IdGrid).html($(data).find(IdGrid).html());
                $.unblockUI();
            }
        });
    }

</script>