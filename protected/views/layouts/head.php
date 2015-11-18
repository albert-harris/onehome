<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com To change this template, choose Tools | Templates
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
?>
<head>
    <meta charset="utf-8" />
    <title><?php echo $this->pageTitle; ?></title>
    <meta name="dcterms.rightsHolder" content="onehome.sg – by Property InfoLogic" />
    <link rel="shortcut icon" href="http://www.onehome.sg/favicon.ico"/>
    <link rel="icon" type="image/gif" href="http://www.onehome.sg/animated_favicon1.gif"/>
    <meta name="viewport" content="width=1280" />
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico" />
    <link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />
    <?php
        // DTOAN - ANH DUNG chi sử dụng cho 1 số action, không bị bể layout
        $aActionLoad = array('index', 'listingdetail', 'addresslisting', 'salesperson_listing');
        $cAction = strtolower(Yii::app()->controller->action->id);
        if( (Yii::app()->controller->id=='site' && ( in_array($cAction, $aActionLoad) || Yii::app()->controller->action->id==''))
            || Yii::app()->controller->id=='listing' 
            || Yii::app()->controller->id=='page' 
            || Yii::app()->controller->action->id=='engageus'
            || (Yii::app()->controller->id=='agent' && Yii::app()->controller->action->id=='tenancy')
          ): 
    ?>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-multiselect.css" type="text/css">
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-multiselect.js"></script>
    <?php endif;?>    
    <!--<link rel="stylesheet" href="<?php // echo Yii::app()->theme->baseUrl; ?>/css/plugin.css" />-->

    <!-------add of home page--------------->
    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/themes/homepage/css/plugin.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/themes/homepage/css/main.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/themes/homepage/css/custom.css" />
    <!-------end add------------------------>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/verz_custom.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/verz_filter.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.bxslider.css" />
	
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.bxslider.min.js"></script>
	
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/verz.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/location-select.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/search-form.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/autoNumeric-master/autoNumeric-2.0-BETA.js"></script>	
    
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins.js"></script>
    
    
<script>
    
    $(window).load(function(){
        $(".show-image").fancybox();
        checkboxList('search');	
		
        $('#bn-list').bxSlider({
           mode: 'fade',
           auto: true,
           pager: false,
           controls: false,
           pause: 15000
         });

        $('#bn-list-bottom').bxSlider({
           mode: 'fade',
           auto: true,
           pager: false,
           controls: false,
           pause: 15000
         });
    });

    $('.shortlist').on('click', function(){
        var user_id = '<?php echo Yii::app()->user->id; ?>';
        var role_id = '<?php echo Yii::app()->user->role_id; ?>';
        var role_member = '<?php echo ROLE_REGISTER_MEMBER; ?>';

        if (user_id && role_id === role_member) {
            var listing_id = $(this).data('listing-id');
            var params = {};
            params["listing_id"] = listing_id;

            var url = '<?php echo Yii::app()->createAbsoluteUrl('site/addShortlist'); ?>';
            $.ajax({
                url: url,
                data:params,
                type:'POST',
                dataType : 'JSON',
                success : function(data) {
                    alert(data.message);
                },
                error: function() {
                    alert(data.message);
                }
            });
        }
        else{
            window.location = $(this).attr('next');
        }
    })

    
</script>
</head>