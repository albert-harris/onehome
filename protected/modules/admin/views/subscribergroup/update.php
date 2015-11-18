<?php
$this->breadcrumbs=array(
	'Group mapping'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'Group mapping management', 'url'=>array('index')),
	array('label'=>'View group mapping', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create group mapping', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update group : <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>