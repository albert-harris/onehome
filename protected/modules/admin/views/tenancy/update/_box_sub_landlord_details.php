<div class="box-5">
    <div class="title clearfix">
        <div class="f-left w-2 fixErrorSummary">
            <h4>Landlord’s Details</h4>
            <?php echo $form->errorSummary($mTransactions->mLandlord); ?>
        </div> 
        <?php if( ProTransactions::IsTenancyTransaction($mTransactions) ):?>
            <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentAddLandlord', array('from_transactions'=>1,'transactions_id'=>$mTransactions->id)); ?>" class="btn-1 f-right AddVendorDetails">Add Landlord</a>
        <?php else: ?>
            <a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/agentAddLandlord', array('transactions_id'=>$mTransactions->id)); ?>" class="btn-1 f-right AddVendorDetails">Add Landlord</a>
        <?php endif; // end if(isset($_GET['add_property']) ?>        
    </div>

    <div class="content table_scroll padding_0 ">    
        <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'landlord-grid',
                'dataProvider'=>  ProTransactionsVendorPurchaserDetail::searchByType($mTransactions->id, Users::USER_LANDLORD),
                'afterAjaxUpdate'=>'function(id, data){}',
                'template'=>'{items}{pager}', 
                'itemsCssClass'=>'tb-1 margin_0 verz_tb',
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
                        'name' => 'id_type',
                        'value' => '$data->getField("id_type")',
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
                    'email',
//                    array(
//                        'name' => 'invoice_bill_to',
//                        'type'=>'YNStatus',
//                        'htmlOptions' => array('style' => 'text-align:center;'),
//                        'headerHtmlOptions' => array('class' => 'item_c'),
//                    ),
//                    'billing_address',
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
                                'url'=>'ProTransactions::GetLinkUpdateLandlordBE($data)',
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

<style>
    .verz_tb { width:936px;}
</style>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>    
<script>
    $(document).ready(function() {
        fnInitFancybox('.AddVendorDetails');
        fnInitFancybox('.update_item');
        fnInitFancyboxTenant('.TenantDetails');
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
    
    function fnInitFancyboxTenant(class_name){
        //http://fancyapps.com/fancybox/
        $(class_name).fancybox({
            fitToView:true,
            width: 600,
            autoSize:false,autoHeight:true,scrolling : false,
            title:"",
            minHeight: 600,
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
//            th.closest('tr').remove(); 
//            fnRefreshOrderRow();
//            return false;
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
        
        $('.DeleteTenantBox').live('click', function (){
            if(!confirm('Are you sure you want to delete this item?')) return false;
            var th = $(this);
//            th.closest('div.box_tenant_detail').remove();
//            fnUpdateTenantNo();
//            return;
            $.ajax({
                type: 'POST',
                url: jQuery(this).attr('href'),
                success: function(data) {
                    th.closest('div.box_tenant_detail').remove();
                    fnUpdateTenantNo();
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
                    // rất rối chỗ này nếu không update trực tiếp to db
//                    var last_tr = $(data).find(IdGrid).find('tr:last');
//                    $(IdGrid).find('tbody').append(last_tr);
//                    fnRefreshOrderRow();
                    // rất rối chỗ này nếu không update trực tiếp to db
                    $(IdGrid).html($(data).find(IdGrid).html());
                    $.unblockUI();
    //                fnInitFancybox(IdGrid);
                }
            });
    }
    
    // sau khi add new hay update thì cập nhật lại grid view
    function fnUpdateBoxTenant(){
        var url_ = '<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->getRequest()->getUrl();?>';
        $.ajax({
                type: 'POST',
                url: url_,
                beforeSend: function( xhr ) {
                    $.blockUI({ message: null });
                },
                success: function(data) {
                    $('.tenant_reload').html($(data).find('.tenant_reload').html());
                    fnInitFancyboxTenant('.TenantDetails');
                    fnUpdateTenantNo();                    
                    $.unblockUI();
                }
            });        
        
//         var url_ = '<?php // echo Yii::app()->createAbsoluteUrl('ajax/tenantFormView');?>';
//         $.ajax({
//                type: 'POST',
//                url: url_,
//                data:{id:id},
//                beforeSend: function( xhr ) {
//                    $.blockUI({ message: null });
//                },
//                success: function(data) {
//                    $('.box_tenant_detail:last').after($(data).find('.box_tenant').html());
//                    fnInitFancyboxTenant('.TenantDetails');
//                    fnUpdateTenantNo();
//                    $.unblockUI();
//    //                fnInitFancybox(IdGrid);
//                }
//            });
    }
    
    function fnUpdateTenantNo(){
        var index = 1;
        $('.tenant_no').each(function(){
            $(this).text(index);
            index++;
        });
        
    }

</script>