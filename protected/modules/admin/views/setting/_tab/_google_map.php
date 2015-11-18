<fieldset>
    <legend>Google Map Settings</legend>
    <!--            <div class="row">
    <?php echo $form->labelEx($model, 'directions', array('label' => 'Directions')); ?>
    <?php echo $form->textArea($model, 'directions', array('rows' => 5, 'cols' => 35, 'style' => 'width:350px;')); ?>
    <?php echo $form->error($model, 'directions'); ?>
                </div>            -->
    <!--            <div class="row">
    <?php echo $form->labelEx($model, 'postal_code', array('label' => 'Postal Code')); ?>
    <?php echo $form->textField($model, 'postal_code', array('size' => 55)); ?>
    <?php echo $form->error($model, 'postal_code'); ?>
                </div>   -->
    <div class="row">
        <?php echo $form->labelEx($model, 'address_map', array('label' => 'Address Map')); ?>
        <?php echo $form->textField($model, 'address_map', array('size' => 55)); ?>
        <?php echo $form->error($model, 'address_map'); ?>
    </div> 
</fieldset>