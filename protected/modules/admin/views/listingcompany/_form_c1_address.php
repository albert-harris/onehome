<div class="row">
    <?php echo $form->labelEx($model, 'property_name_or_address', array('class' => 'lb-1')); ?>
    <div class="group-1 add-search f-left w-290">
        <?php
        if (!$model->isNewRecord && $model->status_listing == STATUS_LISTING_ACTIVE):
            echo $form->textField($model, 'property_name_or_address', array('class' => 'w-245', 'disabled' => true));
        else:
            echo $form->textField($model, 'property_name_or_address', array('class' => 'w-245 anhdung_fix_enter'));
        endif;
        ?>               
        <div class="clear" style='clear: both;'></div>
        <?php echo $form->error($model, 'property_name_or_address', array('style'=>'margin-left:0;')); ?>
    </div>
    
    <?php // if ($model->isNewRecord || $model->status_listing != STATUS_LISTING_ACTIVE): ?>
        <img title ="Search Property Name Or Address" style="margin-right: 5px;" class="search-map f-left" data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/seachmap', array('q' => '')) ?>" alt="search map" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/search_map.png"  />
        <img title ="Reset Property Name Or Address" class="reset-map  f-left" data-fancybox-type="iframe" href="#" alt="reset map" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/undo.png"  />
    <?php // endif; ?>
    
</div>

<div class="row clearfix">
    <?php echo $form->labelEx($model, 'display_title', array('class' => 'lb-1')); ?>
    <div class="group-1">
        <?php echo $form->textField($model, 'display_title', array('class' => 'w-245')); ?>
        <div class="clear" style='clear: both;'></div>
        <?php echo $form->error($model, 'display_title'); ?>
    </div>
</div>

<div class="row clearfix">
    <?php echo $form->labelEx($model, 'display_address', array('class' => 'lb-1')); ?>
    <div class="group-1">
        <?php echo $form->textField($model, 'display_address', array('class' => 'w-245')); ?>
        <div class="clear" style='clear: both;'></div>
        <?php echo $form->error($model, 'display_address'); ?>
    </div>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'postal_code', array('class' => 'lb-1')); ?>
    <div class="group-1">
        <?php /*echo CHtml::textField('text', $model->postal_code, array('id' => 'Listing_field', 'class' => 'text', 'disabled' => true));*/ ?>
        <?php /*echo $form->hiddenField($model, 'postal_code');*/ ?>
        <div id="postal-ajax">
            <?php echo $form->dropDownlist($model,'postal_code',array(),array('empty'=>'----','class'=>'w-250'))?>
        </div>
         <?php echo $form->hiddenField($model, 'postal_code_tmp'); ?>
        <?php echo $form->hiddenField($model, 'postal_code_xy'); ?>
        <div class="clear" style='clear: both;'></div>
        <?php echo $form->error($model, 'postal_code'); ?>
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

?>
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

    $(function() {
        //dtoan load postal code
       <?php if($model->postal_code_tmp !=''): ?> 
       loadCurentPostalcode();
       <?php  endif;?>           
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
    });
    
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