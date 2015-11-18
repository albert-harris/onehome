<style>
/*    .fileupload-buttonbar div.uploader { width: 60% !important; margin-bottom: 0 !important; }
    .fileupload-buttonbar div.uploader input { width: auto !important; }
    .fileupload-buttonbar div.uploader span.filename { background: transparent; }
    .fileupload-buttonbar div.uploader span.action { width: 100%; }    */
</style>
<div class="box-1 space-3">
        <div class="title"><h3>Manage your Photos</h3></div>
        <div class="form-type content"> 
            <div style="margin-left:15px;">
                <p><b style="color:red;">Limit <?php echo LIMIT_PHOTO_UPLOAD ?> photos upload. Only <?php echo Listing::$AllowFile;?> are allow</b></p>
                <div class="l_padding_50">
               <?php
                $this->widget('xupload.XUpload', array(
//                            'url' => Yii::app()->createUrl("member/listing/ajax_upload_photo",array('id'=>100)),
                            'model' => $model,
                            'attribute' => 'photo_listing_anhdung[]',
                            'multiple' => true,
                ));
                ?>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="div_show_image">
                <ul class="T_photo">
                    <?php if (isset($arrOrther['photo'])): ?>
                        <?php
                        $widget = $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $arrOrther['photo'],
                             'emptyText'=>'<div style="margin-left:15px;">No results found.<div>', 
                            'id' => 'manager_photo',
                            'itemView' => 'step/_photo_item',
                            //                   'pagerCssClass'=>'pager_appoitment',
                            'template' => '{items} {pager}',
                            'ajaxUpdate' => true,
                            'ajaxUrl'=> Yii::app()->request->getUrl(),
                            'enablePagination' => true,
                        ));
                        ?>  
                     <?php endif; ?>
                    </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.form.js"></script>
<script>
$(function(){
    $('#Listing_photo_listing_anhdung').change(function(){
            parent_form = $(this).closest('form');
            div_show_image = parent_form.find('div.div_show_image');
            var url_ = '<?php echo Yii::app()->createUrl("admin/listing/ajax_upload_photo",array('id'=>$model->id)); ?>';
            
            parent_form.ajaxSubmit({
                type: 'post',
                url: url_,
                beforeSend:function(data){
                    $.blockUI({
//                        message: '', 
//                        overlayCSS:  { backgroundColor: '#fff' }
                   });
                },
                success: function(data)
                {
                    div_show_image.html($(data).find('.div_show_image').html());
                    parent_form.find('input:file').val('');
                    $.unblockUI();
                }
            });// end parent_form.ajaxSubmit({
    });
});
</script>