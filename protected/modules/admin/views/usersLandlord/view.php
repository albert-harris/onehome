<?php
$this->breadcrumbs=array(
	'Landlord Management'=>array('index'),
	$model->first_name,
);

$model->scenario = 'view_landlord';

$menus = array(
	array('label'=>'Landlord Management', 'url'=>array('index')),
	array('label'=>'Create Landlord', 'url'=>array('create')),
	array('label'=>'Update Landlord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Landlord', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Landlord: <?php echo $model->first_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'first_name',
		'nric_passportno_roc',
                array(
                    'name'=>'id_type',
                    'type'=>'LandLorIdType',
                    'value'=>$model
                ),
		'email_not_login',
//                array(
//                    'name' => 'avatar',
//                    'type' => 'html',
//                    'value' => CHtml::image(ImageProcessing::bindImageByModel($model, 100, 100, array('avatar'=>1))),
//                ),              
		'contact_no',
		'postal_code',
		'address',
		'status:status',
		'created_date:datetime',
	),
)); ?>
