<?php
$this->breadcrumbs=array(
	Yii::t('translation','Categories')=>array('index'),
	$model->category_name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Categories Management'), 'url'=>array('index')),
//	array('label'=> Yii::t('translation', 'View Categories'), 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=> Yii::t('translation', 'Create Categories'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update Categories: '.$model->category_name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>