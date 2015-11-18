<?php
$this->breadcrumbs=array(
	'Pro Master Location Report Defects'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'ProMasterLocationReportDefect Management', 'url'=>array('index')),
	array('label'=>'Create ProMasterLocationReportDefect', 'url'=>array('create')),
	array('label'=>'Update ProMasterLocationReportDefect', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProMasterLocationReportDefect', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View ProMasterLocationReportDefect #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
