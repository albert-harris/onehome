
<!DOCTYPE html>
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <?php  include_once 'head.php'; ?>
    <body>
        <!-- header -->
    	<?php include_once 'header.php'; ?>
        <!----content---->
        <?php echo $content;?>
        <!-----end--->
        <?php $this->widget('AdsBannerBottomWidget'); ?>
       <?php include_once 'footer.php'; ?>
    </body>
</html>
