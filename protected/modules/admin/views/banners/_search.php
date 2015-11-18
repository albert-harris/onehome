<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo Yii::t('translation',$form->label($model,'banner_title')) ;?>
        <?php echo $form->textField($model,'banner_title',array('size'=>60,'maxlength'=>250)); ?>
	</div>


        <div class="row">
		<?php echo Yii::t('translation',$form->label($model,'status')); ?>
		<?php echo $form->dropDownList($model,'status',array(null=>'All',1=>'Active',0=>'Inactive')); ?>
	</div>
    
      
	<div class="row buttons">
		<span class="btn-submit"><?php echo CHtml::submitButton(Yii::t('translation','Search')); ?></span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->