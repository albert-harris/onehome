<?php
$this->breadcrumbs=array(
	'Transactions Management',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Transactions'), 'url'=>array('create')),
);
//$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-transactions-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-transactions-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-transactions-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-transactions-grid');
        }
    });
    return false;
});
");

//if(MyFormat::isAllowAccess('transactions', 'viewInvoice'))
//    echo 'sssssssss';

?>

<h1><?php echo Yii::t('translation', 'Transactions Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pro-transactions-grid',
	'dataProvider'=>$model->search(),
//	'enableSorting' => false,
	'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank(); fnUpdateLink(); }',
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name'=>'created_date',
            'type'=>'date',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('class'=>'first','style' => 'text-align:center;'),
        ),
        array(
            'name'=>'transactions_no',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name'=>'type',
            'header' => 'Type',
            'type'=>'PropertyType',            
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'header' => 'Property Name',
            'type'=>'TransactionPropertyName',
            'name'=>'sPropertyName',
            'value'=>'$data',
//            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'header' => 'Price',
            'name'=>'sPropertyPrice',
            'type'=>'TransactionPropertyPrice',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(                        
            'name' => 'ext_listing_type_id',
            'type'=>'TransListingType',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),   
            
//        array(
//            'header' => 'Invoice Date',
//            'name'=>'invoice_bill_to',
//            'value'=>'',
//            'htmlOptions' => array('style' => 'text-align:center;')
//        ),
            
        array(
            'header' => 'Invoice',
            'type' => 'GenInvoice',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            
        array(
            'header' => 'List of Voucher',
            'type' => 'GenVoucher',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            
        array(
            'header' => 'Receipt',
            'type' => 'GenReceipt',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            
//        array(
//            'header' => 'Calls Log',
//            'type'=>'LinkCallsLog',
//            'value'=>'$data',
//            'htmlOptions' => array('style' => 'text-align:center;')
//        ),
        array(
            'name' => 'admin_approved',
            'value'=>'ProTransactions::$ARR_STATUS_TRANS[$data->admin_approved]',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
                'header' => 'Actions',
                'class'=>'CButtonColumn',
                'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('ApproveTransaction','view','update','delete')),
                'buttons'=>array(
                    'update'=>array(
                        'label'=>'Update tenancy',
                        'url'=>'ProTransactions::GetLinkUpdateTenancyBE($data, array("update_transactions"=>1))',
                        'visible'=>'ProTransactions::CanUpdateTenancyApproved($data)',
                    ),
                    'ApproveTransaction'=>array(
                        'label'=>'Update status transaction',
                        'imageUrl'=>Yii::app()->theme->baseUrl . '/admin/images/icon-view.png',
                        'options'=>array('class'=>'ApproveTransaction'),
                        'url'=>'Yii::app()->createAbsoluteUrl("admin/transactions/approveTransaction",
                            array("id"=>$data->id))',
                        'visible'=>'!$data->admin_approved',
                    ),
                ),                      
        ),
    ),
)); ?>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />
<style>
    .ApproveTransaction { padding-right: 4px;}    
</style>
<script>
    $(function(){
        fnUpdateLink();        
    });
    
    function fnUpdateLink(){
        // for view invoice
        $('.gen_invoice').click(function(){
            var DoAction = $(this).attr('DoAction');
            if(confirm('Do You Want To Gen '+DoAction)){
                var url_ = $(this).attr('next');
                $.blockUI({ message: null });
                $.ajax({
                    url: url_,
                    type: 'post',
                    success:function(data){
                        $.fn.yiiGridView.update("pro-transactions-grid");
                        $.unblockUI();
                    }
                });                
            }
        });
        // for view invoice
        
        // for gen receipt
        $(".gen_receipt").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});
        $(".ApproveTransaction").colorbox({iframe:true,innerHeight:'300', innerWidth: '800',close: "<span title='close'>close</span>"});
        // for gen receipt
    }

</script>
