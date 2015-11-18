<?php
$this->breadcrumbs=array(
	'Page Management'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'Page Management', 'url'=>array('index')),
	array('label'=>'View Page', 'url'=>array('view', 'id'=>$model->id)),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update Page: <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>