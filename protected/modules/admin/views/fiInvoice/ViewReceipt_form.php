<div id="container">
    <table>
        <tbody>
            <tr>
                <td>
                    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/property-infologic-logo-print.png" alt="property infologic" />
                </td>
                <td class="info-company w-500" >
                    <!--<h4 class="h4_border">Property Infologic</h4><br/>-->
                    <h4 class=""><?php echo Yii::app()->params['invoice_title'];?></h4>
                    <address>
                        <?php echo Yii::app()->params['invoice_address_line_1'];?><br/>
                        <?php echo Yii::app()->params['invoice_address_line_2'];?><br/>
                        <?php echo Yii::app()->params['invoice_address_line_3'];?></address>
                    <p><strong>Phone:</strong> <?php echo Yii::app()->params['invoice_phone'];?></p>
                    <p><strong>Fax:</strong> <?php echo Yii::app()->params['invoice_fax'];?></p>
                    <p><strong>UEN:</strong> <?php echo Yii::app()->params['invoice_uen'];?></p>
                    <p><strong>CEA Licence No.:</strong> <?php echo Yii::app()->params['invoice_cea'];?></p>
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
                <td class="col-2"><?php echo $model->receipt_no;?></td>
            </tr>
            <tr>
                <td class="col-1"><strong>NRIC:</strong></td>
                <td><?php echo $model->receipt_nric;?></td>
                <td class="col-2"><strong>Date:</strong></td>
                <td class="col-2"><?php echo $ReceiptDatePaid;?></td>
            </tr>
            <tr>
                <td class="col-1"><strong>Contact No:</strong></td>
                <td><?php echo $model->receipt_contact_no;?></td>
                <td class="col-2" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="col-1"><strong>Payment:</strong></td>
                <td>
                    <?php
                    $mInvoice = $model;
                    if(isset(FiPaymentVoucher::$ARR_PAYMENT_MODE[$mInvoice->payment_mode])){
                        if($mInvoice->payment_mode==FiPaymentVoucher::PAYMENT_MODE_CHEQUE){
                            echo FiPaymentVoucher::$ARR_PAYMENT_MODE[$mInvoice->payment_mode]." - ".$mInvoice->cheque_number;
                        }else{
                            echo FiPaymentVoucher::$ARR_PAYMENT_MODE[$mInvoice->payment_mode];
                        }
                    }
                    ?>                    
                </td>
                <td class="col-2" colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="col-1"><strong>By:</strong></td>
                <td><?php echo Yii::app()->params['invoice_title'];?></td>
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
            <?php foreach($aModelInvoiceDetail as $detail):?>
            <tr>
                <td class="item_c no_border_l">1</td>
                <td class="item_c">Address: <?php echo FiInvoiceDetail::fnBuildDescription($detail);?></td>
                <td class="item_c">1</td>
                <td class="item_r"><?php echo $cmsFormater->formatPriceSign($detail->amount);?></td>
                <td class="item_r"><?php echo $cmsFormater->formatPriceSign($detail->amount);?></td>
            </tr>
            <?php endforeach;?>
            <tr>
                <td class="item_r item_b no_border_l" colspan="4">Total:</td>
                <td class="item_r item_b"><?php echo $CommissionAmount;?></td>
            </tr>
        </tbody>
    </table>
    
    <table class="">
        <tbody>
            <tr>
                <td class="item_b">Official Use Only:</td>
            </tr>
            <tr>
                <td class="item_b">Received By:</td>
            </tr>
            <tr>
                <td class="item_b">Date:</td>
            </tr>
        </tbody>
        
    </table>
    
</div>