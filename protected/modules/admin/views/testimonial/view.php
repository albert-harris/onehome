<?php
$this->breadcrumbs=array(
	'Testimonial Management'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'Testimonial Management', 'url'=>array('index')),
	array('label'=>'Create Testimonial', 'url'=>array('create')),
	array('label'=>'Update Testimonial', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Testimonial', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Testimonial: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'title',
                'name',
		array(
                    'name' => 'type',
                    'type' => 'TestimonialType',
                    'value' => $model,
                ),
		array(
                    'name' => 'description',
                    'type' => 'html',
                    'value' => nl2br($model->description),
                ),
		array(
                    'name' => 'status',
                    'type' => 'status',
                ),
		array(
                    'name' => 'is_member',
                    'type' => 'TestimonialCreatedBy',
                    'value' => $model,
                ),
		'created_date:datetime',
	),
)); ?>
