<?php
$this->breadcrumbs=array(
	'Roles Menuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RolesMenus', 'url'=>array('index')),
	array('label'=>'Create RolesMenus', 'url'=>array('create')),
	array('label'=>'View RolesMenus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RolesMenus', 'url'=>array('admin')),
);
?>

<h1>Update RolesMenus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>