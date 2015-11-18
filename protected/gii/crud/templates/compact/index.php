<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'" . $this->modelClass . "',
);\n";
?>

$menus=array(
	array('label'=> Yii::t('translation','Create <?php echo $this->modelClass; ?>'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#<?php echo $this->class2id($this->modelClass); ?>-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo "<?php echo Yii::t('translation', '".$this->pluralize($this->class2name($this->modelClass))." Management'); ?>"; ?></h1>

<?php echo "<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>"; ?>

<div class="search-form" style="display:none">
<?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'enableSorting' => false,
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
    if($column->name != 'id')
    {
        if(++$count==7)
		  echo "\t\t/*\n";
        echo "\t\t Yii::t('translation','".$column->name."'),\n";
    }
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
