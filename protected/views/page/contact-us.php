Contact Property Infologic
<!--<h1 class="title-page">Contact Property Infologic</h1>
<div class="contact-form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'contact-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div style="font-weight:bold;font-size:14px; color: #0066ff;margin-top: 10px;">
             <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif;?>
    <div class="form-type">
        <div class="clearfix">
            <h2>Feedback Form</h2>
            <p>You can use the form below to contact us on any matters. Whether it is a commercial enquiry or a technical fault - just fill in the form and click 'SEND MESSAGE'. We would also welcome any feedback or suggested changes you would like made to our service.</p>
        </div>
        <div class="in-row clearfix">
            <label class="lb-1"><span class="require">*</span> Enquiry Type :</label>
            <div class="group-3">
                <?php echo $form->dropdownlist($model, 'enquiry_type', array('class' => 'text')); ?>
                <?php echo $form->error($model, 'enquiry_type'); ?>
            </div>
        </div> 
        <div class="in-row clearfix">
            <label class="lb-1">Name :</label>
            <div class="group-3">
                <?php echo $form->textField($model,'name', array('class' => 'text')); ?>
                <?php echo $form->error($model,'name'); ?>
            </div>
        </div> 
        <div class="in-row clearfix">
            <label class="lb-1">Position :</label>
            <div class="group-3">
                <?php echo $form->textField($model,'position', array('class' => 'text')); ?>
                <?php echo $form->error($model,'position'); ?>
            </div>
        </div> 
        <div class="in-row clearfix">
            <label class="lb-1">Company :</label>
            <div class="group-3">
                <?php echo $form->textField($model,'company', array('class' => 'text')); ?>
                <?php echo $form->error($model,'company'); ?>
            </div>
        </div> 
        <div class="in-row clearfix">
            <label class="lb-1">Telephone :</label>
            <div class="group-3">
                <?php echo $form->textField($model,'phone', array('class' => 'text')); ?>
                <?php echo $form->error($model,'phone'); ?>
            </div>
        </div> 
        <div class="in-row clearfix">
            <label class="lb-1">Email Address :</label>
            <div class="group-3">
                <?php echo $form->textField($model,'email', array('class' => 'text')); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <label class="lb-1"><span class="require">*</span> Message :</label>
            <div class="group-3">
                <?php echo $form->textArea($model,'message', array('class' => 'text', 'rows' => 5, 'cols' => 30)); ?>
                <?php echo $form->error($model,'message'); ?>
            </div>
        </div>
        <?php // if(CCaptcha::checkRequirements()): ?>
        <div class="in-row captcha clearfix">
            <label class="lb-1">Please enter the text from the image to the 'security code'</label>
            <div class="group-3">
                <?php $this->widget('CCaptcha', array('captchaAction'=>'site/captcha'));?>
                <?php // $this->widget('CCaptcha', array('id'=>'change_captcha')); ?>
            </div>
        </div>
       
        <div class="in-row clearfix">
             <label class="lb-1"><span class="require">*</span> Security Code :</label>
            <?php echo $form->textField($model,'verifyCode'); ?>
             
             <?php echo $form->error($model, 'verifyCode'); ?> 
        </div>
        <?php // endif; ?>
        <div class="clearfix"><input type="submit" value="Send Message" class="btn-3" /></div>
          
    </div>

    <?php $this->endWidget(); ?>

</div>
<style>.lb{color:#333333 !important;}
    #recaptcha_response_field {line-height: normal !important;}
</style>
<script>
    $('#recaptcha_response_field').removeAttr('placeholder');
</script>
 contact info 
<div class="contact-info">
    <div id="map_canvas" class="map"></div>
     <div class="map" id="map">
                </div>
    <p>Visit our office. Here's our address and directions:</p>
    <h5><?php echo Yii::app()->setting->getItem('company_name'); ?></h5>
    <div class="line clearfix">
        <div class="col-1">
            <address><?php echo Yii::app()->setting->getItem('address'); ?></address>
        </div>
        <div class="col-2">
            <p><strong>Tel:</strong> <?php echo Yii::app()->setting->getItem('tel'); ?></br>
                <strong>Fax:</strong> <?php echo Yii::app()->setting->getItem('fax'); ?></br>
                <strong>Email:</strong> <a href="mailto:<?php echo Yii::app()->setting->getItem('email'); ?>"><?php echo Yii::app()->setting->getItem('email'); ?></a></p>
        </div>
    </div>
    <div class="clearfix">
        <div class="col-1">
            <h4><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-car.png" alt="car" /> By Car</h4>
            <?php echo Yii::app()->setting->getItem('movement_by_car'); ?>
           
        </div>
        <div class="col-2">
            <h4><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-train.png" alt="train" /> By train</h4>
            <?php echo Yii::app()->setting->getItem('movement_by_train'); ?>
        </div>
    </div>                    
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script src="<?php // echo Yii::app()->theme->baseUrl; ?>/js/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&region=ES"></script>
<script>
    var geocoder;
    var map;
    var query = "<?php echo Yii::app()->params['address_map']; ?>";
    
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var mapOptions = {
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        codeAddress();

    }

    function codeAddress() {
        var address = query;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);


                var contentString = "<?php echo Yii::app()->params['address_map']; ?>";
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                 var companyImage = new google.maps.MarkerImage('<?php echo Yii::app()->theme->baseUrl; ?>/img/point.png',
                    new google.maps.Size(86,74),
                    new google.maps.Point(0,0),
                    new google.maps.Point(37,54)
                );
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    title: "Address",
                    icon:companyImage,
                });

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });

            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    
    
</script>-->
