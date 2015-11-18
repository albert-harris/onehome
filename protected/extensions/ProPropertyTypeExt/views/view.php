<?php 
/**
 * @Author: ANH DUNG Apr 03, 2014
 * @Todo: render autocomplete widget and call some fuction after select
 */
?>
<?php
$choosetype = '';
$ul_id = '';
$aChooseRadio = array();
if(isset($aData['select_all'])):
    $choosetype = ProPropertyType::SEARCH_ALL;
endif;

if(isset($aData['not_hompage'])):
    $choosetype = isset($_GET['choosetype'])?$_GET['choosetype']:ProPropertyType::SEARCH_ALL;
    $aChooseRadio = isset($_GET['property_type_code'])?$_GET['property_type_code']:array();
    $aChooseRadio = is_array($aChooseRadio)?$aChooseRadio:array();
endif;

$ul_id = $aData['radio_id'].$choosetype;
$className = get_class($aData['model']);

//$labelSelect = 'Select';
//if(isset($_GET['choosetype'])){
//    $labelSelect = isset(ProPropertyType::$ARR_TYPE_SEARCH[$_GET['choosetype']])?ProPropertyType::$ARR_TYPE_SEARCH[$_GET['choosetype']]:"Select";
//}

?>

<div class="choose-list" id="<?php echo $aData['zonechoosetype'];?>">
    <div class="choosed-text">Select</div>
    <div class="sub-list">
        <ul class="clearfix">
            <?php foreach(ProPropertyType::$ARR_TYPE_SEARCH as $parent_id => $parent_text): ?>
            <li>
                <?php $ParentChecked = ''; 
                    if($choosetype==$parent_id){
                        $ParentChecked = 'checked="checked"';
                    }
                ?>
                <input type="radio" name="choosetype" id="lb<?php echo $aData['radio_id'].$parent_id;?>" value="<?php echo $parent_id;?>" <?php echo $ParentChecked;?> />
                <label class="parent_lb" for="lb<?php echo $aData['radio_id'].$parent_id;?>"><?php echo $parent_text;?></label>
                <?php $aListSub = ProPropertyType::getListOptionByParent($parent_id);?>
                <?php if(count($aListSub)): ?>
                <!--<ul id="choosetype<?php // echo $parent_id;?>">-->
                <ul id="<?php echo $aData['radio_id'].$parent_id;?>">
                    <?php foreach($aListSub as $subId => $subName):?>
                    <?php $SubChecked = ''; 
                        if(in_array($subId, $aChooseRadio)){
                            $SubChecked = 'checked="checked"';
                        }
                    ?>
                    <li><input <?php echo $SubChecked;?> type="checkbox" name="property_type_code[]" value="<?php echo $subId;?>" id="<?php echo $aData['checkbox_id'].$subId;?>" /><label for="<?php echo $aData['checkbox_id'].$subId;?>"><?php echo $subName;?></label></li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </li>
            <?php endforeach;?>
        </ul>
        </div>
</div>
<script>
    $(window).load(function(){
        <?php if(isset($aData['search_var'])):?> // sử dụng trong search listing not hompage
                fnCheckBoxClick(); // sử dụng trong search listing not hompage
            <?php if(isset($_GET['choosetype'])): ?>
                var firstCheckbox = $('#<?php echo $ul_id;?>').find('input:checkbox:first');
                var attCheckbox = firstCheckbox.attr('checked');
                firstCheckbox.trigger('click');
                if(attCheckbox=='checked'){
                    firstCheckbox.attr('checked',true);
                }else{                    
                    firstCheckbox.attr('checked',false);
                }                
            <?php endif;?>                
        <?php endif;?>            
            
        <?php if(isset($aData['select_all'])):?>
            // chỗ này xử lý trigger click cho radio
            $('#<?php echo $aData['zonechoosetype'];?>').find('input:radio').each(function(){
                var attRadioSelect = $(this).attr('checked');    
                if(attRadioSelect=='checked'){
                    $(this).trigger('click');                    
                }
            });
        <?php endif;?>        
    });        
    
    $(function(){    
        <?php if(isset($aData['not_hompage'])):?> // dùng để đăng ký cho những chỗ khác ngoài homepage những sự kiện của element
            $('.choose-list').each(function(){
                $(this).find(".choosed-text").click(function(e){
                    $(this).next().slideToggle();
                    fnCheckIsReadyOpen();
                });
            });

        $("input[name='choosetype']").click(function(){ //    $("input[name='choosetype']").change(function(){
    //        var number = $("input[name='choosetype']:checked").val(); 
            var number = $(this).val();
                current = $(this).closest('li').find('ul:first');
                $(current).slideToggle();
                fnRadioCheck($(this));
                fnHideRadioNotCheck(); // $(current).slideDown();            
        });
        <?php endif;?>
    }); // end $(function(){
    
    
    <?php if(isset($aData['not_hompage'])):?>
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

        function fnRadioCheck(this_){
            var parentLi = this_.closest('li');
            var SubUl = parentLi.find('ul').eq(0);
            var label = parentLi.find('.parent_lb').text()
//            var zonechoosetype = this_.closest('#<?php echo $aData['zonechoosetype'];?>');
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
            
            
//            $('#<?php echo $aData['zonechoosetype'];?>').find('input:checkbox').click(function(){
//                var addPlus = false;
//                var parentUl = $(this).closest('ul');
//                var parentLi = parentUl.closest('li');
//                parentUl.find('input:checkbox').each(function(){
//                    if(!$(this).is(':checked')){
//                        addPlus = true;
//                        return false;
//                    }
//                });
//                var label = parentLi.find('.parent_lb').text();
//                if(addPlus){
//                    label = label+' +';
//                }
//                $('#<?php echo $aData['zonechoosetype'];?>').find('.choosed-text').html(label);            
//            });
        }
        
        <?php endif;?>
    
    $(document).mouseup(function (e)
    {
        var container = $("#<?php echo $aData['zonechoosetype'];?>");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            container.find(".sub-list").hide();
        }
    });
</script>


<style>
</style>