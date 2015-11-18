<?php
$this->breadcrumbs=array(
	Yii::t('translation','Pro Transactions')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'ProTransactions Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View ProTransactions'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create ProTransactions'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update ProTransactions '.$model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>