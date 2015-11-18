<?php
$this->breadcrumbs=array(
	'Page Management'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Page Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Pages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>