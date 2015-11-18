<div class="wide form" style="padding-left:0px;">
     <div class="row">
        <?php 
        $actionCurrent = strtolower(Yii::app()->controller->action->id);
        $this->widget('bootstrap.widgets.TbButtonGroup', array(
            'buttons'=>array(
                array('label'=>'Invoices', 
                    'url'=>Yii::app()->createAbsoluteUrl('admin/fiInvoice/index'),
                    'active'=>($actionCurrent =='index') ? true : false),                
                array('label'=>'Accounts receivables', 
                    'url'=>Yii::app()->createAbsoluteUrl('admin/fiInvoice/accountsReceivables'),
                    'active'=>($actionCurrent =='accountsreceivables') ? true : false),
//                array('label'=>'Transaction Invoice', 
//                    'url'=>Yii::app()->createAbsoluteUrl('admin/fiInvoice/transactionInvoice'),
//                    'active'=>($actionCurrent =='transactioninvoice') ? true : false),
                array('label'=>'Payment Vouchers', 
                    'url'=>Yii::app()->createAbsoluteUrl('admin/FiInvoice/paymentvouchers'),
                    'active'=>($actionCurrent =='paymentvouchers' || $actionCurrent =='createvoucher' || $actionCurrent =='updatevoucher' ) ? true : false),
                array('label'=>'Account Payable', 
/*                    'url'=>Yii::app()->createAbsoluteUrl('admin/listingcompany/index',array('company_listing_type'=>Listing::COMPANY_FOLLOW_UP)),
                    'active'=>($current_compa ny_listing_type ==Listing::COMPANY_FOLLOW_UP) ? true : false),*/
                    'url'=>Yii::app()->createAbsoluteUrl('admin/fiInvoice/accountpayable'),
                    'active'=>($actionCurrent =='accountpayable') ? true : false),
                array('label'=>'Report Financial', 
                    'url'=>Yii::app()->createAbsoluteUrl('admin/FiInvoice/report'),
                    'active'=>($actionCurrent =='report') ? true : false),
                
//                array('label'=>'Report Transaction', 
//                    'url'=>Yii::app()->createAbsoluteUrl('admin/FiInvoice/report_transaction'),
//                    'active'=>($actionCurrent =='report_transaction') ? true : false),                
            ),
        )); 
    ?>   
    </div>
</div> <!-- end wide form -->