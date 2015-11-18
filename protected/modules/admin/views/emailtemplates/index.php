<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: index.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<?php
$this->breadcrumbs=array(
	'Email Template Management',
);

$menus=array(
    array('label'=>'Email Template Management', 'url'=>array('index')),
//    array('label'=>'Create Email Template', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('email-templates-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Email Template Management</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<div style="width: 700px;" >
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'email-templates-grid',
    'dataProvider'=>$model->search(),
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
        'email_subject',
        //'email_body',
        'parameter_description',
        array(
            'header' => 'Actions',
            'class'=>'CButtonColumn',
        	'template'=> ControllerActionsName::createIndexButtonRoles($actions,array('view','update')),
        	'buttons'=>array(
        	),
        ),
    ),
)); ?>
</div>
