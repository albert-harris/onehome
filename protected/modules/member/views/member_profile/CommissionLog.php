<?php
/**
 * @Author: ANH DUNG Apr 29, 2014
 * @Todo: CommissionLog
 */
?>
        
<div class="breadcrumb">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('/');?>">Home</a>
    &raquo; <strong>Commission Log</strong></div>

<div class="wrap_log">
<h3>My Transactions</h3>    
<?php include 'CommissionLogMyTrans.php'; ?>
</div>
<div class="wrap_log">
    <h3>My Downline's Transactions</h3>    
<?php include 'CommissionLogDownline.php'; ?>
</div>


<script>
</script>
            