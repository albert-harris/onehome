<div class="in-row clearfix">
    <?php // ANH DUNG FIX - MAR 26, 2015
        $VerzFixLablel = $mTransactions->mPropertyDetail->getAttributeLabel('property_name_or_address') .'<span class="required"> *</span> :';
        echo $form->labelEx($mTransactions->mPropertyDetail,'property_name_or_address', array('class'=>'lb', 'label'=>$VerzFixLablel)); ?>
    <div class="group-4">
        <?php echo $form->textField($mTransactions->mPropertyDetail,'property_name_or_address',array('class'=>'w-220 anhdung_fix_enter text f-left ad_property_name_or_address', 'placeholder'=>'Type Listing name to search', 'style'=>'')); ?>
        <img title ="Search Property Name Or Address" style="margin-right: 5px;" class="search-map f-left" data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/seachmap', array('q' => '')) ?>" alt="search map" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/search_map.png"  />
        <img title ="Reset Property Name Or Address" class="reset-map  f-left" data-fancybox-type="iframe" href="#" alt="reset map" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/undo.png"  />
    </div>
    <?php echo $form->error($mTransactions->mPropertyDetail,'property_name_or_address'); ?>
</div>


<!--<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fancybox_css.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fancybox.js"></script>-->
<?php
//Yii::app()->clientScript->registerScript('click reset', "
//    $('.T_btn_reset').click(function() {
//        $('.T_form-type-step1 input, .T_form-type-step1 select').val('');
//        $('.T_form-type-step1 select').trigger('change');
//    });
//");
?>

<script>    
    $('.reset-map').live('click',function(){
        $('#ProTransactionsPropertyDetail_property_name_or_address').val('');
        $('#ProTransactionsPropertyDetail_field').val('');
        $('#ProTransactionsPropertyDetail_postal_code').html('<option>---</option>');
        $('#ProTransactionsPropertyDetail_postal_code_tmp').val('');
    });

    //ProTransactionsPropertyDetail_property_name_or_address
      function loadCurentPostalcode(){
          return ;// Dec 01, 2014 chac khong dung ham nay
//          var data = $('#ProTransactionsPropertyDetail_postal_code_tmp').val();
//          $('#ProTransactionsPropertyDetail_postal_code').html(data);
//          $('#ProTransactionsPropertyDetail_postal_code').val('<?php // echo $model->postal_code ?>');
//          $('#ProTransactionsPropertyDetail_postal_code').trigger('click');
      }    

    $(function() {
        //dtoan load postal code
       <?php /* Dec 01, 2014 if($model->postal_code_tmp !=''): ?> 
       loadCurentPostalcode();
       <?php  endif;*/ ?>           
        $('.search-map').click(function() {
            if ($('#ProTransactionsPropertyDetail_property_name_or_address').val() == '') {
                alert('Please enter postal code, address or property name');
            } else {
                var link = $('.search-map').attr('href') + $('#ProTransactionsPropertyDetail_property_name_or_address').val();
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

//        $('.T_btn_reset').click(function() {
//            $('.T_form-type-step1 input, .T_form-type-step1 select').val("");
//            $('.T_form-type-step1 select').trigger('change');
//        });
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