<?php
$this->breadcrumbs=array(
	'Module Management',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Module'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('categories-group-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#categories-group-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('categories-group-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('categories-group-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Module Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categories-group-grid',
	'dataProvider'=>$model->search(),
	'enableSorting' => false,
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		 Yii::t('translation','name'),

		 array(
                     'name'=>'course_id',
                      'value'=>'$data->course->name',
                 ),        
		 array(
                'name'=>'short_description',
                'type'=>'html',
                'value'=>'MyFunctionCustom::ShortenString($data->short_description, 60)',
        ),        
		 array(
                     'name'=>'order_at',
                      'htmlOptions' => array('style' => 'text-align:center;'),
                      'value'=>'$data->order_at',
                 ),        
		 array(
                     'name'=>'status',
                     'type'=>'status',
                      'htmlOptions' => array('style' => 'text-align:center;'),
                      'value'=>'array("status"=>$data->status,"id"=>$data->id)',
                 ),        
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
    