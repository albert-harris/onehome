<?php
$this->breadcrumbs=array(
	Yii::t('translation','Job Opportunity')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Job Opportunity Management') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create Job Opportunity'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>