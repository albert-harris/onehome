<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pro-callslog-grid',
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
            'headerHtmlOptions' => array('class' => 'first', 'width' => '30px', 'style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name' => 'date',
            'type' => 'DateTimeTran',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('style' => 'text-align:center;width:100px'),
        ),
        array(
            'name' => 'received_by',
            'htmlOptions' => array('style' => ';width:120px;'),
        ),
        array(
            'name' => 'description',
            'type' => 'html',
            'value' => 'MyFormat::replaceNewLineTextArea($data->description)',
            'headerHtmlOptions' => array('style' => 'text-align:left;width:230px'),
        ),
        array(
            'name' => 'person_call_type',
            'value' => 'isset(ProCallLog::$ARR_PERSON_CALL_TYPE[$data->person_call_type])?ProCallLog::$ARR_PERSON_CALL_TYPE[$data->person_call_type]:""',
            'htmlOptions' => array('style' => 'text-align:left;', 'class' => 'w-100'),
            'headerHtmlOptions' => array('style' => 'width:150px;text-align:left;'),
        ),
        array(
            'name' => 'person_called',
            'headerHtmlOptions' => array('style' => 'text-align:left;width:120px'),
//            'type'=>'html',
        ),
        array(
            'name' => 'phone',
            'headerHtmlOptions' => array('class' => 'last', 'style' => 'text-align:left;;width:90px'),
//            'type'=>'html',
        ),
    ),
));
?>


<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />

<style>
    #pro-callslog-grid{width: 840px;} 
    #pro-callslog-grid table{width: 840px;}    
</style>