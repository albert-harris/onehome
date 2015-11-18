<?php
$this->breadcrumbs=array(
	'Group mapping',
);

$menus=array(
	array('label'=>'Create Group mapping', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('subscriber-group-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#subscriber-group-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('subscriber-group-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('subscriber-group-grid');
        }
    });
    return false;
});
");
?>

<h1>List Group mapping</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subscriber-group-grid',
	'dataProvider'=>$model->search(),
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
	'enableSorting' => false,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            array(
		'name'=>'name',
                'htmlOptions' => array('style' => 'text-align:center;')
                ),
            array(
            'header'=>'Status',
            'name'=>'status',
            'type'=>'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
            ),
		
		array(
                    'header'=>'Actions',
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
//                        'buttons'=>array(
//                            'delete'=>array(
//                                'visible'=>'count($data->subscriber_group)<1',
//                            ),
                       // ),                     
		),
	),
)); ?>
