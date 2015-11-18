<div class="form">

    <?php
//    $model->newsletter_group_subscriber = $this->getGroupSubscriber($model);
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'newsletter-form-create-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php // echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'subject'); ?>
        <?php echo $form->textField($model,'subject',array('size'=>40)); ?>
        <?php echo $form->error($model,'subject'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'send_time'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
            'model'=>$model, //Model object
            'attribute'=>'send_time', //attribute name
            'mode'=>'datetime', //use "time","date" or "datetime" (default)
            'language'=>'en-GB',
            'options'=>array(
                'showAnim'=>'fold',
                'showButtonPanel'=>true,
                'autoSize'=>true,
                'dateFormat'=>'dd/mm/yy',
                'timeFormat'=>'hh:mm:ss',
                'width'=>'120',
                'separator'=>' ',
//                'regional' => 'en-GB'
            ),
            'htmlOptions' => array(
                'style' => 'width:180px;',
            ),
        ));
        ?>
        <span>(dd/mm/yyyy)</span>
        <?php echo $form->error($model,'send_time'); ?>
    </div>

    <div class="row group_subscriber">
            <?php echo $form->labelEx($model,'newsletter_group_subscriber'); ?>
			<div class="fix-label">
            <?php
               $this->widget('ext.multiselect.JMultiSelect',array(
                     'model'=>$model,
                     'attribute'=>'newsletter_group_subscriber',
                     'data'=>SubscriberGroup::loadItems(),
                     // additional javascript options for the MultiSelect plugin
                     'options'=>array(),
                     // additional style
                     'htmlOptions'=>array('style' => 'width: 350px;'),
               ));    
           ?>
		   </div>
        <?php if(isset($get_error) && $get_error!=""){ echo $get_error;}?>
            <?php echo $form->error($model,'newsletter_group_subscriber'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'content'); ?>
        <div style="float:left;">
            <?php
            $this->widget('ext.ckeditor.CKEditorWidget',array(
                "model"=>$model,
                "attribute"=>'content',
                "config" => array(
                    "height"=>"250px",
                    "width"=>"700px",
                    "toolbar"=>Yii::app()->params['ckeditor']
                )
            ));
            ?>
        </div>
        <div class='clr'></div>
        <?php echo $form->error($model,'content'); ?>
    </div>
    <div class='clr'></div>

    <div class="row buttons" style="margin-left: 60px;">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


<style>
</style>