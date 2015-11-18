<?php
$LinkLogout = Yii::app()->createAbsoluteUrl('site/logout');
$LinkSubmitTestimonial = Yii::app()->createAbsoluteUrl('member/member_profile/submitTestimonials');
$LinkEditAccount='';
if(Yii::app()->user->role_id == ROLE_LANDLORD):
    // for landlord
    $LinkEditAccount = Yii::app()->createAbsoluteUrl('member/landlord/myprofile');
    $ListOfTenancies = ProTransactions::getListTenanciesLandlord(array('limit'=>  ProTransactions::LIMIT_PROPERTIES));
    $LinkViewAllTenancies = Yii::app()->createAbsoluteUrl('member/landlord/property');
endif;

$ListOfProperties = ProEngageUs::getListEngage(array('limit'=>  ProTransactions::LIMIT_PROPERTIES));
$cmsFormater = new CmsFormatter();
if(Yii::app()->user->role_id == ROLE_TENANT):
    $LinkEditAccount = Yii::app()->createAbsoluteUrl('member/tenant/myprofile');
    $ListOfTenancies = ProTransactions::getListTenancies(array('limit'=>  ProTransactions::LIMIT_PROPERTIES));
    $LinkViewAllTenancies = Yii::app()->createAbsoluteUrl('member/tenant/property');    
endif;
$LinkMyshortlist = Yii::app()->createAbsoluteUrl('member/member_profile/myshortlist');
$LinkEngageus = Yii::app()->createAbsoluteUrl('member/member_profile/engageus');

?>
<!--  aside -->
<aside class="sidebar">
    <!-- box -->
    <div class="box-7">
            <div class="user-wrap clearfix">
<!--            <div class="image">
                <img src="img/user.jpg" alt="image" />
            </div>-->
            <div class="content" style="margin-left: 0;">
                <p>Welcome: <?php echo Users::getFullNameById(Yii::app()->user->id);?></p>
                <p>Account Type: <?php echo Users::getAccountType(Yii::app()->user->role_id);?></p>
<!--                <p class="link">
                    <a href="<?php echo $LinkEditAccount;?>">Edit Account</a>
                    | <a href="#">Edit Profile</a>
                </p>-->
            </div>
        </div>
        <div class="date-wrap"><?php echo date('F d, Y l');?> <br>
            <span id="AdClock"></span>
        </div>        
        <h4>Dashboard</h4>
        
        <?php if(Yii::app()->user->role_id != ROLE_REGISTER_MEMBER): ?>
        <h5 class="expanded">Properties</h5>
        <div class="nav-content open">
            <div class="content-wrap bg">
                <?php 
                    $ManagingProperties = "List of Tenancies"; 
                    if(Yii::app()->user->role_id == ROLE_LANDLORD):
                        $ManagingProperties = "Managing Properties"; 
                    endif;
                ?>
                <p><?php echo $ManagingProperties;?></p>
                <ul>
                    <?php foreach($ListOfTenancies->data as $item): ?>
                        <li>
                            <?php echo $cmsFormater->formatpropertyname(array("name"=>$item->listing?$item->listing->property_name_or_address:'', "transaction_id"=>$item->id,'orther'=>(isset($item->listing)) ? $item->listing->display_address :'' ));?>
                        </li>
                    <?php endforeach;?>
                    <li><a href="<?php echo $LinkViewAllTenancies;?>">View All</a></li><!---- OneHome Property---->
                </ul>
            </div>
            
            <?php if(Yii::app()->user->role_id == ROLE_LANDLORD): ?>
            <?php 
                    $MarketingProperties = "List of Properties"; 
                    if(Yii::app()->user->role_id == ROLE_LANDLORD):
                        $MarketingProperties = "Marketing Properties"; 
                    endif;
                ?>
            <div class="content-wrap">
                <p><?php echo $MarketingProperties;?></p>
                <ul>
                    <?php foreach($ListOfProperties->data as $item): ?>
                        <li>
                            <?php echo $cmsFormater->formatpropertyname(array("name"=>$item->listing->property_name_or_address, "transaction_id"=>$item->transaction_id));?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
            <?php endif;?>            
        </div>
        <?php endif;?>
        
        <h5><a href="<?php echo $LinkEditAccount;?>">My Profile</a></h5>
        <!--<h5><a href="#">Customer Service Assistant</a></h5>-->
        <?php if(Yii::app()->user->role_id != ROLE_REGISTER_MEMBER): ?>
            <h5><a href="<?php echo $LinkSubmitTestimonial;?>">Submit Testimonial</a></h5>
        <?php else:?>
            <h5><a href="<?php echo $LinkMyshortlist;?>">My Shortlist</a></h5>
            <h5><a href="<?php echo $LinkEngageus;?>">Engage Us</a></h5>
        <?php endif;?>
        <h5><a href="<?php echo $LinkLogout;?>">Logout</a></h5>
        <ul class="list">
            <li class="first"><?php echo Yii::app()->params['side_bar_text_1'];?></li>
            <li><?php echo Yii::app()->params['side_bar_text_2'];?></li>
        </ul>
    </div>         
</aside>

<script>
// ANH DUNG COPY FROM BELOW    
function updateClock ( )
{
    //    http://www.sitepoint.com/create-jquery-digital-clock-jquery4u/        
    var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );
 
    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
 
    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
 
    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
 
    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;
 
    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
          
    $("#AdClock").html(currentTimeString);        
 }
 
 $(function(){
     setInterval('updateClock()', 1000);
 });
 
</script>