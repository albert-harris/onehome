<?php
$this->breadcrumbs=array(
	Yii::t('translation','Pro Transactions')=>array('index'),
	Yii::t('translation','Create'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'ProTransactions Management') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create ProTransactions'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>