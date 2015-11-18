<?php
$this->breadcrumbs=array(
	'Services'=>array('index', 'cat'=>$model->parent_id),
	'Update',
);

$menus = array(	
	array('label'=>'Service Management', 'url'=>array('index', 'cat'=>$model->parent_id)),
	array('label'=>'Create Service', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Update Service <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>