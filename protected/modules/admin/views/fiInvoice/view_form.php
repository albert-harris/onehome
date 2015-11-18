<!--1: invoice normal For Sale - Rent--> 
<?php
$text1 = FiInvoice::getFiTextViewInvoice($model);
$ChequeText = "Cheque should be crossed and made payable to 'OneHome Infologic'";
//if($mTransactions->type == ProTransactions::FOR_RENT){
//    $text1 = 'Being commission due to us for services rendered in connection with the lease of the above-mentioned property.';
//    $ChequeText = "Cheque should be crossed and made payable to 'OneHome Infologic'.";
//}
?>
<div id="container">
    <table>
        <tbody>
            <tr>
                <td>
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/property-infologic-logo.png" alt="property infologic" />
                </td>
                <td class="info-company">
                    <h4><?php echo Yii::app()->params['invoice_title'];?></h4>
                    <address>
                        <?php echo Yii::app()->params['invoice_address_line_1'];?><br/>
                        <?php echo Yii::app()->params['invoice_address_line_2'];?><br/>
                        <?php echo Yii::app()->params['invoice_address_line_3'];?></address>
                    <p><strong>Phone:</strong> <?php echo Yii::app()->params['invoice_phone'];?></p>
                    <p><strong>Fax:</strong> <?php echo Yii::app()->params['invoice_fax'];?></p>                    
                    <p><strong>CEA Licence No.:</strong> <?php echo Yii::app()->params['invoice_cea'];?></p>
                    <p><strong>GST Reg. No:</strong> <?php echo Yii::app()->params['invoice_uen'];?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <h1>TAX INVOICE</h1>
        <table>
        <tbody>
            <tr>
                <td class="col-1" colspan="2"><strong>Bill to:</strong> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $BillTo;?></td>
                <!--<td>&nbsp;</td>-->
                <td class="col-2"><strong>Tax Invoice No.:</strong></td>
                <td class="col-2"><?php echo $InvoiceNumber;?></td>
            </tr>
            <tr>
                <td class="col-1" colspan="2">
                    <?php echo $BillingAddress;?><br/>
                    <?php echo $PostalCode;?> Singapore<br/>
                </td>                
                <td class="col-2"><strong>Date:</strong></td>
                <td class="col-2"><?php echo $InvoiceDate;?></td>
            </tr>            
        </tbody>
    </table>         
    <table class="invoice-tb">
        <tfoot>
                <td colspan="2">
                <p><?php echo $ChequeText;?></p>
                <p>Please indicate the invoice number on the reverse side of the cheque.</p>
                <p>Please send cheque together with the Payment Slip.</p>
            </td>
        </tfoot>
        <tbody>
            <tr>
                <td class="col-4"><strong>PROPERTY:</strong> <?php // echo $PropertyName;?> </td>
                <td class="w-110">Amount SG $</td>
            </tr>
            
            <?php if(is_array($model->aModelDetail) && count($model->aModelDetail)):?>
            <?php foreach($model->aModelDetail as $key=>$mDetail): if($key!=0) break;?>
                <tr>
                    <td class="col-4"><strong></strong><?php echo FiInvoiceDetail::fnBuildDescriptionPrint($mDetail);?></td>
                    <td><?php echo $cmsFormater->formatPrice($mDetail->amount);?></td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
            
            <tr>
                <td><?php echo $text1;?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="space-1" colspan="2">&nbsp;</td>
            </tr>
            
            <tr>
                <td class="item_r item_b">GST (<?php echo Yii::app()->params['gst'];?>%) </td>
                <td class="item_border_bottom">
                    <?php echo $cmsFormater->formatPrice($mDetail->amount_gst-$mDetail->amount);?>
                </td>
            </tr>
            
            <tr>
                <td class="col-1 item_r"><strong>Total Amount Due:</strong></td>
                <td><?php echo $CommissionAmountFormat;?></td>
            </tr>
            <!--<tr><td class="space-1" colspan="2">&nbsp;</td></tr>-->
            <tr>
                <td class="" colspan="2">SINGAPORE DOLLARS: <?php echo ucfirst($CommissionAmountInText);?></td>
            </tr>
        </tbody>
    </table>
    <table class="sign" style="width:30%;">
        <tbody>
            <tr>
                <td class="line">ACCOUNTS DEPARTMENT <br><br></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
        </tbody>
    </table>
    <p class="line-3">PLEASE DETACH HERE</p>
    <table>
        <tbody>
            <tr>
                <td class="w-500">                    
                        <p ><strong class="uppercase"><?php echo Yii::app()->params['invoice_title'];?></strong></p>
                        <address>
                        <?php echo Yii::app()->params['invoice_address_line_1'];?><br/>
                        <?php echo Yii::app()->params['invoice_address_line_2'];?><br/>
                        <?php echo Yii::app()->params['invoice_address_line_3'];?></address>
                    <p>Official Receipt be sent to:</p>
                    <table>
                        <tbody>
                            <tr>
                                <td>(   ) Existing Address</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>(   ) New Mailing Address:</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Fax:</p>
                </td>
                <td>
                    <table>
                        <tbody>
                            <tr>
                                <td class="w-90"><strong>From:</strong></td>
                                <td><?php echo $BillTo;?></td>
                            </tr>
                            <tr>
                                <td><strong>Invoice No.:</strong></td>
                                <td><?php echo $InvoiceNumber;?></td>
                            </tr>
                            <tr>
                                <td><strong>Amount:</strong></td>
                                <td><?php echo $CommissionAmountFormat;?></td>
                            </tr>
                            <tr>
                                <td><strong>Bank:</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>Cheque No.:</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>