<?php
$this->breadcrumbs=array(
	'Transactions Management'=>array('transactions/index'),
	'Voucher List of Transaction: '.$mTrans->transactions_no,
);

$menus=array(
	array('label'=> 'Create Voucher', 'url'=>array('create', 'id'=>$mTrans->id), 'moreClass'=>'createCallsLog'),
);
$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);
//$this->menu[] = array('label'=> 'Transactions Management', 'url'=>array('transactions/index'));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-transactions-invoice-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-transactions-invoice-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-transactions-invoice-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-transactions-invoice-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo 'Voucher List of Transaction: '.$mTrans->transactions_no; ?></h1>

<?php // echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pro-transactions-invoice-grid',
	'dataProvider'=>$model->search(),
	'enableSorting' => false,
        'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank(); fnUpdateColorbox(); }',        
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            
        array(
            'name' => 'voucher_no',
            'htmlOptions' => array('class'=>'','style' => 'text-align:center;'),
        ),            
        array(
            'name' => 'voucher_pay_to',
            'type'=>'FullNameRegisteredUsers',
            'value'=>'$data->rPayToUser',
            'htmlOptions' => array('class'=>'','style' => 'text-align:center;'),
        ),            
            
        array(
            'header' => 'Total Net Comm',
            'name' => 'voucher_no',
            'value' => 'ProTransactionsInvoice::calcTotalNetComm($data, $data->rTransaction)',
            'type' => 'price',
            'htmlOptions' => array('class'=>'','style' => 'text-align:right;'),
        ),            
        array(
            'name' => 'receipt_date_paid',
            'type' => 'date',
            'htmlOptions' => array('class'=>'','style' => 'text-align:center;'),
        ),            
        array(
            'name' => 'created_date',
            'type' => 'date',
            'htmlOptions' => array('class'=>'','style' => 'text-align:center;'),
        ),            
		 
        array(
            'header' => 'Actions',
            'class'=>'CButtonColumn',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view', 'delete')),
            'buttons'=>array(
                    'view'=>array(
                        'label'=>'View ',
                        'url'=>'Yii::app()->createAbsoluteUrl("admin/transactions/viewInvoice",
                            array("id"=>$data->id, "transactionsVoucher"=>1))',
                    ),
                ), 
        ),
	),
)); ?>


<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />

<script>
$(document).ready(function() {
    fnUpdateColorbox();
});

function fnUpdateColorbox(){    
    $(".createCallsLog a").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});    
}
</script>