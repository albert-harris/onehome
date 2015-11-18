<?php
$this->breadcrumbs=array(
	Yii::t('translation','Document Management')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update Document: '.$model->title); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>