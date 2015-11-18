<?php
/*$headText = 'Transactions Management';
$headLink = array('index');
$headLinkBreck = array('index');
$headTitle = "View Invoice ";

if($model->invoice_type == ProTransactionsInvoice::TYPE_RECEIPT){
    $headText = 'Transactions Management';
    $headLink = array('index');
    $headLinkBreck = array('index');
    $headTitle = "View Receipt ";
}elseif($model->invoice_type == ProTransactionsInvoice::TYPE_VOUCHER){
    $headText = 'Voucher List of Transaction '.$mTransactions->transactions_no;
    $headLink = array('transactionsVoucher/index', 'transactions_id'=>$mTransactions->id);
    $headLinkBreck = array('transactionsVoucher/index/transactions_id/'.$mTransactions->id);
    $headTitle = "View Voucher";
}

$this->breadcrumbs=array(
	$headText => $headLink,
	$headTitle,
);

//$menus = array(
//	array('label'=>$headText, 'url'=>array($headLink)),
//);
$this->menu= array(
	array('label'=>$headText, 'url'=> $headLinkBreck),
);
$cmsFormater = new CmsFormatter();
$mBillTo = $mTransactions->rBillTo;

$text1="Being co-broke commission due to us for services rendered in connection with the lease of the above-mentioned property.";

$InvoiceNumber = $model->invoice_number;
$InvoiceDate = $cmsFormater->formatDate($mTransactions->created_date);
//$Property = Listing::getViewDetailPropertyType($mTransactions->rListing);
// 9
//$PropertyName = $mTransactions->rPropertyDetail->rPropertyType?$mTransactions->rPropertyDetail->rPropertyType->name:'';
// hình như ko dùng cái $PropertyName bên trên
$PropertyName = ProTransactionsInvoice::getPropertyName($model);
$LanlordName = ProTransactions::getInvoiceLanlordName($mTransactions);
$TenantName = ProTransactions::getInvoiceTenantName($mTransactions);
$TransactionNo = $mTransactions->transactions_no;// 8
$ClientType = ProTransactions::$aClientSaleDetail[$mTransactions->client_type_id]; // 10

// invoice normal
$CommissionAmount = $mBillTo->commission_amount_gst;
$AttnTo = $mBillTo->attn_to;
$CompanyName = $mBillTo->company_name;
$BillingAddress = $mBillTo->billing_address;
$ContactNo = $mBillTo->contact_no;
$PostalCode = $mBillTo->postal_code;

// for invoice normal
if( in_array($model->invoice_template, ProTransactionsInvoice::$aTemplateInvoiceExCobroke)){
    $mExternal = $model->rExternalCobroke;
    if($mExternal){
        $CommissionAmount = $mExternal->commission_amount_gst;
        $CompanyName = $mExternal->company_name;
        $BillingAddress = $mExternal->billing_address;
        $ContactNo = $mExternal->contact_no;
        $PostalCode = $mExternal->postal_code;
    }
}
    
$CommissionAmountInText = NumberToText::convertNumber($CommissionAmount);
$CommissionAmountFormat = $cmsFormater->formatPrice($CommissionAmount);
$template = $model->invoice_template;
// for invoice normal

$CreatedDate = $cmsFormater->formatDate($model->created_date);
$ReceiptDatePaid = $cmsFormater->formatDate($model->receipt_date_paid);
$ReceiptInvoice = ProTransactionsInvoice::getReceiptInvoiceNo($model);
if($model->invoice_type == ProTransactionsInvoice::TYPE_RECEIPT){
// for receipt
$CommissionAmount = $cmsFormater->formatPriceSign(ProTransactionsInvoice::getCommissionAmountTrans($model));
// for receipt        
}

// for voucher
if($model->invoice_type == ProTransactionsInvoice::TYPE_VOUCHER){
    $mTransComm = ProTransactionsSaveCommission::getByTransUid($mTransactions->id, $model->voucher_pay_to);
    $mSaleperson = $mTransComm->rUser;
    $voucher_saleperson_name = ''; // 1
    $voucher_saleperson_nric = ''; // 2
    $voucher_saleperson_phone = ''; // 4
    $voucher_saleperson_1st_name = ''; // 3
    $voucher_saleperson_1st_phone = ''; // 5

    if($mSaleperson){
       $voucher_saleperson_name = $cmsFormater->formatFullNameRegisteredUsers($mSaleperson);
       $voucher_saleperson_nric = $mSaleperson->nric_passportno_roc;
       $voucher_saleperson_phone = $cmsFormater->formatFullPhone($mSaleperson);
       $mAgentTierManagerFirst = $mSaleperson->rAgentTierManagerFirst;
       if($mAgentTierManagerFirst){
           if($mTier =  $mAgentTierManagerFirst->rTier){
               $voucher_saleperson_1st_name = $cmsFormater->formatFullNameRegisteredUsers($mTier);
               $voucher_saleperson_1st_phone = $cmsFormater->formatFullPhone($mTier);
           }
       }       
    }

    $voucher_no = $model->voucher_no; // 6
    $ExternalCoBrokeCommission = ProTransactionsSaveCommission::calcClientCommission($mTransactions);
    $InternalCoBrokeCommission = ProTransactionsSaveCommission::calcCommissionInternalCobroke($mTransactions);
    $MA_Gross = $model->voucher_ma_gross_comm; 
    $MA_GrossText = $cmsFormater->formatPriceSign($model->voucher_ma_gross_comm); // 14
    $PrimaySalespersonComm = $mTransComm->received_commission;
    $voucher_number_11 = $PrimaySalespersonComm + $MA_Gross + $ExternalCoBrokeCommission+ $InternalCoBrokeCommission;
    $voucher_number_11_text = $cmsFormater->formatPriceSign($voucher_number_11);
    $SalespersonCommissionScheme_12 = $cmsFormater->formatPrice($mTransComm->percent_of_tier)." %";
//   tam dong lai $voucher_number_13 = $voucher_number_11-$ExternalCoBrokeCommission-$InternalCoBrokeCommission;
    $voucher_number_13 = ProTransactionsInvoice::calcTotalNetComm($model, $mTransactions);
    
    $voucher_number_13_text = $cmsFormater->formatPriceSign($voucher_number_13);
    $ExternalCoBrokeCommissionText = $cmsFormater->formatPriceSign($ExternalCoBrokeCommission); // 15
    $InternalCoBrokeCommissionText = $cmsFormater->formatPriceSign($InternalCoBrokeCommission);// 16
    
    if($template==ProTransactionsInvoice::TEMPLATE_5_VOUCHER_COBROKE){
        if($mUser = $model->rPayToUser){
            $CompanyName = 'Property Infologic'; // 1
            $BillingAddress  = '10 Ubi Crescent #03-52 Lobby C, Ubi Techpark, Singapore'; // 2
            $PostalCode = '408564'; // 3
            if($mUser->role_id == ROLE_EXTERNAL_CO_BROKE){
                $CompanyName = $mUser->agent_company_name;
                $BillingAddress = $mUser->address;
                $PostalCode = $mUser->postal_code;
            }
            $CommissionCoBroke = $mTransComm->received_commission; // 6
            $CommissionCoBrokeText = $cmsFormater->formatPriceSign($CommissionCoBroke);
            $SalespersonName = $cmsFormater->formatFullNameRegisteredUsers($mUser); // 7
        }
    }
    
}
*/
// for voucher
        
//COMMENT '1: invoice normal For Sale - Rent . 2: invoice For Sale Bill External Co-broke.
// 3.: invoice For Rent Bill External Co-broke 4: Voucher 1. 
// 5: Voucher 2. 6: Receipt';
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
    <?php include "invoice_5.php"; ?>
</div>