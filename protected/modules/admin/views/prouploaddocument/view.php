<?php
$this->breadcrumbs=array(
	'Document Management'=>array('index'),
	$model->title,
);

$menus = array(
	array('label'=>'Management', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'Update', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Document: <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
        array(
            'name'=>'file_name',
            'type'=>'DocumentAdmin',
            'value'=>$model,
        ),
//        'order_no',
	),
)); ?>
