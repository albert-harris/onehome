<fieldset>
    <legend>Contact Settings</legend>
    <div class="row">
        <?php echo $form->labelEx($model, 'company_name', array('label' => 'Company Name')); ?>
        <?php echo $form->textField($model, 'company_name', array('size' => 55)); ?>
        <?php echo $form->error($model, 'company_name'); ?>
    </div>            
    <div class="row">
        <?php echo $form->labelEx($model, 'tel', array('label' => 'Tel')); ?>
        <?php echo $form->textField($model, 'tel', array('size' => 55)); ?>
        <?php echo $form->error($model, 'tel'); ?>
    </div>            
    <div class="row">
        <?php echo $form->labelEx($model, 'fax', array('label' => 'Fax')); ?>
        <?php echo $form->textField($model, 'fax', array('size' => 55)); ?>
        <?php echo $form->error($model, 'fax'); ?>
    </div>  
    <div class="row">
        <?php echo $form->labelEx($model, 'address', array('label' => 'Address')); ?>
        <?php echo $form->textArea($model, 'address', array('rows' => 5, 'cols' => 35, 'style' => 'width:300px;')); ?>
        <?php echo $form->error($model, 'address'); ?>
    </div>  
    <div class="row">
        <?php echo $form->labelEx($model, 'email', array('label' => 'Email')); ?>
        <?php echo $form->textField($model, 'email', array('size' => 55)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model, 'movement_by_car', array()); ?>
        <div style="float:left;">
            <?php
            $this->widget('ext.ckeditor.CKEditorWidget', array(
                "model" => $model,
                "attribute" => 'movement_by_car',
                "config" => array(
                    "height" => "100px",
                    "width" => "390px",
                    "toolbar" => Yii::app()->params['ckeditor_simple']
                )
            ));
            ?>
        </div>	
        <div class="clr"></div>                
        <?php echo $form->error($model, 'movement_by_car'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'movement_by_train', array()); ?>
        <div style="float:left;">
            <?php
            $this->widget('ext.ckeditor.CKEditorWidget', array(
                "model" => $model,
                "attribute" => 'movement_by_train',
                "config" => array(
                    "height" => "100px",
                    "width" => "390px",
                    "toolbar" => Yii::app()->params['ckeditor_simple']
                )
            ));
            ?>
        </div>	
        <div class="clr"></div>                
        <?php echo $form->error($model, 'movement_by_train'); ?>
    </div>
</fieldset>