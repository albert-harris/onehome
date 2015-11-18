<?php
$this->breadcrumbs=array(
	'Module'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'Module Management', 'url'=>array('index')),
	array('label'=>'Create Module', 'url'=>array('create')),
	array('label'=>'Update Module', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Module', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Module: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
        array(
			'name' => 'short_description',
			'type' => 'html',
			'value' => $model->short_description,
		),                
        array(
			'name' => 'description',
			'type' => 'html',
			'value' => $model->description,
		),                
		'status:status',
		'order_at',
        array(
			'name' => 'course_id',
			'value' => $model->course->name,
		),        
        array(
			'name' => 'cover',
			'type' => 'html',
			'value' => CHtml::image(ImageProcessing::bindImageByModel($model, 217, 194, 'cover')),
		),        
	),
)); ?>
