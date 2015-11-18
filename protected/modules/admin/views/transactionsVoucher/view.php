<?php
$this->breadcrumbs=array(
	'Pro Transactions Invoices'=>array('index'),
	$model->id,
);

$menus = array(
	array('label'=>'ProTransactionsInvoice Management', 'url'=>array('index')),
	array('label'=>'Create ProTransactionsInvoice', 'url'=>array('create')),
	array('label'=>'Update ProTransactionsInvoice', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProTransactionsInvoice', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View ProTransactionsInvoice #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'transactions_id',
		'invoice_number',
		'invoice_type',
		'invoice_template',
		'trans_bill_to_id',
		'type',
		'client_type_id',
		'invoice_bill_to',
		'created_date',
		'receipt_name',
		'receipt_nric',
		'receipt_contact_no',
		'receipt_date_paid',
		'voucher_pay_to',
		'voucher_no',
		'voucher_cheque_no',
		'voucher_ma_gross_comm',
	),
)); ?>
