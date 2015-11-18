<?php
$this->breadcrumbs=array(
	'Invoice Management'=>array('index'),
	$model->invoice_no,
);

$menus = array(
	array('label'=>'Invoice Management', 'url'=>array('index')),
	array('label'=>'Create Invoice', 'url'=>array('create')),
	array('label'=>'Update Invoice', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Invoice', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
$model->aModelDetail = $model->rDetail;
$cmsFormater = new CmsFormatter();
?>

<h1>View Invoice: <?php echo $model->invoice_no; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'invoice_no',
		'transactions_no',
                array(
                    'name' => 'bill_to',
                    'value' => FiInvoice::$STA_BILL_TO[$model->bill_to],
                ),
		'user_name',
		'user_billing_address',
		'user_postal_code',
		'total_amount_due:Price',
                array(
                    'name' => 'status',
                    'value' => FiInvoice::$STA_STATUS[$model->status],
                ),
		'created_date:date',
	),
)); ?>

<div class="row grid-view l_padding_100">
    <label>&nbsp;</label>
    <table class="materials_table items ">
        <thead>
            <tr>
                <td colspan="3" class="item_c item_b">Details</td>
            </tr>
            <tr>
                <th class="w-20 item_c">#</th>
                <th class="w-500 item_c">Description</th>                        
                <th class="w-200 item_c">Amount SG $</th>                        
            </tr>
        </thead>
        <tbody>
            <?php // if(0):?>
            <?php if(is_array($model->aModelDetail) && count($model->aModelDetail)):                 
                $total_amount_due = 0;
            ?>
            <?php foreach($model->aModelDetail as $key=>$mDetail):?>
            <tr class="materials_row ">
                <td class="item_c order_no row_class_id<?php echo $mDetail->id;?>"><?php echo ($key+1);?></td>
                <td class="l_padding_10 ">
                    <span class="description"><?php echo FiInvoiceDetail::fnBuildDescription($mDetail);?></span>
                    <?php 
                    $display_none = 'display_none';
                    $total_amount_due+=$mDetail->amount;
                    if($key){
                        $display_none = '';
                    }
                        
                    $next = Yii::app()->createAbsoluteUrl('admin/fiInvoice/create', array('row_number'=>($key+1)));?>
                </td>
                <td class="l_padding_10 w-150 item_r">
                    <?php echo MyFormat::formatPrice($mDetail->amount);?>
                </td>
            </tr>                    
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="item_r item_b">
                    Total Amount Due
                </td>
                <td class="item_r TotalAmountDue item_b"><?php echo $cmsFormater->formatPrice($total_amount_due);?></td>
            </tr>
        </tfoot>
    </table>
</div>