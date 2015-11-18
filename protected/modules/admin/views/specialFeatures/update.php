<?php
$this->breadcrumbs=array(
	'Special Features Management' => array('index'),
	'Update',
);

$menus=array(
	array('label'=>'Management', 'url'=>array('index')),
        array('label'=>'Create', 'url'=>array('create'))
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Update Special Features</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>