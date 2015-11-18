<div class="toan">
    <?php $i=1; ?>
   <?php if(is_array($menu) && count($menu)>0) :foreach ($menu as $key=> $item):  $arrMenu = $item; ?>
<div class="col" <?php echo $key; ?>>
    
    <?php  if(isset($arrMenu['parent'])):?>
            <h4><?php echo $arrMenu['parent']->title; ?></h4>
            <?php
                unset($arrMenu['parent']);
                if(count($arrMenu)>0): 
                    echo '<ul class="list">';
                    foreach ($arrMenu as $child):
            ?>
                     <li>
                         <a href=" <?php echo (!empty($child->external_link)) ? $child->external_link : Yii::app()->createAbsoluteUrl('page/index',array('slug'=>$child->slug));?>">
                             <?php echo $child->title; ?>
                         </a>
                     </li>
            <?php endforeach;echo '</ul>'; endif;?>
   <?php endif; ?>
</div>
    <?php if($i%4==0) echo "<div style='clear:both;'></div>"; ?>
    <?php $i++; ?>
<?php endforeach;endif; ?> 
</div>
<style>
    .toan{float:left;width: 820px;}
    
</style>