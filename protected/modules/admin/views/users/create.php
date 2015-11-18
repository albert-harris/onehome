<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
);
?>

<h1>Create Members</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>