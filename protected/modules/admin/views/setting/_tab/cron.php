<fieldset>
    <legend>Cron Alert</legend>

    <div class="row">
        <?php echo $form->labelEx($model, 'month_expiry_alert', array('label' => 'Days alert before tenant expiring')); ?>
        <?php echo $form->textField($model, 'month_expiry_alert', array('style' => 'width:100px;')); ?> days
        <?php echo $form->error($model, 'month_expiry_alert'); ?>
    </div>
    
    

</fieldset>