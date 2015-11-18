<?php
$this->breadcrumbs=array(
    'Roles Menus'
);

$this->menu=array(
    array('label'=>'List Menus', 'url'=>array('/admin/menus')),
    array('label'=>'Menu of This Role', 'url'=>array('/admin/menus/view/id/'.$id)),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});


$('#add_roles').submit(function(){
    if($('#RolesMenus_role_id_em_').css('display') == 'none'){
        $.fn.yiiGridView.update('roles-menus-grid', {
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function() {
                $.fn.yiiGridView.update('roles-menus-grid');
            }
        });
        return false;
    }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#roles-menus-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('banner-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('banner-grid');
        }
    });
    return false;
});
");

?>

<h1>Manage Roles of <?php echo $menus->menu_name; ?></h1>

<?php echo CHtml::link('ADD ROLE','#',array('class'=>'search-button add')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
    'model'=>$model,
    'id'=>$id,
)); ?>
</div><!-- search-form -->
<div style="width: 40%;">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'roles-menus-grid',
    'dataProvider'=>$model->search(),
    //'filter'=>$model,
    'columns'=>array(
        //'id',
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$row+1',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name'=>'role_id',
            'value'=>'$data->role->role_name',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
        ),
    ),
)); ?>
</div>

