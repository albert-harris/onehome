<div id="container">
    <table>
        <tbody>
            <tr>
                <td>
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/property-infologic-logo-print.png" alt="property infologic" />
                </td>
                <td class="info-company w-500" >
                    <!--<h4 class="h4_border">Property Infologic</h4><br/>-->
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
    <br/>
    <h1>ACKNOWLEDGEMENT RECEIPT</h1>
    <br/><br/>
        <table>
        <tbody>
            <tr>
                <td class="col-1"><strong>Name:</strong></td>
                <td><?php echo $model->receipt_name;?></td>
                <td class="col-2"><strong>Ref No:</strong></td>
                <td class="col-2"><?php echo $ReceiptInvoice;?></td>
            </tr>
            <tr>
                <td class="col-1"><strong>NRIC:</strong></td>
                <td><?php echo $model->receipt_nric;?></td>
                <td class="col-2"><strong>Date of paid:</strong></td>
                <td class="col-2"><?php echo $ReceiptDatePaid;?></td>
            </tr>
            <tr>
                <td class="col-1"><strong>Contact No:</strong></td>
                <td><?php echo $model->receipt_contact_no;?></td>
                <td class="col-2" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="col-1"><strong>Payment:</strong></td>
                <td>Cheque (<?php echo $CommissionAmount;?>)-BANK-000000 (<?php echo $ReceiptDatePaid;?>)</td>
                <td class="col-2" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="col-1"><strong>Bank Name:</strong></td>
                <td><?php echo $model->bank_no ?></td>
                <td class="col-2" colspan="2">&nbsp;</td>
            </tr>
        </tbody>
            <tr>
                <td class="col-1"><strong>Cheque No:</strong></td>
                <td><?php echo $model->cheque_no ?></td>
                <td class="col-2" colspan="2">&nbsp;</td>
            </tr>
        </tbody>
    </table>         
    <table class="invoice-tb tb_receipt">
        <thead>
            <tr>
                <th class="no_border_l">ITEM</th>
                <th>DESCRIPTION</th>
                <th>QUANTITY</th>
                <th>UNIT PRICE</th>
                <th>AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="item_c no_border_l">1</td>
                <td class="item_c">Being commission of <?php echo $PropertyName;?></td>
                <td class="item_c">1</td>
                <td class="item_r"><?php echo $CommissionAmount;?></td>
                <td class="item_r"><?php echo $CommissionAmount;?></td>
            </tr>
            <tr>
                <td class="item_r item_b no_border_l" colspan="4">Total:</td>
                <td class="item_r item_b"><?php echo $CommissionAmount;?></td>
            </tr>
        </tbody>
    </table>
    
    <table class="">
        <tbody>
            <tr>
                <td class="item_b">Official Use Only</td>
            </tr>
            <tr>
                <td class="item_b">Received By: <?= $model->rTransaction->user->name_for_slug ?></td>
            </tr>
            <tr>
                <td class="item_b">Date: <?php echo $ReceiptDatePaid;?></td>
            </tr>
        </tbody>
        
    </table>
    
</div>