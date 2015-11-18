<?php
$this->breadcrumbs=array(
	Yii::t('translation','Pro Locations')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'ProLocation Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View ProLocation'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create ProLocation'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update ProLocation '.$model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>