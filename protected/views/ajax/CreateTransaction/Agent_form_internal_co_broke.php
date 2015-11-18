<div style="min-height: 250px;">
<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'Agent-form-external-co-broke',
            'enableAjaxValidation'=>false,
    )); ?>

    <div class="in-row clearfix">
        <?php echo $form->labelEx($model,'user_id', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->hiddenField($model,'user_id'); ?>
            <?php 
                // widget auto complete search user customer and supplier
                $url = Yii::app()->createAbsoluteUrl('ajax/searchAgent');
                $aData = array(
                    'model'=>$model,
                    'name_relation_user'=>'relation_user',
                    'url'=> $url,
                );
                $this->widget('ext.ProAutocompleteUser.ProAutocompleteUser',
                    array('data'=>$aData));                                        

            ?>
        </div>
        <?php echo $form->error($model,'user_id'); ?>
    </div>       
    
    <div class="in-row clearfix">
        <?php echo $form->labelEx($model,'gross_commission_amount', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php echo $form->textField($model,'gross_commission_amount',array('maxlength'=>4, 'class'=>'w-250 text number_only')); ?>
        </div>
        <?php echo $form->error($model,'gross_commission_amount'); ?>
    </div>    

    <div class="clearfix output">
        <a href="javascript:void(0)" class="btn-2 iframe_close">Cancel</a>
        <input type="submit" class="btn-3" value="Submit" />
    </div>

<?php $this->endWidget(); ?>
</div>
<script>
    $(function(){
        $('.iframe_close').on('click', function(){
            parent.$.fancybox.close();
        });
    });
</script>