<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
?>
<div class="in-row clearfix">
    <?php echo $form->labelEx($model, 'asking_psf', array('class' => 'lb-1')); ?>
    <div class="group-1">
        <?php echo $form->textField($model, 'asking_psf', array('class' => 'text number_only')); ?>
        <div class="clear" style='clear: both;'></div>
        <?php echo $form->error($model, 'asking_psf'); ?>
    </div>
</div>

<div class="in-row clearfix">
    <?php echo $form->labelEx($model, 'building_name', array('class' => 'lb-1')); ?>
    <div class="group-1">
        <?php echo $form->textField($model, 'building_name', array('class' => 'text')); ?>
        <div class="clear" style='clear: both;'></div>
        <?php echo $form->error($model, 'building_name'); ?>
    </div>
</div>

<div class="in-row clearfix">
    <?php echo $form->labelEx($model, 'contact_name_no', array('class' => 'lb-1')); ?>
    <div class="group-1">
        <?php echo $form->textField($model, 'contact_name_no', array('class' => 'text')); ?>
        <div class="clear" style='clear: both;'></div>
        <?php echo $form->error($model, 'contact_name_no'); ?>
    </div>
</div>

<div class="in-row clearfix">
    <?php echo $form->labelEx($model, 'dnc_expiry_date', array('class' => 'lb-1')); ?>
    <div class="group-1">
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'dnc_expiry_date',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => ActiveRecord::getDateFormatSearch(),
//                            'minDate'=> '0',
//                            'maxDate'=> '0',
                'changeMonth' => true,
                'changeYear' => true,
                'showOn' => 'button',
                'buttonImage' => Yii::app()->theme->baseUrl . '/admin/images/icon_calendar_r.gif',
                'buttonImageOnly' => true,
            ),
            'htmlOptions' => array(
                'class' => 'text',
                'style' => 'width:166px;',
                'readonly' => 'readonly',
            ),
        ));
        ?>         
        <div class="clear" style='clear: both;'></div>
        <?php echo $form->error($model, 'dnc_expiry_date'); ?>
    </div>
</div>