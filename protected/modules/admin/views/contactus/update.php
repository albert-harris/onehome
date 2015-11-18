<?php
$this->breadcrumbs=array(
	Yii::t('translation','Pro Contact Uses')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'ProContactUs Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View ProContactUs'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create ProContactUs'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update ProContactUs '.$model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>