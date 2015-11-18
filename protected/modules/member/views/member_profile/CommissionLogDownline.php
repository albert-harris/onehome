<?php 
$this->widget('ext.CMenu.CMenu', array(
    'linkLabelWrapper' => 'span',
    'activeCssClass' => 'active',
    'htmlOptions' => array(
        'class' => 'tabs space-6 clearfix',
    ),
    'items' => array(
        array('label' => 'All',
              'url' => '',
               'itemOptions' => array('class'=>'menu_tab',
                    'next'=> Yii::app()->createAbsoluteUrl('member/member_profile/commissionLog', array('ProTransactionsSaveCommission[status]'=>1)),
                ),
              'active'=>'active'),
        array('label' => 'Received',
                'url' => '',
               'itemOptions' => array('class'=>'menu_tab',
                    'next'=> Yii::app()->createAbsoluteUrl('member/member_profile/commissionLog', array('ProTransactionsSaveCommission[status]'=>STATUS_GEN_RECEIPT)),
                ),
                'active'=>''),
        array('label' => 'Receivable',
                'url' => '',
                'itemOptions' => array('class'=>'menu_tab',
                    'next'=> Yii::app()->createAbsoluteUrl('member/member_profile/commissionLog', array('ProTransactionsSaveCommission[status]'=>0)),
                ),
                'active'=>''),

    ),
));
?> 

<div class="search-form-downline padding_0">
    <?php include 'CommissionLogMyTransSearchDownline.php'; ?>
</div>

<style>
    /*.tb-1 { width: 150%;}*/
</style>
<div class="action-group" style="margin-top: 30px;">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid-downline',
	'dataProvider'=>$model->searchFeListDownline(),
        'itemsCssClass'=>'tb-1 margin_0',
        'htmlOptions' => array('class' => ''),
        'enableSorting' => false,
//        'ajaxUpdate' => false,
    'summaryText' => "Showing items {start} to {end} of {count}",
    'template'=>' <div class="table_scroll">{items}</div> 
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
            'selectedPageCssClass'=>'active',
            'htmlOptions'=>array(
                    'class'=>'listing_manager'
               )
    ), 
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name'=>'agent_id',
            'type'=>'FullNameRegisteredUsers',
            'value'=>'$data->rSalePerson',
        ),
        array(
            'header'=>'Commission Scheme',
            'type'=>'AgentCommissionScheme',
            'value'=>'$data->rSalePerson',
        ),
        array(
            'name'=>'transactions_no',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name'=>'submitted_date',
            'type'=>'date',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('class'=>'','style' => 'text-align:center;'),
        ),

        array(
            'name'=>'Transaction Type',
            'type'=>'PropertyType',
            'value'=>'$data->rTransaction->type',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name'=>'Property Type',
            'value'=>'$data->rPropertyType?$data->rPropertyType->name:""',
        ),
            
        array(
            'name'=>'Property Address',
            'type'=>'TransactionPropertyName',
            'value'=>'$data->rTransaction',
            'htmlOptions' => array('style' => 'width:150px;'),
        ),
        array(
            'name'=>'price',
            'type'=>'Price',
            'htmlOptions' => array('style' => 'text-align:right;'),
        ),
          
        array(
            'name'=>'received_commission',
            'type'=>'TransReceivedCommission',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;'),
        ),      
            
        array(
            'name'=>'received_on',
            'type'=>'TransReceivedCommissionDate',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        
        array(
            'name'=>'type_of_tier',
            'value'=>'isset(ProTransactions::$aTypeTier[$data->type_of_tier])?ProTransactions::$aTypeTier[$data->type_of_tier]:"Internal Co-broke"',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),            
        
        array(
            'name'=>'net_commission_after_deduction',
            'type'=>'TransNetCommissionAfterDeduction',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;'),
        ),            
        array(
            'name'=>'overriding_amount',
            'type'=>'TransOverridingAmount',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:right;'),
        ),            
       
	),
)); ?>

</div>