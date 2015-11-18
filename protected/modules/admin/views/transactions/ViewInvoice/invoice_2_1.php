<div id="container">
    <table>
        <tbody>
            <tr>
                <td>
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/property-infologic-logo-print.png" alt="property infologic" />
                </td>
                <td class="info-company">
                    <h4>Property Infologic</h4>
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
                    <?php echo $AttnTo;?><br/>
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
                <p>Cheque should be crossed and made payable to 'PROPERTY INFOLOGIC'.</p>
                <p>Please indicate the invoice number on the reverse side of the cheque.</p>
                <p>Please send cheque together with the Payment Slip.</p>
            </td>
        </tfoot>
        <tbody>
            <tr>
                <td class="col-4"><strong>PROPERTY:</strong></td>
                <td>Amount SG $</td>
            </tr>
            <tr>
                <td class="col-4"><strong>LANDLORD:</strong></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="col-4"><strong>TENANT:</strong></td>
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
                <td class="space-1" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">Being co-broke commission due to us for services rendered in connection with the lease of the above-mentioned property.</td>
            </tr>
            <tr>
                <td class="space-1" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="col-1"><strong>Total Amount Due:</strong></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="space-1" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="col-4">SINGAPORE DOLLARS:</td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <table class="sign" style="width:30%;">
        <tbody>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="line">ACCOUNTS DEPARTMENT</td>
            </tr>
        </tbody>
    </table>
    <p class="line-3">Please Detach Here</p>
    <table>
        <tbody>
            <tr>
                <td>
                        <p><strong>OneHome Infologic</strong></p>
                    <address>10 Ubi Crescent #03-52 Lobby C,<br/>
                        Ubi Techpark,<br/>
                        Singapore 408564</address>
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
                                <td><strong>From:</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>Invoice No.:</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>Amount:</strong></td>
                                <td></td>
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