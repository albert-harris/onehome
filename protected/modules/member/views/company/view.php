<?php
$this->breadcrumbs = array(
    'Company Listing Management' => array('index'),
    'view ',
);
?>
<div class="box-1 space-3">
    <div class="title"><h3>View listing detail</h3></div>
    <div class="content space-5 tempt"> 
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'id' => 'table-company-detail',
            'attributes' => array(
                'property_address',
                'display_title',
                'display_address',                  
                array(
                    'name' => 'location_id',
                    'value' => ActiveRecord::getInfoRecord('ProLocation', $model->location_id, 'name')
                ),
                array(
                    'name' => 'property_type',
                    'value' => ActiveRecord::getInfoRecord('ProPropertyType', $model->property_type, 'name')
                ),
                array(
                    'name' => 'type',
                    'value' => ($model->type == 1) ? 'Sale' : 'Rent'
                ), 
                'asking_price',
                'asking_psf',
                'bed_rooms',
                'bath_rooms',
                'building_name',
                'contact_name_no',               
//                array(
//                    'name' => 'floor_area',
//                    'value' => ActiveRecord::getInfoRecord('ProMasterFloor', $model->floor_area, 'name')
//                ),
                array(
                    'name' => 'Listed By',
                    'value' => ActiveRecord::getInfoRecord('Users', $model->user_id, 'username')
                ),
                array(
                    'name' => 'dnc_expiry_date',
                    'value' => date('d-M-Y', strtotime($model->dnc_expiry_date))
                ),
                array(
//                    'name' => 'created_date',
                    'name'=>'Listed Date',
                    'value' => date('d-M-Y', strtotime($model->created_date))
                ),
                array(
                    'name' => 'remarks',
                    'type' => 'html'
                ),
            ),
        ));
        ?>
    </div>
</div>