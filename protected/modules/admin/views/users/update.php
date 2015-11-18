<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
//	$model->first_name.' '.$model->last_name =>array('update','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Members', 'url'=>array('index'), 'active'=>true),
//	array('label'=>'View Member', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create Member', 'url'=>array('create')),
);
?>

<h1>Update Member #<?php echo $model->first_name.' '.$model->last_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
