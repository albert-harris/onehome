<?php
$this->breadcrumbs=array(
	Yii::t('translation','Invoice Management')=>array('index'),
	$model->invoice_no=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Invoice Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View Invoice'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create Invoice'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update Invoice '.$model->invoice_no); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>