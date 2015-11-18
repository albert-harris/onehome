
<?php
$parent_page = Pages::findRootParentModel($page_id);
$listchild = Pages::findChildOfPages($page_id);
if((!empty($parent_page) && $parent_page->slug != $_GET['slug']) || !empty($listchild)){
        $child_page = Pages::findChildOfPages($parent_page->id);
    
?>
    <!-- box -->
    <div class="box-1">
        <div class="title"><h3><?php echo $parent_page->title ?></h3></div>
        <div class="content">
            <ul class="nav-list">
                <?php
                if(!empty($child_page)){
                    foreach ($child_page as $item){
                        if($item->external_link != ""){
                            $href = $item->external_link;
                        }
                        else{
                            $href = Yii::app()->createAbsoluteUrl("page/index", array('slug'=>$item->slug));
//                            $href = Yii::app()->createAbsoluteUrl("page".$item->slug);??? ai code
                        }
                        $class_li = "";
                        if($_GET['slug']==$item->slug){
                            $class_li .= "active";
                        }
                ?>
                <li class="<?php echo $class_li; ?>"><a href="<?php echo $href ?>"><?php echo $item->title; ?></a></li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
<?php } ?>