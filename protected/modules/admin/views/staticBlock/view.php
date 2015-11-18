<?php
$this->breadcrumbs=array(
	'Static Blocks'=>array('index'),
	$model->title,
);

$menus = array(
	array('label'=>'Create StaticBlock', 'url'=>array('create')),
	array('label'=>'Update StaticBlock', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StaticBlock', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View StaticBlock #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'content',
		'slug',
),
)); ?>