<?php
$this->breadcrumbs=array(
	Yii::t('translation','Registered Users Management')=>array('index'),
	$model->first_name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Registered Users Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View Registered Users '), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create Registered Users '), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update Registered Users: '.$model->first_name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>