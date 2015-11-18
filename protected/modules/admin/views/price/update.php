<?php
$this->breadcrumbs=array(
	'Price For Sale' => array('index'),
	'Update',
);

$menus=array(
	array('label'=>'Management', 'url'=>array('index')),
        array('label'=>'Create', 'url'=>array('create'))
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Update Price For Sale</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>