<?php
$this->breadcrumbs = array(
    'Manage Categories',
);

$this->menu = array(
//    array('label' => 'List Categories', 'url' => array('index')),
    array('label' => 'Create Categories', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('categories-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Categories</h1>

<?php
$dataProvider = new CArrayDataProvider(Categories::model()->getCategoryTree());

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'categories-grid',
    'dataProvider' => $model->search(),
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
    'columns' => array(
	//'id',
	array(
	    'header' => 'Category Name',
	    'name'  => "category_name",
	    'type'  => 'html',
        ),
	array(
            'header' => 'Actions',
            'class'=>'CButtonColumn',
        	'template'=> ControllerActionsName::createIndexButtonRoles($actions,array('update')),
        	'buttons'=>array(
        	),
        ),
    ),
));
?>
