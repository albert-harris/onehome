<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div class="wide form">
    <div class="row">
        <?php echo $form->dropDownList($model, 'action_listing_grid', Listing::$ACTION_COMPANY_LISTING, array('class'=>'action_listing_grid f-left' ,'empty' => 'Select Action')); ?>
        <label class="w-120">New Expiry Date</label>
        <div class="f-left">
        <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,        
                'attribute'=>'dnc_expiry_date_new',
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
                    'class'=>'text w-100 dnc_expiry_date',
                    'style'=>'margin-right:10px;',
                ),
            ));
        ?>
        </div>
        <div class="f-left l_padding_50">
            <button name="yt0" type="button" id="yw3" class="apply_action_listing btn btn-small w-100 ">Apply</button>
            <button name="yt0" type="button" id="yw3" next="<?php echo $MoveToType;?>" NextText="<?php echo $MoveTo;?>" class="move_listing_action btn btn-small">Move to <?php echo $MoveTo;?></button>
        </div>
        
    </div>
</div> <!-- end wide form -->
<?php $this->endWidget(); ?>

<a class=" ForCompanyEditContact display_none" href="#"></a>

<script>
    $(function(){
        fnBindApply();
    });
    
    function fnBindApply(){
        $('.apply_action_listing').click(function(){
            var action = $('.action_listing_grid').val();
            if(action==<?php echo Listing::EDIT_CONTACT_NUMBER;?>){
                fnActionEditContact();
            }else if(action==<?php echo Listing::UPDATE_DNC_EXPIRY_DATE;?>){
                fnActionUpdateDnc();
            }else if(action==<?php echo Listing::DELETE;?>){
                fnActionDelete();
            }else if(action==<?php echo Listing::CHANGE_TELEMARKETER ;?>){
                fnActionChangeTelemarketer();
            }
        });
        
        $('.move_listing_action').click(function(){
            var list_id = fnGetListId();
            var company_listing_type = $(this).attr('next');
            var NextText = $(this).attr('NextText');
            var href = '<?php echo Yii::app()->createAbsoluteUrl('admin/ajax/companyListingMoveto');?>?id='+list_id;
            if($.trim(list_id)!=''){
                if(confirm('Are You Sure Move To '+NextText)){
                    $.blockUI({ message: null });
                    $.ajax({
                        url: href,
                        data: {company_listing_type:company_listing_type},
                        success: function(data){
                            $.fn.yiiGridView.update("listing-company-grid");
                            $.unblockUI();
                        }
                    });
                }
            }
        });
        // end $('.move_listing_action').cli
        
        
        
    }
    
    function fnGetListId(){
        var list_id = '';
        $('.items tbody').find('input:checkbox').each(function(){
            if($(this).is(':checked')){
                list_id += '-'+$(this).val();
            }
        });
        if(list_id=='')
            alert('Please Select One Listing');
        return list_id;
    }
    
    function fnActionEditContact(){
        var list_id = fnGetListId();
        if($.trim(list_id)!=''){
            var href = '<?php echo Yii::app()->createAbsoluteUrl('admin/ajax/companyEditContact');?>?id='+list_id;
            $(".ForCompanyEditContact").attr('href',href);
            $(".ForCompanyEditContact").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});
            $(".ForCompanyEditContact").trigger('click');
        }else{
//            alert(1);
            return false;
        }        
    }
    
    function fnActionUpdateDnc(){
        var list_id = fnGetListId();
        if($.trim(list_id)!=''){
            var dnc_expiry_date = $('.dnc_expiry_date').val();
            var href = '<?php echo Yii::app()->createAbsoluteUrl('admin/ajax/companyUpdateDncExpiryDate');?>?id='+list_id;
//            if(confirm('Are You Sure Update DNC Expiry Date?')){
            if(dnc_expiry_date!=''){
                $.blockUI({ message: null });
                $.ajax({
                    url: href,
                    data: {dnc_expiry_date:dnc_expiry_date},
                    success: function(data){
                        $.fn.yiiGridView.update("listing-company-grid");
                        $.unblockUI();
                    }
                });
            }else{
                alert('Please Input New Expiry Date');
            }
        }else{
//            alert(1);
            return false;
        }
    }
    
    function fnActionDelete(){
        var list_id = fnGetListId();
        var href = '<?php echo Yii::app()->createAbsoluteUrl('admin/ajax/companyDeleteListing');?>?id='+list_id;
        if($.trim(list_id)!=''){
            $.blockUI({ message: null });
            $.ajax({
                url: href,
//                data: {id:list_id},
                success: function(data){
                    $.unblockUI();
                }
            });
        }else{
//            alert(1);
        return false;
        }
    }

	function fnActionChangeTelemarketer() {
        var list_id = fnGetListId();
        if($.trim(list_id)!=''){
            var href = '<?php echo Yii::app()->createAbsoluteUrl('admin/listingcompany/updateTelemarketer');?>?id='+list_id;
            $(".ForCompanyEditContact").attr('href',href);
            $(".ForCompanyEditContact").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});
            $(".ForCompanyEditContact").trigger('click');
        }else{
            return false;
        }        
	}
</script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />

