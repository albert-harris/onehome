<?php
$this->breadcrumbs=array(
	'Group mapping'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'Group mapping management', 'url'=>array('index')),
	array('label'=>'Create group mapping', 'url'=>array('create')),
	array('label'=>'Update group mapping', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete group mapping', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View group : <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'status:status',
	),
)); ?>
