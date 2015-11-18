<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />   
    
    <title><?php echo 'Admin ' . CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="travis">
    
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->theme->baseUrl ?>/favicon.ico" />
    <link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl ?>/favicon.png" />
    
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/jquery-ui-1.8.18.custom.css" type=text/css rel=stylesheet>
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/site.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/form_verz.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/custom_mike.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/form.css" />
    

    
    <?php Yii::app()->getClientScript()->registerCoreScript('jquery');?>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
 <style>

    /*fix layout*/
    .btn-small{font-size:12px !important;}
    .grid-view table.items th{background-image: none;}
    ul.yiiPager a:link, ul.yiiPager a:visited{border: 1px solid #51A351;color: #51A351;}
    ul.yiiPager .selected a{background : none repeat scroll 0 0 #51A351;color: white;}
    ul.yiiPager a:hover{background : none repeat scroll 0 0 #DDDDDD;color: black;border: 1px solid #DDDDDD; }
</style>   
    
  </head>
    <body>
    <div class="navbar navbar-fixed-top">
                   <div class="logo">
                       <a href="<?php echo Yii::app()->createAbsoluteUrl('admin'); ?>"><img  style="width:90px;" src="<?php echo Yii::app()->theme->baseUrl ?>/img/inujobs-logo.png" alt="silkroute asia" /></a>
                          
                        
                        
                    </div>  
          <?php if(isset(Yii::app()->user->id)): ?>
                        <div class="btn-group pull-right">
                              <a class="btn" href="<?php echo Yii::app()->createAbsoluteUrl('admin/manageadmin/update_my_profile'); ?>"><i class="icon-user"></i> <?php echo Yii::app()->user->name;?></a>
                              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu">
                                  <li><a href="<?php echo Yii::app()->createAbsoluteUrl('admin/manageadmin/update_my_profile'); ?>">Profile</a></li>
                                  <li class="divider"></li>
                                  <li><a href="<?php echo Yii::app()->createAbsoluteUrl('admin/manageadmin/change_my_password'); ?>">Change password</a></li>
                                  <li class="divider"></li>
                                  <li><a href="<?php echo Yii::app()->createAbsoluteUrl('admin/site/logout'); ?>">Logout</a></li>
                              </ul>
                        </div>
                        <?php endif;?>  
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
<!--          <a class="brand" href="<?php echo Yii::app()->createAbsoluteUrl('admin/site/index'); ?>">
                <img  style="width:90px;" src="<?php echo Yii::app()->theme->baseUrl ?>/admin/images/inujobs-logo.png" alt="silkroute asia" />            
          </a>-->
         

          <div class="nav-collapse">
	       <?php
		    $menu = new ShowAdminMenu();
		    echo $menu->showMenu();
		?>
          </div>
        </div>
      </div>
    </div>
        <div class="clr"></div>
    <div class="container-fluid">
	<div class="row-fluid">
	    <?php if(isset($this->breadcrumbs)):?>
	    <?php $this->widget('ext.CBreadcrumbs.Cbreadcrumbs', array(
		    'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	    <?php endif?>
	    <?php echo $content; ?>
	</div>
<!--	<footer class="well">
        Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo Yii::app()->createAbsoluteUrl('/');?>">Inujobs</a> <br/>
	</footer>-->
        

        
        
    </div>
        
        <footer class="container-footer clearfix">
           <div class="wrapper">
               <p>Copyright &copy; 2013 <a href="<?php echo Yii::app()->createAbsoluteUrl('/');?>">Inujobs</a>. All Rights Reserved. Web design by <a target="_blank" href="http://www.verzdesign.com/"><strong class="verz">Verz</strong></a></p>
           </div>
       </footer>       
                
    <div style='display:none'>
          <div id='inline_content' style='background:#fff;'>
              <p><strong class="text_warning">You must enter a "Direct Phone Number"</strong></p>
          </div>
    </div>        
    </body>
</html>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/bootstrap.min.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		validateNumber();
                // Nguyen Dung
                $('.ui-datepicker-trigger').click(function(){
                    $('.ui-datepicker').css({'z-index':9999});
                });
                // Nguyen Dung
	});

/* Nguyen Dung add for multiselect */
    $(window).load(function(){
        $('.group_subscriber').find('.ui-multiselect').eq(0).click(function(){
//            $('.group_subscriber .fix-label').find('.ui-multiselect-checkboxes').css({height:'350px'});   
            if($(".ui-multiselect-menu").css('display')=='block')
                $('.ui-multiselect-menu').hide()
            else{
                $('.ui-multiselect-menu').show()
            }    
        });
    });
/* Nguyen Dung add for multiselect */    
        function validateNumber(){
		$(".number_only").each(function(){
			$(this).unbind("keydown");
			$(this).bind("keydown",function(event){
			    if( !(event.keyCode == 190   
                                  ||  event.keyCode == 8                                // backspace
			        || event.keyCode == 46                              // delete
			        || event.keyCode == 9							// tab
//			        || (event.keyCode == 190 || event.keyCode == 110 )							// dấu chấm (point) 
			        || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
			        || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
			        || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
			        ) {
			            event.preventDefault();     // Prevent character input
			    	}
			});
		});
	}     

   
   function showMsg(msg){
        $('.text_warning').html(msg);
        $.colorbox({width:"600px",height:'150px', inline:true, href:"#inline_content"});
   }
    
</script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/colorbox.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>    

<style>
.grid-view .pager{text-align:center;}
 .pager .next > a, .pager .next > span{float:none !important;}
 .pager .previous > a, .pager .previous > span{float:none !important;}
 .grid-view .summary{float:left;width:200px;text-align:left;margin-top:3px;}
 .hidden{float:left;}
#inline_content {vertical-align: middle;}
#inline_content p {text-align: center;margin-top: 29px;}

.dropdown-menu .divider{
    display: none;
}

/*div.form input[type="text"], div.form textarea, div.form select {width: 450px;}*/
</style>