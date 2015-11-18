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
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
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

<h1>List <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>

<?php echo "<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>"; ?>

<div class="search-form" style="display:none">
<?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<form method="post" id="actionForm" action="" style=" padding-top: 20px;">
<?php echo "<?php"; ?> echo Chtml::dropDownList('status', null, array(null => 'Change status', 1=>'Active', 0=>'Inactive'), array('style' => "width: 155px;")); ?>
<input name="selectedField" type="hidden" value="" />
<button id="button-change" style="padding: 0 10px 0 10px; margin-left: 10px;" type="submit">Change</button>
</form>

<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
    'selectableRows' => 2,
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
	if(++$count==7)
		echo "\t\t/*\n";
        if($column->name != 'id')
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'CButtonColumn',
                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>

<script>
$("#button-change").click(function(){
    var atLeastOneIsChecked = $('input[name="chk[]"]:checked').length > 0;
    var status = $('#status').val();
        var df = $('input[name="chk[]"]:checked').map(function(){ return $(this).val(); }).get().join(",");       

        if (!atLeastOneIsChecked || status == "")
        {
                alert('Please select at least one item and status to change');
        }
        else if (window.confirm('Are you sure you want to change these items?'))
        {
                $('input[name="selectedField"]').val(df);                
                $('#actionForm').submit();                
        }
        return false;
});
</script>
