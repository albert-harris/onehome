<?php 
$dataProvider = $model->SearchCompanyBE();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'listing-company-grid',
	'dataProvider'=> $dataProvider,
	'enableSorting' => true,
        'afterAjaxUpdate'=>'function(id, data){ fnBindMoveTo();}',        

//        'summaryText'=>'Displaying {start}-{end} of {count} result(s). Show:' .
        'summaryText'=>'Show:' . MyFormat::GetDropDownPageSize('pageSize', $dataProvider->pagination->pageSize) .
        ' rows per page',
    
	'columns'=>array(
            array(
                'class'=>'CCheckBoxColumn',   
                'selectableRows'=>2,
                'id'=>'chk',
            ),
            array(
                'header' => 'S/N',
                'type' => 'raw',
                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            
            array(
                'name' => 'listing_type',
                'header' => 'Type',
                'type' => 'PropertyType',
                'headerHtmlOptions' => array('class' => 'first', 'style' => 'width:70px;'),
//                'filter'=> Listing::$aTextSaleRentNormal,
            ),        
            array(
                'name' => 'location_id',
                'header' => 'District',
                'value' => '"D".($data->location_id>9?$data->location_id:"0$data->location_id")',
            ),        
            array(
                'name' => 'property_name_or_address',
                'header' => 'Property Address',
//                'filterHtmlOptions'=> array('class'=>'w-50', 'style'=>''),
            ),
            array(
                'name'=>'unit_from',
                'value'=>'$data->unit_from." - $data->unit_to"',
                'htmlOptions' => array('style' => 'width: 50px;'),
            ),
            array(
                'name'=>'floor_area',
                'type' => 'Price',
                'htmlOptions' => array('style' => 'text-align:right;'),
            ),
            array(
                'name'=>'of_bedroom',
                'htmlOptions' => array('style' => 'text-align:center;'),
            ),
            array(
                'name' => 'price',
                'type' => 'Price',
                'htmlOptions' => array('style' => 'width: 80px;text-align:right;'),
            ),            
//            array(
//                'name'=>'username',
//                'header'=>'Listed By',
//                'value'=>'ActiveRecord::getInfoRecord("Users",$data->user_id,"username")'
//            ),
            array(
                'name' => 'company_owner_name',                
//                'type' => 'FullNameRegisteredUsers',                
            ),
            array(
                'name'=>'contact_name_no',
            ),
            
            array(
                'name'=>'company_email',
            ),
            array(
                'name'=>'company_availability',
            ),
            
            array(
                'name'=>'dnc_expiry_date',
                'type'=>'CompanyDncExpiryDate',
                'value'=>'$data',
            ),
            
            array(
                'name' => 'user_id',
                'type' => 'FullNameRegisteredUsers',
                'value' => '$data->rUser?$data->rUser:null',
                'htmlOptions' => array('style' => 'width: 100px;'),
            ),
            array(
                'name' => 'owner_contact_click',
                'type' => 'raw',
                'value' => '$this->grid->widget("application.components.ListingClickWidget", array("listing"=>$data), true)',
                'htmlOptions' => array('style' => 'width: 100px;'),
            ),
            array(
              'name'=>'last_update_time',
              'type'=>'date',
//              'htmlOptions' => array('style' => 'width:110px;')
            ),
            array(
              'name'=>'company_listing_status',
              'type'=>'ListingCompanyStatus',
              'value'=>'$data',
              'htmlOptions' => array('style' => 'text-align:center;')
            ),
            
            array(
                'header' => 'Move To',
                'class'=>'CButtonColumn',
//                'template'=> ControllerActionsName::createIndexButtonRoles($actions),
                'template'=> '{move_to_that}',
                'buttons'=>array(
                    'move_to_that'=>array(
                        'label'=>"Move To $MoveTo",
//                        'imageUrl'=>Yii::app()->theme->baseUrl . '/img/calls.png',
                        'options'=>array('class'=>'move_to_that ajaxupdate remove_target_blank'),
                        'url'=>'Yii::app()->createAbsoluteUrl("admin/ajax/companyListingMoveto",
                            array("id"=>$data->id, "company_listing_type"=>Listing::$COMPANY_TYPE_MOVE_REVERT[$data->company_listing_type] ))',
                    ),
                ), 
            ),
            array(
                'header' => 'Actions',
                'class'=>'CButtonColumn',
//                'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view','update')),
                'template'=> ControllerActionsName::createIndexButtonRoles($actions),
                'buttons'=>array(
                    'update'=>array(
                        'visible'=> 'Listing::CanUpdateCompanyListing($data)',
                    ),
                    'delete'=>array(
                        'visible'=> 'Listing::CanDeleteCompanyListing($data)',
                    ),
                ),
//                'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view')),
//                'buttons'=>array(
//                    'move_to_that'=>array(
//                        'label'=>"Move To $MoveTo",
////                        'imageUrl'=>Yii::app()->theme->baseUrl . '/img/calls.png',
//                        'options'=>array('class'=>'move_to_that ajaxupdate remove_target_blank'),
//                        'url'=>'Yii::app()->createAbsoluteUrl("admin/ajax/companyListingMoveto",
//                            array("id"=>$data->id, "company_listing_type"=>Listing::$COMPANY_TYPE_MOVE_REVERT[$data->company_listing_type] ))',
//                    ),
//                ), 
            ),
	),
)); 
?>

<style>
    .summary { float:right !important;}
    .change-pageSize { padding:0; height:23px;}
</style>

<script>
    $(function(){
        fnBindMoveTo();
    });
    
    function fnBindMoveTo(){
        $('.move_to_that').click(function(){
            if(confirm('Are you sure to move this item?')){
                return true;
            }
            return false;
        });
        $('.remove_target_blank').attr('target','');
        
        $('.change-pageSize').change(function(){
            var pageSize = $(this).val();
            $('.change-pageSize').val(pageSize);
            $('.submit_form_pri').find('button:submit').trigger('click');
        });
    }
</script>
    