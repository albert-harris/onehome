<?php
$this->breadcrumbs=array(
	'Property Types Management'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'Property Types Management', 'url'=>array('index')),
	array('label'=>'Create Property Types', 'url'=>array('create')),
	array('label'=>'Update Property Types', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Property Types', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Property Types: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
//                'type',
                array(
                    'name'=>'parent_id',
                    'value'=>$model->parent?$model->parent->name:"",
                ),
		'price_min:price',
		'price_max:price',
		'price_sign',
		'price_sign_position',
                'status:status',
	),
)); ?>
