<?php
$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Create',
);

$menus=array(
	array('label'=>'Manage Articles', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Articles</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>