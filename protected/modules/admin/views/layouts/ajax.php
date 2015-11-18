<?php Yii::app()->getClientScript()->registerCoreScript('jquery');?>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/form.css" />
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/style.css" rel="stylesheet" type="text/css" />
<!--<link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/jquery-ui-1.8.18.custom.css" type=text/css rel=stylesheet>-->
<div id="main_box">
    <div class="clr"></div>
        <?php echo $content; ?>
    <div class="clr"></div>
</div>
<style>
    #ui-datepicker-div { font-size: 13px;}
</style>

