<?php
$this->breadcrumbs = array(
    'Page Management' => array('index'),
    $model->title,
);

if ($model->show_home_page == 0):
    $menus = array(
        array('label' => 'Page Management', 'url' => array('index')),
        array('label' => 'Update Page', 'url' => array('update', 'id' => $model->id)),
//        array('label' => 'Delete Page', 'url' => array('delete'), 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    );
else:
    $menus = array(
        array('label' => 'Page Management', 'url' => array('index')),
        array('label' => 'Update Page', 'url' => array('update', 'id' => $model->id)),
    );
endif;

$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Page: <?php echo $model->title; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'title',
            'value' => $model->title
        ),
        array(
            'name' => 'Banner',
            'type' => 'html',
            'value' => (!empty($model->banner)) ? CHtml::image(Yii::app()->createAbsoluteUrl('/upload/page/300x/' . $model->banner)) : ''
        ),
        array(
            'name' => 'URL',
            'type' => 'html',
            'value' => CHtml::link(
                    Yii::app()->createAbsoluteUrl('page/index', array('slug' => $model->slug)), Yii::app()->createAbsoluteUrl('page/index', array('slug' => $model->slug)), array("target" => "_blank")
            ),
        ),
        array(
            'name' => 'External Link',
            'type' => 'html',
            'value' => CHtml::link(
                    $model->external_link, array("target" => "_blank")
            ),
        ),
         array(
           'name' => 'title_tag',
           'type' => 'html',
           'value' => $model->title_tag
       ),
//        array(
//            'name' => 'short_content',
//            'type' => 'html',
//            'value' => $model->short_content
//        ),
//        array(
//            'name' => 'banner_description',
//            'type' => 'html',
//            'value' => Pages::model()->localized()->findByPk($model->id)->banner_description
//        ),
        array(
            'name' => 'status',
            'value' => (!empty($model->status) && $model->status == 1) ? 'Active' : 'Inactive',
        ),
    
        'meta_keywords',
        'meta_desc',

        'created:date',
        array(
            'name' => 'Parent Page',
            'value' => $model->parent_id != 0 ? Pages::getPagesName($model->parent_id) : '',
        ),
        'order',
        array(
            'name' => 'show_home_page',
            'value' => $model->show_home_page == 1 ? "Show" : "Unshow",
        ),
        array(
            'name' => 'show_footer',
            'value' => $model->show_footer == 1 ? "Show" : "Unshow",
        ),
//		array(
//			'name'=>'Thumb File',
//            'type'=>'raw',
//            'value' => $model->thumb_image != '' ? CHtml::image(Yii::app()->createAbsoluteUrl(('/upload/admin/'. Pages::$folderUpload.'/'.$model->id.'/204x94/'.$model->thumb_image ))) : '',
//		),  
        array(
            'name' => 'content',
            'type' => 'html',
            'value' => $model->content
        ),
    ),
));
?>