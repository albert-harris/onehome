<?php
$this->breadcrumbs=array(
	'HDB Town/Estate'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'HDB Town/Estate', 'url'=>array('index')),
	array('label'=>'Create HDB Town/Estate', 'url'=>array('create')),
	array('label'=>'Update HDB Town/Estate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete HDB Town/Estate', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View HDB Town/Estate: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
//		'status',
	),
)); ?>
