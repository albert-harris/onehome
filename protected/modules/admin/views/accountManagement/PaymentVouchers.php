<?php
$this->breadcrumbs=array(
	'Account Management',
	'Payment Vouchers',
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

?>
<?php include '_head_tab.php';?>
<h1>Payment Vouchers Management</h1>
<?php $this->renderPartial('payment_voucher/_from_voucher',array(
    'model'=>$model,
)); ?>