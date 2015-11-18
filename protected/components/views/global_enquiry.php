<div class="box-1">
    <div class="title"><h3>Engage Us</h3></div>
        <div class="content box-search WrapEngageUs">

        <label class="lb">I want to...</label>
        <ul class="list-check clearfix" style="margin-left:10px;">
            <li><input ad_fix="for_sale" class="ad_fix_enquiry" type="radio" name="engage" id="buy" value="Buy" checked /><label for="buy">Buy</label></li>
            <li><input ad_fix="for_sale" class="" type="radio" name="engage" id="sell" value="Sell" /><label for="sell">Sell</label></li>
            <li><input ad_fix="for_rent" class="ad_fix_enquiry" type="radio" name="engage" id="rent2" value="Rent" /><label for="rent2">Rent</label></li>
        </ul>
      
        <?php 
              require( Yii::getPathOfAlias('application.components.views') .'/_tab_enquiry/_buy.php');
              require( Yii::getPathOfAlias('application.components.views') .'/_tab_enquiry/_sell.php');
              require( Yii::getPathOfAlias('application.components.views') .'/_tab_enquiry/_rent.php');
        ?>

        </div>
</div>

<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.form.js"></script>
<script type="text/javascript">

    $('.multiselect').multiselect({
        maxHeight:200,
        buttonWidth: '225px',
        numberDisplayed: 0,
        checkboxName: 'ProGlobalEnquiry[furnishing_include][]'
    });
    $('.multiselect-special').multiselect({
        maxHeight:200,
        buttonWidth: '225px',
        numberDisplayed: 0,
        checkboxName: 'ProGlobalEnquiry[special_features][]'
    });
    
    // Jun 07, 2014 ANH DUNG 
    $(function(){
        fnBindRemoveGlobalFile();
        $('.file_name').change(function(){
            parent_div = $(this).closest('div.box_file');
            parent_form = $(this).closest('form');
            var url_ = '<?php echo Yii::app()->createAbsoluteUrl('enquiry/ajaxFileGlobal')?>';
            
            parent_form.ajaxSubmit({
                dataType: 'json',
                type: 'post',
                data: {},
                url: url_,
                beforeSend:function(data){
                    $.blockUI({
                           message: '', 
                           overlayCSS:  { backgroundColor: '#fff' }
                   });
                },
                success: function(data)
                {
                    if(data['code']){                        
                        fnBuilRowFile(parent_div, data['file_name'], data['message']);
                        parent_div.find('input:file').val('');
                    }else{
                        alert(data['message']);
                    }
                    $.unblockUI();
                }
            });// end parent_form.ajaxSubmit({
            
        });// end $('.file_name').change(function(){
        
    });// end $(function()
    
    function fnBuilRowFile(parent_div, file_name, file_id){
        var tr = '';
        tr +='<tr>';
            tr +='<td>'+file_name;
                tr +='<input type="hidden" name="ProGlobalEnquiry[file_id][]" value="'+file_id+'">';
            tr +='</td>';
            tr +='<td class="item_c w-20"><span class="remove_global_file"></span></td>';
        tr +='</tr>';
        var size = parent_div.find('table tr').size();
        if(size<10)
            parent_div.find('table').append(tr);
    }
    
    function fnBindRemoveGlobalFile(){
        $('.remove_global_file').on('click', function(){
            if(confirm('Are you sure delete this item?')){
                $(this).closest('tr').remove();
            }
        });
    }
    
    // ANH DUNG NOW, 12, 2014
    function fnBindSelectTypeEnquiry(){
        // chua dung den doan nay vi 2 cai select price la 2 form doc lap 
        return ;
         $('.ad_fix_enquiry').click(function(){
             var selected = $(this).attr('ad_fix');
             var new_html_select = $('.price_sale_hide_'+selected).html();
             var form = $(this).closest('div.WrapEngageUs');
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
     
     
     // ANH DUNG NOW, 12, 2014
    
</script>
 