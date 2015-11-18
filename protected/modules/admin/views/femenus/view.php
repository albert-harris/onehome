<?php
$this->breadcrumbs=array(
	'Fe Menus'=>array('index'),
	$model->name,
);

$menus = array(
	array('label'=>'Fe Menus Management', 'url'=>array('index')),
	array('label'=>'Create Fe Menu', 'url'=>array('create')),
	array('label'=>'Update Fe Menu', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Fe Menu', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Fe Menu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'link',
		'order',
                array(
                    'name'=>'required_login',
                    'value'=>($model->required_login==1) ? "Yes" : "No"                 
                ),
		array(
                    'name'=>'status',
                    'value'=>($model->status==1) ? "Active" : "Inactive"                  
                ),
		array(
                    'name'=>'type',
                    'value'=>($model->type=="page") ? "Page" : "Custom URL"                  
                ),
		array(
                    'name'=>'parent_id',
                    'value'=>(!is_null(FeMenus::model()->findByPk($model->parent_id))?FeMenus::model()->findByPk($model->parent_id)->name:""),
                ),
                array(
                    'name'=>'place_holder_id',
                    'value'=>$model->place_holder->position                  
                ),
	),
)); ?>
