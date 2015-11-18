<?php
$this->breadcrumbs=array(
	Yii::t('translation','Job Opportunity')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Job Opportunity Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View Job Opportunity'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create Job Opportunity'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update Job Opportunity: '.$model->title); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>