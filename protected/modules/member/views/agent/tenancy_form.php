<?php
//status
$status = STATUS_LISTING_ALL;
if(isset($_GET['status'])&& is_numeric($_GET['status'])){
    $status = (int)$_GET['status'];
}

if ($status == STATUS_LISTING_ALL) {
    echo '<h3>ALL TENANCY</h3>';
}
include 'tenancy_form_search.php';

$this->widget('ext.CMenu.CMenu', array(
    'linkLabelWrapper' => 'span',
    'activeCssClass' => 'active',
    'htmlOptions' => array(
        'class' => 'tabs space-6 clearfix',
    ),
    'items' => array(
        array('label' => 'All',
              'url' => array('/member/agent/tenancy','status'=>STATUS_LISTING_ALL) ,
              'active'=>($status==STATUS_LISTING_ALL) ? 'active':''),        
        array('label' => 'Active',
              'url' => array('/member/agent/tenancy','status'=>STATUS_LISTING_ACTIVE) ,
              'active'=>($status==STATUS_LISTING_ACTIVE) ? 'active':''),
        array('label' => 'Expired',
              'url' => array('/member/agent/tenancy','status'=>STATUS_LISTING_EXPIRED) ,
              'active'=>($status==STATUS_LISTING_EXPIRED) ? 'active':''),
        array('label' => 'Draft',
              'url' => array('/member/agent/tenancy','status'=>STATUS_TENANCY_DRAFT) ,
              'active'=>($status==STATUS_TENANCY_DRAFT) ? 'active':''),
    ),
));

?>

 <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sr-resume-request-grid',
	'dataProvider'=>$model->getListTenanciesAgent(),
	//'filter'=>$model,
//         'enableSorting' => false,
         'summaryText' => "Showing items {start} to {end} of {count}",
         'htmlOptions'=>array(
                            'class'=>'tb-1',
                          ),
          'template'=>'{items} 
                        <div class="action-group clearfix">
                           <div class="pager f-right">{pager}</div> 
                           <div class="lb f-right">{summary}</div>               
                     </div>                
          ',
        'pager' => array(
                    'header' => '',
                    'cssFile' => false,
                    'prevPageLabel' => 'Previous',
                    'nextPageLabel' => 'Next',   
                    'lastPageLabel'  => '',
                    'firstPageLabel'  => '',
                    'htmlOptions'=>array(
                                    'class'=>'listing_manager'
                            ),
                   ),         
          'columns'=>array(
                array(
                    'name'=>'tenancy_agreement_date',
                    'header'=>'Tenancy Agreement Date',  
                    'type' => 'longDate',
                    'value' => '$data->rTransaction->tenancy_agreement_date',
                    'htmlOptions'=>array('style'=>'text-align: center'),
                    'headerHtmlOptions'=>array('class'=>'first','style'=>'width:120px; text-align: center'),   
                ),
                array(
                    'name'=>'commencement_date',
                    'type' => 'longDate',
                    'value' => '$data->rTransaction->commencement_date',
                    'header'=>'Commencement Date', 
                    'htmlOptions'=>array('style'=>'text-align: center'),
                    'headerHtmlOptions'=>array('style'=>'width:120px; text-align: center'),   
                ),
                array(
                    'name'=>'expiring_date',
                    'header'=>'Expiring Date',
                    'type' => 'expiredDate',
                    'value' => '$data->rTransaction->expiring_date',
                    'htmlOptions'=>array('style'=>'text-align: center'),
                    'headerHtmlOptions'=>array('style'=>'width:120px; text-align: center'),   
                ),
                array(
                    'header'=>'Tenancy Amount',
                    'type' => 'price',
                    'value' => '$data->rTransaction->tenancy_amount',
                    'htmlOptions'=>array('style'=>'width: 110px;'),
                ),

                array(
                    'header'=>'Deposit Paid',
                    'type' => 'price',
                    'value' => '$data->rTransaction->deposit_payable',
                    'htmlOptions'=>array('style'=>'width: 70px;'), 
                ),
                 array(
                    'header'=>'Tenancy Period',
                     'value' => '$data->rTransaction->months_rent != NULL ? $data->rTransaction->months_rent." months":""',
                    'htmlOptions'=>array('style'=>'width: 70px;text-align:center;'), 
                 ),             
                 array(
                    'header'=>'Property Name',
                    'type' =>'propertydetail',
                    'value' => 'array("name"=>$data->rTransaction->listing?$data->rTransaction->listing->property_name_or_address:"", "transaction_id"=>$data->rTransaction->id)',
                    'htmlOptions'=>array('style'=>'width: 250px;text-align:left;'), 
                 ),             
                array(
                    'header' => 'Calls Log',
                    'type'=>'CallsLogPopup',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                ),
                array(
                    'type'=>'CallsLogModal',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:center; width:1px;'),
                    'headerHtmlOptions'=>array('style'=>'width:1px;'),
                ),
                array(
                    'header' => 'Report Defect',
                    'type'=>'ReportDefectPopup',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                ),
                array(
                    'type'=>'ReportDefectModal',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:center; width:1px;'),
                    'headerHtmlOptions'=>array('style'=>'width:1px;'),
                ),
                array(
                    'header' => 'Inventory Photo',
                    'type'=>'InventoryPhotoPopup',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                ),
                array(
                    'type'=>'InventoryPhotoModal',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:center; width:1px;'),
                    'headerHtmlOptions'=>array('style'=>'width:1px;'),
                ),
                array(
                    'header' => 'Aircon Services',
                    'type'=>'AirconServicesPopup',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'headerHtmlOptions'=>array('style'=>'text-align:center;'),
                ),
                array(
                    'type'=>'AirconServicesModal',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:center; width:1px;'),
                    'headerHtmlOptions'=>array('style'=>'width:1px;'),
                ),
                array(
                    'class'=>'ButtonColumn',
                    'evaluateID'=>true,
                        'header'=>'Actions',  
//                        'template'=> '{update}{view}{callog}',
                        'template'=> '{update}{view}{delete}',
                        'headerHtmlOptions'=>array('class'=>'last','style'=>'width:70px;'),   
                        'buttons'=>array(
                            'update' => array
                            (
                                'url'=>'ProTransactions::GetLinkUpdateTenancy($data->rTransaction)',
                                'visible' => '$data->rTransaction->status == STATUS_TENANCY_DRAFT',
                            ),
                            'delete' => array
                            (
                                'url'=>'ProTransactions::GetLinkDeleteTenancy($data->rTransaction)',
                                'visible' => '$data->rTransaction->status == STATUS_TENANCY_DRAFT',
                            ),
                            'view' => array
                            (
                                'url'=>'Yii::app()->createAbsoluteUrl("member/agent/view", array("tenancy"=>$data->rTransaction->id))',
                                'visible' => '$data->rTransaction->status != STATUS_TENANCY_DRAFT',
                            ),
                            'callog' => array
                            (
                                'imageUrl'=>Yii::app()->theme->baseUrl . '/img/calls.png',
                                'url'=>'Yii::app()->createAbsoluteUrl("member/agent/calllog", array("transaction_id"=>$data->rTransaction->id))',
                            ),

                        ),
                ),
              
	),
)); ?>

<style> 
    .listing_manager .selected a {color:#333333 !important; }
    #sr-resume-request-grid table.items {width:100% !important;}
</style>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/removePhoto.js"></script>
<?php
Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#sr-resume-request-grid a.ajaxupdate').on('click', function() {
        $.fn.yiiGridView.update('sr-resume-request-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('sr-resume-request-grid');
            }
        });
        return false;
    });
");
?>
<style>
    .th-small{with:5%;}
    .th-normal{width: 13%;}
    .th-big{width: 30%;}
</style>


