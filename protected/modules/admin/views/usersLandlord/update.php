<?php
$this->breadcrumbs=array(
	Yii::t('translation','Landlord Management')=>array('index'),
	$model->first_name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Landlord Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View Landlord '), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create Landlord '), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update Landlord: '.$model->first_name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>