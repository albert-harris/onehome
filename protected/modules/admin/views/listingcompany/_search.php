<?php
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->baseUrl.'/themes/onehome/js/location-select.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('location-select', "
	$('.multiselect_location').multiselect({
		maxHeight: 200,
		buttonWidth: '100%',
		numberDisplayed: 0
	});
", CClientScript::POS_END);
?>
<div class="wide form submit_form_pri">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=> "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->requestUri,
	'method'=>'get',
	'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>
	<div class="row-fluid">
		<div class="span4">
			<div class="control-group">
				<?php echo $form->label($model,'company_listing_keywordsearch', array('class'=>'control-label')); ?>
				<div class="controls"><?php echo $form->textField($model,'company_listing_keywordsearch'); ?></div>
			</div>
		</div>

		<div class="span4">
			<div class="control-group">
				<?php echo $form->label($model,'dnc_expiry_date', array('class'=>'control-label')); ?>
				<div class="controls">
					<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model'=>$model,        
						'attribute'=>'dnc_expiry_date',
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat'=> ActiveRecord::getDateFormatSearch(),
							'changeMonth' => true,
							'changeYear' => true,
							'showOn' => 'button',
							'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
							'buttonImageOnly'=> true,                                
						),        
						'htmlOptions'=>array(
							'style'=>'width: 100px;margin-right:10px;',
						),
					)); ?>
				</div>
			</div>
		</div>

		<div class="span4">
			<?php if (Yii::app()->user->role_id==ROLE_ADMIN 
				|| Yii::app()->user->id==ID_USER_SHOW_FULL_LISTING_1 
				): ?>
			<div class="control-group">
				<?php echo $form->label($model,'user_id', array('label'=>'Telemarketer', 'class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->dropDownList($model,'user_id', 
						CHtml::listData(Users::getTelemarketers(), 'id', 'name_for_slug'),
						array('empty' => 'Select Telemarketer')); ?>
				</div>
			</div>
			<?php endif ?>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span4">
			<div class="control-group">
				<?php echo $form->label($model,'listing_type', array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->dropDownList($model, 'listing_type', 
					Listing::$aTextSaleRentNormal, array('empty' => 'Select Type')); ?>
				</div>
			</div>
		</div>
		
		<div class="span4">
			<div class="control-group">
				<?php echo $form->label($model,'location_id', array('label'=>'District', 'class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->dropDownList($model, 'location_id', 
						ProLocation::getListDataLocation(), array(
							'class' => 'multiselect_location', 
							'multiple' => 'multiple'
					)); ?>
				</div>
			</div>
		</div>

		<div class="span4">
			<div class="control-group">
				<div class="controls">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'label'=>Yii::t('translation','Search'),
					'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					'size'=>'small', // null, 'large', 'small' or 'mini'
					'htmlOptions' => array('class' => 'w-100 '),
				)); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row display_none">
		<?php echo MyFormat::GetDropDownPageSize('pageSize','', array('empty'=>1)); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->