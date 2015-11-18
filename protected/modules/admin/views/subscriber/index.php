<?php
$this->breadcrumbs=array(
	'Subscriber-Public Management',
);

$menus=array(
	array('label'=>'Create Subscriber-Public', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('subscriber-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#subscriber-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('subscriber-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('subscriber-grid');
        }
    });
    return false;
});
");
?>

<h1>Subscriber-Public Management</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<!--<div style="width:700px;">-->
<?php
$visible = ControllerActionsName::checkVisibleButton($actions);


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subscriber-grid',
	'dataProvider'=>$model->search(),
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
	'enableSorting' => false,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$row+1',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
//		'id',
		'name',
		'email:email',
//		array(
//                    'header'=>'Status',
//                    'name'=>'status',
//                    'type'=>'status',
//                    'htmlOptions' => array('style' => 'text-align:center;'),
//                    'value'=>'array("status"=>$data->status,"id"=>$data->id)',
//                    'visible'=>$visible,
//                ),
            
		array(
                    'name'=>'subscriber_group_id',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'value'=>'$data->subscriber_group?$data->subscriber_group->name:""',
                ),

		array(
                    'class'=>'CButtonColumn',
                    'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('update','delete')),
		),
	),
)); ?>
<!--</div>-->