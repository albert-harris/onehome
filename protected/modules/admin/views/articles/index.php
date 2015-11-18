<?php
$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Manage',
);

$menus=array(
	array('label'=>'Create Articles', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('articles-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#articles-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('articles-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('articles-grid');
        }
    });
    return false;
});
");

?>



<h1>Articles Management</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'articles-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
	'columns'=>array(
		//'id',
		'title',
                array(
                    'header' => 'Author',
                    'name'=>'user_id',
                    'value'=> '$data->user->first_name." ".$data->user->last_name',
                ),            
		//'content',
                array(
                    'name'=>'created_date',
                    'value'=> '($data->created_date!= "0000-00-00 00:00:00") ? date(ActiveRecord::getDateFormatPhp()." H:i" ,strtotime($data->created_date)) : ""',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
            
                array(
                    'name'=>'status',
                    'value'=> 'Articles::$articleStatus[$data->status]',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),            
		array(
			'class'=>'CButtonColumn',
                    'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
