<?php
$this->breadcrumbs=array(
	'Report Transaction',
);
?>
<?php // echo $this->renderPartial('_tab_index',array('model'=>$model) ); ?>

<h1>Report Transaction</h1>

<div class="search-form">
<?php $this->renderPartial('_search_report',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<!--<div style="padding-left: 210px;">-->
<div style="">
<?php if(isset($_SESSION['REPORT_TRANSACTION']['COUNT_TRANS'])): ?>
    <?php 
    $TOTAL_AMOUNT_INVOICE = isset($_SESSION['REPORT_TRANSACTION']['TOTAL_AMOUNT_INVOICE'])?$_SESSION['REPORT_TRANSACTION']['TOTAL_AMOUNT_INVOICE']:array();
    $TOTAL_AMOUNT_VOUCHER = isset($_SESSION['REPORT_TRANSACTION']['TOTAL_AMOUNT_VOUCHER'])?$_SESSION['REPORT_TRANSACTION']['TOTAL_AMOUNT_VOUCHER']:array();
    $COUNT_TRANS = isset($_SESSION['REPORT_TRANSACTION']['COUNT_TRANS'])?$_SESSION['REPORT_TRANSACTION']['COUNT_TRANS']:array();
    $LOOP_VAR = isset($_SESSION['REPORT_TRANSACTION']['LOOP_VAR'])?$_SESSION['REPORT_TRANSACTION']['LOOP_VAR']:array();
    $cmsFormater = new CmsFormatter();
    include "Report_$model->report_type.php";
    ?>
<?php else: ?>
    <?php if(isset($_POST['FiInvoice']['report_type'])):?>
        No data found.
    <?php endif; ?>
<?php endif; ?>
</div>
