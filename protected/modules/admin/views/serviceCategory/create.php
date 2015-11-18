<?php
$this->breadcrumbs=array(
	'Service Categories'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Service Category Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Service Category</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>