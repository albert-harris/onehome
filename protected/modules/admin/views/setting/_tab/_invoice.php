<fieldset>
    <legend>Print Invoice</legend>

    <div class="row">
        <?php echo $form->labelEx($model, 'invoice_title', array()); ?>
        <?php echo $form->textField($model, 'invoice_title', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'invoice_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'invoice_address_line_1'); ?>
        <?php echo $form->textField($model, 'invoice_address_line_1', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'invoice_address_line_1'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'invoice_address_line_2', array()); ?>
        <?php echo $form->textField($model, 'invoice_address_line_2', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'invoice_address_line_2'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'invoice_address_line_3', array()); ?>
        <?php echo $form->textField($model, 'invoice_address_line_3', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'invoice_address_line_3'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'invoice_phone', array()); ?>
        <?php echo $form->textField($model, 'invoice_phone', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'invoice_phone'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'invoice_fax', array()); ?>
        <?php echo $form->textField($model, 'invoice_fax', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'invoice_fax'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'invoice_uen', array()); ?>
        <?php echo $form->textField($model, 'invoice_uen', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'invoice_uen'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'invoice_cea', array()); ?>
        <?php echo $form->textField($model, 'invoice_cea', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'invoice_cea'); ?>
    </div>

</fieldset>