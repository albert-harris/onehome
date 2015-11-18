<?php 
$total_trans = 0;
$total_revenue = 0;
?>
<div class="row grid-view l_padding_200">
    <label>&nbsp;</label>
    <table class="materials_table items ">
        <thead>
            <tr>
                <th class="w-200 item_c">Date</th>
                <th class="w-200 item_c">Number of Transactions</th>
                <th class="w-200 item_c">Revenue</th>         
            </tr>
        </thead>
        <tbody>
            <?php foreach($LOOP_VAR as $year=>$arrMonth):?>
                <?php foreach($arrMonth as $month=>$temp):?>
                <?php
                    $amount_invoice = isset($TOTAL_AMOUNT_INVOICE[$year][$month])?$TOTAL_AMOUNT_INVOICE[$year][$month]:0;
                    $amount_voucher = isset($TOTAL_AMOUNT_VOUCHER[$year][$month])?$TOTAL_AMOUNT_VOUCHER[$year][$month]:0;
//                    $revenue = ($amount_invoice-$amount_voucher>0) ? $amount_invoice-$amount_voucher : 0;
                    $revenue = $amount_invoice-$amount_voucher;
                    $total_trans+= ( isset($COUNT_TRANS[$year][$month])?$COUNT_TRANS[$year][$month]:0 );
                    $total_revenue += $revenue;
                ?>
                    <?php if($revenue!=0 || $amount_invoice!=0 || $amount_voucher!=0  ):?>
                    <tr class="materials_row ">
                        <td class="item_c">
                            <?php echo "$month/$year";?>
                        </td>
                        <td class="item_r">
                            <?php echo $COUNT_TRANS[$year][$month];?>
                        </td>
                        <td class=" item_r">
                            <?php echo MyFormat::formatPrice($revenue);?>
                        </td>
                    </tr>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endforeach;?>
        </tbody>
        <tfoot class="display_none">
            <tr>
                <td class="item_c item_b">Total</td>
                <td class="item_r item_b"><?php echo number_format($total_trans,0);?></td>
                <td class="item_r item_b"><?php echo MyFormat::formatPrice($total_revenue);?></td>
            </tr>
        </tfoot>

    </table>
</div>