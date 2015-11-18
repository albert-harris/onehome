<fieldset>
    <legend>General Settings</legend>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'adminEmail'); ?>
        <?php echo $form->textField($model, 'adminEmail', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'adminEmail'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'autoEmail'); ?>
        <?php echo $form->textField($model, 'autoEmail', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'autoEmail'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'meta_description'); ?>
        <?php echo $form->textArea($model, 'meta_description', array('rows' => 5, 'cols' => 35, 'style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'meta_description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'meta_keywords'); ?>
        <?php echo $form->textArea($model, 'meta_keywords', array('rows' => 5, 'cols' => 35, 'style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'meta_keywords'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'login_limit_times'); ?>
        <?php echo $form->textField($model, 'login_limit_times', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'login_limit_times'); ?>
    </div>


    <div class="row">
        <label for="SettingForm_time_refresh_login">Time Refresh Login(minutes)</label>
        <?php echo $form->textField($model, 'time_refresh_login', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'time_refresh_login'); ?>
    </div>

    <?php /* ?><div class="row">
      <?php echo $form->labelEx($model, 'membership_fee',array('label'=>'Membership Fee (S$)')); ?>
      <?php echo $form->textField($model, 'membership_fee', array('style'=>'width:350px;')); ?>
      <?php echo $form->error($model, 'membership_fee'); ?>
      </div><?php */ ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'distance', array('label' => 'Distance (in km)')); ?>
        <?php echo $form->textField($model, 'distance', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'distance'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'limit_result', array('label' => 'Limit result')); ?>
        <?php echo $form->textField($model, 'limit_result', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'limit_result'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'commission_coin', array('label' => 'Register reward')); ?>
        <?php echo $form->textField($model, 'commission_coin', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'commission_coin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'number_month_expired', array('label' => 'Number of month expired')); ?>
        <?php echo $form->textField($model, 'number_month_expired', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'number_month_expired'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'server_name', array('label' => 'Server Name For Cron Job')); ?>
        <?php echo $form->textField($model, 'server_name', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'server_name'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model, 'gst', array()); ?>
        <?php echo $form->textField($model, 'gst', array('style' => 'width:50px;', 'maxlength' => 3)); ?> %
        <?php echo $form->error($model, 'gst'); ?>
    </div> 
    
    <div class="row">
        <?php echo $form->labelEx($model, 'min_land_area', array('label'=>'Minimum Land Area <br>On Create New Listing ')); ?>
        <?php echo $form->textField($model, 'min_land_area', array('style' => 'width:50px;')); ?> sqft
        <?php echo $form->error($model, 'min_land_area'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model, 'min_floor_area', array('label'=>'Minimum Floor Area <br> On Create New Listing')); ?>
        <?php echo $form->textField($model, 'min_floor_area', array('style' => 'width:50px;')); ?> sqft
        <?php echo $form->error($model, 'min_floor_area'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model, 'unit_sqm_sqft', array('label'=>'1 Unit Sqm Equal')); ?>
        <?php echo $form->textField($model, 'unit_sqm_sqft', array('style' => 'width:50px;')); ?> sqft
        <?php echo $form->error($model, 'unit_sqm_sqft'); ?>
    </div> 
    
    <div class="row">
        <?php echo $form->labelEx($model, 'percent_profit_from_company_listing', array()); ?>
        <?php echo $form->textField($model, 'percent_profit_from_company_listing', array('style' => 'width:50px;')); ?> %
        <?php echo $form->error($model, 'percent_profit_from_company_listing'); ?>
    </div> 
    
    <div class="row">
        <?php echo $form->labelEx($model, 'telemarketer_comm', array()); ?>
        <?php echo $form->textField($model, 'telemarketer_comm', array('style' => 'width:50px;')); ?> %
        <?php echo $form->error($model, 'telemarketer_comm'); ?>
    </div> 

    <div class="row">
        <?php echo $form->labelEx($model, 'company_license', array()); ?>
        <?php echo $form->textField($model, 'company_license', array('style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'company_license'); ?>
    </div> 
    

    <div class="row">
        <?php echo $form->labelEx($model, 'side_bar_text_1', array('label'=>'Side bar my account (Landlord, Tenant)')); ?>
        <?php echo $form->textArea($model, 'side_bar_text_1', array('rows' => 5, 'cols' => 35, 'style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'side_bar_text_1'); ?>
    </div>
    
    <div class="row display_none">
        <?php echo $form->labelEx($model, 'side_bar_text_2', array('label'=>'Side bar my account (Landlord, Tenant) text 2')); ?>
        <?php echo $form->textArea($model, 'side_bar_text_2', array('rows' => 5, 'cols' => 35, 'style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'side_bar_text_2'); ?>
    </div>    
    <div class="row display_none">
        <?php echo $form->labelEx($model, 'place_holder_description_send_enquiry', array()); ?>
        <?php echo $form->textArea($model, 'place_holder_description_send_enquiry', array('rows' => 5, 'cols' => 35, 'style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'place_holder_description_send_enquiry'); ?>
    </div>    
    <div class="row display_none">
        <?php echo $form->labelEx($model, 'detail_property_place_holder_description_send_enquiry', array()); ?>
        <?php echo $form->textArea($model, 'detail_property_place_holder_description_send_enquiry', array('rows' => 5, 'cols' => 35, 'style' => 'width:350px;')); ?>
        <?php echo $form->error($model, 'detail_property_place_holder_description_send_enquiry'); ?>
    </div>    

</fieldset>