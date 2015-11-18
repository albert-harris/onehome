<?php
$mTrans = $model->rTransactions;
$cmsFormater = new CmsFormatter();
$arrVal = array("name" => $mTrans->listing->property_name_or_address, "transaction_id" => $mTrans->id);
$sPropertyName = $cmsFormater->formatpropertyname($arrVal);
$tenancy_agreement_date = $cmsFormater->formatLongDate($mTrans->tenancy_agreement_date);
$expiring_date = $cmsFormater->formatLongDate($mTrans->expiring_date);

$titleH1 = $sPropertyName . " [ $tenancy_agreement_date - $expiring_date ] ";
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pro-aircon-service-grid',
    'dataProvider' => $model->searchAtTenancy(),
//	'enableSorting' => false,
    'afterAjaxUpdate' => 'function(id, data){ fixTargetBlank(); fnUpdateColorbox(); }',
    //'filter'=>$model,
    'summaryText' => "Showing items {start} to {end} of {count}",
    'htmlOptions' => array(
        'class' => 'tb-1',
    ),
    'template' => '{items} 
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
        'lastPageLabel' => '',
        'firstPageLabel' => '',
        'htmlOptions' => array(
            'class' => 'listing_manager'
        ),
    ),
    'columns' => array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('class' => 'first','width' => '30px', 'style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'header' => 'Date/Time',
            'type' => 'AirconDateTime',
            'value' => '$data',
        ),
        array(
            'name' => 'remark',
            'type' => 'html',
            'value' => 'nl2br($data->remark)',
        ),
        array(
            'header' => 'Service Documents',
            'name' => 'upload_service_documents',
            'type' => 'AirconFile',
            'value' => '$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('class' => 'last'),
        ),
    ),
));
?>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />

<style>
    #pro-aircon-service-grid{width: 840px;} 
    #pro-aircon-service-grid table{width: 840px;}    
</style>