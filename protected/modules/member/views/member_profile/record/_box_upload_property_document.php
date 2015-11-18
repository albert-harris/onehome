<div class="box-1 space-3">
    <div class="title"><h3>Please upload Property document(s)</h3></div>
    <div class="form-type content grid-view"> 
        <div class="f-left" style="margin-bottom: 10px; width: 100%;">
            <a href="javascript:void(0)" class="btn-1 AddDocument">Add more</a>
            <span>Only <?php echo ProTransactionsPropertyDocument::$AllowFile ;?> are allow</span>
        </div>
        <div class="f-left">
            <?php // echo $form->errorSummary($mTransactions->mPropertyDocument); ?>
        </div>
        <table class="tb-1 tb_upload_document">
            <thead>
                <tr>
                    <th class="first">#</th>
                    <th>Title</th>
                    <th>File Upload</th>
                    <th class="button-column last">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(isset($_GET['id'])){
                    $transaction_id = $_GET['id'];
                }
                if(isset($_GET['type'])){
                    $type = $_GET['type'];
                }
                $list_PropertyDocument = ProTransactionsPropertyDocument::getListDocumentByTransaction($transaction_id);
                
                if($list_PropertyDocument){
                    $model_PropertyDocument = $list_PropertyDocument;
                }else{
                    $model_PropertyDocument = ProTransactionsPropertyDocument::getDefaultArrayForCreate($type);
                }
//                foreach ($mTransactions->aModelPropertyDocument as $key=>$item):
                foreach ($model_PropertyDocument as $key=>$item):    
                    ?>
                    <?php 
                        $display_none = 'display_none';
                        $display_none_title = '';
                        $delete_class= 'delete_item_file';
                        if($key>2){
                            $display_none='';
                            $display_none_title = 'display_none';
                            $delete_class= 'delete_item_upload';
                        }
                        //add
                        if(isset($_GET['id'])){
                            $id_trans = $_GET['id'];
                            $file_name = ProTransactionsPropertyDocument::getDocumentOfTransactionAndTitle($id_trans, $item->title);
                            if($file_name){
                                $display_none = 'display_none';
                                $display_none_title = '';
                                $delete_class= 'delete_item_upload_record';
                            }
                        }
                    ?>
                    <tr>
                        <td class="first"><?php echo $key+1;?></td>
                        <td class="td_title">
                            <span class="text_title <?php echo $display_none_title;?>"><?php echo $item->title;?></span>
                            <?php echo $form->textField($item,'title[]',array('class'=>"$display_none text verz_document_title",'value'=>$item->title)); ?>
                            <?php echo $form->error($item,'title'); ?>
                            <?php echo $form->hiddenField($item,'id[]',array('class'=>"hidden_id",'value'=>$item->id)); ?>
                        </td>
                        <td class="td_file">
                            <?php echo $form->fileField($item,'file_name['.$key.']',array('class'=>'custom-file-upload ','id'=>'custom-input'.rand(1,100),'rel'=>$key+1)); ?>
                            <?php
                                if($file_name){
                                 ?>
                                    <span class="CurrentFile-<?php echo $key ?>">
                                        Current File: 
                                        <?php 
                                        //add
                                        $aData = array('model'=>$file_name, 'fieldName'=>'file_name');
                                        echo $cmsFormater->formatViewTransactionPropertyDocument($aData,$id_trans); 
                                        ?>
                                    </span>
                                <?php
                                }else{?>
                            <span class="CurrentFile-<?php echo $key ?>" style="display:none;"></span>
                                <?php }
                            ?>
                            <?php echo $form->error($item,'file_name'); ?>
                        </td>
                        <td class="last">
                            <a href="javascript:void(0)" title="Remove" class="<?php echo $delete_class;?>" id="<?php echo $file_name->id;?>"><img alt="Remove" src="<?php echo Yii::app()->theme->baseUrl;?>/img/gridview/delete.png"></a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div><!--  end  form-type content -->
</div><!--  end  box-1 space-3-->


<script>
    $(function(){
        fnBindRemoveRowUpload();
        fnBindRemoveFileUpload();
       $('.AddDocument').click(function(){
           var tr = $('.tb_upload_document tbody tr:first').clone();
           tr.find('.hidden_id').val('');
           tr.find('.td_file').find('input').val('');
           tr.find('.td_file').find('.errorMessage').text('');
           tr.find('.td_file').find('.CurrentFile').text('');
           tr.find('.td_title').find('span').text('');
           tr.find('.td_title').find('input').removeClass('display_none').val('').show();
//           tr.find('.delete_item_file').addClass('delete_item_upload').removeClass('delete_item_file');
           tr.find('.delete_item_upload_record').addClass('delete_item_upload').removeClass('delete_item_upload_record');
           $('.tb_upload_document tbody').append(tr);
           fnRefreshOrder();  
           //HTram August 26, 2015
           var id_new = tr.find('td:first').html();
           var id_cr = id_new - 1;
           $('.CurrentFile-'+id_cr).hide();
           $('.CurrentFile-'+id_cr).closest('tr').find('.verz_document_title').removeAttr("readonly");
           //
       });
    });
    
    function fnRefreshOrder(){
        var index = 1;
        $('.tb_upload_document tbody tr').each(function(){
            $(this).find('td:first').text(index);
            //HTram August 26, 2015
            var id = index-1;
            $(this).find('.td_file').find('input').attr('name', 'ProTransactionsPropertyDocument[file_name]['+id+']');
            $(this).find('.td_file').find('span').attr('class', 'CurrentFile-'+id);
            //
            index++;
        });        
    }
    
    function fnBindRemoveRowUpload(){
        $('.delete_item_upload').live('click', function (){
            if(!confirm('Are you sure you want to delete this item?')) return false;
            var th = $(this);
            th.closest('tr').remove();            
            fnRefreshOrder();     
            return false;
        });
    }    
    function fnBindRemoveFileUpload(){
        $('.delete_item_file').live('click', function (){
            if(!confirm('Are you sure you want to remove this file?')) return false;
            var th = $(this);
            th.closest('tr').find('.td_file').find('input:file').val('');
            th.closest('tr').find('.CurrentFile').text('');
            th.closest('tr').find('.hidden_id').val('');
            return false;
        });
    }  
    //HTram August 26 2015 , to do: delete record file document in database.
    function fnBindRemoveFileUploadRecord(){
        $('.delete_item_upload_record').live('click', function (){
            if(!confirm('Are you sure you want to remove this file?')) return false;
            
            var th = $(this);
            parent_form = $(this).closest('form');
            var url_ = '<?php echo Yii::app()->createUrl("member/member_profile/ajaxDeleteFileDocument"); ?>';
            var id_file = $(this).attr('id');
            $.ajax({
                type: 'post',
                url: url_,
                data:{id_file:id_file, is_ajax:1},
                dataType: "json",
                async: false,
                success: function(data)
                {
                   if (data['code'] == true) {
                        parent_form.submit();
                   }
                }
            });
        });
    }
    
</script>
<?php
    $id_transaction = (isset($_GET['id']))?$_GET['id']:0;
?>
<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.form.js"></script>
<script>
     $(function(){
        $('.custom-file-upload').live('change',function(){
             var id_input = $(this).attr('id');
            parent_div = $(this).closest('.tb_upload_document');
            parent_form = $(this).closest('form');
            var url_ = '<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/AjaxFileTransactionsPropertyDocument',array('id_transaction'=>$id_transaction))?>';
            // Anh Dung Aug 24, 2015, cTitle là title của file hiện tại upload
            var tr = $(this).closest('tr');
            var cTitle = tr.find('.verz_document_title').val();
            // Anh Dung Aug 24, 2015
            
            parent_form.ajaxSubmit({
                dataType: 'json',
                type: 'post',
                data: {title : cTitle},
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
//                        alert(data['message']);
                        $('.CurrentFile-'+data['key']).show();
                        $('.CurrentFile-'+data['key']).html('Current File: '+data['url_image']);
                        $('.CurrentFile-'+data['key']).closest('tr').find('.td_file').find('input:file').val('');  
                        $('.CurrentFile-'+data['key']).closest('tr').find('.verz_document_title').attr('readonly','true');
                        $('.CurrentFile-'+data['key']).closest('tr').find('.delete_item_upload').addClass('delete_item_upload_record').removeClass('delete_item_upload');
                        $('.CurrentFile-'+data['key']).closest('tr').find('.delete_item_upload_record').attr('id',data['id']);
//                        parent_form.submit();
                    }else{
                        alert(data['message']);
                         $('.custom-file-upload').closest('tr').find('.td_file').find('input:file').val('');   
                    }
                    $.unblockUI();
                }
            });// end parent_form.ajaxSubmit({
        });// end $('.file_name').change(function(){
    });// end $(function()
    
    
    
</script>