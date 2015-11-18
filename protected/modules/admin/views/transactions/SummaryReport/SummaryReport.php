<?php
$this->breadcrumbs=array(
	'Summary Report',
);
//$b=3;
//echo $b;die;
//$a = "333333";
//$aabc = 45456;
//$aabc = 222;
// echo $aabc;die;
?>
<h1>Summary Report</h1>

<div class="search-form">
<?php include '_search.php';;?>
</div><!-- search-form -->
<style>
    .tb-1 { width: 250% !important;max-width: 250% !important;}
</style>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pro-transactions-grid',
	'dataProvider'=>$model->SummaryReport(),
        'itemsCssClass'=>'tb-1 items',
        'enableSorting' => false,
	'afterAjaxUpdate'=>'function(id, data){ }',
        'template'=>' <div class="table_scroll">{items}</div> 
                        <div class="action-group clearfix">
                           <div class="pager f-right">{pager}</div> 
                           <div class="lb f-right">{summary}</div>               
                     </div>                
          ',
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'header' => 'Invoice No',
            'type' => 'SumReportInvoiceNo',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            
        array(
            'name'=>'created_date',
            'type'=>'date',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('class'=>'first','style' => 'text-align:center;'),
        ),
            
        array(                        
            'name' => 'ext_listing_type_id',
            'type'=>'TransListingType',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),    
        array(
            'header' => 'Property Address',
            'type'=>'TransactionPropertyName',
            'value'=>'$data',
            'htmlOptions' => array('class' => 'w-150'),
        ),
        array(
            'name'=>'type',
            'header' => 'Type',
            'type'=>'PropertyType',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'header' => 'Price',
//            'name'=>'sPropertyPrice',
            'type'=>'TransactionPropertyPrice',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(
            'header' => 'Client Commission',
            'type'=>'SumReportClientCom',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(
            'header' => 'Receivable Commission Amount',
            'type'=>'SumReportReceivableCommissionAmount',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(
            'header' => 'Received Commission Amount',
            'type'=>'SumReportReceivedCommissionAmount',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(
            'header' => 'Received Date',
            'type'=>'SumReportReceivedDate',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(
            'header' => 'Commission Receivable from External Cobroke agent',
            'type'=>'SumReportComExternalCobrokeAgent',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(
            'header' => 'Commission payable to  External Cobroke agent',
            'type'=>'SumReportComPayableExternalCobrokeAgent',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(
            'header' => 'External Coboke agent company',
            'type'=>'SumReportExternalCobrokeAgentCompany',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:left;'),
//            'headerHtmlOptions' => array('class'=>'w-250'),
            'headerHtmlOptions' => array('style' => 'width:150px;'),
        ),
        array(
            'header' => 'External Coboke agent name',
            'type'=>'SumReportExternalCobrokeAgentName',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:left;')
        ),
        array(
            'header' => 'Paid date',
            'type'=>'SumReportDatePaidExernalCobroke',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            
        array(
            'header' => 'Gross Commission to Company',
            'type'=>'SumReportGrossCommissiontoCompany',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),    
            
        array(
            'header' => 'Salesperson Name',
            'type'=>'SumReportSalespersonName',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:left;')
        ),    
            
        array(
            'header' => 'Commission Payable to Salesperson',
            'type'=>'SumReportCommissionPayabletoSalesperson',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(
            'header' => '1st Tier Manager  Name',
            'type'=>'SumReport1stTierName',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:left;')
        ),
        array(
            'header' => 'Overriding to 1st Tier Manager',
            'type'=>'SumReport1stTierOverriding',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
        array(
            'header' => '2nd Tier Manager  Name',
            'type'=>'SumReport2ndTierName',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:left;')
        ),
        array(
            'header' => 'Overriding to 2nd Tier Manager',
            'type'=>'SumReport2ndTierOverriding',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
            
        array(
            'header' => "Telemarketer's Name",
            'type'=>'SumReportTelemarketerName',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:left;')
        ),
        array(
            'header' => "Commission Payable to Telemarketer",
            'type'=>'SumReportTelemarketerComm',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
            
        array(
            'header' => "Net Commission Earned by Company",
            'type'=>'SumReportNetCommissionEarnedbyCompany',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),
            
    ),
)); ?>
