<?php
$this->breadcrumbs=array(
	'Manage Menu'=>array('index'),
	'Create',
);

$menus=array(
	array('label'=>'List Menus', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create Menu</h1>

<?php 
if(isset($errorSummary))
echo $this->renderPartial('_form', array('model'=>$model,
                                                'aRoles'=>$aRoles,
                                                'aSelectedRoles'=>$aSelectedRoles,
                                                'aRoleMenuActionExist'=>$aRoleMenuActionExist,
                                                'errorSummary' => $errorSummary,
                                                ));
else
echo $this->renderPartial('_form', array('model'=>$model,
                                                'aRoles'=>$aRoles,
                                                'aSelectedRoles'=>$aSelectedRoles,
                                                'aRoleMenuActionExist'=>$aRoleMenuActionExist
                                                )); ?>