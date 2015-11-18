<?php

/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
?>
<!--<div class="info-box clearfix">
    <div class="image"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/img-user.jpg" alt="image" /></div>
    <div class="col-1">
        <p>Welcome, <strong>Mr. Arthur Zhang</strong></p>
        <p><strong>Commission Scheme:</strong> 80%</p>
        <p><a href="#">Edit Profile</a></p>
    </div>
    <div class="col-2">
        <p><strong>Designation:</strong> Senior Associate Consultant (SAC)</p>
    </div>
</div>     -->

<?php
$this->widget('zii.widgets.CMenu', array(
    'items'=>array(
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default acion is used.
        array('label'=>'Home', 'url'=>array('site/index')),
        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
        array('label'=>'Products', 'url'=>array('product/index'), 'items'=>array(
            array('label'=>'New Arrivals', 'url'=>array('product/new', 'tag'=>'new')),
            array('label'=>'Most Popular', 'url'=>array('product/index', 'tag'=>'popular')),
        )),
        array('label'=>'Login', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
    ),
));
?>