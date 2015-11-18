<?php
/* @var $this CommissionController */

$this->breadcrumbs = array(
    'Commission scheme',
);
$menus = array(
    array('label' => Yii::t('translation', 'Create'), 'url' => array('create')),
);
$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);
?>
<h1>Commission scheme</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pages-grid',
    'dataProvider' => $model->search(),
    'afterAjaxUpdate' => 'function(id, data){ fixTargetBlank();}',
    'columns' => array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px', 'style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name' => 'Designation',
            'value' => '$data->name'
        ),
        array(
            'name' => 'Commission Scheme',
            'value' => '$data->percent."%"',
            'htmlOptions' => array('style' => 'text-align:right'),
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
//            'commission_received',
        array(
            'header' => 'Actions',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'delete' => array(
                    'visible' => '(ProCommission::visibleDeleteIcon($data->id))',
                ),
            ),
        )
    )
));
?>
