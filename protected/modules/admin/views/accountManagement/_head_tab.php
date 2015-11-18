<?php 
    $cAction = strtolower(Yii::app()->controller->action->id);

$this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
        array('label'=>'Invoice', 
            'url'=>Yii::app()->createAbsoluteUrl('admin/accountManagement/invoice'),
            'active'=>($cAction=='invoice') ? true : false),
        
        array('label'=>'Account Receivables', 
            'url'=>Yii::app()->createAbsoluteUrl('admin/accountManagement/accountReceivables'),
            'active'=>($cAction=='accountreceivables') ? true : false),
        
        array('label'=>'Payment Vouchers', 
            'url'=>Yii::app()->createAbsoluteUrl('admin/accountManagement/paymentVouchers'),
            'active'=>($cAction=='paymentvouchers') ? true : false),
        
        array('label'=>'Account Payable', 
            'url'=>Yii::app()->createAbsoluteUrl('admin/accountManagement/accountPayable'),
            'active'=>($cAction=='accountpayable') ? true : false),
        
        array('label'=>'Profit & Loss Accounts', 
            'url'=>Yii::app()->createAbsoluteUrl('admin/accountManagement/profitLossAccounts'),
            'active'=>($cAction=='profitlossaccounts') ? true : false),
        
        array('label'=>'Balance Sheet', 
            'url'=>Yii::app()->createAbsoluteUrl('admin/accountManagement/balanceSheet'),
            'active'=>($cAction=='balancesheet') ? true : false),
        
    ),
)); 
?>