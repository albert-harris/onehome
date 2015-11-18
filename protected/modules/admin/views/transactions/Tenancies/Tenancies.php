<?php
$this->breadcrumbs=array(
	'Tenancies Approved',
);

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

<h1><?php echo Yii::t('translation', 'Tenancies Approved'); ?></h1>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'users-model-grid',
        'dataProvider'=>$model->getBEListTenancies(),
        'filter'=>$model,
        'enableSorting' => false,
        'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank(); fnUpdateLink(); }',
          'columns'=>array(
            array(
                'header' => 'Property name',
                'name' => 'sPropertyName',
                'type' =>'propertyname',
                'value' => 'array("name"=>$data->listing?$data->listing->property_name_or_address:"", "transaction_id"=>$data->id)',//$data->listing->property_name_or_address'
                'htmlOptions' => array('class'=>'w-250 ' ,'style' => ''),
            ),              
            array(
//                'header' => 'Tenancy Agreement Date',
                'name' => 'tenancy_agreement_date',
                'type' => 'longDate',
                'value' => '$data->tenancy_agreement_date',
                'htmlOptions' => array('class'=>'w-150 item_c' ,'style' => ''),
                'filterHtmlOptions'=> array('class'=>'ad_w1 ad_datepicker', 'style'=>''),
            ),
            array(
//                'header' => 'Commencement Date',
                'name' => 'commencement_date',
                'type' => 'longDate',
                'value' => '$data->commencement_date',
                'htmlOptions' => array('class'=>'w-150 item_c' ,'style' => ''),
                'filterHtmlOptions'=> array('class'=>'ad_w1 ad_datepicker', 'style'=>''),
            ),
            array(
//                'header' => 'Expiring Date',
                'name' => 'expiring_date',
                'type' => 'expiredDate',
                'value' => '$data->expiring_date',
                'htmlOptions' => array('class'=>'w-150 item_c' ,'style' => ''),
                'filterHtmlOptions'=> array('class'=>'ad_w1 ad_datepicker', 'style'=>''),
            ),
            array(
                'header' => 'Tenancy Amount',
                'name' => 'tenancy_amount',
                'type' => 'price',
                'value' => '$data->tenancy_amount',
                'htmlOptions' => array('class'=>'w-80 item_r' ,'style' => ''),
                'filterHtmlOptions'=> array('class'=>'ad_w1', 'style'=>''),
            ),
            array(
                'header' => 'Deposit Payable',
                'name' => 'deposit_payable',
                'type' => 'price',
                'value' => '$data->deposit_payable',
                'htmlOptions' => array('class'=>'w-80 item_r' ,'style' => ''),
                'filterHtmlOptions'=> array('class'=>'ad_w1', 'style'=>''),
            ),
            array(
                'header' => 'Tenancy Period',
                'name' => 'months_rent',
                'value' => '$data->months_rent != NULL ? $data->months_rent." months":""',
                'htmlOptions' => array('class'=>'w-80 item_c' ,'style' => ''),
                'filterHtmlOptions'=> array('class'=>'ad_w1', 'style'=>''),
            ),
            array(
                'header' => 'Calls Log',
                'type'=>'LinkCallsLog',
                'value'=>'$data',
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            array(
                'header' => 'Report Defect(s)',
                'type'=>'LinkReportDefect',
                'value'=>'$data',
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            array(
                'header' => 'Inventory Photo',
                'type'=>'LinkInventoryPhoto',
                'value'=>'$data',
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            array(
                'header' => 'Aircon Services',
                'type'=>'LinkAirconServices',
                'value'=>'$data',
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
        )
    ));
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>


<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />
<script>
    $(function(){
        fnUpdateLink();        
    });
    
    function fnUpdateLink(){
        fnBindDateFilter();
    }

</script>


<script>
function fnBindDateFilter(){
    $('.ad_datepicker input').datepicker({
        changeMonth:true,
        changeYear:true,
//        showOn: 'button',
//        buttonImage: '<?php echo Yii::app()->theme->baseUrl.'/img/calendar-ico.png';?>',
//        buttonImageOnly: true,
        dateFormat: '<?php echo ActiveRecord::getDateFormatSearch();?>',
    });    
}
</script>
