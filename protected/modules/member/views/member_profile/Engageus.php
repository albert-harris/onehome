<!--  main inner -->
<div class="main-inner">
    <?php $this->widget('AdBreadcrumb'); ?>
    <?php //include 'myshortlist_form.php';?>
    <?php $this->widget('GlobalEnquiry'); ?>
</div><!--  main inner -->
<!--  aside -->
<?php $this->widget('AdSidebar'); ?>
<?php
$choosetype = isset($_GET['choosetype'])?$_GET['choosetype']:'';
$aChooseRadio = isset($_GET['property_type_code'])?$_GET['property_type_code']:array();
$aChooseRadio = is_array($aChooseRadio)?$aChooseRadio:array();
?>

<script>
    $(window).load(function(){
        <?php if(isset($_GET['choosetype'])): ?>
            var firstCheckbox = $('#choosetype<?php echo $_GET['choosetype'];?>').find('input:checkbox:first');
            // console.log(firstCheckbox); chỗ này sử dụng sự kiện click của check box trong mỗi (ul) radio
            // vì khi click vào radio nó thay đổi text select ở trên( thêm dấu + )
           // còn biến radio hay checkbox dc php xử lý check rồi
            var attCheckbox = firstCheckbox.attr('checked');    
            firstCheckbox.trigger('click');            
            if(attCheckbox=='checked'){
                firstCheckbox.attr('checked',true);
            }else{
                firstCheckbox.attr('checked',false);
            }
                
        <?php endif;?>
        
    });        
    
    $(function(){
        $('.choose-list').each(function(){
            $(this).find(".choosed-text").click(function(e){
                $(this).next().slideToggle();
                fnCheckIsReadyOpen();
            });
        });

        $("input[name='choosetype']").click(function(){ //    $("input[name='choosetype']").change(function(){
    //        var number = $("input[name='choosetype']:checked").val(); 
            var number = $(this).val();
//                current = "#choosetype" + number;
                current = $(this).closest('li').find('ul:first');
                $(current).slideToggle();
                fnRadioCheck($(this));
                fnHideRadioNotCheck(); // $(current).slideDown();            
        });
    }); // end $(function(){
    
    function fnCheckIsReadyOpen(){
        $("input[name='choosetype']").each(function(){
            if($(this).is(':checked')){
                var parentLi = $(this).closest('li');
                if(parentLi.find('ul').eq(0).css('display')!='block'){
                    $(this).trigger('click');
                    return false;
                }
            }
        });
    }
    
    function fnHideRadioNotCheck(){
        $('.choose-list input:radio').each(function(){
            if(!$(this).is(':checked')){
                var parentLi = $(this).closest('li');
                if(parentLi.find('ul').eq(0).css('display')=='block'){
                    parentLi.find('ul').eq(0).slideToggle();
                    fnRadioUnCheck($(this));
                }
            }
        });
    }
    
    function fnBindChangeBedRoom(){
        $('#minimum_bedroom').change(function(){
            var minimum_bedroom = $('#minimum_bedroom').val()*1;
            var maximum_bedroom = $('#maximum_bedroom').val()*1;
            if(minimum_bedroom>maximum_bedroom){
                $('#maximum_bedroom').val(minimum_bedroom);
                $('#maximum_bedroom').trigger('change');
            }
        });
                
        $('#maximum_bedroom').change(function(){
            var minimum_bedroom = $('#minimum_bedroom').val()*1;
            var maximum_bedroom = $('#maximum_bedroom').val()*1;
            if(minimum_bedroom>maximum_bedroom){
                $('#minimum_bedroom').val(maximum_bedroom);
                $('#minimum_bedroom').trigger('change');
            }
        });        
     }
     
     /** Jun 02, 2014 ANH DUNG. To do bind change select alway min <= max
      * @param {string} MaxId '#minimum_price'
      * @param {string} MaxId '#maximum_price'
      */
     function fnBindChangeMinMax(MinId, MaxId){
        $(MinId).change(function(){
            var minimum_bedroom = $(MinId).val()*1;
            var maximum_bedroom = $(MaxId).val()*1;
            if(minimum_bedroom>maximum_bedroom){
                $(MaxId).val(minimum_bedroom);
                $(MaxId).trigger('change');
            }
        });
                
        $(MaxId).change(function(){
            var minimum_bedroom = $(MinId).val()*1;
            var maximum_bedroom = $(MaxId).val()*1;
            if(minimum_bedroom>maximum_bedroom){
                $(MinId).val(maximum_bedroom);
                $(MinId).trigger('change');
            }
        });        
     }
     
     function fnBindSelectType(){
         $('.select_type').click(function(){
             var selected = $(this).val();
             var new_html_select = $('.price_sale_hide_'+selected).html();
             var form = $(this).closest('form');
             //minimum_price maximum_price
             var minimum_price = form.find('.minimum_price');
             var maximum_price = form.find('.maximum_price');
             minimum_price.html(new_html_select);
             maximum_price.html(new_html_select);
             maximum_price.find('option').eq(0).text('Maximum');
             
             minimum_price.trigger('click');
             maximum_price.trigger('click');
             fnShowHideTenure(); // fix Aug 11, 2014
         });
     }
     
     function fnShowHideTenure(){
         $('.select_type').each(function(){
             var selected = $(this).val();             
             $('.div_furnished_tenure').find('select').val('').trigger('click');
             if($(this).is(':checked')){
                 $('.div_furnished_tenure_'+selected).show();
             }else{
                 $('.div_furnished_tenure_'+selected).hide();
             }
         });
     }






    function fnRadioCheck(this_){ // this_ là radio check
        var parentLi = this_.closest('li');
        var SubUl = parentLi.find('ul').eq(0);
        var label = parentLi.find('.parent_lb').text()
        var zonechoosetype = this_.closest('.choose-list');
        var CheckAll = true;
        SubUl.find('input:checkbox').each(function(){
            if($(this).is(':checked')){
                CheckAll = false;
                return false;
            }
        });
        
        if(CheckAll){
            SubUl.find('input:checkbox').attr('checked', true);
            zonechoosetype.find('.choosed-text').html(label);
        }
    }
    
    function fnRadioUnCheck(this_){
        var parentLi = this_.closest('li');
        var SubUl = parentLi.find('ul').eq(0);
        SubUl.find('input:checkbox').attr('checked', false);
    }
    
    function fnCheckBoxClick(){
        $('.choose-list').each(function(){
            var div_wrap_type = $(this);
            $(this).find('input:checkbox').click(function(){
                var addPlus = false;
                var parentUl = $(this).closest('ul');
                var parentLi = parentUl.closest('li');
                parentUl.find('input:checkbox').each(function(){
                    if(!$(this).is(':checked')){
                        addPlus = true;
                        return false;
                    }
                });
                var label = parentLi.find('.parent_lb').text();
                if(addPlus){
                    label = label+' +';
                }
                div_wrap_type.find('.choosed-text').html(label);
            });
        }); // end $('.choose-list').each(function(){
    }
    
    $(document).mouseup(function (e)
    {
        var container = $("#zonechoosetype");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            container.find(".sub-list").hide();
        }
    });

        $('.multiselect_location').multiselect({
              maxHeight:200,
              buttonWidth: '225px',
              numberDisplayed: 0,
              checkboxName: 'location[]'
          });
        $('.multiselect_location_buy').multiselect({
              maxHeight:200,
              buttonWidth: '225px',
              numberDisplayed: 0
//              checkboxName: 'location[]'
          });
        $('.multiselect_location_rent').multiselect({
              maxHeight:200,
              buttonWidth: '225px',
              numberDisplayed: 0
//              checkboxName: 'location[]'
          });

          fnBindChangeMinMax('#minimum_price', '#maximum_price');
          fnBindChangeMinMax('#minimum_floor', '#maximum_floor');
          fnBindChangeMinMax('#minimum_price_engage', '#maximum_price_engage');
          fnBindChangeMinMax('#minimum_price_engage_rent', '#maximum_price_engage_rent');          
          fnBindChangeMinMax('#minimum_bedroom_engage', '#maximum_bedroom_engage');
          fnBindChangeMinMax('#minimum_bedroom_engage_rent', '#maximum_bedroom_engage_rent');
          fnBindChangeMinMax('#minimum_floor_engage', '#maximum_floor_engage');
          fnBindChangeMinMax('#minimum_floor_engage_rent', '#maximum_floor_engage_rent');

     $(window).load(function(){
        $('.wrap_multiselect_location').show();
        $('.wrap_multiselect_hide').show();
        fnShowHideTenure();
     });
</script>
 <!-- model content -->
 	<?php //  ANH DUNG CLOSE JAN 09, 2015
        // $pageTerm = Pages::model()->findByPk(PAGE_TERMS_CONDITION);?>
<!--    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">&times;</a>
                    <h3><?php if(isset($pageTerm->title)) echo $pageTerm->title; ?></h3>
                </div>
                <div class="modal-body" style="height: 500px;overflow-y: scroll;">
                        <?php if(isset($pageTerm->content)) echo $pageTerm->content; ?>
                </div>
            </div>

        </div>
    </div>-->
  <!-- end model content -->
 <script>
//    $('.click-tearm-condition').live('click',function(){
//        $('#myModal').modal('show');
//    })
 </script>