<div class="breadcrumb">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('/');?>">Home</a>
    &raquo; <strong>Transaction Management</strong></div>

<h3>ALL TRANSACTIONS</h3>

<?php $status='';?>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>Yii::app()->createUrl($this->route),
            'method'=>'get',
    )); ?>
        <div class="search-view clearfix">
            <div class="box-3 form-type">
                <div class="in-row clearfix">
                    <div class="col-1">
                        <div class="in-row clearfix">
                            <?php echo $form->labelEx($model,'SubmittedFrom', array('class'=>'lb')); ?>
                            <?php 
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model'=>$model,        
                                    'attribute'=>'SubmittedFrom',
                                    'options'=>array(
                                        'showAnim'=>'fold',
                                        'dateFormat'=> ActiveRecord::getDateFormatSearch(),
                                        'changeMonth' => true,
                                        'changeYear' => true,
                                        'showOn' => 'button',
                                        'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                                        'buttonImageOnly'=> true,                                
                                    ),        
                                    'htmlOptions'=>array(
                                        'class'=>'text w-7',
                                        'style'=>'float:left',
                                    ),
                                ));
                            ?> 
                            
                        </div>
                        <div class="in-row clearfix">
                            <?php echo $form->label($model,'type', array('class'=>'lb','label'=>'Type')); ?>
                            <div class="group-5">
                            <?php echo $form->dropDownList($model,'type', Listing::$aTextSaleRent, array('empty'=>'All', 'class'=>'')); ?>
                                </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="in-row clearfix">
                            <?php echo $form->labelEx($model,'SubmittedTo', array('class'=>'lb')); ?>
                            <?php 
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model'=>$model,        
                                    'attribute'=>'SubmittedTo',
                                    'options'=>array(
                                        'showAnim'=>'fold',
                                        'dateFormat'=> ActiveRecord::getDateFormatSearch(),
                                        'changeMonth' => true,
                                        'changeYear' => true,
                                        'showOn' => 'button',
                                        'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                                        'buttonImageOnly'=> true,                                
                                    ),        
                                    'htmlOptions'=>array(
                                        'class'=>'text w-7',
                                        'style'=>'float:left',
                                    ),
                                ));
                            ?>
                        </div>
                        
                        
                        <div class="in-row clearfix">
                            <?php echo CHtml::submitButton('Search', array('class'=>'btn-3 f-right', 'style'=>'')); ?>
                        </div>
                    </div>
                </div>
            </div>	
            <a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/createTransaction',array('type'=>Listing::FOR_RENT, 'list'=>'transaction', 'add_property'=>ProTransactions::ADD_UNLISTED));?>" class="btn-2 btn-new">Submit a New Transaction</a>
        </div>


<?php $this->endWidget(); ?> 

<div class="action-group">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->searchFeList(),
        'itemsCssClass'=>'tb-1 margin_0',
        'htmlOptions' => array('class' => 'tb-1'),
        'enableSorting' => false,
        'ajaxUpdate' => false,
    'summaryText' => "Showing items {start} to {end} of {count}",
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
            'selectedPageCssClass'=>'active',
            'htmlOptions'=>array(
                    'class'=>'listing_manager'
               )
    ), 
	'columns'=>array(
//        array(
//            'header' => 'S/N',
//            'type' => 'raw',
//            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
//            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
//            'htmlOptions' => array('style' => 'text-align:center;')
//        ),
        array(
            'name'=>'created_date',
            'type'=>'date',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('class'=>'first','style' => 'text-align:center;'),
        ),
        array(
            'name'=>'transactions_no',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name'=>'type',
            'type'=>'PropertyType',            
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'header' => 'Property Name',
            'type'=>'TransactionPropertyName',
            'name'=>'listing_id',
            'value'=>'$data',
//            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'header' => 'Price',
//            'name'=>'listing_id',
            'type'=>'TransactionPropertyPrice',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
//        array(
//            'header' => 'Invoice Date',
////            'name'=>'listing_id',
//            'value'=>'',
//            'htmlOptions' => array('style' => 'text-align:center;')
//        ),
        array(
            'header' => 'Actions',
            'class'=>'CButtonColumn',
            'template'=> '{view}{print}',
//            'template'=> '{update}{view}{print}',
            'headerHtmlOptions'=>array('class'=>'last'),   
            'buttons'=>array(
                'update'=>array(
                    'label'=>'Update Transaction',
                    'options'=>array('class'=>'view','target'=>'_blank'),
                    'url'=>'Yii::app()->createAbsoluteUrl("member/member_profile/createTransaction",
                        array("id"=>$data->id,
                                "type"=>$data->type,
                                "listing_id"=>$data->listing_id,
                                "list"=>"transaction",
                                "update_transactions"=>start,
                            ))',
                ),
                'view'=>array(
                    'label'=>'View Detail Transaction',
                    'options'=>array('class'=>'view','target'=>'_blank'),
                    'url'=>'Yii::app()->createAbsoluteUrl("member/member_profile/viewTransaction",
                        array("id"=>$data->id))',
                ),
                'print'=>array(
                    'label'=>'Print Transaction',
                    'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/print.png',
                    'options'=>array('class'=>'print','target'=>'_blank'),
                    'url'=>'Yii::app()->createAbsoluteUrl("member/member_profile/viewTransaction",
                        array("id"=>$data->id,"print_transaction"=>"now"))',
                ),                                                    
            ),  
        ),
	),
)); ?>

</div>