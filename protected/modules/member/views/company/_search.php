<div class="search-form-company search-form padding_0" style="border-top:0 0 5px 5px !important;border-top:1px solid #DDDDDD;">
    <?php $form=$this->beginWidget('CActiveForm', array(
		'method'=>'get',
        'id'=>'search-form-company'
	)); ?>
	<div class="search-trans clearfix">
		<div class="box-3 form-type padding_0 margin_0">
			<div class="in-row clearfix">
				<div class="col-1">
					<div class="in-row clearfix">
						<?php echo $form->label($model,'company_listing_keywordsearch',array('class'=>'lb','label'=>'Keyword')); ?>
						<div class="group-5">
							<?php echo $form->textField($model,'company_listing_keywordsearch',array('class'=>'text')); ?>
						</div>
					</div>
					<div class="in-row clearfix">
						<?php echo $form->label($model,'listing_type',array('class'=>'lb','label'=>'Type')); ?>
						<div class="group-5">
							<?php echo $form->dropdownList($model,'listing_type', Listing::$aTextSaleRentNormal, array(
								'class'=>'text', 'empty'=>'--All--')); ?>
						</div>
					</div>
					<div class="in-row clearfix">
						<?php echo $form->label($model,'location_id',array('class'=>'lb','label'=>'Location')); ?>
						<div class="group-5">
							<?php echo $form->dropdownList($model, 'location_id', ProLocation::getListDataLocation(), array(
							'empty'=>'--All--')); ?>
						</div>
					</div>
					<div class="in-row clearfix">
						<?php echo $form->label($model,'user_id',array('class'=>'lb','label'=>'Telemarketer')); ?>
						<div class="group-5">
							<?php echo $form->dropdownList($model, 'user_id', CHtml::listData(Users::getTelemarketers(), 'id', 'name_for_slug'), array(
							'empty'=>'--All--')); ?>
						</div>
					</div>
					<div class="in-row clearfix">
						<?php echo $form->label($model,'price',array('class'=>'lb','label'=>'Max Price')); ?>
						<div class="group-5">
							<?php echo $form->dropDownList($model,'price', ProMasterPrice::getListOption(ProMasterPrice::PRICE_FOR_RENT), array('empty' => 'Maximum')); ?>
						</div>
					</div>
				</div>

				<div class="col-1">
					<div class="in-row clearfix r_margin_20">
						<input type="submit" value="Search" name="yt0" style="width:120px;float:left !important;" class="btn-3 f-right submit_search_trans">
					</div>
				</div>
			</div>
		</div>	            
	</div>
	<?php $this->endWidget(); ?>   
</div>


<?php


Yii::app()->clientScript->registerScript('search', "
$('.search-form-company form').submit(function(){
	$.fn.yiiGridView.update('sr-resume-request-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#listing-company-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('sr-resume-request-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('sr-resume-request-grid');
        }
    });
    return false;
});
");
?>