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
            <p><b style="color:red;">Limit <?php echo LIMIT_PHOTO_UPLOAD ?> photos upload. Only <?php echo Listing::$AllowFile;?> is allowed. Recommended Dimension:  633 px x 390 px</b></p>
           <?php
            $this->widget('xupload.XUpload', array(
//                            'url' => Yii::app()->createUrl("member/listing/ajax_upload_photo",array('id'=>100)),
                        'model' => $model,
                        'attribute' => 'photo_listing_anhdung[]',
                        'multiple' => true,
            ));
            ?>
        </div>

        <div class="clearfix"></div>
        <p><b style="color:red;">Drag and drop photos to organize</b></p>
        <div class="div_show_image T_photo ad_sortable_div">
            <!--<ul class="T_photo" id="sortable_photo">-->
                <?php if (isset($arrOrther['photo'])): ?>
                    <?php
                    $widget = $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $arrOrther['photo'],
                        'emptyText'=>'<div style="margin-left:15px;">No results found.<div>', 
                        'id' => 'manager_photo',
                        'itemView' => 'step/_photo_item',
                        //                   'pagerCssClass'=>'pager_appoitment',
                        'template' => '{items} {pager}',                        
                        'itemsTagName'=>'ul',
                        'itemsCssClass'=>'sortable_photo',
                        'ajaxUpdate' => true,
                        'ajaxUrl'=> Yii::app()->request->getUrl(),
                        'enablePagination' => true,
                    ));
                    ?>  
                 <?php endif; ?>
            <!--</ul>-->
        </div>
        <div class="clearfix"></div>
    </div>
</div> <!--end <div class="box-1 space-3">-->

<style>
    .ad_sortable_div ul li { list-style: none; }
    .ad_sortable_div .ui-state-default { background: none !important; border: none !important; }
    
</style>

<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.form.js"></script>

<script>
  function fnBindSortable(){
    $( ".sortable_photo" ).sortable({        
         update: function(event, ui) {             
            var url_ = '<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->requestUri;?>/ad_form_sort_photo/1';
            $.blockUI({message: null});
            
            $.ajax({
                url:url_,
                type:'post',
                data:$('.ad_form_sort_photo').serialize(),
                success:function(data){
                    $.unblockUI();
                }
            });
            
        }
    });
//    $( ".sortable_photo" ).disableSelection();
  };
</script>

<script>
$(function(){
    $('#Listing_photo_listing_anhdung').change(function(){
            parent_form = $(this).closest('form');
            div_show_image = parent_form.find('div.div_show_image');
            var url_ = '<?php echo Yii::app()->createUrl("member/listing/ajax_upload_photo",array('id'=>$model->id)); ?>';
            
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
                    fnBindSortable();
                    $.unblockUI();
                }
            });// end parent_form.ajaxSubmit({
    });
    fnBindSortable();
    
});

</script>