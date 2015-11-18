<?php
$this->breadcrumbs=array(
	'Subscriber-Public Management'=>array('index'),
	$model->email,
	'Update Subscriber-Public',
);

$menus=array(
	array('label'=>'Subscriber-Public Management', 'url'=>array('index')),
	array('label'=>'Create Subscriber-Public', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update Subscriber-Public [<?php echo $model->email; ?>]</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>