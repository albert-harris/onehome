<footer class="footer-container">
    <div class="wrapper clearfix">
        <div class="clearfix">
            <div class="logo">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('site/home'); ?>"><img src="<?php echo Yii::app()->baseUrl ?>/themes/homepage/img/one-home-logo-foot.png" alt="One Home" /></a>
            </div>
            <div class="links-group">
                <h4>SITEMAP</h4>
                <?php
                $menuFe = new ShowMenu();
                echo $menuFe->showMenu_footer();
                ?>
            </div>
            <div class="contact-info">
                <h4>CONTACT US</h4>
                <p><?php echo Yii::app()->setting->getItem('company_name'); ?></p>
                <address><?php echo Yii::app()->setting->getItem('address'); ?></address>
                <p><a href="mailto:<?php echo Yii::app()->setting->getItem('email'); ?>"><?php echo Yii::app()->setting->getItem('email'); ?></a></p>
            </div>
            <div class="social">
                <!-----newsletter-------->
                <h4>NEWSLETTER</h4>
                <p>Receive the latest deals, news and special offers from OneHome.sg</p>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'guest-subscribe-form',
                    'action' => Yii::app()->createAbsoluteUrl('/Site/GuestSubscriber'),
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array(
                        'class' => 'newsletter',
                    ),
                ));
                ?>
                <div class="in-row clearfix">
                    <input name="guest_mail" type="text" placeholder="Type in your email address here" class="text" id="guest_mail" onKeyPress="return event.keyCode != 13;" />
                    <input type="submit" value="SIGNUP" class="btn" id="btn_Subscribe" />
                </div>
                <div  class="errorSummary " style='visibility: hidden;'>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#btn_Subscribe').unbind('click').bind('click', function () {
                            var email = $('#guest_mail').val();
                            // begin ajax
                            var url_ = "<?php echo Yii::app()->createAbsoluteUrl('site/GuestSubscriber'); ?>";
                            $.ajax({
                                url: url_,
                                data: {email: email, ajax: 'ajax'},
                                type: "post",
                                dataType: "json",
                                async: false,
                                success: function (data) {
                                    if (data['success'] == true) {
                                        $('#btn_Subscribe').parent().next('.errorSummary').css({visibility: "visible", color: "#0099FF"}).text("Successfully!");
                                        $('#guest_mail').replaceWith('<input name="guest_mail" type="text" placeholder="Type in youe email address here" class="text" id="guest_mail" onKeyPress="return event.keyCode!=13;" />');
                                    } else {
                                        $('#btn_Subscribe').parent().next('.errorSummary').css({visibility: "visible", color: "#FF0000"}).text(data['msg']);
                                        return false;
                                    }
                                }
                            });
                            return false;
                            // end ajax
                        });
                    });
                </script>
                <?php $this->endWidget(); ?>
                <!-----end newsletter--------->
                <h4>CONNECT WITH US</h4>
                <ul>
                    <li><a href="<?php echo Yii::app()->setting->getItem('follow_us_facebook'); ?>"><span class="icon-facebook"></span> Facebook</a></li>
                    <li><a href="<?php echo Yii::app()->setting->getItem('follow_us_twitter'); ?>"><span class="icon-twitter"></span> Twitter</a></li>
<!--                    <li><a href="<?php echo Yii::app()->setting->getItem('follow_us_instagram'); ?>"><span class="icon-instagram"></span> Instagram</a></li>
                    <li><a href="<?php echo Yii::app()->setting->getItem('follow_us_google'); ?>"><span class="icon-gplus"></span> Google +</a></li>
                    <li><a href="<?php echo Yii::app()->setting->getItem('follow_us_linkedin'); ?>"><span class="icon-linkedin"></span> LinkedIn</a></li>
                    <li><a href="<?php echo Yii::app()->setting->getItem('follow_us_tumblr'); ?>"><span class="icon-tumblr"></span> Tumblr</a></li>-->
                </ul>
            </div>
        </div>
        <div class="copyright"><?php echo Yii::app()->setting->getItem('copyright_on_footer'); ?></div>
    </div>
</footer>

<!-- end model content -->
    <!--<script src="<?php echo Yii::app()->baseUrl ?>/themes/homepage/js/vendor/jquery-1.8.3.min.js"></script>-->
<script src="http://www.onehome.sg/themes/property/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/themes/homepage/js/jquery.bxslider.min.js"></script>
<!--        <script src="<?php echo Yii::app()->baseUrl ?>/themes/homepage/js/plugins.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/themes/homepage/js/location-select.js"></script>-->
<script>
    $(document).ready(function () {
        $('.product-slider').bxSlider({
            slideWidth: 268,
            minSlides: 4,
            maxSlides: 4,
            slideMargin: 30,
            pager: false,
            infiniteLoop: false
            //moveSlides: 1
        });
    });
</script>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-58314527-1', 'auto');
    ga('send', 'pageview');

</script>