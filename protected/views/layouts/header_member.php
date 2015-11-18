<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com 
 */
?>
<div class="top-header ">
            <div class="wrapper clearfix">
                <?php if(Yii::app()->user->id): ?>
                   <ul class="links drop-right">
                       <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/myprofile'); ?>"><span class="icon-user"></span> Welcome, <em><?php echo Yii::app()->user->first_name.' '.Yii::app()->user->last_name ?></em></a>
                        <?php if(Yii::app()->user->role_id == ROLE_REGISTER_MEMBER): ?>
                            <ul>
                                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/myprofile') ?>">My Profile</a></li>
                                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/myshortlist') ?>">My Shortlist</a></li>
                                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout') ?>">Logout</a></li>
                            </ul>
                            <?php elseif(Yii::app()->user->role_id == ROLE_TENANT): ?>
                                <ul>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/tenant/property') ?>">Properties</a></li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/tenant/myprofile') ?>">My Profile</a></li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/submitTestimonials') ?>">Submit Testimonials</a></li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout') ?>">Logout</a></li>
                                </ul>
                            <?php elseif(Yii::app()->user->role_id == ROLE_AGENT): ?>
                                <ul>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/dashboard') ?>">DashBoard</a></li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/agent/myprofile') ?>">My Profile</a></li>
                                    <li><a href="<?php echo ProAgent::getForumLoginUrl(Yii::app()->user->id) ?>" target="_blank">Discussion Forum</a></li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout') ?>">Logout</a></li>
                                </ul>
                            <?php else: ?>
                                <ul>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/landlord/property') ?>">Properties</a></li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/landlord/myprofile') ?>">My Profile</a></li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/submitTestimonials') ?>">Submit Testimonials</a></li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout') ?>">Logout</a></li>
                                </ul>
                            <?php endif; ?>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="links">
                    <li><a href="#"><span class="icon-user"></span> Client Login</a>
                        <ul>
                            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/landlordlogin'); ?>">Landlord Login</a></li>
                            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/tenantlogin'); ?>">Tenant Login</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span class="icon-user"></span> Agent Login</a>
                        <ul>
                            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/agentlogin'); ?>">Onehome Agent login</a></li>
                            <!--<li><a href="#">External Agent login</a></li>-->
                        </ul>
                    </li>
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/login'); ?>"><span class="icon-lock"></span> User Login</a></li>
                </ul>
                <ul class="links drop-right">
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/register'); ?>"><span class="icon-user"></span> Register</a>
<!--                        <ul>
                            <li><a href="#">Member Registration</a></li>
                            <li><a href="#">Associate Agent Registration</a></li>
                            <li><a href="#">External Agent Registration</a></li>
                        </ul>-->
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
<header class="header-container head-page">
    <div class="wrapper clearfix">
        <!--<div class="clearfix">-->
            <div class="logo"><a href="<?php echo Yii::app()->createAbsoluteUrl(''); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/property-infologic-logo.png" alt="Property Infologic" /></a></div>
        <!--</div>-->
        <nav>
            <?php        
                $this->widget('ext.CMenu.CMenu', array(
                        'linkLabelWrapper' => 'span',
                        'activeCssClass'=>'active',
                        'htmlOptions'=>array(
                           'class'=>'menu',
                           'id'=>'menu'
                        ),                   
                        'items'=>array(
                                 array(
                                        'label'=>'Dashboard',
                                        'active'=>(Yii::app()->controller->id=='dashboard') ? true:false, 
                                        'url'=>array('/member/dashboard')
                                     ),
                                 array(
                                        'label'=>'Advertisements',
                                        'active'=>(Yii::app()->controller->id=='listing') ? true:false,
                                        'url'=>array('/member/listing')
                                     ),
                                 array(
                                        'label'=>'Transactions',
                                     '  active'=>(Yii::app()->controller->id=='member_profile'&& Yii::app()->controller->action->id=='transactionManagement') ? true:false,
                                        'url'=>array('/member/member_profile/transactionManagement')
                                     ),
                                 array(
                                        'label'=>'Commissions Log',
                                        'active'=>(Yii::app()->controller->id=='member_profile' && Yii::app()->controller->action->id=='commissionLog' ) ? true:false, 
                                        'url'=>array('/member/member_profile/commissionLog')
                                     ),
                                 array(
                                        'label'=>'Company Listing',
                                        'active'=>(Yii::app()->controller->id=='company' ) ? true:false, 
                                        'url'=>array('/member/company')
                                     ),
                                 array(
                                        'label'=>'Tenancy',
                                        'active'=>(Yii::app()->controller->id=='agent' && Yii::app()->controller->action->id=='tenancy') ? true:false,
                                        'url'=>array('/member/agent/tenancy')
                                     ),
                                 array(
                                        'label'=>'Enquiries','active'=>(Yii::app()->controller->id=='enquiries') ? true:false,
                                        'url'=>array('/member/enquiries')
                                     ),
                                 array(
                                        'label'=>'Download',
                                        'active'=>(Yii::app()->controller->id=='agent' && Yii::app()->controller->action->id=='download') ? true:false,
                                        'url'=>array('/member/agent/download')
                                     ),
                       ),

                ));          
            ?>             
        </nav>
    </div>
</header>