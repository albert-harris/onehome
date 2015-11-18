<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->category_name),
	'Update',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
//	array('label'=>'View Category', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

<h1>Update Categories <?php echo $model->category_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>