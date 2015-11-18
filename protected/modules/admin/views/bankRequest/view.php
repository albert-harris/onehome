<?php
$this->breadcrumbs=array(
	'Bank  Evaluation Report'=>array('index'),
	$model->property_name_or_address,
);

$menus = array(
	array('label'=>'Bank Evaluation Report', 'url'=>array('index')),
//	array('label'=>'Create BankRequest', 'url'=>array('create')),
//	array('label'=>'Update BankRequest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
$PropertyTypeList = ProPropertyType::FormatViewProperyType($model);
?>

<h1>View Bank Evaluation Report: <?php echo $model->property_name_or_address; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'property_name_or_address',
		'postal_code',
                array(
                    'name'=>'unit_from',
                    'value'=>$model->unit_from. " - $model->unit_to",
                ),            
//		'unit_from',
//		'unit_to',
                array(
                    'name'=>'location_id',
                    'value'=>ProLocation::getNameWithDistrict($model->location_id),
                ),
                array(
                    'name'=>'property_type_id',
//                    'value'=>$model->property?$model->property->name:"",
                    'type' => 'html',
                    'value' => $PropertyTypeList,
                ),
		'tenure',
                array(
                    'name'=>'furnished',
                    'value'=> $model->furnished?$model->furnished->name:"",
                ),
		'of_bedroom_from',
//		'of_bedroom_to',
		'of_bathrooms_from',
//		'of_bathrooms_to',
		'type_selling',
		'floor_area',
                array(
                    'name' => 'tenancy_expiry_date',
                    'type'=>'TenancyExpiryDate',
                    'value'=>$model,
                    ),            
		'monthly_rental_amount',
                array(
                    'name' => 'target_price',
                    'type'=>'NumberOnly',
                    ),            
		'remark',
		'nric',
//		'owner_particular',
		'fullname',
		'contact_no',
		'email',
		'target_price:Price',
	),
)); ?>
