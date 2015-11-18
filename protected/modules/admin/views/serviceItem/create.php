<?php
$this->breadcrumbs=array(
	'Services'=>array('index', 'cat'=>$model->parent_id),
	'Create',
);

$menus = array(		
	array('label'=>'Service Management', 'url'=>array('index', 'cat'=>$model->parent_id)),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Service</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>