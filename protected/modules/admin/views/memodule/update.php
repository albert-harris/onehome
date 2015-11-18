<?php
$this->breadcrumbs=array(
	Yii::t('translation','Module')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);
$menus = array(	
        array('label'=> Yii::t('translation', 'Module Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View Module'), 'url'=>array('view', 'id'=>$model->name)),
	array('label'=> Yii::t('translation', 'Create Module'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Update Module '.$model->name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>