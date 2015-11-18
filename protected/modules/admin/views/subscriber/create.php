<?php
$this->breadcrumbs=array(
	'Subscriber-Public Management'=>array('index'),
	'Create Subscriber-Public',
);

$menus=array(
	array('label'=>'Subscriber-Public Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Subscriber</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>