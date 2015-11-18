<?php
$this->breadcrumbs=array(
	'Bank Evaluation Report',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Bank Valuation Request'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bank-request-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#bank-request-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('bank-request-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('bank-request-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Bank Evaluation Report'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bank-request-grid',
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
		 Yii::t('translation','property_name_or_address'),
		 Yii::t('translation','postal_code'),
//		 Yii::t('translation','unit_from'),
//		 Yii::t('translation','unit_to'),
                array(
                    'name'=>'location_id',
                    'value'=>'ProLocation::getNameWithDistrict($data->location_id)',
                ),
//                array(
//                    'name'=>'property_type_id',
//                    'value'=>'$data->property?$data->property->name:""',
//                ),
		/*
		 Yii::t('translation','tenure'),
		 Yii::t('translation','furnished'),
		 Yii::t('translation','of_bathrooms'),
		 Yii::t('translation','of_bedroom'),
		 Yii::t('translation','type_selling'),
		 Yii::t('translation','floor_area'),
		 Yii::t('translation','tenancy_expiry_date'),
		 Yii::t('translation','monthly_rental_amount'),
		 Yii::t('translation','remark'),
		 Yii::t('translation','nric'),
		 Yii::t('translation','owner_particular'),
		 Yii::t('translation','fullname'),
		 Yii::t('translation','contact_no'),
		 Yii::t('translation','email'),
		 Yii::t('translation','target_price'),
		*/
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
