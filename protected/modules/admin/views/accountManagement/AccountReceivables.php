<?php
$this->breadcrumbs=array(
	'Account Management',
	'Account Receivables',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Transactions'), 'url'=>array('create')),
);
//$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-transactions-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-transactions-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-transactions-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-transactions-grid');
        }
    });
    return false;
});
");

//if(MyFormat::isAllowAccess('transactions', 'viewInvoice'))
//    echo 'sssssssss';

?>
<?php include '_head_tab.php';?>
<h1>Account Receivables Management</h1>





<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />
<style>
    .ApproveTransaction { padding-right: 4px;}    
</style>
<script>
    $(function(){
        fnUpdateLink();        
    });
    
    function fnUpdateLink(){
        // for view invoice
        $('.gen_invoice').click(function(){
            var DoAction = $(this).attr('DoAction');
            if(confirm('Do You Want To Gen '+DoAction)){
                var url_ = $(this).attr('next');
                $.blockUI({ message: null });
                $.ajax({
                    url: url_,
                    type: 'post',
                    success:function(data){
                        $.fn.yiiGridView.update("pro-transactions-grid");
                        $.unblockUI();
                    }
                });                
            }
        });
        // for view invoice
        
        // for gen receipt
        $(".gen_receipt").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});
        $(".ApproveTransaction").colorbox({iframe:true,innerHeight:'300', innerWidth: '800',close: "<span title='close'>close</span>"});
        // for gen receipt
    }

</script>
