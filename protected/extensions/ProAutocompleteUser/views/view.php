<?php 
/**
 * @Author: ANH DUNG Apr 03, 2014
 * @Todo: render autocomplete widget and call some fuction after select
 */
?>
<div class="unique_wrap_autocomplete">
<?php 
if(!isset($data['url']))
    $data['url'] = Yii::app()->createAbsoluteUrl('ajax/search_user');
if(!isset($data['field_autocomplete_name']))
    $data['field_autocomplete_name'] = 'autocomplete_user_name';
$data['class_name'] = get_class($data['model']);
$idField = "#".$data['class_name']."_".$data['field_autocomplete_name'];

if(!isset($data['field_customer_id']))
    $data['field_customer_id'] = 'user_id';
$idFieldCustomerID = "#".$data['class_name']."_".$data['field_customer_id'];
$placeHolder = 'Type Name Of Salespersons';
if(isset($data['placeHolder']))
    $placeHolder = $data['placeHolder'];
$divClosest = 'group-4';
if(isset($data['divClosest']))
    $divClosest = $data['divClosest'];

$ShowNoDataFound = 1;
if(isset($data['ShowNoDataFound']))
    $ShowNoDataFound = $data['ShowNoDataFound'];

$CustomClass = '';
if(isset($data['CustomClass']))
    $CustomClass = $data['CustomClass'];

$width = 'width:250px';
if(isset($data['width']))
    $width = $data['width'];

$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'attribute'=>$data['field_autocomplete_name'],
        'model'=>$data['model'],
        'sourceUrl'=>$data['url'],
        'options'=>array(
                'minLength'=>MIN_LENGTH_AUTOCOMPLETE,
                'multiple'=> true,
        'search'=>"js:function( event, ui ) {
                $('$idField').addClass('grid-view-loading-gas');
                } ",
        'response'=>"js:function( event, ui ) {
                var json = $.map(ui, function (value, key) { return value; });
                if(json.length<1){
                    var error = '<div class=\'clr autocomplete_name_text\'>No data found.</div>';
                    if($('.autocomplete_name_text').size()<1 && $ShowNoDataFound)
                        //$('.autocomplete_name_error').closest('div.$divClosest').after(error);
                        $('.autocomplete_name_error').closest('div.$divClosest').append(error);
                    else
                        $('.autocomplete_name_error').closest('div.$divClosest').parent('div').find('.autocomplete_name_text').show();                                                    
                    $('.autocomplete_name_error').parent('div').find('.remove_row_item').hide();                                                    
                }
                $('$idField').removeClass('grid-view-loading-gas');
                } ",

            'select'=>"js:function(event, ui) {
                    $('$idFieldCustomerID').val(ui.item.id);
                    var remove_div = '<span class=\'remove_row_item\' onclick=\'fnRemoveName(this, \"$idField\", \"$idFieldCustomerID\")\'></span>';
                    $('$idField').parent('div').find('.remove_row_item').remove();
                    $('$idField').attr('readonly',true).after(remove_div);
                    fnBuildTableInfo(ui.item);
                    fnShowTableInfo(ui.item, \"$idField\");
                    fnCallSomeFunction(ui.item, \"$idField\");
                    $('.autocomplete_name_error').closest('div.$divClosest').parent('div').find('.autocomplete_name_text').hide();
            }",
        ),
        'htmlOptions'=>array(
            'class'=>"autocomplete_name_error text $CustomClass",            
            'style'=>"float:left;$width",
            'placeholder'=>$placeHolder,
        ),
)); 

$display='display: none;';

$info_name ='';
$info_code ='';
$info_address ='';
$info_phone ='';
$cmsFormat = new CmsFormatter();
if(($data['model']->$data['name_relation_user'])){
    $display='display:inline;';
    $info_name = $cmsFormat->formatFullNameRegisteredUsers($data['model']->$data['name_relation_user']);
    $info_address = $data['model']->$data['name_relation_user']->nric_passportno_roc;
} 

?> 
<div class="clr"></div> 
<?php if(!isset($data['NotShowTableInfo'])):?>
<div class="autocomplete_customer_info" style="<?php echo $display;?>">
    <table>
        <tr>
            <td class="_l">Name:</td>
            <td class="_r info_name"><?php echo $info_name;?></td>
        </tr>                    
        <tr>
            <td class="_l">NRIC:</td>
            <td class="_r info_address"><?php echo $info_address;?></td>
        </tr>

    </table>
</div>
<div class="clr"></div>
<?php endif;?>

</div>

<style>
    .autocomplete_name_text { color: #FF0000;}
</style>

<script>
    $(function(){
        // trigger readonly + show close icon 
        <?php if(($data['model']->$data['name_relation_user']) && isset($data['TriggerReadonlyInput']) ) :?>
            var remove_div = '<span class=\'remove_row_item\' onclick=\'fnRemoveName(this, \"<?php echo $idField;?>\", \"<?php echo $idFieldCustomerID;?>\")\'></span>';
            $('<?php echo $idField;?>').val('<?php echo $info_name;?>').attr('readonly',true).after(remove_div);
        <?php endif;?>
    });
    
    function fnRemoveName(this_, idField, idFieldCustomer){        
        $(this_).closest('div.unique_wrap_autocomplete').find('input').attr("readonly",false);                                     
        $(idField).val("");
        $(idFieldCustomer).val("");
        $('.autocomplete_customer_info').hide();
        
        <?php if(isset($data['FunctionRemoveUid'])):?>
            <?php echo $data['FunctionRemoveUid'];?>(this_, idField, idFieldCustomer);
        <?php endif;?>

    }
    function fnBuildTableInfo(item){
        $(".info_name").text(item.full_name);
        $(".info_address").text(item.nric_passportno_roc);
    }
    
    function fnShowTableInfo(item, idField){
        <?php if(isset($data['NotShowTableInfo'])):?>
                $('.autocomplete_customer_info').hide();
        <?php else:?>
            $('.autocomplete_customer_info').show();
        <?php endif;?>
            
        // dùng cho tạo agent trong BE - remove readonly for input search
        <?php if(isset($data['ReadonlyFalseForTier'])):?>
            $(idField).attr("readonly",false); 
        <?php endif;?>
        // dùng cho tạo agent trong BE - remove readonly for input search
            
        <?php if(isset($data['CallFunctionTier'])):?>
            
        <?php endif;?>            
    }
    
    // dùng để gọi 1 số hàm ở bên ngoài truyền vào
    function fnCallSomeFunction(item, idField){
        <?php if(isset($data['CallFunctionTier'])):?>
            fnBuildTrInfoTier(item, idField);
        <?php endif;?>  
            
        <?php if(isset($data['CallFunctionLandLord'])):?>
            <?php echo $data['CallFunctionLandLord'];?>(item, idField);
        <?php endif;?>
            
    }
    
</script>
