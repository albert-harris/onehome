<?php
$this->breadcrumbs=array(
	'Testimonial Management',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Testimonial'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-testimonial-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-testimonial-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-testimonial-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-testimonial-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Testimonial Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pro-testimonial-grid',
	'dataProvider'=>$model->search(),
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
//	'enableSorting' => false,
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
//             Yii::t('translation','title'),
		array(
                    'name' => 'name',
                    'htmlOptions' => array('style' => 'width:100px;'),
                ),
		array(
                    'name' => 'type',
                    'type' => 'TestimonialType',
                    'value' => '$data',
                    'htmlOptions' => array('style' => 'width:100px;'),
                ),
		 array(
                    'name' => 'description',
                    'type' => 'html',
                    'value' => 'nl2br($data->description)',
                ),
		 array(
                    'name' => 'status',
                    'type' => 'status',
                    'htmlOptions' => array('style' => 'text-align:center;'),
//                    'value' => 'array("status"=>$data->status,"id"=>$data->id)',
                ),
		array(
                    'name' => 'is_member',
                    'type' => 'TestimonialCreatedBy',
                    'value' => '$data',
                    'htmlOptions' => array('style' => 'width:120px;'),
                ),
		array(
                    'name' => 'created_date',
                    'type' => 'datetime',
                    'htmlOptions' => array('style' => 'text-align:center; width:80px;'),
                ),
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
