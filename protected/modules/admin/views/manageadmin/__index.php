<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>'', 'active'=>true),
	array('label'=>'Create Users', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
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

<h1>List Users</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$row+1',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
	//	'id',
		'username',
		'email',
	//	'password',
		'fullname',
	//	'nric',
		/*
		'mcr',
		'contact_number',
		'contact_name',
		'address',
		'post_code',
		'zone',
		'created_date',
		'application_id',
		'role_id',
		'last_login',
		'last_login_ip',
		'status',
		'deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
=======
<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>'', 'active'=>true),
	array('label'=>'Create Users', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
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

<h1>List Users</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$row+1',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
//		'id',
		'username',
		'email',
//		'password',
		'fullname',
		'nric',
		/*
		'mcr',
		'contact_number',
		'contact_name',
		'address',
		'post_code',
		'zone',
		'created_date',
		'application_id',
		'role_id',
		'last_login',
		'last_login_ip',
		'status',
		'deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
