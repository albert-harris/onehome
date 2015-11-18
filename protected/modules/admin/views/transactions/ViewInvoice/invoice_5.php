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
    <h1>PAYMENT VOUCHER</h1>
    
    <table>
        <tbody>
            <tr>
                <td class="col-1"><strong>Company Name:</strong></td>
                <td><?php echo $CompanyName;?></td>
                <td class="col-2"><strong>Date:</strong></td>
                <td class="col-2"><?php echo $ReceiptDatePaid;?></td>
            </tr>
            <tr>
                <td class="col-1"><strong>Address:</strong></td>
                <td><?php echo $BillingAddress;?></td>
                <td class="col-2"><strong>Voucher No.:</strong></td>
                <td class="col-2"><?php echo $voucher_no;?></td>
            </tr>
            <tr>
                <td class="col-1">&nbsp;</td>
                <td><?php echo $PostalCode;?></td>
                <td class="col-2"><strong>Cheque No.:</strong></td>
                <td class="col-2"><?php echo $model->voucher_cheque_no;?></td>
            </tr>
            <tr>
                <td class="col-1">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="col-2"><strong>Amount:</strong></td>
                <td class="col-2"><?php echo $CommissionCoBrokeText;?></td>
            </tr>
        </tbody>
    </table>         
    <table>
        <tbody>
            <tr>
                <td class="col-3"><strong>PAY TO:</strong></td>
                <td><?php echo $CompanyName;?></td>
            </tr>
            <tr>
                <td class="col-3"><strong>CO-BROKE AGENT:</strong></td>
                <td><?php echo $SalespersonName;?></td>
            </tr>
            <tr>
                <td class="space-1">&nbsp;</td>
            </tr>
            <tr>
                <td class="col-3"><strong>PROPERTY:</strong></td>
                <td><?php echo $PropertyName;?></td>
            </tr>
            <tr>
                <td class="space-1">&nbsp;</td>
            </tr>
            <tr>
                <td class="col-3"><strong>OUR INVOICE NO.:</strong></td>
                <td><?php echo $ReceiptInvoice;?></td>
            </tr>
            <tr>
                <td class="col-3"><strong>YOUR INVOICE NO.:</strong></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="space-1">&nbsp;</td>
            </tr>
            <tr>
                <td class="col-3"><strong>TOTAL NET COMMISSION:</strong></td>
                <td><?php echo $CommissionCoBrokeText;?></td>
            </tr>
        </tbody>
    </table>
    
    
</div>