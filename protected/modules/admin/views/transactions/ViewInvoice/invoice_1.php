<!--1: invoice normal For Sale - Rent--> 
<?php
$text1 = 'Being commission due to us for services rendered in connection with the sales of the above-mentioned property.';
$ChequeText = "Cheque should be crossed and made payable to 'OneHome Infologic' upon completion of the ";
if($mTransactions->type == ProTransactions::FOR_RENT){
    $text1 = 'Being commission due to us for services rendered in connection with the lease of the above-mentioned property.';
    $ChequeText = "Cheque should be crossed and made payable to 'OneHome Infologic'.";
}
?>
<div id="container">
    <table>
        <tbody>
            <tr>
                <td>
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/property-infologic-logo-print.png" alt="property infologic" />
                </td>
                <td class="info-company">
                    <h4><?php echo Yii::app()->params['invoice_title'];?></h4>
					<p><em>formerly known as Propertyinfologic.com Pte Ltd</em></p>
                    <address>
                        <?php echo Yii::app()->params['invoice_address_line_1'];?><br/>
                        <?php echo Yii::app()->params['invoice_address_line_2'];?>,
                        <?php echo Yii::app()->params['invoice_address_line_3'];?></address>
                    <p><strong>Phone:</strong> <?php echo Yii::app()->params['invoice_phone'];?></p>
                    <p><strong>Fax:</strong> <?php echo Yii::app()->params['invoice_fax'];?></p>
                    <p><strong>CEA Licence No.:</strong> <?php echo Yii::app()->params['invoice_cea'];?></p>
                    <p><strong>UEN & GST Reg. No. :</strong> <?php echo Yii::app()->params['invoice_uen'];?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <h1>TAX INVOICE</h1>
        <table>
        <tbody>
            <tr>
                <td class="col-1">Bill To:</td>
                <td><?php echo isset(ProTransactions::$aBillTo[$mBillTo->bill_to_id]) ? 
					ProTransactions::$aBillTo[$mBillTo->bill_to_id]
					: "" ?></td>
                <td class="col-2">Tax Invoice No.:</td>
                <td class="col-2"><?php echo $InvoiceNumber ?></td>
            </tr>
            <tr>
                <td class="col-1">Address:</td>
				<td><?php echo $BillingAddress ?></td>
                <td class="col-2">Date:</td>
                <td class="col-2"><?php echo $InvoiceDate ?></td>
            </tr>
            <tr>
                <td class="col-1">Email:</td>
				<td><?php echo $ContactNo ?></td>
                <td class="col-2">Attn:</td>
                <td class="col-2"><?php echo $AttnTo ?></td>
             </tr>
            <tr>
                <td class="col-1"></td>
				<td></td>
                <td class="col-2">Tel:</td>
                <td class="col-2"><?php echo $ContactNo ?></td>
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
                <td><strong>PROPERTY:</strong></td>
                <td class="col-4"><?php echo $PropertyName;?> </td>
                <td class="w-110">Amount SG $</td>
            </tr>            
            <tr>
                <td><strong>LANDLORD:</strong> 
				<td class="col-4">
					<?php foreach($mTransactions->rLandlord as $k => $landlord): ?>
						<?= $landlord->name ?></br>
					<?php endforeach ?>
				</td>
                <td><?php echo $mBillTo->commission_amount ?></td>
            </tr>
            
            <tr>
                <td><strong>TENANT:</strong> 
				<td class="col-4">
					<?php foreach($mTransactions->rTenantAll as $k => $tenant): ?>
						<?= $tenant->name ?></br>
					<?php endforeach ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Being commission due to us for services rendered in connection with the lease of the above-mentined property.</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="space-1" colspan="2">&nbsp;</td>
            </tr>            
            <tr>
                <td>&nbsp;</td>
                <td class="col-1" style="text-align:right"><strong>GST on 7%:</strong></td>
                <td><?php echo $mBillTo->commission_amount_gst - $mBillTo->commission_amount ?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="col-1" style="text-align:right"><strong>Total Amount Due:</strong></td>
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
            <!--<tr><td>&nbsp;</td></tr>-->
            <tr>
                <td class="line">ACCOUNTS DEPARTMENT</td>
            </tr>
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
                    <p>New Contact Number:</p>
                </td>
                <td>
                    <table>
                        <tbody>
                            <tr>
                                <td class="w-90"><strong>From:</strong></td>
                                <td><?php echo $AttnTo;?></td>
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