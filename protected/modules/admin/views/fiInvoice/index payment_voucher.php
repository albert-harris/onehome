<?php
$this->breadcrumbs=array(
	'Payment Vouchers Management',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Voucher'), 'url'=>array('createvoucher')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('fi-invoice-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#fi-invoice-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('fi-invoice-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('fi-invoice-grid');
        }
    });
    return false;
});
");
?>

<?php include '_tab_index.php'; ?>

<h1 ><?php echo Yii::t('translation', 'Payment Vouchers Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php 
$this->renderPartial('_search_voucher',array(
	'model'=>$model,
));
 ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fi-invoice-grid',
	'dataProvider'=>$model->search(),
	'enableSorting' => false,
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        'voucher_no',
        array(
            'name'=>'pay_to',
            'value'=>'FiPaymentVoucher::getStatus($data->pay_to)'
        ),
        'user_name',
//        'user_billing_address',
//        'user_postal_code',
        array(
            'header' => 'Property Address',
            'type'=>'PaymentVoucherPropertyAddress',
            'value'=>'$data',           
//            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            
        array(
            'name' => 'total_amount',
            'type' => 'Price',
            'htmlOptions' => array('style' => 'text-align:right;'),
        ),
        array(
            'header' => 'Print Voucher',
            'type'=>'PrintPaymentVoucher',
            'value'=>'$data',           
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name'=>'date_paid',
            'type' => 'date',
        ),
        array(
            'name'=>'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=>'($data->status==1) ? "Paid" : "Unpaid" '
        ),
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions),
            'buttons'=>array(
               'update'=>array(
                    'url'=>'Yii::app()->createAbsoluteUrl("admin/fiInvoice/updatevoucher", array("id"=>$data->id))',
                    'visible'=> 'FiPaymentVoucher::CanUpdate($data)',
                ), 
               'view'=>array(
                    'url'=>'Yii::app()->createAbsoluteUrl("admin/fiInvoice/viewvoucher", array("id"=>$data->id))',
                ), 
               'delete'=>array(
                    'url'=>'Yii::app()->createAbsoluteUrl("admin/fiInvoice/deletevoucher", array("id"=>$data->id))',
                ) 
            )
		),
	),
)); ?>