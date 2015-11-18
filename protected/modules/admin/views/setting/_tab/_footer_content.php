<fieldset>
    <legend>Footer content</legend>
    <div class="row">
        <?php echo $form->labelEx($model, 'text_on_footer', array()); ?>
        <div style="float:left; margin-left: 10px;">
            <?php
            $this->widget('ext.ckeditor.CKEditorWidget', array(
                "model" => $model,
                "attribute" => 'text_on_footer',
                "config" => array(
                    "height" => "100px",
                    "width" => "380px",
                    "toolbar" => Yii::app()->params['ckeditor_simple']
                )
            ));
            ?>
        </div>	
        <div class="clr"></div>            
        <?php echo $form->error($model, 'text_on_footer'); ?>
    </div>    
    <div class="row">
        <?php echo $form->labelEx($model, 'copyright_on_footer', array()); ?>
        <div style="float:left; margin-left: 10px;">
            <?php
            $this->widget('ext.ckeditor.CKEditorWidget', array(
                "model" => $model,
                "attribute" => 'copyright_on_footer',
                "config" => array(
                    "height" => "100px",
                    "width" => "380px",
                    "toolbar" => Yii::app()->params['ckeditor_simple']
                )
            ));
            ?>
        </div>	
        <div class="clr"></div>            
<?php echo $form->error($model, 'copyright_on_footer'); ?>
    </div>             
</fieldset>