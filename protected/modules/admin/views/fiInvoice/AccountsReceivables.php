<?php
$this->breadcrumbs=array(
	'Account Receivables Management',
);

$menus=array(
	array('label'=> Yii::t('translation','Create FiInvoice'), 'url'=>array('create')),
);
//$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('fi-invoice-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#fi-invoice-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('fi-invoice-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('fi-invoice-grid');
        }
    });
    return false;
});
");
?>

<?php include '_tab_index.php'; ?>

<h1><?php echo Yii::t('translation', 'Account Receivables Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fi-invoice-grid',
	'dataProvider'=>$model->search(),
	'enableSorting' => false,
        'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();  fnUpdateLink(); }',        
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		 Yii::t('translation','invoice_no'),
		 Yii::t('translation','transactions_no'),
                array(
                    'name' => 'total_amount_due',
                    'type' => 'Price',
                    'htmlOptions' => array('style' => 'text-align:right;'),
                ),
                array(
                    'name' => 'status',
                    'value' => 'FiInvoice::$STA_STATUS[$data->status]', 
                    'htmlOptions' => array('style' => 'text-align:center;'),
                ),
                array(
                    'header' => 'Receipt',
                    'type' => 'InvoiceGenReceipt',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
		array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
                    'template'=> ControllerActionsName::createIndexButtonRoles($actions),
                    'buttons'=>array(
                        'update'=>array(
                            'visible'=> 'FiInvoice::CanUpdate($data)',
                        ),
                    ),
		),
	),
)); ?>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />
<script>
    $(function(){
        fnUpdateLink();        
    });
    
    function fnUpdateLink(){
        // for gen receipt
        $(".gen_receipt").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});
        // for gen receipt
    }

</script>