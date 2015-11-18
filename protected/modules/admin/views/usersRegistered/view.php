<?php
$this->breadcrumbs=array(
	'Registered Users Management'=>array('index'),
	$model->first_name,
);

$model->scenario = 'view_register';

$menus = array(
	array('label'=>'Registered Users Management', 'url'=>array('index')),
	array('label'=>'Create Registered Users', 'url'=>array('create')),
	array('label'=>'Update Registered Users', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Registered Users', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Registered Users: <?php echo $model->first_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'label'=>'Full Name',
                    'type'=>'FullNameRegisteredUsers',
                    'value'=>$model
                ),
                'nric_passportno_roc',
                array(
                    'name'=>'phone',
                    'type'=>'FullPhone',
                    'value'=>$model
                ),
		'email',
                'address',
                'postal_code',
                array(
                    'name'=>'country_id',                    
                    'value'=>$model->country?$model->country->area_name:"",
                ),
            
		'is_subscriber:YNStatus',
		'status:status',
		'created_date:datetime',
	),
)); ?>
