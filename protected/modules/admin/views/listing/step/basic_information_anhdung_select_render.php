<div class="display_none">
<?php 
$sr_parent = ProPropertyType::getListOptionParent(array('normal_select'=>1));
?>
<?php foreach($sr_parent as $parent_id=>$parent_name):?>
    <?php 
    
        echo ProPropertyType::getOptionSelectGroupByParent($parent_id, 
                 "ad_nb_replace_$parent_id", //$name, 
                "ad_nb_replace_$parent_id", //$id, 
                "", //$value,
                "Select", //$hasEmpty, 
                "ad_nb_replace_$parent_id" //$classSelect
                );
    ?>
    <?php // echo CHtml::dropDownList('maximum_bedroom', '', 1, array('empty' => 'Select', 'class'=>"sr_replace$parent_id")); ?>
<?php endforeach;?>
    
<!-- for dropdown list parent property type need add more attributes to option tag -->    
<?php $arrModelParentPro = ProPropertyType::getListOptionParent(array('model_only'=>1)); ?>
<?php foreach($arrModelParentPro as $item):?>
<span class="group_show_parent_<?php echo $item->id;?>"><?php echo $item->group_show; ?></span>
<?php endforeach;?>
<!-- for dropdown list parent property type need add more attributes to option tag -->    
    
</div>