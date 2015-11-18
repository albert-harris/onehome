<?php
$this->breadcrumbs = array(
    'System Configurations',
);
?>

<h1>System configurations</h1>

<?php if (Yii::app()->user->hasFlash('setting')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('setting'); ?>
</div>

<?php endif; ?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'setting-form-admin-form',
    'enableAjaxValidation' => false,
    'method'=>'post',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="column" style="width: 45%;float: left;margin-right: 10px;">
        <?php include '_tab/_general.php'; ?>
        <?php include '_tab/_invoice.php'; ?>
        <?php include '_tab/_email.php'; ?>
        <?php include '_tab/_google_map.php'; ?>
        <?php include '_tab/_image_settings.php'; ?>
    </div>

    <div class="column" style="width: 45%;float: left;margin-right: 10px;">
        <?php include '_tab/_footer_content.php'; ?>
        <?php include '_tab/_contact_settings.php'; ?>
        <?php include '_tab/_follow_u_ links.php'; ?>
        <?php include '_tab/_paypal_settings.php'; ?>
        <?php include '_tab/cron.php'; ?>
    </div>
    
        <div class='clr'></div>
    <div class="buttons clear" style ='margin-left: -60px;'>
        <button type="submit">Submit</button>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->

<style>
div.flash-success {
  background-attachment:scroll;
  background-color:#E6EFC2;
  background-image:none;
  background-position:0 0;
  background-repeat:repeat repeat;
  border-color:#C6D880;
  color:#264409;
  margin-bottom:1em;
  padding:0.8em;
}    

div.form .row label {
width: 137px !important;
}
</style>