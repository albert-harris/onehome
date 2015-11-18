<div class="fix_table_grid">

<div>
    <h3 class="report uppercase">Aircon Service</h3>
    <!--<a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/addAirconService', array('transaction_id'=>$_GET['transaction_id'])); ?>" class="btn-5 add_report_item"> Add More </a>-->
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'aircon_service_grid',
	'dataProvider'=>$mAirconService->searchFe(),
	//'filter'=>$model,
         'enableSorting' => false,
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
                                       )
                       ),
          'columns'=>array(
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
                    'name'=>'upload_service_documents',
                    'type'=>'AirconFile',
                    'value'=>'$data'
                ),
//                array(
//                    'header' => 'Status',
//                    'name' => 'status',
//                    'value' => 'ProAirconService::$STATUS_AIRCON[$data->status]'
//                ),
                array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
//                    'template'=> '{update_item} {delete_item}',
                    'template'=> '{update_item}',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'headerHtmlOptions' => array('class'=>'','style' => 'text-align:center;'),
                    'buttons'=>array(
                        'update_item'=>array(
                                'label'=>'Update Status',
                                'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/update.png',
                                'options'=>array('class'=>'update_item', 'data-fancybox-type'=>'iframe'),
                                'url'=>'Yii::app()->createAbsoluteUrl("ajax/updateAirconService",
                                    array("id"=>$data->id))',
                                'visible'=> '$data->user_id == Yii::app()->user->id',
                            ),
                        'delete_item' => array
                        (
                            'url'=>'Yii::app()->createAbsoluteUrl("ajax/deleteAirconService", array("id" => $data->id))',
                            'options' => array('class'=>'delete_item'),
                            'imageUrl'=>Yii::app()->theme->baseUrl . '/img/delete.png',
                            'visible'=> '$data->user_id == Yii::app()->user->id',
                        ),
                    ),
                )              
	),
)); ?>

</div>