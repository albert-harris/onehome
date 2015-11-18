<?php
$this->breadcrumbs=array(
	'Resume Management'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'Resume Management', 'url'=>array('index')),
	array('label'=>'Create Resume', 'url'=>array('create')),
	array('label'=>'Update Resume', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Resume', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Resume: <?php echo $model->position; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'position',
		'name',
		'email',
		'phone',
		'comment',
                array(
                    'name'=>'file_resume',
                    'type'=>'fileresume',
                    'value'=>array("file_resume"=>$model->file_resume,"id"=>$model->id),
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),  
		'status:status',
	),
)); ?>
