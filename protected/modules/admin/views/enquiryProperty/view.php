<?php
$this->breadcrumbs=array(
	'Enquiry of Property Management'=>array('index'),
	'View Enquiry'
);

$menus = array(
	array('label'=>'Delete Enquiry', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Enquiry of Property #<?php echo $model->listing->property_name_or_address; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
     array(
            'name' => 'property_id',
            'type'=>'raw',
            'value' => $model->listing->property_name_or_address
        ),
		Yii::t('translation','name'),
		Yii::t('translation','email'),
		Yii::t('translation','phone'),
        array(
            'name' => 'country_id',
            'type'=>'raw',
            'value' => isset($model->areaCode) ? $model->areaCode->area_name : ''
        ),
        array(
            'name' => 'description',
            'type'=>'html',
            'value' => nl2br(strip_tags($model->description))
        ),
	),
)); ?>
