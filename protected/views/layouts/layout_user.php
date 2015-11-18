<!DOCTYPE html>
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <?php  include_once 'head.php';; ?>
    <body>
    <!-- header -->
    <?php  include_once 'header.php';; ?>
    <?php
    /** May 19, 2014 ANH DUNG FIX breadcrumbs*/
    /** Sep 04, 2014 ANH DUNG FIX breadcrumbs for 
     * 1/ Landlord 
     * 2/ xxxx
     */
//    $aAlias = array(
//        'myshortlist'=>'My Shortlist',
//        'myprofile'=>'My Profile',
//        'tenancies_detail'=>'Tenancies Details',
//        'myshortlist'=>'My Shortlist',
//        'sendenquiryshortlist'=>'Enquiry Multiple Listing',
//        'agentlogin'=>'Saleperson Login',
//        'login'=>'User Login',
//		'property'=>'List of Tenancies',
//    );
//    
//    $breadcrumbsText = isset($aAlias[strtolower(Yii::app()->controller->action->id)])?$aAlias[strtolower(Yii::app()->controller->action->id)]:Yii::app()->controller->action->id;
//    /** May 19, 2014 ANH DUNG FIX breadcrumbs*/
//    
//    //HTram
//    $this->breadcrumbs = array(
//        ucfirst($breadcrumbsText),
////        array('controller'=>Yii::app()->controller->id,
////            'action'=>Yii::app()->controller->action->id
////            )
//        );
    ?>

    <div class="wrapper breadcrumb">
        <?php
//            if(isset($this->breadcrumbs)):
//                echo '<div class="clearfix">';
//                $this->widget('ext.CBreadcrumbs.Cbreadcrumbs', array(
//                                'homeLink'=>  CHtml::link('Home',Yii::app()->getHomeUrl()),
//                                'links'=>$this->breadcrumbs,
//                                'htmlOptions'=>array('class'=>'breadcrumb f-left','style'=>'margin-top:0px;'),
//                                'inactiveLinkTemplate'=>'<strong>{label}</strong>'
//                            ));
//                echo '</div>';
//            endif;
       ?>
    </div>
    <!-- main -->
    <div class="wrapper main clearfix">
        <?php echo $content; ?>
    </div>

    <?php include_once 'footer.php'; ?>

    <!--<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins.js"></script>-->
    </body>
</html>
