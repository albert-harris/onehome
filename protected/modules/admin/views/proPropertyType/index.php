<?php
$this->breadcrumbs=array(
	'Property Types Management',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Property Type'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-property-type-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-property-type-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-property-type-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-property-type-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Property Types Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pro-property-type-grid',
	'dataProvider'=>$model->search(),
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
    'template'=>'{summary}{items}{pager}',
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            'name',
//            array(
//                'name' => 'type',
//                'value' => '$data->parent?"":$data->type',
//            ),
            array(
                'name' => 'parent_id',
                'value' => '$data->parent?$data->parent->name:""',
            ),
//		 Yii::t('translation','display_order'),
            array(
                'name' => 'price_min',
                'type' => 'price',
                'htmlOptions' => array('style' => 'text-align:right;')
            ),
            array(
                'name' => 'price_max',
                'type' => 'price',
                'htmlOptions' => array('style' => 'text-align:right;')
            ),
            array(
                'name' => 'price_sign',
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            array(
                'name' => 'price_sign_position',
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            array(
                'name' => 'status',
                'type'=>'status',
                'value' => 'array("status"=>$data->status,"id"=>$data->id)',
                'htmlOptions' => array('style' => 'text-align:center;')
            ),		 
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
//                        'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view','update')),
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view','update','delete')),
		),
	),
)); ?>
