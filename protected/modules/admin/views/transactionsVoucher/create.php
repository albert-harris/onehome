<?php
$this->breadcrumbs=array(
	Yii::t('translation','Pro Transactions Invoices')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'ProTransactionsInvoice Management') , 'url'=>array('index')),
);
//$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h2>Create Voucher for Transaction <?php echo $mTrans->transactions_no;?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'mTrans'=>$mTrans)); ?>