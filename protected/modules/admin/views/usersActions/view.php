<?php
$this->breadcrumbs=array(
	'Users Actions'=>array('index'),
	$model->id,
);

$menus = array(
	array('label'=>'Create UsersActions', 'url'=>array('create')),
	array('label'=>'Update UsersActions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UsersActions', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View UsersActions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user.username',
		'module',
		'controller',
		'actions',
		'type',
	),
)); ?>
