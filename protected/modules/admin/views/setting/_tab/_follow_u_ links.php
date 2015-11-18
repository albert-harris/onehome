<fieldset>
    <legend>Follow us links</legend>
    <div class="row">
        <?php echo $form->labelEx($model, 'follow_us_facebook', array('label' => 'Facebook')); ?>
        <?php echo $form->textField($model, 'follow_us_facebook', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'follow_us_facebook'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'follow_us_twitter', array('label' => 'Twitter')); ?>
        <?php echo $form->textField($model, 'follow_us_twitter', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'follow_us_twitter'); ?>
    </div>
<!--    <div class="row">
        <?php echo $form->labelEx($model, 'follow_us_youtube', array('label' => 'Youtube')); ?>
        <?php echo $form->textField($model, 'follow_us_youtube', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'follow_us_youtube'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'follow_us_linkedin', array('label' => 'LinkedIn')); ?>
        <?php echo $form->textField($model, 'follow_us_linkedin', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'follow_us_linkedin'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'follow_us_instagram', array('label' => 'Instagram')); ?>
        <?php echo $form->textField($model, 'follow_us_instagram', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'follow_us_instagram'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'follow_us_google', array('label' => 'Google +')); ?>
        <?php echo $form->textField($model, 'follow_us_google', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'follow_us_google'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'follow_us_tumblr', array('label' => 'Tumblr')); ?>
        <?php echo $form->textField($model, 'follow_us_tumblr', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'follow_us_tumblr'); ?>
    </div>-->
    

</fieldset>