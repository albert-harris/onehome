<?php
$this->breadcrumbs=array(
	Yii::t('translation','Categories')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Categories Management') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create Categories'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>