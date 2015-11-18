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
                <?php foreach ($mTransactions->aModelPropertyDocument as $key=>$item):?>
                    <?php 
                        $display_none = 'display_none';
                        $display_none_title = '';
                        $delete_class= 'delete_item_file';
                        if($key>2){
                            $display_none='';
                            $display_none_title = 'display_none';
                            $delete_class= 'delete_item_upload';
                        }
                    ?>
                    <tr>
                        <td class="first"><?php echo $key+1;?></td>
                        <td class="td_title">
                            <span class="text_title <?php echo $display_none_title;?>"><?php echo $item->title;?></span>
                            <?php echo $form->textField($item,'title[]',array('class'=>"$display_none text",'value'=>$item->title)); ?>
                            <?php echo $form->error($item,'title'); ?>
                            <?php echo $form->hiddenField($item,'id[]',array('class'=>"hidden_id",'value'=>$item->id)); ?>
                        </td>
                        <td class="td_file">
                            <?php echo $form->fileField($item,'file_name[]',array('class'=>'')); ?>
                            <?php 
                                $FileExit = Yii::getPathOfAlias("webroot"). '/'.ProTransactionsPropertyDocument::$folderUpload."/$item->transactions_id/$item->file_name";
                                if(!empty($item->file_name) && file_exists($FileExit)):?>
                                <span class="CurrentFile">
                                    Current File: <?php // echo $item->file_name;?>
                                    <a href="<?php echo ProTransactionsPropertyDocument::getLinkDownDocument($item);?>" target="_blank">
                                        <?php echo $item->file_name;?>
                                    </a>
                                </span>
                            <?php endif;?>

                            <?php echo $form->error($item,'file_name'); ?>
                        </td>
                        <td class="last">
                            <a href="javascript:void(0)" title="Remove" class="<?php echo $delete_class;?>"><img alt="Remove" src="<?php echo Yii::app()->theme->baseUrl;?>/img/gridview/delete.png"></a>
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
           tr.find('.delete_item_file').addClass('delete_item_upload').removeClass('delete_item_file');
           $('.tb_upload_document tbody').append(tr);
           fnRefreshOrder();           
       });
    });
    
    function fnRefreshOrder(){
        var index = 1;
        $('.tb_upload_document tbody tr').each(function(){
            $(this).find('td:first').text(index);
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
    
</script>