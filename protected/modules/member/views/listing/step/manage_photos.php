<style> #Listing_status_wrap_list {display: none;}
#uniform-Listing_image_photo {width:200px;}
</style>

<div class="main-inner-2 T_custom_Step_2">
    <?php include 'manage_photos_anhdung.php';?>
    <div class="box-1 space-3">
        <div class="title"><h3>Provided photos by Onehome Property Pte Ltd</h3></div>
        <div class="form-type content"> 
                <?php  $this->widget('ReleatedPhotoWidget',array('listing_id'=>$model->id,'listing_title'=>$model->property_name_or_address,'json_releated'=>$model->listing_releated)) ?>
        </div>
    </div>
    
    <div class="box-1 space-3">
        <div class="title"><h3>Please upload CEA forms OR Exclusive Agreement</h3></div>
     
         <p style="margin-left:20px;"><b style="color:red;">Limit <?php echo LIMIT_DOC_UPLOAD?> files upload</b></p>
        <div style="margin:20px 0px 0px 20px;" class="clearfix">
                <?php echo $form->textField($model, 'title_cea',array('style'=>'float:left;','placeholder'=>'Title file')) ?>
            
            <div class="T_custom_input_step2" style="width:auto;">

                <?php
                    $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
                                    'id'=>'upload_cea',
                                    'config'=>array(
                                    'action'=>Yii::app()->createAbsoluteUrl('member/listing/ajax_upload_doc',array('id'=>$model->id,'type'=>'upload_cea')),
                                           'allowedExtensions'=>array("doc","docx","xls","xlsx","pdf","csv"),
                                           'sizeLimit'=>10*1024*1024,// maximum file size in bytes,
                                           'onSubmit'=>"js:function(file, extension) { 
                                                $.get(
                                                        '".Yii::app()->createAbsoluteUrl('member/listing/ajax_upload_doc',array('id'=>$model->id,'type'=>'upload_cea'))."', 
                                                        {title: $('#Listing_title_cea').val()},function(data){}
                                                );   
                                                if($('#Listing_title_cea').val()==''){
                                                    alert('Title canot be blank');
                                                    return false;
                                                }
                                              $.blockUI({message: null});
                                            }",
                                            'onComplete'=>"js:function(id, fileName, responseJSON){
                                                $('.qq-upload-list').remove();
                                                setTimeout($.unblockUI, 2000);
                                                if(responseJSON['success']==1){
                                                    $.fn.yiiListView.update('manager_cea', {
                                                       data: $(this).serialize()
                                                    });                                                               
                                                }else{
                                                    if(responseJSON['errorMesage'] !=''){
                                                        alert(responseJSON['errorMesage']);
                                                    }
                                                }
                                            }",
                                    )
                    )); 
                ?>                
            </div>
        </div>       
        <div class="form-type content"> 
            
             <?php if (isset($arrOrther['cea'])): 
                        $widget = $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $arrOrther['cea'],
                            'id' => 'manager_cea',
                            'itemView' => 'step/_item_cea',
                            //'pagerCssClass'=>'pager_appoitment',
                              'emptyText'=>'<tr><td colspan="3">No results found.</td></tr>', 
                            'template'=>'
                                        <table class="tb-1">
                                                <thead>
                                                    <tr>
                                                        <th class="first">#</th>
                                                        <th>Title</th>
                                                        <th>File download</th>
                                                        <th class="last">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {items} 
                                                </tbody>
                                        </table>
                                       {pager}',
                            'ajaxUpdate' => true,
                            'enablePagination' => true,
                        ));
                 endif; 
             ?>           

        </div>
    </div>


    <div class="w-2 clearfix T_step_1_custom_btn" style="margin-left:10px;">
        <input type ='button' onclick="window.location.href='<?php echo Yii::app()->createAbsoluteUrl('member/listing/extradetail',array('id'=>$model->id)) ?>'" name="back" class='btn-3' value="Back" />&nbsp;&nbsp;&nbsp;
        <input type ='submit' name="save_exit" class='btn-3' value="Save & Exit" />&nbsp;&nbsp;&nbsp;
        <input type ='submit' name="next"  class='btn-3' value="Next" />
    </div>    

</div>
<?php 
    if(isset($arrOrther['messagePhoto']) &&  $arrOrther['messagePhoto'] !=''){
        Yii::app()->clientScript->registerScript('messageErrorPhoto', "
           alert('".$arrOrther['messagePhoto']."');
      ");   
    }
?>


<script type="text/javascript">
$(function(){
    $('#Listing_title_cea').change(function(){
        $.get(
                '<?php echo  Yii::app()->createAbsoluteUrl('member/listing/ajax_upload_doc',array('id'=>$model->id,'type'=>'upload_cea')) ?>', 
                {title: $(this).val()},function(data){}
        );          
    })
});
</script>
<style>
    #Listing_title_cea {height: 30px;border:1px solid #D0D0D0;padding-left:2px;}
    .T_custom_input_step2 .qq-upload-list li {float:left;margin-left: -170px;}
</style>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/removePhoto.js"></script>