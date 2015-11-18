<fieldset>
    <legend>Image Settings</legend>
    <div class="row">
        <div class="image-watermark">
            <?php
            if (empty($model->image_watermark))
                $image = 'no_photo.jpg';
            else
                $image = $model->image_watermark;
            ?>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/upload/admin/settings/<?php echo $image; ?>" alt="">
        </div>
        <div class='clr'></div>
        <div>
            <?php echo $form->labelEx($model, 'image_watermark2', array('label' => 'Watermark Photo')); ?>
            <?php echo $form->fileField($model, 'image_watermark2'); ?>
            <?php echo $form->error($model, 'image_watermark2'); ?>
            <p>Only png are allow</p>
        </div>
    </div>
    <div class='clr'></div>
</fieldset> 