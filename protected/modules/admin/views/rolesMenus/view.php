<?php
$this->breadcrumbs=array(
	'Roles Menuses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RolesMenus', 'url'=>array('index')),
	array('label'=>'Create RolesMenus', 'url'=>array('create')),
	array('label'=>'Update RolesMenus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RolesMenus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RolesMenus', 'url'=>array('admin')),
);
?>

<h1>View RolesMenus: <?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
                   'name'=>'role_id',
                   'value'=>$model->role->role_name,
                ),            
		array(
                   'name'=>'menu_id',
                   'value'=>$model->menu->menu_name,
                ),            
	),
)); ?>
