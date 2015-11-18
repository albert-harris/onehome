<?php
$choosetype = isset($_GET['choosetype'])?$_GET['choosetype']:'';
$aChooseRadio = isset($_GET['property_type_code'])?$_GET['property_type_code']:array();
$aChooseRadio = is_array($aChooseRadio)?$aChooseRadio:array();
?>
<div class="choose-list" id="zonechoosetype_quick">
    <div class="choosed-text">Select</div>
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
    
    function fnRadioCheck(this_){ // this_ là radio check
        var parentLi = this_.closest('li');
        var SubUl = parentLi.find('ul').eq(0);
        var label = parentLi.find('.parent_lb').text();
        var zonechoosetype_quick = this_.closest('.choose-list');
        var CheckAll = true;
        SubUl.find('input:checkbox').each(function(){
            if($(this).is(':checked')){
                CheckAll = false;
                return false;
            }
        });
        
        if(CheckAll){
            SubUl.find('input:checkbox').attr('checked', true);
            zonechoosetype_quick.find('.choosed-text').html(label);
        }
    }
    
    
    $(document).mouseup(function (e)
    {
        var container = $("#zonechoosetype_quick");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            container.find(".sub-list").hide();
        }
    });
</script>

