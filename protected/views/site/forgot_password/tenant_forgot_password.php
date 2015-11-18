                
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login-form',

                            'enableClientValidation'=>true,
                            'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                            ),
                    'htmlOptions'=>array('class'=>'form-type login-form'),
                    )); ?>
            
<!--                <div class="breadcrumb"><a href="landing.html">Welcome Guest</a> Forgotten Password</div>-->
                <h1>Forgotten Password</h1>

                <?php if(Yii::app()->user->hasFlash('success')) : ?>
                    <div class="row">
                        <div class="alert" style="text-align: center;">
                            <strong><?php echo Yii::app()->user->getFlash('success'); ?></strong>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                <?php else: ?>

                <div class="in-row clearfix">
                    <label class="lb-1"><span class="require">*</span> Your registered email :</label>
                    <div class="group-1">
                    <?php echo $form->textField($model,'email',array('class'=>'text','maxlength'=>100,'value'=>'')); ?>
                    <?php echo $form->error($model,'email'); ?>
                    </div>
                </div>

                <div class="in-row clearfix">
                    <button class="btn-3" type="submit" >Submit</button>
                        <button type="button" class="btn-3" onclick="location.href='<?php echo Yii::app()->createAbsoluteUrl('site/tenantlogin') ?>'" >Cancel</button>
                </div>
                                
                <?php endif; ?>
                
                    <!--</form>-->
                <?php $this->endWidget(); ?>

<style>
    .in-row button{
        margin-left: 10px !important;
    }

    .lb-1{
        width: 135px !important;
    }
    .form-type .in-row {
        margin-right:402px;
    }
</style>
           
                
           

