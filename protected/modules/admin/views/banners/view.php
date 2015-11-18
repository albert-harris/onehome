<?php
$this->breadcrumbs = array(
    Yii::t('translation', 'Banner Management') => array('index'),
    Yii::t('translation', 'View Banner: ').$model->banner_title,
);
    $menus = array(
        array('label' => Yii::t('translation', 'Banner Management'), 'url' => array('index')),
        array('label' => Yii::t('translation', 'Create Banner'), 'url' => array('create')),
        array('label' => Yii::t('translation', 'Update Banner'), 'url' => array('update', 'id' => $model->id)));

$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);

$description = '';
$description .='<p>' . nl2br($model->banner_description) . '</p>';
$title = '';
$title .='<p>' . nl2br($model->banner_title) . '</p>';

$url = CHtml::link($model->link, $model->link, array("target" => "_blank"));
$str = $model->banner_title;
$str = str_replace("<br>", " ", $str);
$arr_name = explode(" ", $str);
?>
<h1>View Banner: <?php echo $model->banner_title; ?></h1>
<!--<h1>View Banner [<?php
if (count($arr_name) > 2) {
    echo $arr_name[0] . '...';
} else {
    echo $arr_name[0];
}
?>]</h1> -->
<?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            array(
                'name' => 'banner_title',
                'value' => $title,
                'type' => 'html',
            ),
            array(
                'name' => 'banner_type',
                'htmlOptions' => array('style' => 'text-align:center;'),
                'value' => Banners::$bannerType[$model->banner_type],
            ),
            array(
                'name' => 'large_image',
                'value' => CHtml::image($model->getImageUrl()),
				'type' => 'raw',
                'htmlOptions' => array('style' => 'text-align:center;width:600px;'),
//                'value' => file_exists(Yii::getPathOfAlias("webroot")."/upload/admin/banner/".$model->id."/".$model->large_image) ? CHtml::image(Yii::app()->baseUrl."/upload/admin/banner/".$model->id."/".$model->large_image, "image", array("class"=>"b_img","style"=>'height:70px')):"",
            ),
            
            array(
                'name' => 'banner_description',
                'value' => $model->banner_description,
                'type' => 'html',
            ),
            array(
                'name' => 'link',
                'value' => $url,
                'type' => 'html',
            ),
            
//            array(
//                'name' => 'order_by',
//                'value' => $model->order_by,
//            ),
            array(
                'name' => Yii::t('translation', 'status'),
                'type' => 'status',
            ),
            'created_date:date',
        ),
    ));

   
?>

