<?php
/* @var $model ServiceRegistration */

$this->breadcrumbs=array(
	'Service Registration Management',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('service-registration-grid', {
        url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#service-registration-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('service-registration-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('service-registration-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Service Registration Management'); ?></h1>

<?php //echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'service-registration-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'header' => 'Name',
			'name'=>'fullname',
		),
		'email',
		'contact_no',
		'preferedTimeText',
        array(
            'name' => 'created_at',
            'type'=>'dateTime',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
            'template'=> '{view}{delete}',
		),
	),
)); ?>
