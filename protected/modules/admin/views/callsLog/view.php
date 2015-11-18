<?php
$this->breadcrumbs=array(
	'Pro Call Logs'=>array('index'),
	$model->id,
);

$menus = array(
	array('label'=>'ProCallLog Management', 'url'=>array('index')),
	array('label'=>'Create ProCallLog', 'url'=>array('create')),
	array('label'=>'Update ProCallLog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProCallLog', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View ProCallLog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'time_of_call',
		'received_by',
		'description',
		'person_called',
		'transaction_id',
		'status',
		'person_call_type',
		'phone',
	),
)); ?>
