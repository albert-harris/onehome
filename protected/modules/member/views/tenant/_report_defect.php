
<div>
<h3 class="report">REPORT DEFECT(s) </h3>
<a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/addReport', array('transaction_id'=>$_GET['transaction_id'])); ?>" class="btn-5 add_report_item"> Add More </a>    
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'defect-grid',
	'dataProvider'=>$report,
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
                    'name' => 'Date/Time',
                    'type' => 'DateTimeReport',
                    'value' => '$data->created_date',
                ),

                array(
                    'name' => 'Description',
                    'type' => 'html',
                    'value' => 'nl2br($data->description)',
                ),
                array(
                    'name' => 'location_text',
                ),
//                array(
//                    'header' => 'Location',
//                    'value' => 'ProReportDefect::GetViewLocation($data)'
//                ),
                array(
                    'header' => 'Uploaded Photos',
                    'name'=>'photo',
//                    'type'=>'Photo',
                    'type'=>'PhotoAdmin',
                    'value'=>'$data'
                ),
                array(
                    'header' => 'Status',
                    'value' => 'CmsFormatter::$statusReport[$data->status];'
                ),
                array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
                    'template'=> '{delete_item}',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'headerHtmlOptions' => array('class'=>'','style' => 'text-align:center;'),
                    'buttons'=>array(
                        'delete_item' => array
                        (
                            'url'=>'Yii::app()->createAbsoluteUrl("member/tenant/delete", array("report_id" => $data->id))',
                            'options' => array('class'=>'delete_item'),
                            'imageUrl'=>Yii::app()->theme->baseUrl . '/img/delete.png',
                            'visible'=> '$data->user_id == Yii::app()->user->id',
                        ),
                    ),
                )              
	),
)); ?>

