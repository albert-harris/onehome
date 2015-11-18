<?php
$this->breadcrumbs=array(
	Yii::t('translation','Bank Valuation Request')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('translation','Update'),
);

$menus = array(	
        array('label'=> Yii::t('translation', 'BankRequest ManagementBank Valuation Request'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View BankRequest'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=> Yii::t('translation', 'Create BankRequest'), 'url'=>array('create')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo Yii::t('translation', 'Update BankRequest '.$model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>