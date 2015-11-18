<?php
$this->breadcrumbs=array(
	'Job Opportunity'=>array('index'),
	$model->title,
);

$menus = array(
	array('label'=>'Job Opportunity Management', 'url'=>array('index')),
	array('label'=>'Create Job Opportunity', 'url'=>array('create')),
	array('label'=>'Update Job Opportunity', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Job Opportunity', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Job Opportunity: <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'title',
            array(
                'name'=>'country_id',
                'value'=>$model->country->area_name,
            ),
            'department',
            'posted:date',
            'job_description:html',
            'requirements:html',
	),
)); ?>
