<?php
$this->breadcrumbs = array(
    'Locations Management',
);

$menus = array(
    array('label' => Yii::t('translation', 'Create'), 'url' => array('create')),
);
$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-location-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-location-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-location-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-location-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Locations Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pro-location-grid',
    'dataProvider' => $model->search(),
    'enableSorting' => false,
    'afterAjaxUpdate' => 'function(id, data){ fixTargetBlank();}',
    //'filter'=>$model,
    'columns' => array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px', 'style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        Yii::t('translation', 'name'),
//        Yii::t('translation', 'status'),
//        Yii::t('translation', 'created_date'),
        array(
            'header' => 'Actions',
            'class' => 'CButtonColumn',
            'template' => ControllerActionsName::createIndexButtonRoles($actions),
        ),
    ),
));
?>
