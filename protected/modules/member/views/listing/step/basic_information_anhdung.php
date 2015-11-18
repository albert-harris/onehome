<?php include 'basic_information_anhdung_select_render.php';
?>
<script>
    $(function(){
        fnHideAll();
        // Jun 25, 2014 ANH DUNG - FOR SELECT PROPETY TYPE - I'M SICK
        fnFirstChange();
        fnSecondChange();
        fnMapGroupToParent();
        fnAddLabelRequired();
        fnBindSelectAskingPrice();
        fnCheckShowHideSubmitButton();
        fnRadioListingTypeChange();
        fnCheckLoad();
        fnCheckShowHideSubmitButton(); // phải gọi lại lần nữa do cái select thứ 2 nó change
        fnCheckSelectedOfficeBank();
        // Jun 25, 2014 ANH DUNG - FOR SELECT PROPETY TYPE - I'M SICK
    });
    
    function fnCheckLoad(){
        <?php
            $scenario = Listing::getScenarioOfListing($model);// lấy scenario để validate
        ?>
        // hiện các textfield của scenario đó
        <?php if(trim($scenario)!=''):?>
            fnCheckShowScenario('<?php echo $scenario;?>');
            // add  fnAddLabelRequired
            fnAddScenarioRequired('<?php echo $scenario;?>');
        <?php endif;?>
            
        // hiện các Listing_asking_price_select
        <?php if($model->asking_price_select==Listing::NB_PRICE_OTHER):?>
            $('#Listing_asking_price_select').trigger('change');
        <?php endif;?>
        
        // lấy html cho cái select thứ 2
        <?php if($model->property_type_2!=""):?>
            var html_update = $('.ad_nb_replace_<?php echo $model->property_type_2;?>').html();
            // không dùng js change nữa, sẽ load = php
//            $('.ad_nb_property_second').html(html_update);
//            $('.ad_nb_property_second').val('<?php echo $model->property_type_1;?>');
        <?php endif;?>
            
        // remove some span.required of yii form auto gen
        $('.ad_nb_show_all').find('span.required').remove();
    }
    
    function fnFirstChange(){
        $('.ad_nb_property_first').change(function(){
            fnHideAll();
            var scenario = $(this).find('option:selected').attr('ad_nb');
            var selected = $(this).val();
            var html_update = '<option value="">Select</option>';
            if($.trim(selected)==''){
                $('.ad_nb_property_second').html(html_update);
            }else{
                var html_update = $('.ad_nb_replace_'+selected).html();
                $('.ad_nb_property_second').html(html_update);
                $('.ad_nb_property_second').trigger('click');
//                var scenario = $(this).find('option:selected').attr('ad_nb');
//                fnCheckShowScenario(scenario);
//                fnAddScenarioRequired(scenario);
            }
            fnResetVal();
            SomeSameFunctionOfTwoSelect(scenario);
        });        
        // xử lý khi load lại page sẽ không gọi trigger change ở đây mà sẽ find by id của property rồi get ra group_show và gọi js group_show.show()
    }
    
    function SomeSameFunctionOfTwoSelect(scenario){
        fnCheckShowScenario(scenario);
        fnAddScenarioRequired(scenario);
        fnCheckShowHideSubmitButton();
        fnCheckSelectedOfficeBank();
    }
    
    function fnSecondChange(){
        $('.ad_nb_property_second').change(function(){
            var scenario = $(this).find('option:selected').attr('ad_nb');            
//            fnCheckShowScenario(scenario);
//            fnAddScenarioRequired(scenario);
            fnResetVal();
            SomeSameFunctionOfTwoSelect(scenario);
        });
    }
    
    /**
     * @param {string} scenario ex: gsv1
     * @returns {undefined}
     */
    function fnCheckShowScenario(scenario){
        if($.trim(scenario)!='') {
            fnHideAll();
            fnOnlyShowClass(scenario);
        }
    }
        
    function fnResetVal(){
        $('.ad_nb_show_all').find('input').val('');
        $('.ad_nb_show_all').find('.errorMessage').hide();
        $('.ad_nb_show_all').find('select').val('');
        $('.ad_nb_show_all').find('select').trigger('click');
    }
    
    function fnOnlyShowClass(NameClass){        
        $('.'+NameClass).show();
    }
    
    function fnHideAll(){
        $('.ForLandedHouse').hide();
        $('.asking_price_select_other').hide();
        $('.ad_nb_show_all').hide();
    }
    
    // có 1 vài parent sẽ lấy group_show ở parent ko lấy ở con
    function fnMapGroupToParent(){
        $('.ad_nb_property_first option').each(function(){
            var pk = $(this).attr('value');
            var group_show = $.trim($('.group_show_parent_'+pk).text());
            $(this).attr('ad_nb', group_show);
        });
    }
    
    function fnAddLabelRequired(){
        var span = '<span class="required_hide display_none"> *</span>';
        $('.of_bedroom label:first').append(span);
        $('.floor_area label:first').append(span);
        $('.land_area label:first').append(span);
        $('.hdb_town_estate label:first').append(span);
    }
    
    // xử lý thêm hay xóa dấu * đỏ required ở client
    function fnAddScenarioRequired(scenario){
        if($.trim(scenario)!='') {
            var current_scenario = $('.current_scenario').val();
            if($.trim(current_scenario)!=''){
                var class_required = current_scenario+'_required';
                $('.ad_nb_form').find('.'+class_required).removeClass(class_required);
            }
            
            var class_required_new = scenario+'_required';
            $('.ad_nb_show_all').addClass(class_required_new);
           $('.current_scenario').val(scenario);
           if(scenario=='gsv3'){
                $('.floor_area').removeClass(class_required_new);
                $('.land_area').removeClass(class_required_new);
                $('.ForLandedHouse').show();
           }
        }        
    }
    
    // when asking price select change
    function fnBindSelectAskingPrice(){
        $('#Listing_asking_price_select').change(function(){
            if($(this).val()==<?php echo Listing::NB_PRICE_OTHER;?>){
                $('.asking_price_select_other').show();
            }else{
                $('.asking_price_select_other').val('').hide();
            }
        });
    }
    
    // show hide submit button
    function fnCheckShowHideSubmitButton(){
        var ok=false;
        var s1 = $('.ad_nb_property_first').find('option:selected').attr('ad_nb');
        var s2 = $('.ad_nb_property_second').find('option:selected').attr('ad_nb');
        if($.trim(s1)!='' || $.trim(s2)!='')
            ok=true;
        if(ok)
            $('.ad_nb_recheck').show();
        else
            $('.ad_nb_recheck').hide();
    }
    
    
    /* for office_bkank_valuation */
    function fnRadioListingTypeChange(){
        $('.ad_nb_type_listing').change(function(){
            showHideOfficeBank($(this).val());
        });
    }
    
    function fnCheckSelectedOfficeBank(){
        $('.ad_nb_type_listing').each(function(){            
            if($(this).is(':checked')){
                showHideOfficeBank($(this).val());
            }
        });
    }
    
    function showHideOfficeBank(chkVal){
        if(chkVal==2) //For Sales
        {
            $('.office_bkank_valuation').show();
        }else if(chkVal==1){// rent
            $('.office_bkank_valuation').hide();
        }
    }
    /* for office_bkank_valuation */
        
</script>
<input type="hidden" class="current_scenario" value="" name="ad_nb_current_scenario">

<div class="ad_nb_form form-type T_form-type-step1" style='margin-top: -20px;'>
    <div class="in-row clearfix my_optgroup">
            <?php echo $form->labelEx($model, 'property_type_2', array('class' => 'lb-1')); ?>
        <div class="group-1">
            <?php // echo ProPropertyType::getDropDownSelectGroup('Listing[property_type_1]', 'Listing_property_type_1', $model->property_type_1,  'Select'); ?>
            <div class="w-170 f-left">
                <?php  
                    // thực tế đang lưu cái property_type_1 để search và phục vụ cho transaction
                echo $form->dropDownlist($model, 'property_type_2', 
                        ProPropertyType::getListOptionParent(),
                        array( 'class' => 'text ad_nb_property_first', 'empty'=>'Select'));?>
            </div>
            <div class="w-220 f-left l_padding_20">
                <?php
                    $arrType1 = array();
                    if($model->property_type_2){
                        echo ProPropertyType::getOptionSelectGroupByParent($model->property_type_2, 
                            "Listing[property_type_1]", //$name, 
                           "ad_nb_replace_$model->property_type_1", //$id, 
                           $model->property_type_1, //$value,
                           "Select", //$hasEmpty, 
                           "ad_nb_property_second ad_nb_replace_$model->property_type_1" //$classSelect
                           );
                    }else{
                        echo $form->dropDownlist($model, 'property_type_1', 
    //                        ProPropertyType::getListOptionParent(),
                            $arrType1,
                            array( 'class' => 'text ad_nb_property_second', 'empty'=>'Select'));
                    }
                    ?>
            </div>

            <div class="clear" style='clear: both;'></div>
            <?php echo $form->error($model, 'property_type_1'); ?>
        </div>
    </div>   

    <div class="unit_from in-row clearfix ad_nb_show_all <?php echo implode(' ', ProPropertyType::$A_FIELD_MAP['unit_from']);?>">
        <?php echo $form->labelEx($model, 'unit_from', array('class' => 'lb-1')); ?>
        <div class="group-1">
            <div class="group-1">
                <?php echo $form->textField($model, 'unit_from', array('class' => 'text ', 'placeholder' => '','style'=>'width:50px;')); ?>
                -
                 <?php echo $form->textField($model, 'unit_to', array('class' => 'text ', 'placeholder' => '','style'=>'width:50px;')); ?>
                <span style="color:gray;"><i>Unit number will not be showed in your details.</i> </span>
            </div>
            <div class="clear" style='clear: both;'></div>
            <?php echo $form->error($model, 'unit_from'); ?>   
        </div>
    </div>
    
    <div class="hdb_town_estate in-row clearfix ad_nb_show_all <?php echo implode(' ', ProPropertyType::$A_FIELD_MAP['hdb_town_estate']);?>">
        <?php echo $form->labelEx($model, 'hdb_town_estate', array('class' => 'lb-1')); ?>
        <div class="group-1">
            <?php echo $form->dropDownlist($model, 'hdb_town_estate', Listing::getListOptionsHDB(), array('empty' => 'Select')); ?> 
            <div class="clear" style='clear: both;'></div>
            <?php echo $form->error($model, 'hdb_town_estate'); ?>
        </div>
    </div>

    <div class="price in-row clearfix ad_nb_show_all <?php echo implode(' ', ProPropertyType::$A_FIELD_MAP['price']);?>">
            <?php echo $form->labelEx($model, 'price', array('class' => 'lb-1')); ?>
        <div class="group-1">
            <div class="f-left w-120">
                <?php echo $form->textField($model, 'price', array('class' => 'text number_only ad_fix_currency')); ?>
            </div>
            <div class="f-left w-150 l_padding_10">
                <?php echo $form->dropDownlist($model, 'asking_price_select', Listing::getListOptionsPrice(), array('empty' => 'Select')); ?> 
            </div>
            <div class="f-left w-120 l_padding_10">
                <?php echo $form->textField($model, 'asking_price_select_other', array('class' => 'text asking_price_select_other display_none', 'placeholder' => '','style'=>'')); ?>
            </div>
            <div class="clear" style='clear: both;'></div>
            <?php echo $form->error($model, 'price'); ?>              
        </div>
    </div>   

    <div class="office_bkank_valuation in-row clearfix ad_nb_show_all <?php echo implode(' ', ProPropertyType::$A_FIELD_MAP['office_bkank_valuation']);?>">
            <?php echo $form->labelEx($model, 'office_bkank_valuation', array('class' => 'lb-1')); ?>
        <div class="group-1">
            <?php echo $form->textField($model, 'office_bkank_valuation', array('class' => 'text number_only',)); ?>
            <div class="clear" style='clear: both;'></div>
            <?php echo $form->error($model, 'office_bkank_valuation'); ?>              
        </div>
    </div>   

    <div class="of_bedroom in-row clearfix ad_nb_show_all <?php echo implode(' ', ProPropertyType::$A_FIELD_MAP['of_bedroom']);?>">
            <?php echo $form->labelEx($model, 'of_bedroom', array('class' => 'lb-1')); ?>
        <div class="group-1">
            <?php // echo $form->dropDownlist($model, 'of_bedroom', ProMasterBedroom::getListDataBedroom('id'), array('empty' => 'Select')); ?>
               <?php echo $form->dropDownlist($model, 'of_bedroom', Listing::getListOptionsBedroom(), array('empty' => 'Select')); ?> 
            <div class="clear" style='clear: both;'></div>
            <?php echo $form->error($model, 'of_bedroom'); ?>               
        </div>
    </div>   
    
    <div class="of_bathrooms in-row clearfix ad_nb_show_all <?php echo implode(' ', ProPropertyType::$A_FIELD_MAP['of_bathrooms']);?>">
            <?php echo $form->labelEx($model, 'of_bathrooms', array('class' => 'lb-1')); ?>
        <div class="group-1">
            <?php // echo $form->dropDownlist($model, 'of_bedroom', ProMasterBedroom::getListDataBedroom('id'), array('empty' => 'Select')); ?>
               <?php echo $form->textField($model,'of_bathrooms',array('class'=>'text number_only'));?>
            <div class="clear" style='clear: both;'></div>
            <?php echo $form->error($model, 'of_bathrooms'); ?>               
        </div>
    </div>   

    <div class="floor_area in-row clearfix ad_nb_show_all <?php echo implode(' ', ProPropertyType::$A_FIELD_MAP['floor_area']);?>">
        <?php echo $form->labelEx($model, 'floor_area', array('class' => 'lb-1')); ?>
        <div class="group-1">
            <?php // echo $form->dropDownlist($model, 'floor_area', ProMasterFloor::getListDataFloor('id'), array('empty' => 'Select')); ?> 
            <div class="f-left w-120">
                <?php echo $form->textField($model, 'floor_area',array('class'=>'text number_only','style'=>'width:120px;')); ?>
            </div>
            <div class="f-left w-150 l_padding_10">
                <?php echo $form->dropDownlist($model, 'floor_area_unit', Listing::getListOptionsFloorAreaUnit(), array()); ?> 
            </div>
            
            <div class="clear" style='clear: both;'></div>
            <div class="ForLandedHouse" style="padding-top:5px;">For Landed House, either floor area or land area must be filled in.</div>
            <?php echo $form->error($model, 'floor_area'); ?>        
            <?php echo $form->error($model, 'error_gvs3'); ?>
        </div>
    </div>
            
    <div class="land_area in-row clearfix ad_nb_show_all <?php echo implode(' ', ProPropertyType::$A_FIELD_MAP['land_area']);?>">
        <?php echo $form->labelEx($model, 'land_area', array('class' => 'lb-1')); ?>
        <div class="group-1" >
            <?php // echo $form->dropDownlist($model, 'floor_area', ProMasterFloor::getListDataFloor('id'), array('empty' => 'Select')); ?> 
            <div class="f-left w-120">
                <?php echo $form->textField($model, 'land_area',array('class'=>'text number_only','style'=>'')); ?>
            </div>
            <div class="f-left" style="padding:3px;color: red;"> <?php echo Listing::LAND_AREA_UNIT; ?></div>
            <div class="clear" style='clear: both;'></div>
            <?php echo $form->error($model, 'land_area'); ?>
        </div>
    </div>

</div>