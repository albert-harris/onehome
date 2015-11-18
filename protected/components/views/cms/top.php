<?php  ?>
<nav class="menu">
    <ul id="menu" class="clearfix">
        <li  <?php if(($controller->action->id=='index' || $controller->action->id=='') && $controller->id=='site' ) echo 'class="current-menu-item"' ?> ><a href="<?php echo Yii::app()->getHomeUrl(); ?>" class="first">HOme</a></li>
        <?php if(is_array($menu) && count($menu)>0): foreach ($menu as $key=>$item): ?>
        <?php $link = (!empty($item['parent']->external_link)) ? $item['parent']->external_link : Yii::app()->createAbsoluteUrl('page/index',array('slug'=>$item['parent']->slug));?>
        
        <?php
                $active='';
                if(isset($_GET['slug']) && trim($_GET['slug'])== $item['parent']->page_slug)
                    $active = 'class="current-menu-item"';
        ?>
        
        <li <?php echo $active; ?> >
            <a href="<?php echo $link; ?>"><?php echo $item['parent']->title; ?></a>
        </li>
        <?php endforeach;endif; ?>
    </ul>
</nav>