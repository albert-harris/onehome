<?phpYii::app()->clientScript->registerScriptFile(	Yii::app()->theme->baseUrl.'/js/jquery.form.js', CClientScript::POS_END);Yii::app()->clientScript->registerScript('engage-us', 'app.setupEngageUsForm();', CClientScript::POS_LOAD);?><div class="form-group WrapEngageUs">	<label class="control-label" for="">I want to</label>	<div>		<label class="radio-inline">		  <input type="radio" ad_fix="for_sale" class="ad_fix_enquiry" name="engage" id="buy" value="Buy" checked> Buy		</label>		<label class="radio-inline">		  <input type="radio" ad_fix="for_sale" class="ad_fix_enquiry" name="engage" id="sell" value="Sell"> Sell		</label>		<label class="radio-inline">		  <input type="radio" ad_fix="for_rent" class="ad_fix_enquiry" name="engage" id="rent2" value="Rent"> Rent		</label>	</div></div><?php require( Yii::getPathOfAlias('application.components.views') .'/_tab_enquiry_home/_buy.php');require( Yii::getPathOfAlias('application.components.views') .'/_tab_enquiry_home/_sell.php');require( Yii::getPathOfAlias('application.components.views') .'/_tab_enquiry_home/_rent.php');?><style>    .box-search{padding: 0;}    .title_engage{padding-left: 6px;}    .txt-area{padding-left: 15px; padding-right: 15px;}</style><script type="text/javascript">    // Jun 07, 2014 ANH DUNG     $(function(){        fnBindRemoveGlobalFile();        $('.file_name').change(function(){            parent_div = $(this).closest('div.box_file');            parent_form = $(this).closest('form');            var url_ = '<?php echo Yii::app()->createAbsoluteUrl('enquiry/ajaxFileGlobal')?>';            parent_form.ajaxSubmit({                dataType: 'json',                type: 'post',                data: {},                url: url_,                beforeSend:function(data){                },                success: function(data)                {                    if(data['code']){                                                fnBuilRowFile(parent_div, data['file_name'], data['message']);                        parent_div.find('input:file').val('');                    }else{                        alert(data['message']);                    }                }            });// end parent_form.ajaxSubmit({        });// end $('.file_name').change(function(){    });// end $(function()    function fnBuilRowFile(parent_div, file_name, file_id){        var tr = '';        tr +='<tr>';            tr +='<td>'+file_name;                tr +='<input type="hidden" name="ProGlobalEnquiry[file_id][]" value="'+file_id+'">';            tr +='</td>';            tr +='<td class="item_c w-20"><span class="remove_global_file"></span></td>';        tr +='</tr>';        var size = parent_div.find('table tr').size();        if(size<10)            parent_div.find('table').append(tr);    }    function fnBindRemoveGlobalFile(){        $('.remove_global_file').on('click', function(){            if(confirm('Are you sure delete this item?')){                $(this).closest('tr').remove();            }        });    }    // ANH DUNG NOW, 12, 2014    function fnBindSelectTypeEnquiry(){        // chua dung den doan nay vi 2 cai select price la 2 form doc lap         return ;         $('.ad_fix_enquiry').click(function(){             var selected = $(this).attr('ad_fix');             var new_html_select = $('.price_sale_hide_'+selected).html();             var form = $(this).closest('div.WrapEngageUs');             //minimum_price maximum_price             var minimum_price = form.find('.minimum_price');             var maximum_price = form.find('.maximum_price');             minimum_price.html(new_html_select);             maximum_price.html(new_html_select);             maximum_price.find('option').eq(0).text('Maximum');             minimum_price.trigger('click');             maximum_price.trigger('click');             fnShowHideTenure(); // fix Aug 11, 2014         });     }     // ANH DUNG NOW, 12, 2014</script>