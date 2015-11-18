<?php
$this->breadcrumbs=array(
	'Bathroom Management'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Bathroom</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
