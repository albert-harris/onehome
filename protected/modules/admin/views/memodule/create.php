<?php
$this->breadcrumbs=array(
	Yii::t('translation','Module')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Module Management') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create Module'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>