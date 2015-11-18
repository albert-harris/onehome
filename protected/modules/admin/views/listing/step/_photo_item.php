<li class="item-photo">
     <?php // if($data->default==0): ?>
    <img rel="<?php echo Yii::app()->createAbsoluteUrl('admin/listing/ajaxdelete_photo',array('listing'=>$data->listing_id,'photo'=>$data->id)) ?>" title="Remove photo" class="remove-photo" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/remove.png" >
     <?php // endif; ?>
    <div>
        <img src="<?php echo Yii::app()->createAbsoluteUrl('upload/listing/'.$data->listing_id."/120x96/".$data->image) ?>" class="rsTmb">
    </div>
    <?php if($data->default==0): ?>
    <input rel="<?php echo Yii::app()->createAbsoluteUrl('admin/listing/setdefault',array('listing'=>$data->listing_id,'photo'=>$data->id)) ?>"  type ="button" name="next"  class='btn-set-cover' value="Set as cover" />
    <?php endif; ?>
</li>