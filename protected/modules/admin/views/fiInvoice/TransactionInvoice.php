<?php
$this->breadcrumbs=array(
	'Transaction Invoice Management',
);

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

<h1><?php echo Yii::t('translation', 'Transaction Invoice Management'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php 
$this->renderPartial('_search_trans_invoice',array(
	'model'=>$model,
));

?>
</div><!-- search-form -->

<?php // $cmsFormater = new CmsFormatter(); $total_amount = $cmsFormater->formatPrice(FiInvoice::getTotalAmountGst()); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fi-invoice-grid',
	'dataProvider'=>$model->search(),
	'enableSorting' => false,
        'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();  fnUpdateLink(); }',        
//	'template'=>"<div class='item_b'>Total Amount: $total_amount</div>{summary}{items}{pager}",
//	'template'=>' <div class="table_scroll">{items}</div> 
//                        <div class="action-group clearfix">
//                           <div class="pager f-right">{pager}</div> 
//                           <div class="lb f-right">{summary}</div>               
//                     </div>                
//          ',
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
		 Yii::t('translation','invoice_number'),
                array(
                    'header' => 'Invoice Date',
                    'name' => 'created_date',
                    'type' => 'date',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
		 
                array(
                    'header' => 'Transactions No',
                    'type' => 'TransactionInvoiceTransNo',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align: center;')
                ),
                array(
                    'header' => 'Property Address',
                    'type' => 'TransactionPropertyName',
                    'value'=>'$data->rTransaction?$data->rTransaction:null',
//                    'htmlOptions' => array('style' => 'text-align: center;')
                ),
                array(
                    'header' => 'Total Amount',
                    'type' => 'TransactionInvoiceAmount',
                    'value'=>'$data',
                    'htmlOptions' => array('style' => 'text-align:right;'),
                ),
                
		array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
                    'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view')),
                    'buttons'=>array(
                        'view'=>array(
                            'url'=>'Yii::app()->createAbsoluteUrl("admin/transactions/viewInvoice",
                            array("id"=>$data->id, "from_trans_invoice"=>1))',
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
        // for gen receipt
    }

</script>