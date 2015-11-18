<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Member', 'url'=>array('Member/')),
	array('label'=>'Create Member', 'url'=>'', 'active'=>true),
);
?>

<h1>Create Member</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>