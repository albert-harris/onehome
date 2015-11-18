<?php
$this->breadcrumbs=array(
	'Invoice Management',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Invoice'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

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

<h1><?php echo Yii::t('translation', 'Invoices Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $cmsFormater = new CmsFormatter(); $total_amount = $cmsFormater->formatPrice(FiInvoice::getTotalAmountGst()); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fi-invoice-grid',
	'dataProvider'=>$model->searchMixed(),
	'enableSorting' => true,
        'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();  fnUpdateLink(); }',        
	'template'=>"<div class='item_b'>Total Amount: $total_amount</div>{summary}{items}{pager}",
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		array(
			'header'=>'Invoice No',
			'name'=>'invoice_no',
		),
		array(
			'header'=>'Invoice Date',
			'name'=>'created_date',
			'type' => 'date',
			'htmlOptions' => array('style' => 'text-align:center;')
		),
		array(
			'header'=>'Transaction No',
			'name'=>'transactions_no',
		),
		array(
			'header'=>'Property Address',
			'name'=>'property_address',
			'type'=>'raw',
		),
		array(
			'header'=>'Total Amount Due Gst',
			'name'=>'total_amount_due_gst',
		),
		array(
			'header'=>'Status',
			'name'=>'status',
		),
		array(
			'header' => 'Receipt',
			'name'=>'receipt',
			'type'=>'raw',
			'htmlOptions' => array('style' => 'text-align:center;')
		),
		array(
			'header' => 'Actions',
			'class'=>'CButtonColumn',
			'template'=> '{view}{update}{delete}',
			'buttons'=>array(
				'view'=>array(
					'url'=> '$data["viewUrl"]',
				),
				'update'=>array(
					'visible'=> 'isset($data["updateUrl"])',
					'url'=> '$data["updateUrl"]',
				),
				'delete'=>array(
					'visible'=> 'isset($data["deleteUrl"])',
					'url'=> '$data["deleteUrl"]',
				),
			),
		)
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