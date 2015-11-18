<?php
$this->breadcrumbs = array(
    'Banner Management',
);

$menus = array(
    array('label' => 'Create Banner', 'url' => array('create')),
);
$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('banners-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#banners-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('banners-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('banners-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Banner Management') ?></h1>

<?php echo CHtml::link(Yii::t('translation', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'banners-grid',
    'dataProvider' => $model->search(),
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
    //'filter'=>$model,
//    'enableSorting' => FALSE,
    'columns' => array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px', 'style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name' => 'banner_title',
            'type' => 'html',
        ),
        array(
            'name' => 'large_image',
            'type' => 'BannerImageBe',
            'value' => '$data',
            'htmlOptions' => array('style' => 'text-align:center;width:600px;'),
//            'value' => 'file_exists(Yii::getPathOfAlias("webroot")."/upload/admin/banner/".$data->id."/".$data->large_image) ? CHtml::image(Yii::app()->baseUrl."/upload/admin/banner/".$data->id."/".$data->large_image, "image", array("class"=>"b_img")):"";'
        ),

        array(
            'header' => 'Banner Type',
            'name' => 'banner_type',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value' => 'Banners::$bannerType[$data->banner_type]',
        ),
//        array(
//            'name' => 'order_by',
//            'htmlOptions' => array('style' => 'text-align:center;'),
//            'value' => '$data->order_by',
//        ),
        
        array(
            'name' => 'status',
            'type' => 'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
//            'value' => 'array("status"=>$data->status,"id"=>$data->id)',
        ),
        'created_date:date',
        array(
            'header' => 'Actions',
            'class' => 'CButtonColumn',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions),
            'buttons' => array(
//                'delete' => array('visible' => '($data->order_by == 1) ? 1 : 0'),
            ),
        ),
    ),
));
?>
<style>
    .b_img{
        height: 70px !important;
    }
</style>
