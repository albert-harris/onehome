<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->username=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Member', 'url'=>array('Member/')),
	array('label'=>'View Member', 'url'=>array('view', 'id'=>$model->id)),
	array(
        'label'=>'Create Member',
        'url'=>array('create'),
        'visible'=>Yii::app()->user->checkAccess('create'),
    ),
	array('label'=>'Update Member', 'url'=>'', 'active'=>true),
);
?>

<h1>Update Member <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>