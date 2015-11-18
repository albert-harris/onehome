<?php
    /** May 19, 2014 ANH DUNG FIX breadcrumbs*/
    /** Sep 04, 2014 ANH DUNG FIX breadcrumbs for 
     * 1/ Landlord 
     * 2/ xxxx
     */
     $cAction = strtolower(Yii::app()->controller->action->id);
     $cController = strtolower(Yii::app()->controller->id);
    $aAlias = array(
        'myshortlist'=>'My Shortlist',
        'myprofile'=>'My Profile',
        'tenancies_detail'=>'Tenancy Details',
        'myshortlist'=>'My Shortlist',
        'sendenquiryshortlist'=>'Enquiry Multiple Listing',
        'agentlogin'=>'Saleperson Login',
        'login'=>'User Login',
        'property'=>'List of Tenancy',
        'engageus'=>'Engage Us',
    );
    
    $breadcrumbsText = isset($aAlias[$cAction])?$aAlias[$cAction]:Yii::app()->controller->action->id;
    /** May 19, 2014 ANH DUNG FIX breadcrumbs*/
    //HTram
    $breadcrumbs = array( ucfirst($breadcrumbsText) );
    // ANH DUNG Sep 05, 2014
    if($cAction == 'tenancies_detail' && $cController == 'landlord'){
        $breadcrumbs = array(
//            'Sample post'=>array('post/view', 'id'=>12),
            'List of Tenancies'=>array('landlord/property'),
            ucfirst($breadcrumbsText),
        );
    }elseif($cAction == 'tenancies_detail' && $cController == 'tenant'){
        $breadcrumbs = array(
            'List of Tenancies'=>array('tenant/property'),
            ucfirst($breadcrumbsText),
        );
    }
    elseif($cAction == 'sendenquiryshortlist' && $cController == 'member_profile'){
        $breadcrumbs = array(
            'My Shortlist'=>array('member_profile/myshortlist'),
            ucfirst($breadcrumbsText),
        );
    }
    // ANH DUNG Sep 05, 2014
?>

<?php
    echo '<div class="clearfix">';
    $this->widget('ext.CBreadcrumbs.Cbreadcrumbs', array(
                    'homeLink'=>  CHtml::link('Home',Yii::app()->getHomeUrl()),
                    'links'=>$breadcrumbs,
                    'htmlOptions'=>array('class'=>'breadcrumb','style'=>''),
                    'inactiveLinkTemplate'=>'<strong>{label}</strong>'
                ));
    echo '</div>';
?>