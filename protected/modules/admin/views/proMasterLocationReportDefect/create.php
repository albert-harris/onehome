<?php
$this->breadcrumbs=array(
	Yii::t('translation','Location For Report Defect')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Location For Report Defect') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create Location For Report Defect'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>