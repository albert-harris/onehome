<!DOCTYPE html>
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <?php  include_once 'head.php';; ?>
    <body ng-app>
    	<!-- header -->
    	<?php   include_once 'header_member.php';; ?>
            <div class="wrapper main clearfix">
                   <?php echo $this->renderPartial('application.modules.member.views._menu_user_info'); ?>
                   <?php
                        if(isset($this->breadcrumbs)):
                            echo '<div class="clearfix">';
                            $this->widget('ext.CBreadcrumbs.Cbreadcrumbs', array(
                                            'homeLink'=>  CHtml::link('Home',Yii::app()->getHomeUrl()),
                                            'links'=>$this->breadcrumbs,
                                            'htmlOptions'=>array('class'=>'breadcrumb f-left','style'=>'margin-top:0px;'),
                                            'inactiveLinkTemplate'=>'<strong>{label}</strong>'
                                        ));
                            echo '</div>';
                        endif;
                   ?>
                   <?php echo $content; ?>
           </div>        
       <?php include_once 'footer.php'; ?>
		
        <!-- ANH DUNG REMOVE CHU Y LUON DUNG Yii::app()->clientScript->registerCoreScript('jquery');
        <script src="<?php // echo Yii::app()->theme->baseUrl; ?>/js/vendor/jquery-1.8.3.min.js"></script>-->
        <!--<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins.js"></script>-->
    </body>
</html>
