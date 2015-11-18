
<h3 class="uppercase">Call Histories</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'calllog-grid',
	'dataProvider'=>$calllog,
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
                    'name'=>'date',
                    'type'=>'DateTimeTran',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'headerHtmlOptions' => array('class'=>'w-150','style' => 'text-align:center;'),
                ),
                array(
                    'name'=>'received_by',
//                    'htmlOptions' => array('style' => 'text-align:center;'),
                ),
                array(
                    'name'=>'description',
                    'type'=>'html',
                    'value'=>'MyFormat::replaceNewLineTextArea($data->description)',
                ),
                array(
                    'name'=>'person_call_type',
                    'value'=>'isset(ProCallLog::$ARR_PERSON_CALL_TYPE[$data->person_call_type])?ProCallLog::$ARR_PERSON_CALL_TYPE[$data->person_call_type]:""',
                    'htmlOptions' => array('style' => 'text-align:center;', 'class'=>'w-150')
                ),            
                array(
                    'name'=>'person_called',
        //            'type'=>'html',
                ),            
                array(
                    'name'=>'phone',
        //            'type'=>'html',
                ), 
	),
)); ?>