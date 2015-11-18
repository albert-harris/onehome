<?php
$this->breadcrumbs=array(
	Yii::t('translation','Banner Management')=>array('index'),
	Yii::t('translation','Create Banner'),
);

$menus = array(
	array('label'=>Yii::t('translation','Banner Management'), 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation','Create Banner');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>