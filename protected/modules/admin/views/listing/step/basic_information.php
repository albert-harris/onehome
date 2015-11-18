<div class="main-inner-2">
    <div class="form-type T_form-type" style="border:none;">
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'listing_type', array('class' => 'lb-1')); ?>
            <div class="group-1">
                <?php
                echo $form->radioButtonlist($model, 'listing_type', Listing::getListType(), array('separator' => '', 'class' => 'ad_nb_type_listing',
                    'template' => '<div class="list_type_custom" style="float:left;margin-right:10px;width:120px !important;">{input}  {label}</div>',
                        )
                );
                ?>
                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'listing_type'); ?>               
            </div>
        </div>
        <div class="in-row clearfix display_none">
            <?php echo $form->labelEx($model, 'listing_type_transaction', array('class' => 'lb-1')); ?>
            <div class="group-1">
                <?php
                echo $form->radioButtonlist($model, 'listing_type_transaction', ProTransactionsPropertyDetail::$aListingType, array('separator' => '', 'class' => 'companyTransaction',
                    'template' => '<div class="list_type_custom" style="float:left;margin-right:10px;width:120px !important;">{input}{label}</div>',
                        )
                );
                ?>
                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'listing_type_transaction'); ?>               
            </div>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'property_name_or_address', array('class' => 'lb-1')); ?>
            <div class="group-1 add-search">
                <?php
                if (!$model->isNewRecord && $model->status_listing == STATUS_LISTING_ACTIVE):
                    echo $form->textField($model, 'property_name_or_address', array('class' => 'text', 'disabled' => true));
                else:
                    echo $form->textField($model, 'property_name_or_address', array('class' => 'text anhdung_fix_enter'));
                endif;
                ?>               
                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'property_name_or_address'); ?>
            </div>
            <?php if ($model->isNewRecord || $model->status_listing != STATUS_LISTING_ACTIVE): ?>
                <img title ="Search Property Name Or Address" style="margin-left:3px;" class="search-map" data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/seachmap', array('q' => '')) ?>" alt="search map" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/search_map.png"  />
                <img title ="Reset Property Name Or Address" class="reset-map" data-fancybox-type="iframe" href="#" alt="reset map" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/undo.png"  />
            <?php endif; ?>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'display_title', array('class' => 'lb-1')); ?>
            <div class="group-1">
                <?php echo $form->textField($model, 'display_title', array('class' => 'text')); ?>
                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'display_title'); ?>
            </div>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'display_address', array('class' => 'lb-1')); ?>
            <div class="group-1">
                <?php echo $form->textField($model, 'display_address', array('class' => 'text')); ?>
                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'display_address'); ?>
            </div>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'postal_code', array('class' => 'lb-1')); ?>
            <div class="group-1">
                <?php /*echo CHtml::textField('text', $model->postal_code, array('id' => 'Listing_field', 'class' => 'text', 'disabled' => true));*/ ?>
                <?php /*echo $form->hiddenField($model, 'postal_code');*/ ?>
                <div id="postal-ajax">
                    <?php echo $form->dropDownlist($model,'postal_code',array(),array('empty'=>'----','class'=>'text'))?>
                </div>
                 <?php echo $form->hiddenField($model, 'postal_code_tmp'); ?>
                <?php echo $form->hiddenField($model, 'postal_code_xy'); ?>
                <?php echo $form->hiddenField($model, 'property_building_name'); ?>
                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'postal_code'); ?>
            </div>
        </div>

        <div class="in-row clearfix member_check">
            <?php echo $form->labelEx($model, 'user_agent_id', array('class' => 'lb-1')); ?>
            <div class="group-1">
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'attribute' => 'user_member',
                    'model' => $model,
                    'name' => 'member',
                    'sourceUrl' => Yii::app()->createAbsoluteUrl('admin/listing/autocomplete_agent'),
                    'options' => array(
                        'minLength' => MIN_LENGTH_AUTOCOMPLETE,
                        'multiple' => true,
                        'select' => 'js:function(event, ui) {
                                                 $("#Listing_user_agent_id").val(ui.item.id);
                                                 $("#Listing_user_agent_nirc").val(ui.item.nirc);
                                                 $("#member").attr("disabled",true);
                                                 $(".T_btn_reset_user").show();
                                         }',
                    ),
                    'htmlOptions' => array(
                        'class' => 'text',
//                        'disabled'=>'disabled',
                        'maxlength' => 80,
                        'style' => 'width:150px;',
                        'placeholder' => 'Enter name of member',
                    ),
                ));
                ?>      
                NRIC/FIN/PP No <?php echo $form->textField($model, 'user_agent_nirc', array('class' => 'text', 'style' => 'width:132px;', 'disabled' => true)); ?>
                <?php echo $form->hiddenField($model, 'user_agent_id'); ?>      

                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'user_agent_id'); ?>
            </div>
            <input  style="margin-left:10px;display:none;" type ='button' class="T_btn_reset_user" value="Clear" /> 
        </div> 
        

        
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'developer', array('class' => 'lb-1')); ?>
            <div class="group-1">
                <?php echo $form->textField($model, 'developer', array('class' => 'text')); ?>
                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'developer'); ?>
            </div>
        </div>
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'tenure', array('class' => 'lb-1')); ?>
            <div class="group-1">
                <?php // echo $form->textField($model, 'tenure', array('class' => 'text')); ?>
                 <?php    echo $form->dropDownlist($model, 'tenure', Listing::getDropdownlistWithTableName('ProMasterTenure','id','name'),array( 'class' => 'text'));?>
                
                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'tenure'); ?>
            </div>
        </div>    

        <div id="company_show" style="<?php echo ($model->listing_type_transaction == 2) ? 'display: block;' : 'display: none;' ?> ">
            <?php include('_company.php') ?>
        </div>
    </div>
    
    <?php include('basic_information_anhdung.php') ?>

    
    <div class="w-2 clearfix T_step_1_custom_btn ad_nb_recheck" >
        <input type ='submit' name="save_exit" class='btn-3' value="Save & Exit" />
        <input type ='submit' name="next"  class='btn-3' value="Next" />
    </div>        

</div>
</div>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fancybox_css.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fancybox.js"></script>
<?php
Yii::app()->clientScript->registerScript('click reset', "
    $('.T_btn_reset').click(function() {
        $('.T_form-type-step1 input, .T_form-type-step1 select').val('');
        $('.T_form-type-step1 select').trigger('change');
    });
");

Yii::app()->clientScript->registerScript('click reset_user', "
        $('.T_btn_reset_user').click(function() {
            $('#member').attr('disabled', false);
            $('#member').val('');
            $('#Listing_user_agent_id').val('');
            $('#Listing_user_agent_nirc').val('');
            $('.T_btn_reset_user').hide();
        });
");

if (!$model->isNewRecord && isset($model->user->first_name)) {
    $typeMember = ($model->user->role_id == ROLE_LANDLORD) ? '[ Landlord ]' : '[ Agent ]';
    if ($model->status_listing == STATUS_LISTING_ACTIVE) {
        Yii::app()->clientScript->registerScript('updatelisting', "
                     $('#member').attr('disabled', true);
                     $('#member').val('" . $model->user->first_name . ' ' . $model->user->last_name . ' ' . $typeMember . "');
                     $('.T_btn_reset_user').hide();
                     $('#Listing_user_agent_id').val('" . $model->user_id . "');
                     $('#Listing_user_agent_nirc').val('" . $model->user->nric_passportno_roc . "');
               ");
    } else {
        Yii::app()->clientScript->registerScript('updatelisting', "
                    $('#member').attr('disabled', true);
                    $('#member').val('" . $model->user->first_name . ' ' . $model->user->last_name . ' ' . $typeMember . "');
                    $('#Listing_user_agent_id').val('" . $model->user_id . "');
                    $('#Listing_user_agent_nirc').val('" . $model->user->nric_passportno_roc . "');    
                    $('.T_btn_reset_user').show();
              ");
    }
} else {
    if ($model->user_member != '') {
        Yii::app()->clientScript->registerScript('updatelisting', "
                    $('.T_btn_reset_user').show();
               ");
    }
}
?>
<style>
    .main-inner-2 { width: 1000px !important; } /* ANH DUNG ADD */
    
    .search-map:hover {cursor: pointer;}
    /*input, textarea, select, .uneditable-input {height: 25px;line-height: 25px;}*/
    input, textarea, .uneditable-input {height: 30px;line-height: 25px;}
    .list_type_custom {width: auto !important;}
    #Listing_listing_type input {float:left;margin-right:5px;}
    .form-type label {width: 200px !important;}
    #Listing_listing_type_transaction_0 ,#Listing_listing_type_transaction_1 {float: left;margin-right:5px;}
</style>

<?php if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') == true)): ?>
    <style>
        input, textarea, select, .uneditable-input {height: 30px;line-height: 25px;}
        .list_type_custom input {float:left;padding:0px;width:20px !important; margin-right:3px;height: 16px;}
        label, input, button, select, textarea {font-size: 11px;}
        .T_btn_reset_user ,.T_btn_reset {line-height: 16px !important;}
        .form-type .text {padding-right: 0px !important;border: none !important;padding-top:0px !important;}
        .T_btn_reset { padding: 5px 7px !important; }
    </style>
<?php endif; ?>
<script>
    $('.reset-map').live('click',function(){
        $('#Listing_property_name_or_address').val('');
        $('#Listing_field').val('');
        $('#Listing_postal_code').html('<option>---</option>');
        $('#Listing_postal_code_tmp').val('');
    });

    //Listing_property_name_or_address
    function loadCurentPostalcode(){
        var data = $('#Listing_postal_code_tmp').val();
        $('#Listing_postal_code').html(data);
        $('#Listing_postal_code').val('<?php echo $model->postal_code ?>');
        $('#Listing_postal_code').trigger('click');
    }    

    // ANH DUNG Sep 18, 2014
    function fnInitInputCurrency() {
        $(".ad_fix_currency").each(function(){
            $(this).autoNumeric('init', {lZero:"deny", aPad: false} ); 
        });    
    }


    $(function() {        
        fnInitInputCurrency();
        //dtoan load postal code
       <?php if($model->postal_code_tmp !=''): ?> 
       loadCurentPostalcode();
       <?php  endif;?>   

        fnBindChangeIndividualCompany();
        $('.search-map').click(function() {
            if ($('#Listing_property_name_or_address').val() == '') {
                alert('Please enter postal code, address or property name');
            } else {
                var link = $('.search-map').attr('href') + $('#Listing_property_name_or_address').val();
                $.fancybox({
                    fitToView: true,
                    width: 700,
                    height: 550,
                    autoSize: false, scrolling: false,
                    title: "",
                    href: link,
                    titlePosition: 'Result Search',
                    fitToView:true,
                            type: 'iframe',
                    helpers: {overlay: {
                            closeClick: false,
                        }
                    },
                    beforeLoad: function() {
                        var a = $('.fancybox-skin iframe').contents().find('#address').trigger('change', function() {
                            alert('asd');
                        });
                    },
                });
            }
        });

        $('.T_btn_reset').click(function() {
            $('.T_form-type-step1 input, .T_form-type-step1 select').val("");
            $('.T_form-type-step1 select').trigger('change');
        });

        $('.companyTransaction').change(function() {
            if ($(this).val() == 2) {
                $('#company_show').show();
            } else {
                    <?php if ($model->isNewRecord): ?>
                    $('#company_show input').each(function() {
                        $(this).val('');
                    })
                    <?php endif; ?>
                $('#company_show').hide();
            }
        });
    });
    
    // ANH DUNG
    function fnAddRequiredMember(){
        var span = '<span class="required"> *</span>';
        $('.member_check label:first').append(span);
    }
    function fnRemoveRequiredMember(){
        $('.member_check label:first').find('span').remove();
    }
    
    function fnBindChangeIndividualCompany(){
        $('.companyTransaction').change(function(){
            var select = $(this).val();
            if(select==<?php echo ProTransactionsPropertyDetail::VAR_INDIVIDUAL;?>){
                fnAddRequiredMember();
            }else
                fnRemoveRequiredMember();            
        });
        
        <?php if($model->listing_type_transaction == ProTransactionsPropertyDetail::VAR_INDIVIDUAL) : ?>
            fnAddRequiredMember();
        <?php endif;?>
    }
    // ANH DUNG
    
    // ANH DUNG Oct 29, 2014
    function fnBindFixEnterSearch(){
        $('.anhdung_fix_enter').keypress(function(e){
            var code = e.keyCode || e.which;
            if(code == 13) { //Enter keycode
              //Do something
              $('.search-map').trigger('click');
              return false;
            }
        });
    }    
    $(window).load(function(){ fnBindFixEnterSearch(); });
    // ANH DUNG Oct 29, 2014
    
</script>
