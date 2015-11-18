<div id="container">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/property-infologic-logo-print.png" alt="property infologic" />
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
            <h1 class="h1">PAYMENT VOUCHER</h1>
            <table>
                <tbody>
                    <tr>
                        <td class="col-1"><strong>PAY TO:</strong></td>
                        <!--<td><?php // echo FiPaymentVoucher::getStatus($model->pay_to) ?></td>-->
                        <td><?php echo $model->user_name; ?></td>
                        <td class="col-2"><strong>VOUCHER NO:</strong></td>
                        <td class="col-2"><?php echo $model->voucher_no; ?></td>
                    </tr>
                    
<!--                    <tr> ANH DUNG CLOSE JAN 16, 2015
                        <td class="col-1"><strong>&nbsp;</strong></td>
                        <td>&nbsp;</td>
                        <td class="col-2"><strong>DATE PAID:</strong></td>
                        <td class="col-2"><?php echo Yii::app()->format->date($model->date_paid) ?></td>
                    </tr>-->
                    
<!--                    <tr>
                        <td class="col-1">
                            <strong>NAME:</strong>
                        </td>
                        <td>
                            <?php // echo $model->user_name; ?>
                        </td>
                        <td class="col-2"><strong>&nbsp;</strong></td>
                        <td class="col-2">&nbsp;</td>
                    </tr>-->
                    
                    <tr>
<!--                        <td class="col-1"><strong>ADDRESS:</strong></td>
                        <td><?php echo $model->user_billing_address; ?></td>-->
                        <td class="col-1"><strong>NRIC:</strong></td>
                        <td><?php echo $model->nric; ?></td>
                        <td class="col-2"><strong>DATE PAID:</strong></td>
                        <td class="col-2"><?php echo Yii::app()->format->date($model->date_paid) ?></td>
<!--                        <td class="col-2"><strong>&nbsp;</strong></td>
                        <td class="col-2">&nbsp;</td>-->
                    </tr>
                </tbody>
            </table>
            <table class="report">
                <thead>
                    <tr>
                        <th class="fsize_11">TRXN NO</th>
                        <th class="fsize_11">Invoice No</th>
                        <th class="fsize_11">DESCRIPTION</th>
                        <th class="fsize_11">CLIENT TYPE</th>
                        <th class="fsize_11">GROSS COMM. ($)</th>
                        <th class="fsize_11">COMM. %</th>
                        <th class="fsize_11">AMOUNT SG ($)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>TOTAL AMOUNT</td>
                        <td><strong><?php echo Yii::app()->format->price($model->total_amount); ?></strong></td>
                    </tr>
                </tfoot>
                <tbody>

                    <?php
                        if($dataTmp !='' && count($dataTmp)>0){
                             foreach($dataTmp as $item){
                                $conver = json_decode($item,true);

                    ?>
                    <tr>
                        <td><?php echo $conver['transacion']; ?></td>
                        <td><?php echo $conver['invoice_no'] ?></td>
                        <td><?php echo strip_tags($conver['description']); ?></td>
                        <td><?php echo ProMasterClientType::getInfoRecord("ProMasterClientType",$conver['client_type'],"name"); ?></td>
                        <td class="item_r"><?php echo Yii::app()->format->Price($conver['gross_commission']); ?></td>
                        <td class="item_r"><?php echo Yii::app()->format->Price($conver['comm']); ?></td>
                        <td class="t-center item_r"><?php echo Yii::app()->format->Price($conver['amount'])  ?></td>
                    </tr>
                    <?php            
                             }
                        }
                    ?>                       
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
                        <td class="line">Prepared by</td>
                        <td>&nbsp;</td>
                        <td class="line">Approved by</td>
                    </tr>
                </tbody>
            </table>
            <p class="line-1">I have checked this statement and hereby confirm that they are correct and I hereby acknowledge receipt of </p>
            <p><strong>Total Amount in text:</strong> <?php echo ucfirst(NumberToText::convertNumber($model->total_amount));?> </p>
            <p><span style="padding-right: 100px;">Payment Mode:</span> <strong>CHEQUE</strong>- <span class="line-2"></span> <strong>dated</strong> <span class="line-2"></span> </p>          
            <table class="sign" style="width:80%;">
                <tbody>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="line">SIGNATURE OF CONSULTANT</td>
                    </tr>
                    <tr>
                        <td class="t-left"><p><strong>NOTE: SHOULD THERE BE ANY DISCREPANCY PLEASE NOTIFY OUR ACCOUNTS DEPT WITHIN 7 DAYS <br> PLEASE RETAIN THIS RECEIPT FOR INCOME TAX PURPOSE</strong></p></td>
                    </tr>
                </tbody>
            </table>
        </div> 