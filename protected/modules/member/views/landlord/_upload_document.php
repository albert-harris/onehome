
<div>
<h3 class='report' >UPLOAD/DOWNLOADED DOCUMENT(S)</h3>
<a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('member/landlord/uploadfile', array('transaction_id'=>$_GET['transaction_id'])); ?>" class="btn-5 upload_item"> Add More </a>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'document-grid',
	'dataProvider'=>$document,
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
                    'header' => '#',
                    'type' => 'raw',
                    'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                    'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
                array(
                    'name' => 'Title',
                    'value' => '$data->title',
                ),
                array(
                    'header' => 'File name',
//                    'type'=>'Document',
//                    'value' => '$data'
                    'value' => '$data->file_name'
                ),
                array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
                    'template'=> '{download_item} {delete_item}',
                    'buttons'=>array(
                        'download_item' => array
                        (
                            'url'=>'Yii::app()->createAbsoluteUrl("site/download",array("class"=>"ProTransactionsPropertyDocument","file_id"=>$data->id,"field"=>"file_name"))',
                            'options' => array('class'=>'download_item'),
                            'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/download.png',
                        ),
                        'delete_item' => array
                        (
                            'url'=>'Yii::app()->createAbsoluteUrl("member/tenant/delete", array("document_id" => $data->id))',
                            'options' => array('class'=>'delete_item'),
                            'imageUrl'=>Yii::app()->theme->baseUrl . '/img/delete.png',
                            'visible' => '$data->user->role_id == ROLE_LANDLORD'
                        ),                        
                    ),
                )
	),
)); ?>