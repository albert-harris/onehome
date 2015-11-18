<?php
$this->breadcrumbs=array(
	'Group mapping'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Group mapping management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create group</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>