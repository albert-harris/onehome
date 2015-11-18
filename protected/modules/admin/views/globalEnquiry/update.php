<?php
$this->breadcrumbs=array(
	Yii::t('translation','Pro Global Enquiries')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'ProGlobalEnquiry Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View ProGlobalEnquiry'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create ProGlobalEnquiry'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update ProGlobalEnquiry '.$model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>