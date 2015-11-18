<?php
$this->breadcrumbs=array(
	Yii::t('translation','Document Management')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Management') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>