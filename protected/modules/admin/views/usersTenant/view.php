<?php
$this->breadcrumbs=array(
	'Tenant Management'=>array('index'),
	$model->first_name,
);

$model->scenario = 'view_tenant';

$menus = array(
	array('label'=>'Tenant Management', 'url'=>array('index')),
	array('label'=>'Create Tenant', 'url'=>array('create')),
	array('label'=>'Update Tenant', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tenant', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Tenant: <?php echo $model->first_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'first_name',
		'nric_passportno_roc',
		'ic_number',
                array(
                    'name'=>'id_type',
                    'type'=>'LandLorIdType',
                    'value'=>$model
                ),
                'pass_expiry_date:date',
                array(
                    'name'=>'upload_employment_pass_passport',
                    'type'=>'EmploymentPassPassport',
                    'value'=> array('model'=>$model, 'fieldName'=>'upload_employment_pass_passport'),
                ),
                array(
                    'name'=>'scanned_passport',
                    'type'=>'EmploymentPassPassport',
                    'value'=> array('model'=>$model, 'fieldName'=>'scanned_passport'),
                ),
		'email_not_login',
//                array(
//                    'name' => 'avatar',
//                    'type' => 'html',
//                    'value' => ($model->avatar!='')?CHtml::image(ImageProcessing::bindImageByModel($model, 100, 100, array('avatar'=>1))):"",
//                ),              
		'contact_no',
		'postal_code',
		'address',
		'expiration_date:date',
		'status:status',
		'created_date:datetime',
	),
)); ?>
