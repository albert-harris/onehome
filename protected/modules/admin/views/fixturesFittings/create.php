<?php
$this->breadcrumbs=array(
	'Fixtures & Fitting Management'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Fixtures & Fitting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
