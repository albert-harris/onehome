<?php
$this->breadcrumbs=array(
	'Manage Sub Admin'=>array('index'),
    $model->first_name . " " . $model->last_name=>array('view','id'=>$model->id),
	'Update Sub Admin',
);

$menus=array(
	array('label'=>'Manage Sub Admin', 'url'=>array('index')),
	array('label'=>'View Sub Admin', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create Sub Admin', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update Sub Admin : <?php echo $model->first_name . " " . $model->last_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>