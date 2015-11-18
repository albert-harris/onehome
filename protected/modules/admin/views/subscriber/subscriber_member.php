<?php
$this->breadcrumbs=array(
	'Subscriber Management',
);

$menus=array(
//	array('label'=>'Create Subscriber', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('subscriber-member-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#subscriber-member-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('subscriber-member-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('subscriber-member-grid');
        }
    });
    return false;
});
");
?>

<h1>Subscriber Member Management</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search_member',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div style="width:700px;">
<?php
$visible = ControllerActionsName::checkVisibleButton($actions);


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subscriber-member-grid',
	'dataProvider'=>$model->search_subscriber(),
//	'enableSorting' => false,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$row+1',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
                array(
                    'name'=>'full_name',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'value'=>'$data->first_name." ".$data->last_name',
                ),
		'email:email',
            array(
                    'header'=>'Subscriber Group',
                    'name'=>'role_id',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'value'=>'($data->role_id!="")?Subscriber::$groupUsers[$data->role_id]:""',
                ),
            array(
                    'name'=>'status',
                    'value'=>'Users::$requestStatus[$data->status]',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                ),
//		array(
//			'class'=>'CButtonColumn',
//                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),  
//			'buttons'=>array(
//                            'view'=>array(
//                                    'visible'=>''
//                            ),
//			),
//		),
	),
)); ?>
</div>