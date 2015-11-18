<?php
$this->breadcrumbs=array(
	'Special Features Management'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Special Features</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
