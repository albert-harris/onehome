<?php
$this->breadcrumbs=array(
	'Admin Accounts'=>array('index'),
	'Create Admin Account',
);

$menus=array(
	array('label'=>'Admin Accounts', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Admin Account</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>