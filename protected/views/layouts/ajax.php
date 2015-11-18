<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php Yii::app()->getClientScript()->registerCoreScript('jquery');?>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/form.css" />-->
<!--<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />-->
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/themes/homepage/css/main.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/verz_custom.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/autoNumeric-master/autoNumeric-2.0-BETA.js"></script>	
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/verz.js"></script>

<div class="clearfix wrap_commission" style="width:490px">
    <?php echo $content; ?>
</div>
<style>
    
.output .btn-3, .output .btn-2 {
     margin: 10px 0 0 10px;
}
</style>
<script>
    /* for commission_amount and commission_amount_gst */
//        fnCalcCommissionGst('<?php // echo Yii::app()->params['gst'];?>');
</script>
    