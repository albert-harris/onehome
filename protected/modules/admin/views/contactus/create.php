<?php
$this->breadcrumbs=array(
	Yii::t('translation','Pro Contact Uses')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'ProContactUs Management') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create ProContactUs'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>