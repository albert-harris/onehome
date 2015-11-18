<?php
$this->breadcrumbs=array(
	'Transactions Management'=>array('index'),
	"View Transaction $mTransactions->transactions_no",
);

$menus = array(
	array('label'=>'Transactions Management', 'url'=>array('index')),
//	array('label'=>'Create ProTransactions', 'url'=>array('create')),
//	array('label'=>'Update ProTransactions', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete ProTransactions', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>
<?php include 'ViewTransaction/ViewTransaction.php'; ?>