<div id="container">
    <table>
        <tbody>
            <tr>
                <td>
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/property-infologic-logo-print.png" alt="property infologic" />
                </td>
                <td class="info-company">
                    <h4><?php echo Yii::app()->params['invoice_title'];?></h4>                    
					<p>formerly known as Propertyinfologic.com Pte Ltd</p>
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
    <h1>INVOICE</h1>
        <table>
        <tbody>
            <tr>
                <td class="col-1"><strong>Bill to:</strong></td>
                <td>&nbsp;</td>
                <td class="col-2"><strong>Invoice No.:</strong></td>
                <td class="col-2"><?php echo $InvoiceNumber;?></td>
            </tr>
            <tr>
                <td class="col-1" colspan="2">
                    <?php echo $CompanyName;?><br/>
                    <?php echo $BillingAddress;?><br/>
                    <?php echo $ContactNo;?><br/>
                    <?php echo $PostalCode;?><br/>
                </td>                
                <td class="col-2"><strong>Date:</strong></td>
                <td class="col-2"><?php echo $InvoiceDate;?></td>
            </tr>
        </tbody>
    </table>         
    <table class="invoice-tb">
        <tfoot>
                <td colspan="2">
                <p>Cheque should be crossed and made payable to 'OneHome Infologic'.</p>
                <p>Please indicate the invoice number on the reverse side of the cheque.</p>
                <p>Please send cheque together with the Payment Slip.</p>
            </td>
        </tfoot>
        <tbody>
            <tr>
                <td class="col-4"><strong>PROPERTY:</strong> <?php echo $PropertyName;?> </td>
                <td class="w-110">Amount SG $</td>
            </tr>
            <tr>
                <td class="col-4"><strong>LANDLORD:</strong> <?php echo $LanlordName;?></td>
                <td><?php echo $CommissionAmountFormat;?></td>
            </tr>
            <tr>
                <td class="col-4"><strong>TENANT:</strong> <?php echo $TenantName;?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="col-4"><strong>OUR ASSOCIATE:</strong></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="col-4"><strong>YOUR ASSOCIATE:</strong></td>
                <td>&nbsp;</td>
            </tr>            
            
            <tr>
                <td><?php echo $text1;?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="space-1" colspan="2">&nbsp;</td>
            </tr>            
            <tr>
                <td class="col-1"><strong>Total Amount Due:</strong></td>
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
                                <td><?php echo $CompanyName;?></td>
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