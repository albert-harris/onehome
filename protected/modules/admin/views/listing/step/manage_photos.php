<style> #Listing_status_wrap_list {display: none;}</style>

<div class="main-inner-2 T_custom_Step_2">
    <?php include 'manage_photos_anhdung.php';?>
    <div class="box-1 space-3">
        <div class="title"><h3>Provided photos by Property Infologic</h3></div>
        <div class="form-type content"> 
                <?php  $this->widget('ReleatedPhotoWidget',array('listing_id'=>$model->id,'listing_title'=>$model->property_name_or_address,'json_releated'=>$model->listing_releated)) ?>
        </div>
    </div>


    
    <div class="box-1 space-3">
        <div class="title"><h3>Please upload CEA forms OR Exclusive Agreement</h3></div>
         <p style="margin-top:20px;"><b style="color:red;margin-left:20px;">Limit <?php echo LIMIT_DOC_UPLOAD?> files upload</b></p>
        <div style="margin:20px 0px 0px 20px;width: 500px;">
           
            <?php echo $form->textField($model, 'title_cea',array('style'=>'float:left;','placeholder'=>'Title file')) ?>
            <didv class="T_custom_input_step2">
              <?php
                    $this->widget('ext.uploadFileAjax.uploadFileAjax', array(
                        'url' => Yii::app()->createAbsoluteUrl("admin/listing/ajax_upload_doc", array('id' => $model->id)),
                        'model' => $model,
                        'idFormdata' => 'pages-form',
                        'attribute' => 'file_upload',
                        'class' => 'upload_doc',
                        'function' => 'sendFile',
                        'allowFile' => 'doc|docx|xls|xlsx|txt,pdf,csv',
                        'Maxfile' => 1,
                        'multiple' => true,
                    ));
             ?>                      
            </didv>
        </div>       
        <div class="form-type content" > 
            
             <?php if (isset($arrOrther['cea'])): 
                        $widget = $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $arrOrther['cea'],
                            'id' => 'manager_cea',
                            'itemView' => 'step/_item_cea',
                             'emptyText'=>'<tr><td colspan="3">No results found.</td></tr>', 
                            //'pagerCssClass'=>'pager_appoitment',
                            'template'=>'
                                        <table style="width:700px;" class="tb-1">
                                                <thead>
                                                    <tr>
                                                        <th class="first">#</th>
                                                        <th>Title</th>
                                                        <th >File download</th>
                                                        <th style="width:100px;" class="last">Actions</th>
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


    <div >
        <input type ='button' onclick="window.location.href='<?php echo Yii::app()->createAbsoluteUrl('admin/listing/extradetail',array('id'=>$model->id)) ?>'" name="back" class='btn-3' value="Back" />&nbsp;&nbsp;&nbsp;
        <input type ='submit' name="save_exit" class='btn-3' value="Save & Exit" />&nbsp;&nbsp;&nbsp;
        <input type ='submit' name="next"  class='btn-3' value="Next" />
    </div>    

</div>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/removePhoto.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins_be.js"></script>
<style>
    input, textarea, select, .uneditable-input {height: 25px;line-height: 25px;}
</style>

<?php if(isset($arrOrther['messagePhoto']) &&  $arrOrther['messagePhoto'] !=''){
        Yii::app()->clientScript->registerScript('messageErrorPhoto', "
           alert('".$arrOrther['messagePhoto']."');
      ");   
} ?>

<?php
    if (isset($_SERVER['HTTP_USER_AGENT']) && 
    (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)):
?>
<style>
    input, textarea, select, .uneditable-input {height: 26px;line-height: 25px;padding-top:3px;}
</style>
<?php    endif;?>