<?php
/* @var $this CommissionController */

$this->breadcrumbs=array(
	'Tier Management',
);
?>
<h1>Tier Management</h1>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pages-grid',
        'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
	'dataProvider'=>$model->search(),
	'columns'=>array(
            array(
                'header' => 'S/N',
                'type' => 'raw',
                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            array(
                'name' => "Name",
                'value' => '$data->name'
            ),
            array(
                'name' => 'First Tier',
                'value' => '$data->first_tier."%"',
                'htmlOptions' => array('style' => 'text-align:right'),
            ),   
            array(
                'name' => 'Second Tier',
                'value' => '$data->second_tier."%"',
                'htmlOptions' => array('style' => 'text-align:right'),
            ),
            array(
                'header' => 'Actions',
                'class'=>'CButtonColumn',
                'template'=> '{update}',    
            )
        )
    ));
    
 
?>
