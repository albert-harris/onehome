<?php
/* @var $model ServiceRegistrationForm */
?>
<?php $this->renderPartial('reg-step-navigator', array('current'=>2)) ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-registration-form',
	'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>
	<?= $form->error($model, 'services') ?>

	<?php foreach (OurService::getMainCategories() as $category): ?>
	<div class="form-group">
		<div class="col-md-10">
			<h4 class="checkbox"><label>
				<?php
				$name = 'ServiceRegistrationForm[services][]';
				$value = $category->id;
				$select = $model->services;
				$checked=!is_array($select) && !strcmp($value,$select) || is_array($select) && in_array($value,$select);
				?>
				<?= CHtml::checkBox($name,$checked,array('value'=>$value)) ?>
				<?= CHtml::encode($category->name) ?>
			</label></h4>
			<div class="row">
			<?php foreach ($category->childs as $k => $item): ?>
				<?php $col = count($category->childs)>6 ? 4 : 6 ?>
				<?php if ($k%3==0): ?><div class="col-sm-<?= $col ?>"><?php endif ?>
				<div style="margin-left: 10px">
					<div class="checkbox">
						<label>
							<?php
							$name = 'ServiceRegistrationForm[services][]';
							$value = $item->id;
							$select = $model->services;
							$checked=!is_array($select) && !strcmp($value,$select) || is_array($select) && in_array($value,$select);
							?>
							<?= CHtml::checkBox($name,$checked,array('value'=>$value)) ?>
							<span style="min-width: 200px; display: inline-block"><?= CHtml::encode($item->name) ?></span>
							<span style="color: #c7c7c7"><?= strip_tags($item->short_description) ?></span>
						</label>
					</div>
				</div>
				<?php if ($k%3==2 || $k==count($category->childs)-1): ?></div><?php endif ?>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
		
	<div class="form-group">
		<div class="col-xs-5 text-left"><p><a href="<?= $this->createUrl('step1') ?>" class="btn btn-9">Back</a></p></div>
		<div class="col-xs-5 text-right"><p><button class="btn btn-9" type="submit">Next</button></p></div>
	</div>	
<?php $this->endWidget(); ?>
<script type="text/javascript">
//<![CDATA[
// set child checkbox state each time parent change
$('h4 input[type="checkbox"]').click(function() {
	$(this).closest('.form-group').find('.row input[type="checkbox"]').prop('checked', $(this).is(':checked'));
});

// set parent checkbox state each time child change
$('.row input[type="checkbox"]').click(function() {
	var parent = $(this).closest('.form-group').find('h4 input[type="checkbox"]');
	if ( $(this).is(':checked') ) {
		parent.prop('checked', true);
	}  else if ( $(this).closest('.form-group').find('.row input[type="checkbox"]:checked').size() == 0 ) {
		parent.prop('checked', false);
	}
});

// set parent checkbox state on load
$('.form-group').each(function() {
	var parent = $(this).find('h4 input[type="checkbox"]');
	if ($(this).find('.row input[type="checkbox"]').size() > 0) {
		if ($(this).find('.row input[type="checkbox"]:checked').size()==0) {
			parent.prop('checked', false);
		} else {
			parent.prop('checked', true);
		}
	}
});
//]]>
</script> 