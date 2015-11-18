<?php

if ($model->rent_type == 'Tenant') {
    $furnishing_include = json_decode($model->furnishing_include, true);
   if (is_array($furnishing_include) && count($furnishing_include) > 0) {       
        $arr  = CHtml::listData(ProMasterFurnishingIncluded::model()->findAllByAttributes(array("id"=>array_unique($furnishing_include))),'name', 'name');
        $furnishing_include = '- ' . implode('<br>- ', $arr);
   }
   else  $furnishing_include = '';   
    
    $arrayData = array(
        'type_enquiry',
        'rent_type',
        array(
            'name' => 'property_type_id',
//            'value' => $model->property->name
            'type' => 'html',
            'value' => $PropertyTypeList,            
        ),
//        array(
//            'name' => 'location_id',
//            'type' => 'raw',
//            'value' => (isset($model->location->name)) ? $model->location->name : ''
//        ),
        array(
            'name' => 'location_list_id',
            'type' => 'EngageDistrict',
        ),
        'price',
        'bedrooms',
        'floor_size',
//        array(
//            'name' => 'Furnishing',
//            'type' => 'html',
//            'value' => $furnishing_include
//        ),        
        'move_in_date',
        'of_persons_staying',
        array(
            'name' => 'remark',
            'type' => 'raw',
            'value' => (!empty($model->remark)) ? $model->remark : '',
        ),
        'name',
        'email',
        'occupation',
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
} else {

    $arrayData = array(
    'type_enquiry',
    array(
        'name' => 'Property Name or Address',
        'value' => $model->address
    ),
//        'listing_type',
    'rent_type',
    array(
        'name' => 'property_type_id',
//        'type' => 'raw',
//        'value' => $model->property->name
        'type' => 'html',
        'value' => $PropertyTypeList,
    ),
//        array(
//            'name' => 'location_id',
//            'type' => 'raw',
//            'value' => (isset($model->location->name)) ? $model->location->name : ''
//        ),
        array(
            'name' => 'location_list_id',
            'type' => 'EngageDistrict',
        ),
    'postal_code',
    'floor_area',
    'unit',
//    'price',
//    'lease_term',
    'tenure',
    array(
       'name' => '# of Bedrooms',
       'value' => $model->bedrooms
   ),       
    array(
       'name' => '# of bathrooms',
       'value' => $model->bathrooms
   ),   
    'availability',
    'furnished',
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
}


$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' =>$arrayData
));
?>