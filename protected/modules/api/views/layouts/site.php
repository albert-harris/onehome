<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="65doctor.com – by 65 Doctor" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico" />
<link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style2.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jnice.css" />

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancyBox/source/jquery.fancybox.css?v=2.0.6" media="screen" />

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2" />
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/tooltip.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.yiiactiveform.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jnice.js"></script>


<script type="text/javascript">
$(document).ready(function(){
	//tooltip
	$(".tool").tooltip({ offset: [8,100], effect: 'slide'});
	// header stick
	$(window).scroll(function(){
            if($(".search-result").size()>0){
		var h = $(".search-result").offset().top;
		var top = $(window).scrollTop();
		if( top > h ) // height of float header
			$("#header_stick").addClass("stick");
		else
			$("#header_stick").removeClass("stick");
            }
	})
});
</script>

<!--[if lt IE 9]>
<style type="text/css">
	.banner .search-form, .page .page-link a, section .content, aside .people, .tab-container, .document img, .booking .group-1 img, .doctor-profile .image, .profile .group-2 img, .profile .group-2 .map, .box, .list-4 li, .health-info .link { behavior: url(<?php echo Yii::app()->theme->baseUrl; ?>/PIE.htc); }
</style>
<![endif]-->
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js//sharethis.js"></script>
<script type="text/javascript">stLight.options({publisher: "ur-b6512971-795c-3992-16f1-99cee80688f"}); </script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33333926-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body class="innerpage" onLoad="">
	<header>
    	<div class="wrapper">
        	<div class="logo"><a href="<?php echo Yii::app()->createAbsoluteUrl('/');?>"><?php echo Yii::t('translation','layout.site.Doctor65');?></a></div>
            <div class="share">
            	<p><?php echo Yii::t('translation','layout.site.Share_this');?></p>
                <span class='st_twitter_large' displayText='Tweet'></span>
                <span class='st_facebook_large' displayText='Facebook'></span>
                <span class='st_linkedin_large' displayText='LinkedIn'></span>
                <span class='st_googleplus_large' displayText='Google +'></span>
            </div>
            <?php $this->widget('LangBox'); ?>
            <nav>
            	<ul>
                    <li class="home"><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>"><?php  echo Yii::t('translation','layout.site.Find_a_Doctor');?></a></li>
                    <?php if(isset(Yii::app()->user->id)): ?>    
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/member/site/logout'); ?>"><?php echo Yii::t('translation','layout.site.Logout');?></a></li>
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/member/users/profile'); ?>"><?php  echo Yii::t('translation','layout.site.My_Account');?></a></li>
                    <?php else :?>
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/member/site/chooselogin'); ?>"><?php echo Yii::t('translation','layout.site.Login');?></a></li>
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/member/site/chooseregister'); ?>"><?php  echo Yii::t('translation','layout.site.Join_Now');?></a></li>
                    <?php endif;?>
                </ul>
            </nav>
            <ul class="link">
                <li class="twitter"><a href="https://twitter.com/#!/65doctor" target="_bank"><?php  echo Yii::t('translation','layout.site.Follow_us_on_Twitter');?></a></li>
            	<li><a href="https://www.facebook.com/pages/65doctor/267042123402667" target="_bank"><?php  echo Yii::t('translation','layout.site.Find_us_on_Facebook');?></a></li>
            </ul>
        </div>
    </header><!-- //header -->
     <?php 
	$specialty = Specialty::model()->findAll(array('order'=>'first_char ASC'));
	$banner = Banners::model()->findAll(array('order'=>'RAND()','limit'=>'1'));
	$body_part = BodyPart::model()->findAll(array('condition'=>'parent_id IS NULL'));

    Yii::app()->clientScript->registerScript('search', "
        $('#search_submit').click(function(){
            if( $('#specialty').val()=='' && $('#doctor_clinic').val() == ''){
                alert('" . Yii::t('translation','layout.site.Please_choose_Specialty_OR_type_Doctor_name_to_search_for_doctor') ."');
                return false;
            }
        });
    ");
	?>
    <div class="banner">
    	<div class="wrapper">
        	<div class="search-form">
                <p class="title"><strong><?php  echo Yii::t('translation','layout.site.It_s_FREE');?></strong></p>
                <?php echo CHtml::form(Yii::app()->createAbsoluteUrl('/search/index/'), 'get', array('id'=>'search-form','class'=>'jNice')) ?>
                	<input type="hidden" name="find-doctor" value="1" />
                    <fieldset>
                        <p class="type"><?php  echo Yii::t('translation','layout.site.Find_a_Doctor');?></p>
                        <div class="group">
                            <div class="row">
                                <?php echo CHtml::dropDownList('specialty', '', Specialty::findAllArray()); ?>
                            </div>
                            <div class="row">
                                <?php echo CHtml::dropDownList('hospital', '', Hospital::findAllArray()); ?>
                            </div>
                        </div>
                        <div class="group">
                            <div class="row">
                                <?php echo CHtml::dropDownList('insurance', '', Insurance::findAllArray()); ?>
                            </div>
                            <div class="row">
                                <input type="text" name="doctor_clinic" id="doctor_clinic" placeholder="<?php  echo Yii::t('translation','layout.site.by_Doctor_s_Name');?>" />
                            </div>
                        </div>
                        <ul class="check-list">
                            <li><input type="checkbox" id="appointment_today" name="appointment_today" value="1" /><label for="check-1"><?php echo Yii::t('translation','layout.site.Available_for_appointment_today');?></label></li>
                            <li><input type="checkbox" id="male_doctor" name="male_doctor" value="1" /><label for="male_doctor"><?php  echo Yii::t('translation','layout.site.Male_Doctor');?></label></li>
                            <li><input type="checkbox" id="female_doctor" name="female_doctor" value="1" /><label for="female_doctor"><?php  echo Yii::t('translation','layout.site.Female_Doctor');?></label></li>
                        </ul>
                        <input id="search_submit" type="submit" value="<?php  echo Yii::t('translation','layout.site.Search');?>" />
                    </fieldset>
                </form>
    		</div>
        </div>
    </div>
    <div id="main">
    	<div class="wrapper">
            <div class="text text_emergencies">
                <p><?php echo Yii::t('translation','layout.site.For_emergencies_or_urgent_medical');?></p>   
                <p><?php  echo Yii::t('translation','layout.site.Do_not_book_online_for_emergency');?></p>
            </div>
            <div class="maincontent">
               <?php echo $content; ?>
            </div><!-- maincontent -->
            <div class="clear"></div>
    	</div>
    </div><!-- //main -->
    <footer>
        <div class="wrapper">
            <div class="group-1"><span class="term-corner">E. &amp; O.E</span><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/view_cms_slug/slug/'.ActiveRecord::getSlugPrivacyPolicy()) ?>"><?php  echo Yii::t('translation','layout.site.Privacy_Policy');?></a> | 
                <a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/view_cms_slug/slug/'.ActiveRecord::getSlugTermsOfUse()) ?>"><?php  echo Yii::t('translation','site.book.Terms_of_Use');?></a> |
                <a href="<?php echo Yii::app()->createAbsoluteUrl('site/contact') ?>"><?php echo Yii::t('translation','layout.site.Contact');?></a></div>
            <div class="group-2"><?php echo Yii::t('translation','layout.site.Copyright');?></div>
        </div>
    </footer><!-- //footer -->
    

</body>
</html>
<script>
    // placeholder polyfill
    $(document).ready(function(){
        function add() {
            if($(this).val() == ''){
                $(this).val($(this).attr('placeholder')).addClass('placeholder');
            }
        }

        function remove() {
            if($(this).val() == $(this).attr('placeholder')){
                $(this).val('').removeClass('placeholder');
            }
        }

        // Create a dummy element for feature detection
        if (!('placeholder' in $('<input>')[0])) {

            // Select the elements that have a placeholder attribute
            $('input[placeholder], textarea[placeholder]').blur(add).focus(remove).each(add);

            // Remove the placeholder text before the form is submitted
            $('form').submit(function(){
                $(this).find('input[placeholder], textarea[placeholder]').each(remove);
            });
        }
    });
    
    function authorizeUser(this_) {
        var provider = $(this_).attr('rel');
        if(provider=='facebook'){
            FB.login(function(response) {
                if (response.authResponse) {
                    window.location = "<?php echo Yii::app()->createAbsoluteUrl('member/auth/fblogin');?>";
                } else {
                    // cancelled
                }
            },{scope: 'email,user_likes'});
        }else if(provider=='yahoo'){
            window.location = "<?php echo Yii::app()->createAbsoluteUrl('member/auth/LoginYahoo');?>";
        }else if(provider=='google'){
            window.location = "<?php echo Yii::app()->createAbsoluteUrl('member/auth/LoginGoogle');?>";
        }else if(provider=='twitter'){
        }
    }    
    
</script>
