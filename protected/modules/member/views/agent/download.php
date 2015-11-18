<div class="breadcrumb">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('/');?>">Home</a>
    &raquo; <strong>All Downloadable Document</strong></div>
<div>
<h3 class='report' >ALL DOWNLOADABLE DOCUMENT</h3>
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
//                    'type'=>'DocumentAdmin',
//                    'value' => '$data'
                    'value' => '$data->file_name'
                ),
                array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
                    'template'=> '{download_item}',
                    'buttons'=>array(
                        'download_item' => array
                        (
                            'url'=>'Yii::app()->createAbsoluteUrl("site/download",array("class"=>"ProUploadDocument","file_id"=>$data->id,"field"=>"file_name"))',
                            'options' => array('class'=>'download_item'),
                            'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/download.png',
                        ),
                    ),
                )
	),
)); ?>


<style> 
    .listing_manager .selected a {color:#333333 !important; }
    #document-grid table.items {width:100% !important;}
</style>
