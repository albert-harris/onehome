<h3 class="uppercase">Inventory Photo</h3>
<div class="box_inventory_photo" style="">
    <!--<div class="form-type upload_inventory_photo" style="border-top: none;border-left: none;border-right: none;">-->
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'method' => 'post',
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
        ));
        $transaction_id = isset($_GET['transaction_id'])?$_GET['transaction_id']:0;
        $mProInventoryPhoto = new ProInventoryPhoto();
        $aModelPhoto = ProInventoryPhoto::GetByUidAndTransactionId(Yii::app()->user->id, $transaction_id);
        $countModelPhoto = count($aModelPhoto);
        ?>
    <?php /*
    <div class="form-type inventory_photo_upload" >
        <div class="in-row clearfix">
            <label class="lb">Upload Photo</label>
            
            <div class="group-upload f-left w-400">
                <?php echo $form->fileField($mProInventoryPhoto,'file_name', array('class'=>'file_name') );?>  
                <span>Only <?php echo ProInventoryPhoto::$AllowFile ;?> are allow</span>
                <input type="hidden" name="ClassName" value="ProInventoryPhoto">
                <input type="hidden" name="Scenario" value="file_upload">
                <input type="hidden" name="ColumnNameFile" value="file_name">
                <input type="hidden" name="transaction_id" value="<?php echo $transaction_id?>">
            </div>
            
        </div>
    </div>
    */ ?>
    
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
                    $linkRemove = Yii::app()->createAbsoluteUrl('enquiry/ajaxRemoveFileAll', array('id'=>$item->id));
                }
            ?>
            <li class="<?php echo $first." $last" ;?>" >
                <a href="<?php echo $pathPhotoBig;?>" class="FancyPhoto"  rel='group'>
                    <img src="<?php echo $pathPhoto;?>" alt="image">
                </a>
                <?php // if($CanRemove): ANH DUNG CLOSE AUT 20, 2014 ?>
                <?php if(0):?>
                <a href="javascript:void(0);" next="<?php echo $linkRemove;?>" class="ico-delete remove_file_js"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-delete.png" alt="delete"></a>
                <?php endif;?>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<!-- for submit ajax file upload -->
<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.form.js"></script>

<script type="text/javascript">
    // Jul 25, 2014 ANH DUNG 
    $(function(){
        fnBindRemoveGlobalFile();
        fnBindFancyPhoto();
        $('.file_name').change(function(){
            parent_div = $(this).closest('div.box_inventory_photo');
            parent_form = $(this).closest('form');
            var url_ = '<?php echo Yii::app()->createAbsoluteUrl('enquiry/ajaxUploadFileAll')?>';
            parent_form.ajaxSubmit({
                dataType: 'json',
                type: 'post',
                data: {},
                url: url_,
                beforeSend:function(data){
                    $.blockUI({
                           message: '', 
                           overlayCSS:  { backgroundColor: '#fff' }
                   });
                },
                success: function(data)
                {
                    if(data['code']){
                        $('.inventory_photo_show').find('ul').append(data['li']);
                        parent_div.find('input:file').val('');
                    }else{
                        alert(data['message']);
                    }
                    fnBindFancyPhoto();
                    $.unblockUI();
                }
            });// end $('#submit-form').ajaxSubmit({
            
        });// end $('.file_name').change(function(){
        
    });// end $(function()
    
    function fnBindRemoveGlobalFile(){
        $('.remove_file_js').live('click', function(){
            if(confirm('Are you sure delete this item?')){
                $(this).closest('li').remove();
                var url_ = $(this).attr('next');
                $.ajax({
                    url:url_
                });
            }
        });
    }
    
    function fnBindFancyPhoto(){
        $('.FancyPhoto').fancybox({
//            fitToView:true,
            width: 600,
            autoSize:false,autoHeight:true,scrolling : false,
            title:"",
            helpers: { overlay : {
                    closeClick : true,  // if true, fancyBox will be closed when user clicks on the overlay
                }
            }
        });
    }
    
</script>

 