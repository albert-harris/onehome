<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createAbsoluteUrl('/enquiry/addPropertyItem',array('id'=>$property_id)),
    'method'=>'post',
    'enableClientValidation' => true,
    'enableAjaxValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions'=>array(
        'class'=>'form-type box-3'
    ),
)); ?>

    <?php
	/* agent detail */
	require( $dir);
    ?>

    <h3 class="title-2">Enquiry</h3>
    <div class="form-group">
        <?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'Full Name')); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>'Email address')); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->textField($model,'phone',array('class'=>'form-control number_only','placeholder'=>'Contact No')); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('empty'=>'Select Country','class'=>'form-control'));?>
        <?php echo $form->error($model,'country_id'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->textArea($model,'description',array('class'=>'note-box-2 form-control',
			'placeholder'=> 'Message',
			'rows' => 4
		));?>
         <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn-3">SEND ENQUIRY</button>
    </div>

    <?php
    $mUser = Users::model()->findByPk($agent_id);
    if ($mUser): 
		$link = Yii::app()->createUrl('/agent/view', array('slug'=>$mUser->slug, 'tab'=>'listing'));
	?>
    <ul class="links-list list-unstyled" style="border: none;">
        <li class="first last">
            <a href="<?= $link ?>">View all listings by Agent</a>
        </li>
    </ul>
    <?php endif;?>
    
<?php $this->endWidget(); ?>

