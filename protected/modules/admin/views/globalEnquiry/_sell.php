<?php

if($model->type_selling =='Tenancy'){
    
    $arrData = array(
        'type_enquiry',
//        'listing_type',
        array(
            'name' => 'Property Name or Address',
            'value' => $model->address
        ),
        array(
            'name' => 'property_type_id',
            'type' => 'html',
//            'value' => $model->property->name
            'value' => $PropertyTypeList,
        ),
        'postal_code',
        array(
            'name' => 'location_id',
            'type' => 'raw',
            'value' => (isset($model->location->name)) ? $model->location->name : ''
        ),
        'unit',
        'tenure',
        'floor_area',
         array(
            'name' => '# of Bedrooms',
            'value' => $model->bedrooms
        ),       
         array(
            'name' => '# of bathrooms',
            'value' => $model->bathrooms
        ),       
        array(
            'name' => 'type_selling',
            'value' => (!empty($model->type_selling)) ? $model->type_selling : '',
        ),
        array(
            'name' => 'Tenancy expiry date',
            'value' => date('d-m-Y', strtotime($model->tenancy_expiry_datepicker)) . ' - ' . $model->tenancy_expiry_date
        ),
        array(
            'name' => 'monthly_rental_amount',
            'value' => (!empty($model->monthly_rental_amount)) ? $model->monthly_rental_amount : '',
        ),
        'furnished',
        'price',
        'official_bank_val',
        array(
            'name' => 'remark',
            'type' => 'raw',
            'value' => (!empty($model->remark)) ? $model->remark : '',
        ),
        'name',
        array(
            'name' => 'nric',
            'value' => (!empty($model->nric)) ? $model->nric : '',
        ),
        'email',
        'phone',
        array(
            'name' => 'Country',
            'value' => ActiveRecord::getInfoRecord('AreaCode', $model->country_id, 'area_name'),
        ),
        array(
            'name'=>'description',
            'type'=>'html',
            'value'=>  nl2br(strip_tags($model->description))
        ),
        'created_date:dateTime',       
    );
    
}else{
 
    $arrData = array(
        'type_enquiry',
        array(
            'name' => 'Property Name or Address',
            'value' => $model->address
        ),
        array(
            'name' => 'property_type_id',
            'type' => 'html',
//            'value' => $model->property->name
            'value' => $PropertyTypeList,
        ),
        'postal_code',
        array(
            'name' => 'location_id',
            'type' => 'raw',
            'value' => (isset($model->location->name)) ? $model->location->name : ''
        ),
        'unit',
        'tenure',
        'floor_area',
         array(
            'name' => '# of Bedrooms',
            'value' => $model->bedrooms
        ),       
         array(
            'name' => '# of bathrooms',
            'value' => $model->bathrooms
        ),       
        array(
            'name' => 'type_selling',
            'value' => (!empty($model->type_selling)) ? $model->type_selling : '',
        ),
        'name',
        array(
            'name' => 'nric',
            'value' => (!empty($model->nric)) ? $model->nric : '',
        ),
        'email',
        'phone',
        array(
            'name' => 'Country',
            'value' => ActiveRecord::getInfoRecord('AreaCode', $model->country_id, 'area_name'),
        ),
        array(
            'name'=>'description',
            'type'=>'html',
            'value'=>  nl2br(strip_tags($model->description))
        ),
        'created_date:dateTime',       
    );
    
}


$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => $arrData
));
?>