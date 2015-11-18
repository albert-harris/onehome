<?php
$this->breadcrumbs=array(
	'Users Actions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$menus = array(	
        array('label'=>'User Privileges Management', 'url'=>array('index')),
	array('label'=>'View UsersActions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Create UsersActions', 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Update UsersActions <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>