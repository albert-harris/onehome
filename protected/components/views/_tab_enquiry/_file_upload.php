<div class="box_file">
    <?php echo $form->labelEx($model,'file_name',array()); ?>
    <?php echo $form->fileField($model,'file_name', array('class'=>'file_name uniform_verz_file') );?>  
    <em><?php echo "Only ".ProGlobalEnquiry::$AllowFile." is allowed.";?></em>
    <?php echo $form->error($model,'file_name'); ?> 
    <div class="table_file_name">
        <table><tbody></tbody></table>
    </div>
</div>
