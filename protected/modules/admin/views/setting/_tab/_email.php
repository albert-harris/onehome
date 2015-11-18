<fieldset>
    <legend>Email Settings</legend>
    <div class="row">
        <?php echo $form->labelEx($model, 'transportType'); ?>
        <?php echo $form->dropDownList($model, 'transportType', array('php' => 'PHP', 'smtp' => 'Smtp')); ?>
        <?php echo $form->error($model, 'transportType'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'smtpHost'); ?>
        <?php echo $form->textField($model, 'smtpHost'); ?>
        <?php echo $form->error($model, 'smtpHost'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'smtpPort'); ?>
        <?php echo $form->textField($model, 'smtpPort'); ?>
        <?php echo $form->error($model, 'smtpPort'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'smtpUsername'); ?>
        <?php echo $form->textField($model, 'smtpUsername', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'smtpUsername'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'smtpPassword'); ?>
        <?php echo $form->passwordField($model, 'smtpPassword', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'smtpPassword'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'encryption'); ?>
        <?php echo $form->dropDownList($model, 'encryption', array('' => 'Normal', 'ssl' => 'SSL', 'tls' => 'TLS')); ?>
        <?php echo $form->error($model, 'encryption'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'title_all_mail'); ?>
        <?php echo $form->textField($model, 'title_all_mail', array('size' => 50)); ?>
        <?php echo $form->error($model, 'title_all_mail'); ?>
    </div>
</fieldset>