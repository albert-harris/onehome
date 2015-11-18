<?php
$this->breadcrumbs=array(
	Yii::t('translation','Registered Users Management')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Registered Users Management') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create Registered Users'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>