<div id="one_image" style="float: left; width: 842px; height: 117px; border: 1px solid; border-radius: 8px;
            margin: 5px 0;">
    <div style="float: left; padding: 5px;">
        <li value="<?php echo $model->id; ?>" name="<?php echo $model->url; ?>" style="display: inline-block;">
            <a href="#media">
                    <?php echo CHtml::image(Yii::app()->baseUrl .
                            "/upload/uploaded_" . $model->user_id . "/adminthumb/" . $model->url, "image",
                            array(                                
                                'border' => 'medium')); ?>
            </a>
            <br/>
            <div class="image-name" id="image-upload-name-<?php echo $model->id; ?>"> 
                <?php echo StringHelper::createShortEnd($model->title, 10) ?>
            </div>
        </li> 
        </div>
        <div style="float: right; padding: 42px 18px 0 0;">
        <a name="<?php echo $model->url; ?>" class="image-upload-set" value="<?php echo $model->id; ?>" href="#media" >Set Featured</a>
        </div>            
</div>