<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pro-defect-grid',
    'dataProvider' => $model->searchFE(),
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
            'name' => 'created_date',
            'type' => 'DateTimeReport',
            'value' => '$data->created_date',
            'headerHtmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name' => 'description',
            'value' => '$data->description',
        ),
        array(
            'name' => 'location_text',
        ),
        array(
            'header' => 'Uploaded Photos',
            'name' => 'photo',
            'type' => 'PhotoAdmin',
            'value' => '$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'header' => 'Status',
            'value' => 'CmsFormatter::$statusReport[$data->status]',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name' => 'approved_by_progess',
            'type' => 'ReportApproveBy',
            'value' => '$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name' => 'approved_date',
            'type' => 'ReportApproveDate',
            'value' => '$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name' => 'remark',
            'type' => 'ReportApproveRemark',
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
    #pro-defect-grid{width: 840px;} 
    #pro-defect-grid table{width: 840px;}    
</style>
