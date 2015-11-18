<?php
$this->breadcrumbs=array(
	'Floor Management'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Floor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
