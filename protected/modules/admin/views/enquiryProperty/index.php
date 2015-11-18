<?php
$this->breadcrumbs=array(
	'Enquiry of Property',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-enquiry-property-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");
//abbamariahcareynumberone@gmail.com
Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-enquiry-property-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-enquiry-property-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-enquiry-property-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Enquiry of Property Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pro-enquiry-property-grid',
	'dataProvider'=>$model->search(),
	'enableSorting' => false,
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
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
            'name' => 'property_id',
            'type'=>'raw',
            'value' => '$data->listing->property_name_or_address'
        ),
		Yii::t('translation','name'),
		Yii::t('translation','email'),
		Yii::t('translation','phone'),
        array(
            'name' => 'country_id',
            'type'=>'raw',
            'value' => '$data->areaCode->area_name'
        ),
		'created_date:date',
//        array(
//            'name' => 'description',
//            'type'=>'html',
//            'value' => '$data->description'
//        ),
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
