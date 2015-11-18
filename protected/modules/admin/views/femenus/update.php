<?php
$this->breadcrumbs=array(
	'Fe Menus'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'Fe Menus Management', 'url'=>array('index')),
	array('label'=>'View Fe Menu', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create Fe Menu', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update Fe Menu <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>