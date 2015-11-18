<?php
$this->breadcrumbs=array(
	'Fe Menuses'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Fe Menus Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Fe Menu</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>