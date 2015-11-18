<?php
$furnishing_include = json_decode($model->furnishing_include, true);
if (is_array($furnishing_include) && count($furnishing_include) > 0) {
     $arr  = CHtml::listData(ProMasterFurnishingIncluded::model()->findAllByAttributes(array("id"=>array_unique($furnishing_include))),'name', 'name');
     $furnishing_include = '- ' . implode('<br>- ', $arr);
}
else  $furnishing_include = '';


$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'type_enquiry',
//        'listing_type',
        array(
            'name' => 'property_type_id',
            'type' => 'html',
//            'value' => $model->property->name,
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
        'furnished',
        array(
            'name'=>'remark',
            'type'=>'html',
            'value'=>  nl2br(strip_tags($model->remark))
        ),
//        array(
//            'name' => 'Furnishing',
//            'type' => 'html',
//            'value' => $furnishing_include
//        ),
        'name',
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
    ),
));
?>