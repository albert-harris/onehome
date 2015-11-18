<?php
$this->breadcrumbs=array(
	'Contact Us Management',
);

$menus=array(
	//array('label'=> Yii::t('translation','Create ProContactUs'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-contact-us-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-contact-us-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-contact-us-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-contact-us-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Contact Us Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pro-contact-us-grid',
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
		 	'name'=>Yii::t('translation','enquiry_type'),
		 	'value'=>'$data->getType($data->enquiry_type)'
		 ),
		 Yii::t('translation','name'),
		 Yii::t('translation','position'),
		 Yii::t('translation','company'),
		array(
			'name'=>'phone',
			'headerHtmlOptions' => array('style' => 'text-align:center;'),
			'htmlOptions' => array('style' => 'text-align:right;')
		),		 
		 Yii::t('translation','email'),
		array(
			'name'=>'created_date',
			'type'=>'date'
		),
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
