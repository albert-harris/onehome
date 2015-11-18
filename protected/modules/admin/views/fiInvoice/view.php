<?php
$this->breadcrumbs=array(
	'Invoice Management'=>array('index'),
	$model->invoice_no,
);

$menus = array(
	array('label'=>'Invoice Management', 'url'=>array('index')),
	array('label'=>'Create Invoice', 'url'=>array('create')),
	array('label'=>'Update Invoice', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Invoice', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
$model->aModelDetail = $model->rDetail;
$cmsFormater = new CmsFormatter();

$InvoiceNumber = $model->invoice_no;
$InvoiceDate = $cmsFormater->formatDate($model->created_date);

// invoice normal
//$BillTo = FiInvoice::$STA_BILL_TO[$model->bill_to];
$CommissionAmount = $model->total_amount_due_gst;
$BillTo = $model->user_name;
$BillingAddress = $model->user_billing_address;
$PostalCode = $model->user_postal_code;

    
$CommissionAmountInText = NumberToText::convertNumber($CommissionAmount);
$CommissionAmountFormat = $cmsFormater->formatPrice($CommissionAmount);
//
//$CreatedDate = $cmsFormater->formatDate($model->created_date);
//$ReceiptDatePaid = $cmsFormater->formatDate($model->receipt_date_paid);
//$ReceiptInvoice = ProTransactionsInvoice::getReceiptInvoiceNo($model);

?>

<div class="sprint l_padding_140">
    <a class="button_print" href="javascript:void(0);" title="Print">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/print.png">
    </a>
</div>
<script  src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.printElement.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print_invoice.css" />
<script type="text/javascript">
    $(document).ready(function(){
        $(".button_print").click(function(){
            $('#printElement').printElement({ overrideElementCSS: ['<?php echo Yii::app()->theme->baseUrl;?>/css/print_invoice_print.css'] });
        });       
    });
</script>
<div id="printElement">
    <?php include "view_form.php"; ?>
</div>

