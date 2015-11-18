<?php
$this->breadcrumbs=array(
	'Static Blocks'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'StaticBlock Management', 'url'=>array('index')),
	array('label'=>'View StaticBlock', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create StaticBlock', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update StaticBlock <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>