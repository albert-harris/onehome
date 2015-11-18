<?php
$this->breadcrumbs=array(
	'Admin Accounts'=>array('index'),
    $model->first_name . " " . $model->last_name=>array('view','id'=>$model->id),
	'Update Admin Account',
);

$menus=array(
	array('label'=>'Admin Accounts', 'url'=>array('index')),
	array('label'=>'View Admin Account', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create Admin Account', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update Admin Account [<?php echo $model->first_name . " " . $model->last_name; ?>]</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>