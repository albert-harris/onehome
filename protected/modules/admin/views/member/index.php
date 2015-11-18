<?php
$this->breadcrumbs=array(
	'Member',
);

$this->menu=array(
	array('label'=>'List Member', 'url'=>'', 'active'=>true),
    array('label'=>'Export Excel', 'url'=>array('exportExcel')),
	array('label'=>'Create Member', 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('member-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#member-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('member-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('member-grid');
        }
    });
    return false;
});
");
?>

<h1>List Members</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'member-grid',
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
		'username',
		'created_time:datetime',
		'last_login:datetime',
		'last_login_ip',
		array(
            'name'=>'status',
            'type'=>'status',
            'value'=>'array("id"=>$data->id, "status"=>$data->status)',
        ),
		'email:email',
		array(
			'class'=>'CButtonColumn',
			'deleteConfirmation' =>'Are you sure want to permanently delete this user?',
            'buttons'=>array(
                'update'=>array(
                    'visible'=>'Yii::app()->user->checkAccess("update")'
                ),
                'delete'=>array(
                    'visible'=>'Yii::app()->user->checkAccess("delete")'
                ),
            ),
		),
	),
)); ?>
