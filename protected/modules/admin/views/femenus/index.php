<?php
$this->breadcrumbs=array(
	'Fe Menus',
);

$menus=array(
	array('label'=>'Create Fe Menu', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('fe-menus-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#fe-menus-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('fe-menus-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('fe-menus-grid');
        }
    });
    return false;
});
");
?>

<h1>List Fe Menus</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fe-menus-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		'name',
                array(
                    'name'=>'link',
                    'value'=>'($data->type=="page") ? "" : "$data->link"'
                ),
		array(
                    'name'=>'order',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                ),
                array(
                    'name'=>'type',
                    'value'=>'($data->type=="page") ? "Page" : "Custom URL"'                    
                ),
                array(
                    'name'=>'parent_id',
                    'header'=>'Parent menu',
                    'value'=>'(!is_null(FeMenus::model()->findByPk($data->parent_id))?FeMenus::model()->findByPk($data->parent_id)->name:"")',
                    'filter'=>FeMenus::getDropDownList("FeMenus[parent_id]","FeMenus_parent_id",0,true),
                    'htmlOptions' => array('style' => 'text-align:center;'),
                ),
                array(
                    'name'=>'place_holder_id',
                    'value'=>'$data->place_holder->position'            
                ),
		array(
                    'name'=>'status',
                    'type'=>'status',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'value'=>'array("status"=>$data->status,"id"=>$data->id)',
                ),
		array(
                    'class'=>'CButtonColumn',
                    'template'=> ControllerActionsName::createIndexButtonRoles($actions),
                    'buttons'=>array(
                        'delete'=>array(
                             'visible'=>'FeMenus::canDelete($data->id)==true'
                        ),
                    ),
		),
	),
)); ?>
