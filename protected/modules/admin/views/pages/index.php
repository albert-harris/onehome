<?php
$this->breadcrumbs = array(
    'Page Management',
);

$menus = array(
    array('label' => Yii::t('translation', 'Create'), 'url' => array('create')),
);
$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pages-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pages-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pages-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pages-grid');
        }
    });
    return false;
});
");
?>

<h1>Page Management</h1>

<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));  ?>
<div class="search-form" style="display:none">
    <?php
//$this->renderPartial('_search',array(
//	'model'=>$model,
//)); 
    ?>
</div><!-- search-form -->

<?php
$visible = ControllerActionsName::checkVisibleButton($actions);

$p = new Pages();
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pages-grid',
//	'dataProvider'=>$model->search(),
    'dataProvider' => $model->searchPageBacked(),
    //'filter'=>$model,
    'columns' => array(
//        array(
//            'header' => 'S/N',
//            'type' => 'raw',
//            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
//            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
//            'htmlOptions' => array('style' => 'text-align:center;')
//        ),
//        'id'
        array(
            'header' => 'Page name',
            'name' => "title",
            'type' => 'html',
            'value' => '$data->level > 0 ? $data->buildLevelTreeCharacter($data->level) . $data->title . "</span>": $data->title'),
        array(
            'header' => 'URL',
            'type' => 'raw',
            'value' => 'CHtml::link(
                    Yii::app()->createAbsoluteUrl("page/index",array("slug"=> $data->slug)), 
                    Yii::app()->createAbsoluteUrl("page/index",array("slug"=> $data->slug)), 
                    array("target" => "_blank")
            )'
        ),
//        array(
//            'header'=>'Banner',
//            'type'=>'html',
//            'name'=>'featured_image',
//            'value'=> 'file_exists(Yii::getPathOfAlias("webroot")."/upload/admin/pages/".$data->id."/".$data->featured_image) ? CHtml::image(Yii::app()->baseUrl."/upload/admin/pages/".$data->id."/".$data->featured_image, "image", array("class"=>"b_img")):"";',
//            'htmlOptions' => array('style' => 'text-align:center;'),
//        ),
//        'short_content:html',
        array(
            'header' => 'Created Date',
            'type' => 'date',
            'name' => 'created',
            'value' => '$data->created',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'header' => 'Status',
            'name' => 'status',
            'type' => 'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
//            'value' => 'array("status"=>$data->status,"id"=>$data->id)',
            'visible' => $visible,
        ),
//        array(
//            'header'=>'Parent Page',
//            'name'=>'parent_id',
//            'value'=>'Pages::getPagesName($data->parent_id)',
//            'htmlOptions' => array('style' => 'text-align:center;'),
//        ),            
//            'order',
//            array(
//               'header' => 'View Banner',
//               'class' => 'CButtonColumn',
//               'template' => '{ViewImages}',
//
//               'buttons' => array(
//                   'ViewImages' => array(
//                       'label' => 'Images',
//                       'imageUrl' => Yii::app()->theme->baseUrl . '/admin/images/view_gallery.png',
////                            'options' => array('class' => 'show-images','target'=>'_blank'),
//                       'options' => array('class' => 'show-images'),
//                       'url' => 'Yii::app()->createAbsoluteUrl("admin/pages/listbanner/",array("id"=>$data->id))',
////                       'visible'=>'$data->visibleIcon($data->id)'
//                   ),
//
//               ),
//           ),
        array(
            'header' => 'Order',
            'name' => 'order',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value' => '$data->order',
        ),
        array(
            'header' => 'Show in footer',
            'name' => 'show_footer',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value' => '$data->show_footer == 1 ? "Show":"Unshow"',
        ),
//            array(
//            'header'=>'Position',
//            'name'=>'show_footer',
//            'htmlOptions' => array('style' => 'text-align:center;'),
//            'value'=> 'Pages::getPosition($data->show_footer)'
//        ),
        array(
            'header' => 'Actions',
            'class' => 'CButtonColumn',
//            'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view','update','delete')),
            'template' => '{view} {update} ', // anh dung May 26. 2014
//            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'delete' => array
                    (
                    'visible' => '($data->page_default == 0) ? 1 : 0'
                ),
            ),
        ),
    ),
));
?>
<style>
    .b_img{
        height: 109px !important;
    }
</style>