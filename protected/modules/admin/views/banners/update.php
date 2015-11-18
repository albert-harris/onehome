<?php
$this->breadcrumbs=array(
	'Banner Management'=>array('index'),
	$model->banner_title=>array('view','id'=>$model->id),
	'Update Banner',
);

$menus = array(
    array('label'=> Yii::t('translation','Banner Management'), 'url'=>array('index')),
    array('label'=> Yii::t('translation','Create Banner'), 'url'=>array('create')),
    array('label'=> Yii::t('translation','View Banner'), 'url'=>array('view', 'id'=>$model->id)),
    array('label'=> Yii::t('translation','Delete Banner'), 'url'=>'delete', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=> Yii::t('translation','Are you sure you want to delete this item?'))),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);


$str = $model->banner_title;
$str = str_replace("<br>"," ",$str);

$arr_name =  explode(" ", $str);
?>

<!--<h1><?php  echo Yii::t('translation','Update Banner')?> [<?php 
if (count($arr_name) > 2) {
echo $arr_name[0].'...'; 
}else{
echo $arr_name[0]; }
?>]</h1>    -->

<h1><?php  echo Yii::t('translation','Update Banner')?>: <?php echo $model->banner_title; ?></h1>    

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>