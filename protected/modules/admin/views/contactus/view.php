<?php
$this->breadcrumbs=array(
	'Contact Us Management'=>array('index'),
	$model->email,
);

$menus = array(
	array('label'=>'Contact Us Management', 'url'=>array('index')),
	array('label'=>'Delete Contact Us', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Contac Us : <?php echo $model->email; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'enquiry_type',
			'value'=>$model->getType($model->enquiry_type)
		),
		'name',
		'position',
		'company',
		'phone',
		'email',
		'created_date:date',
		array(
			'name'=>'message',
			'value'=>nl2br(strip_tags($model->message)),
			'type'=>'html',
		),
		
	),
)); ?>
