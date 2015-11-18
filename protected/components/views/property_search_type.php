<?php
$choosetype = isset($_GET['choosetype'])?$_GET['choosetype']:'';
$aChooseRadio = isset($_GET['property_type_code'])?$_GET['property_type_code']:array();
$aChooseRadio = is_array($aChooseRadio)?$aChooseRadio:array();
//$labelSelect = 'Select';
//if(isset($_GET['choosetype'])){
//    $labelSelect = isset(ProPropertyType::$ARR_TYPE_SEARCH[$_GET['choosetype']])?ProPropertyType::$ARR_TYPE_SEARCH[$_GET['choosetype']]:"Select";
//}

?>

<div class="choose-list" id="zonechoosetype">
    <div class="choosed-text">Any Type</div>
    <div class="sub-list">
        <ul class="clearfix">
            <?php foreach(ProPropertyType::$ARR_TYPE_SEARCH as $parent_id => $parent_text): ?>
            <li>
                <?php $ParentChecked = ''; 
                    if($choosetype==$parent_id){
                        $ParentChecked = 'checked="1"';
                    }
                ?>
                <input type="radio" name="choosetype" id="choose_<?php echo $parent_id;?>" value="<?php echo $parent_id;?>" <?php echo $ParentChecked;?> />
                <label class="parent_lb" for="choose_<?php echo $parent_id;?>"><?php echo $parent_text;?></label>
                <?php $aListSub = ProPropertyType::getListOptionByParent($parent_id);?>
                <?php if(count($aListSub)): ?>
                <ul id="choosetype<?php echo $parent_id;?>" class="">
                    <?php foreach($aListSub as $subId => $subName):?>
                    <?php $SubChecked = ''; 
                        if(in_array($subId, $aChooseRadio)){
                            $SubChecked = 'checked="1"';
                        }
                    ?>
                    <li><input <?php echo $SubChecked;?> type="checkbox" name="property_type_code[]" value="<?php echo $subId;?>" id="choose_<?php echo $subId;?>" /><label for="choose_<?php echo $subId;?>"><?php echo $subName;?></label></li>
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
</script>


<style>
</style>