<?php
$this->breadcrumbs=array(
	'Service Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
	array('label'=>'Service Category Management', 'url'=>array('index')),
	array('label'=>'Create Service Category', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Update Service Category <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>