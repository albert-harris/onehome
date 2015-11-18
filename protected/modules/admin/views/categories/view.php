<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->category_name,
);

$menus = array(
array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>View Categories <?php echo $model->category_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'category_name',
//		'display_order',
//		array(
//			'name'=>'Published',
//			'value'=>(!empty($model->published) && $model->published==1) ? 'Yes' : 'No',
//		),
//	array(
//            'name'=>'parent',
//            'value'=>(!is_null(Categories::model()->findByPk($model->parent_id))?Categories::model()->findByPk($model->parent_id)->category_name:''),
//        ),
	),
)); ?>
