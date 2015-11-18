<?php
$this->breadcrumbs=array(
	'Manage Sub Admin'=>array('index'),
	'Create Sub Admin',
);

$menus=array(
	array('label'=>'Manage Sub Admin', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>
<h1>Create Sub Admin</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>