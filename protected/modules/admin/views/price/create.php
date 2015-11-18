<?php
$this->breadcrumbs=array(
	'Price For Sale'=>array('index'),
	'Create',
);

$menus = array(		
        array('label'=>'Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Price For Sale</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>