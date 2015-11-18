<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com To change this template, choose Tools | Templates
 */
?>

<tr style="font-size: 12px;">
    <td class="first"><?php echo $index+1; ?></td>
    <td><?php echo $data->title; ?></td>
        <td><a  href="<?php echo Yii::app()->createAbsoluteUrl('site/download',array('class'=>'ProListingUploadCea','file_id'=>$data->id,'field'=>'file')) ?>">Download</a></td>
    <td class="last"><a class="btn-2 remove-file-doc" rel="<?php echo Yii::app()->createAbsoluteUrl('member/listing/ajaxdelete_doc',array('listing'=>$data->listing_id,'doc'=>$data->id)) ?>"  href="javascript:;">Remove</a></td>
</tr>