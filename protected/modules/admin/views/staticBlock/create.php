<?php
$this->breadcrumbs=array(
	'Static Blocks'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'StaticBlock Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create StaticBlock</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>