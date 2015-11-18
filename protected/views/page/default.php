<?php
    // ANH DUNG FIX JAN 09, 2015
    $mPage = Pages::findBySlug($_GET['slug']);
    if(! $mPage)
        throw new CHttpException(404, 'The requested page does not exist.');
    $page_id = $mPage->id;
    
    
?>
<!--  main container -->
<div class="main-inner">
    <?php
        if( in_array($page_id, Pages::$aPageSaleRent) ){
            include 'default_for_sale_rent.php';
        }else{
            include 'default_content.php';
        }
    ?>
    
</div>
<!--  aside -->
<aside class="sidebar">
    <?php include 'default_aside.php';?>
<!------ads banner----->
    <?php if( in_array($page_id, Pages::$aPageSaleRent) ):?>
        <?php $this->widget('PropertySearch'); ?>
    <?php else:?>
        <?php $this->widget('GlobalEnquiry'); ?>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/verz_fe_property_type.js"></script>
        <script>
            fnBindChangeMinMax('#minimum_price_engage', '#maximum_price_engage');
            fnBindChangeMinMax('#minimum_price_engage_rent', '#maximum_price_engage_rent');          
            fnBindChangeMinMax('#minimum_bedroom_engage', '#maximum_bedroom_engage');
            fnBindChangeMinMax('#minimum_bedroom_engage_rent', '#maximum_bedroom_engage_rent');
            fnBindChangeMinMax('#minimum_floor_engage', '#maximum_floor_engage');
            fnBindChangeMinMax('#minimum_floor_engage_rent', '#maximum_floor_engage_rent');
            fnCheckBoxClick();
        </script>
    <?php endif;?>
    <?php $this->widget('AdsBannerMiddleWidget'); ?>   
</aside>