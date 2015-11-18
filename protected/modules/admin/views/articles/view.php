<?php
$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->title,
);

$menus=array(
	array('label'=>'Create Articles', 'url'=>array('create')),
	array('label'=>'Update Articles', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Articles', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Articles', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Articles: <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		array(
			'name'=>'content',
                        'type'=>'html',
		),             
		array(
			'name'=>'user_id',
                        'value'=>  $model->user->first_name." ".$model->user->last_name,
		),             
		array(
			'name'=>'created_date',
			'value'=>date(ActiveRecord::getDateFormatPhp().' H:i' , strtotime($model->created_date)),
		),
		array(
			'name'=>'status',
                        'value'=>  Articles::$articleStatus[$model->status],
		),            
	),
)); ?>
