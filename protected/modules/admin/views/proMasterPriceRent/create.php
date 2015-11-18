<?php
$this->breadcrumbs=array(
	'Price For Rent'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Price For Rent</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>