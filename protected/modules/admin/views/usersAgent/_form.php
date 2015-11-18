<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
)); ?>

	<?php echo Yii::t('translation', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
	
        <div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->dropDownList($model,'title', CmsFormatter::$TITLE_MR, array('empty'=>'Select')); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>    

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'first_name')); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'last_name')); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'commission_schema_id'); ?>
            <?php echo $form->dropDownList($model,'commission_schema_id', ProCommission::getListData(), array('empty'=>'Select')); ?>
            <?php echo $form->error($model,'commission_schema_id'); ?>
        </div>
    
	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'nric_passportno_roc')); ?>
		<?php echo $form->textField($model,'nric_passportno_roc',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nric_passportno_roc'); ?>
	</div>
    

	<div class="row">
                <?php if (!$model->isNewRecord):?>
                    <div style="width: 100%;float: left;padding-bottom: 5px;padding-left: 170px;">
                        <label style="color: red;width: auto; ">Leave this blank if you don't want to change current password</label>
                    </div>
                <?php endif?>                        
		<?php echo Yii::t('translation', $form->labelEx($model,'password_hash')); ?>
		<?php echo $form->passwordField($model,'password_hash',array('size'=>60,'maxlength'=>100, 'value'=>'')); ?>
		<?php echo $form->error($model,'password_hash'); ?>
	</div>

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'password_confirm')); ?>
		<?php echo $form->passwordField($model,'password_confirm',array('size'=>30,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'email_not_login')); ?>
		<?php echo $form->textField($model,'email_not_login',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email_not_login'); ?>
	</div>    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'agent_cea')); ?>
		<?php echo $form->textField($model,'agent_cea',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'agent_cea'); ?>
	</div>    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'license')); ?>
		<?php echo $form->textField($model,'license',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'license'); ?>
	</div>    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'agent_company_name')); ?>
		<?php echo $form->textField($model,'agent_company_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'agent_company_name'); ?>
	</div>    
        <div class="row">
		<?php // echo Yii::t('translation', $form->labelEx($model,'email')); ?>
		<?php // echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php // echo $form->error($model,'email'); ?>
	</div>    
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'agent_company_logo')); ?>
		<?php echo $form->fileField($model,'agent_company_logo',array()); ?>
                <span>Only <?php echo Users::$AllowFileAvatar ;?> are allow. Recommended Dimension:  86 px x 75 px</span>
                <?php if (!$model->isNewRecord && $model->agent_company_logo != ''): ?>
                    <p style="text-align: left;padding-left: 170px;">
                        <img src="<?php echo ImageProcessing::bindImageByModel($model, 106 ,75, array('agent_company_logo'=>1)); ?>">                            
                        <br/> 
                        <input type="checkbox" name="delete_current_logo" class="delete_current_image">
                        Delete Current Logo
                    </p>
                    <script>
                        $('.delete_current_image').click(function() {
                            if ($(this).is(':checked')) {
                                $(this).parent('p').parent('div').find('input:file').hide().val('');
                            } else
                                $(this).parent('p').parent('div').find('input:file').show();
                        });



                    </script>
                <?php endif ?>
		<?php echo $form->error($model,'agent_company_logo'); ?>
	</div>    
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'avatar')); ?>
		<?php echo $form->fileField($model,'avatar',array()); ?>
                <span>Only <?php echo Users::$AllowFileAvatar ;?> are allow. Recommended Dimension:  66 px x 65 px</span>
                <?php if (!$model->isNewRecord && $model->avatar != ''): ?>
                    <p style="text-align: left;padding-left: 170px;">
                        <img src="<?php echo ImageProcessing::bindImageByModel($model, 100, 100, array('avatar'=>1)); ?>">                            
                        <br/> 
                        <input type="checkbox" name="delete_current_image" class="delete_current_image">
                        Delete Current Avatar
                    </p>
                    <script>
                        $('.delete_current_image').click(function() {
                            if ($(this).is(':checked')) {
                                $(this).parent('p').parent('div').find('input:file').hide().val('');
                            } else
                                $(this).parent('p').parent('div').find('input:file').show();
                        });



                    </script>
                <?php endif ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>    
    
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'phone')); ?>
		<?php echo $form->dropDownList($model,'area_code_id', AreaCode::getAreaCode(), array('style'=>'width:200px;' , 'empty'=>'Select')); ?>
		<?php echo $form->textField($model,'phone',array('style'=>'width:200px;','maxlength'=>50)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>    

	<div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'address')); ?>
		<?php echo $form->textArea($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>    

	<div class="row display_none">
		<?php echo Yii::t('translation', $form->labelEx($model,'contact_no')); ?>
		<?php echo $form->textField($model,'contact_no',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_no'); ?>
	</div>
    
        <div class="row">
		<?php echo Yii::t('translation', $form->labelEx($model,'postal_code')); ?>
		<?php echo $form->textField($model,'postal_code',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'postal_code'); ?>
	</div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'country_id'); ?>
            <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('empty'=>'Select')); ?>
            <?php echo $form->error($model,'country_id'); ?>
        </div>    
    
        <div class="row">
            <?php echo $form->labelEx($model,'is_subscriber'); ?>
            <?php echo $form->dropDownList($model,'is_subscriber', CmsFormatter::$yesNoFormat, array()); ?>
            <?php echo $form->error($model,'is_subscriber'); ?>
        </div>    
    
        <div class="row">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->dropDownList($model,'status', CmsFormatter::$statusVar, array()); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>    
        <div class="row">
            <?php echo $form->labelEx($model,'gst'); ?>
            <?php echo $form->dropDownList($model,'gst', CmsFormatter::$yesNoFormat, array()); ?>
            <?php echo $form->error($model,'gst'); ?>
        </div>    
    
        <div class="clr"></div>
        <div class="row wrap_multiselect_location">
            <?php echo $form->labelEx($model,'ProAgentDistrict'); ?>
            <?php echo $form->dropDownList($model,'ProAgentDistrict', ProLocation::getListDataLocation(), array('class'=>'multiselect_location','multiple'=>'multiple')); ?>
            <?php echo $form->error($model,'ProAgentDistrict'); ?>
        </div>    
        <div class="clr"></div>
        
        <div class="row">
            <?php echo $form->labelEx($model,'TierManagerId'); ?>
            <?php echo $form->hiddenField($model,'TierManagerId'); ?>
            <div class="f-left">
            <?php 
                // ANH DUNG Apr 03, 2014 widget auto complete search user customer and supplier
            $url = Yii::app()->createAbsoluteUrl('ajax/search_agent_tier');
            if(isset($_GET['id'])){
                $url = Yii::app()->createAbsoluteUrl('ajax/search_agent_tier',array('id'=>$_GET['id']));
            }
                $aData = array(
                    'model'=>$model,
                    'name_relation_user'=>'rTierManager',
                    'field_customer_id'=>'TierManagerId',
                    'placeHolder'=>'Type name of saleperson',
                    'divClosest'=>'unique_wrap_autocomplete',
                    'ReadonlyFalseForTier'=>1,// remove readonly for input search
                    'CallFunctionTier'=>1,
                    'NotShowTableInfo'=>1,
                    'url'=> $url,
                );
                $this->widget('ext.ProAutocompleteUser.ProAutocompleteUser',
                    array('data'=>$aData));

            ?>
            <?php echo $form->error($model,'TierManagerId'); ?>
            </div>
        </div>    
        
    
        <div class="row grid-view">
            <label>&nbsp;</label>
            <table class="materials_table items ">
                <thead>
                    <tr>
                        <th class="w-20 item_c">#</th>
                        <th class="w-320 item_c">Name</th>                        
                        <th class=" item_c">NRIC/FIN/PP No</th>                        
                        <th class=" item_c">Type</th>
                        <th class="last item_c">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($model->aTierManager)): $cmsFormater = new CmsFormatter();?>
                    <?php foreach($model->aTierManager as $key=>$mAgentTier):?>
                    <tr class="materials_row">
                        <td class="item_c order_no row_class_id<?php echo $mAgentTier->tier_manager_id;?>"><?php echo ($key+1);?></td>
                        <td class="l_padding_10">
                            <?php echo $mAgentTier->rTier?($cmsFormater->formatFullNameRegisteredUsers($mAgentTier->rTier)):"" ?>
                            <input type="hidden" name="tier_id[]" value="<?php echo $mAgentTier->tier_manager_id;?>">
                            <input type="hidden" name="type_tier[]" value="<?php echo $mAgentTier->type_tier;?>">
                        </td>
                        <td class="l_padding_10">
                            <?php echo $mAgentTier->rTier?$mAgentTier->rTier->nric_passportno_roc:"" ?>
                        </td>
                        <td class="l_padding_10 w-150 item_c">
                            <?php echo ProAgentTierManager::$TYPE[$mAgentTier->type_tier];
                                    //CHtml::dropDownList('type_tier[]', $mAgentTier->type_tier, ProAgentTierManager::$TYPE);
                            ?>
                        </td>
                        <td class="item_c last">
                            <?php if($key==0): ?>
                            <span class="remove_icon_only"></span>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>

	<div class="row">
        <?php echo $form->labelEx($model, 'introduction'); ?>
        <div style="float:left;">
			<?php
			$this->widget('ext.editMe.ExtEditMe', array(
				'model' => $model,
				'height' => '250px',
				'width' => '700px',
				'attribute' => 'introduction',
				'toolbar' => Yii::app()->params['ckeditor_editMe'],
				'filebrowserBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html',
				'filebrowserImageBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html?type=Images',
				'filebrowserFlashBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html?type=Flash',
				'filebrowserUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				'filebrowserImageUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				'filebrowserFlashUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			));
			?>
		</div>
	</div>
	<div class="row">
        <?php echo $form->labelEx($model, 'qualification'); ?>
        <div style="float:left;">
			<?php
			$this->widget('ext.editMe.ExtEditMe', array(
				'model' => $model,
				'height' => '250px',
				'width' => '700px',
				'attribute' => 'qualification',
				'toolbar' => Yii::app()->params['ckeditor_editMe'],
				'filebrowserBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html',
				'filebrowserImageBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html?type=Images',
				'filebrowserFlashBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html?type=Flash',
				'filebrowserUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				'filebrowserImageUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				'filebrowserFlashUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			));
			?>
		</div>
	</div>
	<div class="row">
        <?php echo $form->labelEx($model, 'experience'); ?>
        <div style="float:left;">
			<?php
			$this->widget('ext.editMe.ExtEditMe', array(
				'model' => $model,
				'height' => '250px',
				'width' => '700px',
				'attribute' => 'experience',
				'toolbar' => Yii::app()->params['ckeditor_editMe'],
				'filebrowserBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html',
				'filebrowserImageBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html?type=Images',
				'filebrowserFlashBrowseUrl' => Yii::app()->baseUrl . '/ckfinder/ckfinder.html?type=Flash',
				'filebrowserUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				'filebrowserImageUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				'filebrowserFlashUploadUrl' => Yii::app()->baseUrl . '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			));
			?>
		</div>
	</div>
	<div class="row buttons" style="padding-left: 170px;">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'label'=>$model->isNewRecord ? Yii::t('translation', 'Create') : Yii::t('translation', 'Save'),
                'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'small', // null, 'large', 'small' or 'mini'
                //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
            )); ?>	
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="display_none dropdown_hide">
<?php // echo CHtml::dropDownList('type_tier[]', 1, ProAgentTierManager::$TYPE);?>
</div>

<style>
    div.form .row label { width: 170px;}
    .btn-group {float: left;}
</style>
    <!--<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />-->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-multiselect.css" type="text/css">
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/verz_custom.css" />
    
<script>

$(function(){
    fnBindRemoveIcon();    
        $('.multiselect_location').multiselect({
          maxHeight:200,
          buttonWidth: '225px',
          numberDisplayed: 0,
          includeSelectAllOption: true
//          checkboxName: 'location[]'
      });
});
/**
 * to do build tr info tier manager
 * @pa@param {object} item is object of user
 */
function fnBuildTrInfoTier(item, idField){
    var url_ = '<?php echo Yii::app()->createAbsoluteUrl('admin/usersAgent/create') ;?>';
    var first_tier_manager_id = item.id;
    $.blockUI({ message: null });
    $.ajax({
        url: url_,
        data:{first_tier_manager_id:first_tier_manager_id},
        success:function(data){
            $('.materials_table').html($(data).find('.materials_table'));
            $.unblockUI();
        }
    });
}

/** Mar 06, 2014 hàm này custom cho chỗ này, ko dùng dc cho chỗ khác 
 * vì nó remove cả cái tbody
 * @todo remove tr and refresh order number of row
 */
function fnBindRemoveIcon(){
    $('.remove_icon_only').live('click',function(){
        if(confirm('Are you sure you want to delete this item?')){
            $(this).closest('tbody').remove();
            fnRefreshOrderNumber();
        }
    });
}
   

</script>