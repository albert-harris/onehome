<?php
/**
 * User: Kvan
 * Date: 4/23/14
 * Time: 2:29 PM
 * To change this template use File | Settings | File Templates.
 */
$this->breadcrumbs=array(
	'ALL ENQUIRIES'=>array('/member/enquiries'),
    $model->listing->property_name_or_address." Enquiry",
);

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name'=>'name',
            'header'=>'Property Name',
            'headerHtmlOptions'=>array('style'=>'width:200px;'),
            'value'=>isset($model->listing->property_name_or_address) ? $model->listing->property_name_or_address :""
        ),         
         array(
            'header'=>'Address',
            'name'=>'email',
            'type'=>'raw',
            'headerHtmlOptions'=>array('style'=>'width:200px;'),
        ),        
        
        
        
        
//        array(
//            'name' => 'From',
//            'value' => $model->email,
//        ),
//        array(
//            'name' => 'Name',
//            'value' => $model->name,
//        ),
        array(
            'name' => 'Phone',
            'value' => $model->phone,
        ),
        array(
            'name' => 'Country',
            'value' => $model->areaCode->area_name,
        ),
        'created_date:datetime',
        array(
            'name' => 'Message',
            'type'=>'html',
            'value' => nl2br(strip_tags($model->description)),
        ),        
    ),
));

?>
<br/><br/>
<h2>Replied Content</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'enquiry-grid-view',
    'dataProvider'=>$replyListData,
    'enableSorting' => true,
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
            'header' => 'No',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('class'=>'first','width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name'=>'subject',
            'header'=>'Subject',
            'value'=>'$data->subject',
            'headerHtmlOptions'=>array('style'=>'width:270px;'),
        ),
        array(
            'header'=>'To',
            'name'=>'email_to',
            'type'=>'raw',
            'headerHtmlOptions'=>array('style'=>'width:200px;'),
        ),
        array(
            'name'=>'message',
            'value'=>'$data->message',
            'headerHtmlOptions'=>array('style'=>'width:370px;'),
        ),
        array(
            'name'=>'created_date',
            'header'=>'Sent Date',
            'type'=>'datetime',
            'htmlOptions'=>array('style'=>'width: 200px;text-align:left;'),
        ),
    ),
)); ?>
