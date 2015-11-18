<?php
$this->breadcrumbs=array(
	Yii::t('translation','Resume Management')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Resume Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View Resume'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create Resume'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update Resume: '.$model->position); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>