<?php
$this->breadcrumbs=array(
	'Members',
);

$menus=array(
//	array('label'=> Yii::t('translation','Create Member'), 'url'=>array('create')),  
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-model-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#users-model-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('users-model-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('users-model-grid');
        }
    });
    return false;
});
");

?>

<h1>List subscriber Members</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
   
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-model-grid',
	'dataProvider'=>$model->search(),
        'enableSorting' => false,
//	'filter'=>$model,
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
                'type'=>'raw',
                'value'=>'$data->first_name." ".$data->last_name',
            ),        

            'email',

             array(
                'name'=>'status',
                'type'=>'status',
                'htmlOptions' => array('style' => 'text-align:center;'),
                'value'=>'array("status"=>$data->status,"id"=>$data->id)',
                            'filter' => array('1'=>'Yes','0' => 'No')
            ),
        
       
	),
)); ?>
