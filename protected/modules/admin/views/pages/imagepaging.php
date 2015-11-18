<div style="float:right; padding-right: 42px;">
<?php $this->widget('CLinkPager', array('pages' => $pages, 'id' => 'link_pager')) ?>
</div>

<div style="clear: both;"></div>
<ul  id="resultHolder" style="display: block;">
<?php
            foreach ($list as $data) {
                echo '               
                    <li class="image" value="' . $data->id . '" name="' . $data->
                    url . '" style="opacity: 0.67; display: inline-block; height: 111px; width: 121px;"><a href="#media">';
                echo CHtml::image(Yii::app()->baseUrl . "/upload/uploaded_" . $user_id_image .
                    "/adminthumb/" . $data->url, "image", array(                    
                    'border' => 'medium'));
                echo '</a><br/><div class="image-name" id="image-name-' . $data->id . '">' .
                    StringHelper::createShortEnd($data->title, 10) . '</div></li>';
            } ?>
</ul>