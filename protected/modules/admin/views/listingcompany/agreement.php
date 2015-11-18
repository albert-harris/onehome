<?php
$this->breadcrumbs=array(
	'T&C Company Listing Agreements',
);

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#listing-company-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('listing-company-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('listing-company-grid');
        }
    });
    return false;
});
");
?>
<h1>T&amp;C Company Listing Agreements</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'listing-company-grid',
	'dataProvider'=> $model->search(),
	'enableSorting' => false,
	'columns'=>array(
		array(
			'header' => 'S/N',
			'type' => 'raw',
			'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
			'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
			'htmlOptions' => array('style' => 'text-align:center;')
		),
		'agentName',
		'location1',
		'location2',
		'location3',
	),
)); 
?>