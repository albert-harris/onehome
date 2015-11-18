<fieldset>
    <legend>Paypal Settings</legend>
    <div class="row">
        <?php echo $form->labelEx($model, 'paypalType'); ?>
        <?php
        echo $form->dropDownList($model, 'paypalType', array(
            'live' => 'Live Paypal',
            'test' => 'Test Paypal',
                )
        );
        ?>
<?php echo $form->error($model, 'paypalType'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'paypal_email_address'); ?>
        <?php echo $form->textField($model, 'paypal_email_address', array('size' => 35)); ?>
<?php echo $form->error($model, 'paypal_email_address'); ?>
    </div>
    <div class="row" style="">
        <?php echo $form->labelEx($model, 'paypalCurrencySign', array('label' => 'Paypal Currency Code')); ?>
        <?php echo $form->textField($model, 'paypalCurrencySign', array('size' => 35, 'maxlength' => 5)); ?>
<?php echo $form->error($model, 'paypalCurrencySign'); ?>
    </div>
</fieldset>