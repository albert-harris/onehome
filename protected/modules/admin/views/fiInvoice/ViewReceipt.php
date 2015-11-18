<?php
$headText = 'Invoices Management';
$headLink = array('index');
$headLinkBreck = array('index');
$headTitle = "View Receipt $model->receipt_no";

$this->breadcrumbs=array(
	$headText => $headLink,
	$headTitle,
);

$this->menu= array(
	array('label'=>$headText, 'url'=> $headLinkBreck),
);
$cmsFormater = new CmsFormatter();

// for receipt        
$ReceiptDatePaid = $cmsFormater->formatDate($model->receipt_date_paid);
$mInvoice = $model->rInvoice;
$aModelInvoiceDetail = $mInvoice->rDetail;
$CommissionAmount = $cmsFormater->formatPriceSign($mInvoice->total_amount_due);
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
    <?php include "ViewReceipt_form.php"; ?>
</div>

