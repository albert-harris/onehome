<?php
$this->breadcrumbs=array(
    'Payment Vouchers Management'=>array('paymentvouchers'),
    'View Voucher'
);
$menus = array(
	array('label'=>'Payment Vouchers Management', 'url'=>array('paymentvouchers')),
	array('label'=>'Create Voucher', 'url'=>array('createvoucher')),
	array('label'=>'Update Voucher', 'url'=>array('updateVoucher', 'id'=>$model->id)),
	array('label'=>'Delete Voucher', 'url'=>array('DeleteVoucher'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
$cmsFormater = new CmsFormatter();
?>

<h1>View Voucher: <?php echo $model->voucher_no; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'name'=>'pay_to',
            'value'=>FiPaymentVoucher::getStatus($model->pay_to)
        ),
        'voucher_no',
        'user_name',
        'nric',
        'user_billing_address',
        'user_postal_code',
        'total_amount:Price',
        array(
            'name'=>'payment_mode',
            'type'=>'VoucherPaymentMode',
            'value'=> $model,
        ),
        'cheque_number',
        'bank_reference_no',
        'date_paid:date',
	),
)); ?>
<?php 
$this->renderPartial('payment_vouchers/view_from_voucher',array(
    'model'=>$model,
     'dataTmp' => $dataTmp
)); 
?>