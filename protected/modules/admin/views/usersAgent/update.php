<?php
$this->breadcrumbs=array(
	Yii::t('translation','Saleperson Management')=>array('index'),
	$model->first_name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Saleperson Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View Saleperson '), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create Saleperson '), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update Saleperson: '.$model->first_name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>