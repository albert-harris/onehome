<?php
if($aModelPhoto){
?>
<div class="inventory_photo_show">
    <ul class="photo-list clearfix">
        <?php foreach ($aModelPhoto as $key => $item): ?>
            <?php
            $first = 'first';
            $last = 'last';
            if ($key != 0)
                $first = '';
            if ($key != ($countModelPhoto - 1))
                $last = '';
            $pathPhoto = ImageProcessing::bindImageByModel($item, 160, 160);
            $pathPhotoBig = ImageProcessing::bindImageByModel($item, -1, -1);
            $linkRemove = '';
            $CanRemove = $item->user_id == Yii::app()->user->id ? true : false;
            if ($CanRemove) {
                $linkRemove = Yii::app()->createAbsoluteUrl('admin/tenancy/inventoryPhoto', array('id' => $model->transaction_id, 'InventoryPhotoId' => $item->id));
            }
            ?>
            <li class="<?php echo $first . " $last"; ?>" >
                <a href="<?php echo $pathPhotoBig; ?>" class="FancyPhoto"  rel='group' target="_blank">
                    <img src="<?php echo $pathPhoto; ?>" alt="image">
                </a>
                <?php if ($CanRemove):// ANH DUNG CLOSE AUT 20, 2014 ?>
                    <?php // if(0):?>
                    <a href="javascript:void(0);" next="<?php echo $linkRemove; ?>" class="ico-delete remove_file_js"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-delete.png" alt="delete"></a>
                    <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php
}else{
    echo '<p>No results found.</p>';
}
?>