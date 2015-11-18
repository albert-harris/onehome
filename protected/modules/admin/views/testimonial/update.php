<?php
$this->breadcrumbs=array(
	Yii::t('translation','Testimonial Management')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Testimonial Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View Testimonial'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create Testimonial'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update Testimonial: '.$model->title); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>