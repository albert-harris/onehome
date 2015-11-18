<div class="main-inner-2">
    <div class="form-type T_form-type">
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'listing_type', array('class' => 'lb-1')); ?>
            <div class="group-1">
                <?php
                echo $form->radioButtonlist($model, 'listing_type', Listing::getListType(), array('separator' => '', 'class' => 'text ad_nb_type_listing',
                    'template' => '<div style="float:left;margin-right:10px;">{input}{label}</div>',
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
                echo $form->radioButtonlist($model, 'listing_type_transaction', ProTransactionsPropertyDetail::$aListingType, array('separator' => '', 'class' => 'text companyTransaction',
                    'template' => '<div style="float:left;margin-right:10px;">{input}{label}</div>',
                        )
                );
                ?>
                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'listing_type_transaction'); ?>               
            </div>
        </div>
        

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model, 'property_name_or_address', array('class' => 'lb-1')); ?>
            <div class="group-1">
                
                 <?php 
                    if(!$model->isNewRecord && $model->status_listing==STATUS_LISTING_ACTIVE):
                        echo $form->textField($model, 'property_name_or_address', array('class' => 'text','disabled'=>true));
                    else:    
                        echo $form->textField($model, 'property_name_or_address', array('class' => 'text anhdung_fix_enter'));
                    endif;
                 ?>
                <?php echo $form->error($model, 'property_name_or_address'); ?>
            </div>
            <?php if($model->isNewRecord  || $model->status_listing !=STATUS_LISTING_ACTIVE): ?>
			<div class="btn_action">
				<a href="<?php echo Yii::app()->createAbsoluteUrl('ajax/seachmap',array('q'=>'')) ?>"
				   data-fancybox-type="iframe" class="btn-4 search-map" 
					style="margin-left:3px;">Search</a>
				<a href="javascript:void(0)"
				   data-fancybox-type="iframe" class="btn-4 reset-map" 
					style="margin-left:3px;">Reset</a>
			</div>
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
                <?php /*echo CHtml::textField('text',$model->postal_code,array('id'=>'Listing_field','class'=>'text','disabled'=>true));*/ ?>
                <div id="postal-ajax">
                    <?php echo $form->dropDownlist($model,'postal_code',array(),array('empty'=>'----'))?>
                </div>
                <?php echo $form->hiddenField($model, 'postal_code_tmp'); ?>
                <?php echo $form->hiddenField($model, 'postal_code_xy'); ?>
                <?php echo $form->hiddenField($model, 'property_building_name'); ?>
                <div class="clear" style='clear: both;'></div>
                <?php echo $form->error($model, 'postal_code'); ?>
            </div>
            
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
        
        <div id="company_show" style="<?php echo ($model->listing_type_transaction == 2 ) ? 'display: block;' : 'display: none;' ?> ">
            <?php include('_company.php') ?>
        </div>      
    </div>

    <?php echo $form->hiddenField($model,'company_listing_id'); ?>

    <?php include('basic_information_anhdung.php') ?>
    
    <div class="w-2 clearfix T_step_1_custom_btn ad_nb_recheck">
        <input type ='submit' name="save_exit" class='btn-3' value="Save & Exit" />
        <input type ='submit' name="next"  class='btn-3' value="Next" />
    </div>
</div>



<style>
    .search-map:hover {cursor: pointer;}    
</style>

<script>
	//Listing_property_name_or_address
    $('.reset-map').live('click',function(){
        $('#Listing_property_name_or_address').val('');
        $('#Listing_field').val('');
        $('#Listing_postal_code').html('<option>---</option>');
        $('#Listing_postal_code_tmp').val('');
    });
	
  function loadCurentPostalcode(){
      var data = $('#Listing_postal_code_tmp').val();
      $('#Listing_postal_code').html(data);
      $('#Listing_postal_code').val('<?php echo $model->postal_code ?>');
      $('#Listing_postal_code').trigger('click');
  }

    $(function() {        
          $('.search-map').click(function(e){
			  e.preventDefault();
               if($('#Listing_property_name_or_address').val()==''){
                   alert('Please enter postal code, address or property name');
               }else{
                       var link = $('.search-map').attr('href')+ $('#Listing_property_name_or_address').val();
                       $.fancybox({
                          fitToView:true,
                          width: 700,
                          height:550,
                          autoSize:false,scrolling : false,
                          title:"",
                          href : link,
                          titlePosition  : 'Result Search',

                          fitToView:true,
                           type: 'iframe',
                          helpers: { overlay : {
                                  closeClick : false, 
                              }
                          },  
                           beforeLoad: function(){
                                   var a = $('.fancybox-skin iframe').contents().find('#address').trigger('change',function(){
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
        })    

       <?php if($model->postal_code_tmp !=''): ?> 
       loadCurentPostalcode();
       <?php  endif;?>     
    });
    
    // ANH DUNG Sep 18, 2014 - move to verz.js 03 Nov, 2014
//    function fnInitInputCurrency() {
//        $(".ad_fix_currency").each(function(){
//            $(this).autoNumeric('init', {lZero:"deny", aPad: false} ); 
//        });    
//    }
    
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
