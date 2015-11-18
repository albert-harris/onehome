<?php
$this->breadcrumbs=array(
	Yii::t('translation','HDB Town/Estate')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'HDB Town/Estate') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create HDB Town/Estate'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>