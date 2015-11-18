<?php
$this->breadcrumbs=array(
	'Payment Vouchers Management'=>array('paymentvouchers'),
    (Yii::app()->controller->action->id=='createvoucher') ? 'Create Voucher' : 'Update Voucher'
);

/*$menus=array(
	array('label'=> Yii::t('translation','Create Transactions'), 'url'=>array('create')),
);*/
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

?>
<?php include '_tab_index.php'; ?>
<h1 style="padding-left:26px;"><?php echo  (Yii::app()->controller->action->id=='createvoucher') ? 'Create Voucher' : 'Update Voucher'; ?></h1>
<?php 
$this->renderPartial('payment_vouchers/_from_voucher',array(
    'model'=>$model,
     'dataTmp' => $dataTmp
)); 
?>