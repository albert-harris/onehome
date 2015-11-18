<?php
$this->breadcrumbs=array(
	'Global Enquiry Management',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-global-enquiry-grid', {
        url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-global-enquiry-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-global-enquiry-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-global-enquiry-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Global Enquiry Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pro-global-enquiry-grid',
	'dataProvider'=>$model->search(),
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
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
        array(
            'name' =>'type_enquiry',
            'type'=>'raw',
        ),
//        array(
//            'name' => 'property_type_id',
//            'type'=>'raw',
//            'value' => '$data->property->name'
//        ),
        Yii::t('translation','name'),
        Yii::t('translation','email'),
        Yii::t('translation','phone'),
        array(
            'name' => 'country_id',
            'type'=>'raw',
            'value' => '$data->areaCode->area_name'
        ),
        array(
            'name' => 'created_date',
            'type'=>'dateTime',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
