<style>
.classTextArea { width:580px !important;max-height:135px;min-height: 135px;overflow-y: scroll;}
.classBtn {float:right; margin-top: 30px;}
body{min-width: 0px;}
  .clearfix {width:580px;}
</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'AgentPurchaser-form',
    'enableAjaxValidation' => true,
        ));
?>
<div >
    <h1 class="title-page">Reason</h1>

    <?php echo $form->textArea($model, 'remark_by_admin', array('class' => 'text w-3 classTextArea')); ?>
    <?php echo $form->error($model, 'remark_by_admin'); ?>
    <?php if (!empty($role_id)): ?>
        <input type="submit" class="btn-3 classBtn" value="Submit" />
    <?php endif; ?>
<?php $this->endWidget(); ?>

</div>