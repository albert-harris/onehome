<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>'List Member', 'url'=>array('Member/')),
	array('label'=>'View Member', 'url'=>'', 'active'=>true),
	array('label'=>'Create Member', 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess('create')),
	array(
        'label'=>'Update Member',
        'url'=>array('update', 'id'=>$model->id),
        'visible'=>Yii::app()->user->checkAccess('update')
    ),
	array(
        'label'=>'Delete Member',
        'url'=>'#',
        'visible'=>Yii::app()->user->checkAccess('delete'),
        'linkOptions'=>array(
            'submit'=>array('delete','id'=>$model->id),
            'confirm'=>'Are you sure want to permanently delete this user?'
        )
    ),
);
?>

<h1>View Member <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		array(
            'name'=>'Name',
            'type'=>'raw',
            'value'=>$model->title." ".$model->first_name." ".$model->last_name,
        ),
		'email:email',
		'phone',
		'company_name',
		'created_time:datetime',
		'last_update_time:datetime',
		'last_update_by',
		'last_login:datetime',
		'last_login_ip',
		'address',
		'birthday:date',
		'gender',
		'status:status',
	),
)); ?>
