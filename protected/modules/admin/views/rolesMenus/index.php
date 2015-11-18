<?php
$this->breadcrumbs=array(
	'Roles Menuses',
);

$this->menu=array(
	array('label'=>'Create RolesMenus', 'url'=>array('create')),
	array('label'=>'Manage RolesMenus', 'url'=>array('admin')),
);
?>

<h1>Roles Menuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
