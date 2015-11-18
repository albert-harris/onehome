<?php
$this->breadcrumbs=array(
	'Registered Users Management',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Registered Users'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#users-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('users-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('users-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Registered Users Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->searchForProperty(),
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name'=>'full_name',
            'header' => 'Full Name',
            'type'=>'FullNameRegisteredUsers',
            'value'=>'$data',
        ),
        'nric_passportno_roc',
//        array(
//            'name'=>'id_type',
//            'type'=>'LandLorIdType',
//            'value'=>'$data',
//        ),
        'email',
//        'contact_no',
        'address',
        array(
            'header'=>'Subscriber Newsletter',
            'name'=>'is_subscriber',
            'type'=>'YNStatus',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name'=>'status',
            'type'=>'status',
            'value'=>'array("status"=>$data->status,"id"=>$data->id)',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name'=>'created_date',
            'type'=>'datetime',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'header' => 'Actions',
            'class'=>'CButtonColumn',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions),
        ),
	),
)); ?>
