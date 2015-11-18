<?php
$this->breadcrumbs=array(
	Yii::t('translation','Location For Report Defect')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Location For Report Defect'), 'url'=>array('index')),
//	array('label'=> Yii::t('translation', 'View Location For Report Defect'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create Location For Report Defect'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update Location For Report Defect: '.$model->name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>