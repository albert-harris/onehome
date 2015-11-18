<?php
$this->breadcrumbs=array(
	'Service',
);
$menus=array(
	array('label'=>'Create Service', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('service-item-grid', {
		url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");
Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#service-item-grid a.ajaxupdate').live('click', function() {
	$.fn.yiiGridView.update('service-item-grid', {
		type: 'POST',
		url: $(this).attr('href'),
		success: function() {
			$.fn.yiiGridView.update('service-item-grid');
		}
	});
	return false;
});
");
$cat = ServiceCategory::model()->findByPk($model->parent_id);
?>
<h1>Services of <?= $cat->name ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'service-item-grid',
	'dataProvider'=>$model->searchItems(),
	'selectableRows' => 2,
	'columns'=>array(
		array(
			'header' => 'S/N',
			'type' => 'raw',
			'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
			'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
			'htmlOptions' => array('style' => 'text-align:center;')
		),
		'name',
		array
		(
			'class'=>'CButtonColumn',
			'template'=>'{up}',
			'buttons' => array(
				'up' => array(
					'label'=>'',
					'url'=>'Yii::app()->createAbsoluteUrl("admin/serviceCategory/up", array("id"=>$data->id))',
					'options'=>array(
						'class'=>'icon-chevron-up ajaxupdate',
						'title'=>'Move up',
					),
					'visible'=>'$data->getSibling(false)',
				)			
			),
		),
		array
		(
			'class'=>'CButtonColumn',
			'template'=>'{down}',
			'buttons' => array(
				'down' => array(
					'label'=>'',
					'url'=>'Yii::app()->createAbsoluteUrl("admin/serviceCategory/down", array("id"=>$data->id))',
					'options'=>array(
						'class'=>'icon-chevron-down ajaxupdate',
						'title'=>'Move down',
					),
					'visible'=>'$data->getSibling()',
				)			
			),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=> '{update} {delete}',
		),
	),
)); ?>
