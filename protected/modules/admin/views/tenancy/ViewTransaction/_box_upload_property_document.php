<div class="box-1 space-3">
    <div class="title"><h3>Upload Property document(s)</h3></div>
    <div class="form-type content grid-view"> 
        <table class="tb-1 tb_upload_document">
            <thead>
                <tr>
                    <th class="border_l w-20">#</th>
                    <th class="w-6">Title</th>
                    <th class="button-column border_r item_l">File Upload</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mTransactions->aModelPropertyDocument as $key=>$item):?>
                    <?php 
                        $display_none = 'display_none';
                        if($key>2)
                            $display_none='';
                    ?>
                    <tr>
                        <td class="first"><?php echo $key+1;?></td>
                        <td class="td_title">
                            <span class="text_title"><?php echo $item->title;?></span>
                        </td>
                        <td class="td_file last">
                            <?php 
                                $FileExit = Yii::getPathOfAlias("webroot"). '/'.ProTransactionsPropertyDocument::$folderUpload."/$item->transactions_id/$item->file_name";
                                if(!empty($item->file_name) && file_exists($FileExit)){
                            ?>
                            <a href="<?php echo ProTransactionsPropertyDocument::getLinkDownDocument($item);?>" target="_blank">
                            <?php echo $item->file_name;?>
                            </a>
                                <?php } ?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div><!--  end  form-type content -->
</div><!--  end  box-1 space-3-->
