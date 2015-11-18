<?php
$this->breadcrumbs=array(
	'Users Actions'=>array('index'),
	'Create',
);

$menus = array(	
	array('label'=>'User Privileges Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create UsersActions</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>