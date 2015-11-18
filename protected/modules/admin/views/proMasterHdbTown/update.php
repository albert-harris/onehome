<?php
$this->breadcrumbs=array(
	Yii::t('translation','HDB Town/Estate')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'HDB Town/Estate'), 'url'=>array('index')),
//	array('label'=> Yii::t('translation', 'View HDB Town/Estate'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update HDB Town/Estate: '.$model->name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>