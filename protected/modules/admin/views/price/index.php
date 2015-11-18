<?php
/* @var $this FloorController */

$this->breadcrumbs=array(
	'Price For Sale',
);
$menus=array(
    array('label'=>Yii::t('translation', 'Create'), 'url'=>array('create')),

);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('price-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Price For Sale</h1>
<?php // echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-grid',
        'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
	'dataProvider'=>$model->search(),
	'columns'=>array(
            array(
                'header' => 'S/N',
                'type' => 'raw',
                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
//            array(
//                'name' => 'name',
//                'value' => '$data->name'
//            ),  
            array(
                'name' => 'value',
                'type' => 'price',
//                'value' => '$data->value',
                'htmlOptions' => array('style' => 'text-align:right;')
            ), 
//            array(
//                'type' => 'mtype',
//                'name' => 'type',
//                'value' => '$data->type',
//                'htmlOptions' => array('style' => 'text-align:center;')
//            ),
            array(
                'header' => 'Actions',
                'class'=>'CButtonColumn',
                'template'=> '{update}{delete}',    
            )
        )
    ));
    
 
?>

