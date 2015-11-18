<div class="clr"></div>
<div class="box_inventory_photo" style="">    
    <?php
        $form = $this->beginWidget('CActiveForm', array(
            'method' => 'post',
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
        ));
        $countModelPhoto = count($aModelPhoto);
        ?>
    
    <div class="form-type inventory_photo_upload l_padding_100" >
        <div class="in-row clearfix">
            <label class="lb">Upload Photo</label>
            
            <div class="group-upload f-left w-400">
                <?php echo $form->fileField($model,'file_name', array('class'=>'file_name') );?>  
                <span>Only <?php echo ProInventoryPhoto::$AllowFile ;?> are allow</span>
                <input type="hidden" name="ClassName" value="ProInventoryPhoto">
                <input type="hidden" name="Scenario" value="file_upload">
                <input type="hidden" name="ColumnNameFile" value="file_name">
                <input type="hidden" name="transaction_id" value="<?php echo $model->transaction_id;?>">
            </div>
            
        </div>
    </div>
    
    <?php $this->endWidget(); ?>
    <div class="clr"></div>
    
    <div class="inventory_photo_show">
        <ul class="photo-list clearfix">
            <?php foreach($aModelPhoto as $key=>$item):?>
            <?php 
                $first = 'first';
                $last = 'last';
                if($key!=0)
                    $first = '';
                if($key!= ($countModelPhoto-1))
                    $last = '';
                $pathPhoto = ImageProcessing::bindImageByModel($item, 160, 160);
                $pathPhotoBig = ImageProcessing::bindImageByModel($item, -1, -1);
                $linkRemove = '';
                $CanRemove = $item->user_id == Yii::app()->user->id?true:false;
                if($CanRemove){
                    $linkRemove = Yii::app()->createAbsoluteUrl('admin/transactions/inventoryPhoto', array('id'=>$model->transaction_id, 'InventoryPhotoId'=>$item->id));
                }
            ?>
            <li class="<?php echo $first." $last" ;?>" >
                <a href="<?php echo $pathPhotoBig;?>" class="FancyPhoto"  rel='group'>
                    <img src="<?php echo $pathPhoto;?>" alt="image">
                </a>
                <?php if($CanRemove):// ANH DUNG CLOSE AUT 20, 2014 ?>
                <?php // if(0):?>
                <a href="javascript:void(0);" next="<?php echo $linkRemove;?>" class="ico-delete remove_file_js"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-delete.png" alt="delete"></a>
                <?php endif;?>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div><!--end box_inventory_photo-->
