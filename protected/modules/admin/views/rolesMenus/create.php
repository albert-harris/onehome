<?php
$this->breadcrumbs=array(
	'Roles Menuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RolesMenus', 'url'=>array('index')),
	array('label'=>'Manage RolesMenus', 'url'=>array('admin')),
);
?>

<h1>Create RolesMenus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>