<?php
$HeadTitle = 'Immediate Listing';
if(isset($_GET['company_listing_type'])){
    $current_company_listing_type = $_GET['company_listing_type'];
    if($current_company_listing_type==Listing::COMPANY_FOLLOW_UP){
        $HeadTitle = 'Follow Up Listing';
    }
}
$this->breadcrumbs=array(
	'Company Listing Management'=>array('index'),
	$model->property_name_or_address,
);

$menus = array(
	array('label'=>'Company Listing Management', 'url'=>array('index')),
	array('label'=>'Update ', 'url'=>array('update', 'id'=>$model->id)),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View <?php echo "$HeadTitle: ".$model->property_name_or_address; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'property_name_or_address',
            'display_title',
            'display_address',            
            'postal_code',
            array(
                'name'=>'location_id',
                'label'=>'District – location',
                'type'=>'ListingDistrict',
                'value'=>$model,
            ),   
            array(
                'name'=>'property_type_1',
                'value'=>Listing::getViewDetailPropertyType($model),
            ),   
            array(
                'name'=>'unit_from',
                'value'=>$model->unit_from." - $model->unit_to",
            ),   
            array(
                'name'=>'house_blk_no',
            ),   
            array(
                'name'=>'building_name',
            ),   
            array(
                'name' => 'listing_type',
                'type' => 'PropertyType',
            ),
            array(
                'name' => 'company_owner_name',
            ),
            array(
                'name' => 'contact_name_no',
            ),
            array(
                'name' => 'company_email',
            ),
            array(
                'name' => 'dnc_expiry_date',
                'type' => 'CompanyDncExpiryDate',
                'value' => $model,
            ),
                           
            array(
              'name'=>'remark',
              'type'=>'html'
            ),
            array(
                'name' => 'floor_area',
                'type' => 'Price',
            ),
            array(
                'name' => 'of_bedroom',
                'type' => 'Price',
            ),
            array(
                'name' => 'company_storey',
            ),
            
            array(
                'name' => 'company_utility_room',
            ),
            array(
                'name' => 'price',
                'type' => 'Price',
            ),
            array(
                'name' => 'company_built_up',
            ),
            array(
                'name' => 'tenure',
            ),
            array(
                'name' => 'company_availability',                
            ),
            
            array(
                'name' => 'user_id',
                'type' => 'NameForAll',
                'value' => $model->rUser?$model->rUser:'',
            ),
            array(
                'name' => 'last_update_time',
                'type' => 'date',
            ),
            array(
                'name' => 'company_listing_status',
                'type' => 'ListingCompanyStatus',
                'value' => $model,
            ),
            
            
		
	),
)); ?>
