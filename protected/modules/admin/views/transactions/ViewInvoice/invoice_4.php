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
                    <p><strong>UEN & GST Reg. No.. :</strong> <?php echo Yii::app()->params['invoice_uen'];?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <h1>COMMISSION PAYMENT VOUCHER</h1>
    <table>
        <tbody>
            <tr>
                <td class="col-1"><strong>PAY TO:</strong></td>
                <td>&nbsp;</td>
                <td class="col-2"><strong>VOUCHER NO:</strong></td>
                <td style="width: 20%;" class="col-2"><?php echo $voucher_no;?></td>
            </tr>
            <tr>
                <td class="col-1"><strong>CONSULTANT NAME:</strong></td>
                <td><?php echo $voucher_saleperson_name;?></td>
                <td class="col-2"><strong>DATE PAID:</strong></td>
                <td class="col-2"><?php echo $ReceiptDatePaid;?></td>
            </tr>
        </tbody>
    </table>    
    
    <table class="contact-no">
        <tbody>
            <tr>
                <td class="col-1">CONSULTANT I/C NO:</td>
                <td><?php echo $voucher_saleperson_nric;?></td>
                <td class="col-2">MANAGER:</td>
                <td><?php echo $voucher_saleperson_1st_name;?></td>
            </tr>
            <tr>
                <td class="col-1">CONTACT NO:</td>
                <td><?php echo $voucher_saleperson_phone;?></td>
                <td class="col-2">CONTACT NO:</td>
                <td><?php echo $voucher_saleperson_1st_phone;?></td>
            </tr>
        </tbody>
    </table>
    <table class="report">
        <thead>
            <tr class="fsize_11">
                <th>TRXN NO</th>
                <th>DESCRIPTION</th>
                <th>CLIENT TYPE</th>
                <th>GROSS COMM. (<?php echo MyFormat::getSignCurrency();?>)</th>
                <th>COMM. %</th>
                <th>NET AMOUNT (<?php echo MyFormat::getSignCurrency();?>)</th>
            </tr>
        </thead>
        <tfoot>
                <tr>
                <td colspan="6">&nbsp;</td>
            </tr>
                <tr>
                <td colspan="5">CONSULTANT GROSS COMM:</td>
                <td><?php echo $voucher_number_11_text;?></td>
            </tr>
                <tr>
                <td colspan="5">M.A GROSS COMM:</td>
                <td><?php echo $MA_GrossText;?></td>
            </tr>
                <tr>
                <td colspan="5">INTERNAL CO-BROKE:</td>
                <td><?php echo $InternalCoBrokeCommissionText;?></td>
            </tr>
                <tr>
                <td colspan="5">EXTERNAL CO-BROKE:</td>
                <td><?php echo $ExternalCoBrokeCommissionText;?></td>
            </tr>
                <tr class="ref">
                <td colspan="6"><strong>REF. NO:</strong> <?php echo $TransactionNo;?></td>
            </tr>
                <tr class="price">
                <td colspan="5">TOTAL NETT COMM</td>
                <td><?php echo $voucher_number_13_text;?></td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td class="item_c"><?php echo $TransactionNo;?></td>
                <td><?php echo $PropertyName;?></td>
                <td class="item_c"><?php echo $ClientType;?></td>
                <td class="item_r"><?php echo $cmsFormater->formatPrice($voucher_number_11);?></td>
                <td class="item_c"><?php echo $SalespersonCommissionScheme_12;?></td>
                <td class="item_r"><?php echo $cmsFormater->formatPrice($voucher_number_13);?></td>
            </tr>
        </tbody>
    </table>            
    <table class="sign">
        <tbody>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="line">AUTHORISED BY:</td>
                <td>&nbsp;</td>
                <td class="line">CHECKED BY</td>
            </tr>
        </tbody>
    </table>
    <p class="line-1">I have checked this statement and hereby confirm that they are correct and I hereby acknowledge receipt of<br> <strong><?php echo $voucher_number_13_text;?></strong></p>
    <p>Payment Mode: <strong>CHEQUE</strong>- <span class="line-2"></span> <strong>dated</strong> <span class="line-2"></span> </p>          
    <table class="sign" style="width:50%;">
        <tbody>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="line">SIGNATURE OF CONSULTANT</td>
            </tr>
        </tbody>
    </table>
    <p class="fsize_11"><strong>NOTE: SHOULD THERE BE ANY DISCREPANCY PLEASE NOTIFY OUR ACCOUNTS DEPT WITHIN 7 DAYS <br> PLEASE RETAIN THIS RECEIPT FOR INCOME TAX PURPOSE</strong></p>
    
</div>