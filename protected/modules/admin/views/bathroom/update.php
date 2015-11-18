<?php
$this->breadcrumbs=array(
	'Bathroom Management' => array('index'),
	'Update',
);

$menus=array(
	array('label'=>'Management', 'url'=>array('index')),
        array('label'=>'Create', 'url'=>array('create'))
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Update Bathroom</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>