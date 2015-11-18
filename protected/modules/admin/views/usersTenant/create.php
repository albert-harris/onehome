<?php
$this->breadcrumbs=array(
	Yii::t('translation','Tenant Management')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Tenant Management') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create Tenant'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>