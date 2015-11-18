<?php
$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$menus=array(
	array('label'=>'Create Articles', 'url'=>array('create')),
	array('label'=>'View Articles', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Articles', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Update Articles: <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>