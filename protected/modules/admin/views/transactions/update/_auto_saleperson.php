<div class="row">
    <?php echo $form->labelEx($mTransactions,'user_id'); ?>
    <?php echo $form->hiddenField($mTransactions,'user_id'); ?>
    <div class="">
    <?php 
        // ANH DUNG Apr 03, 2014 widget auto complete search user customer and supplier
    $url = Yii::app()->createAbsoluteUrl('ajax/search_agent_tier');
    if(isset($_GET['id'])){
        $url = Yii::app()->createAbsoluteUrl('ajax/search_agent_tier',array('id'=>$_GET['id']));
    }
        $aData = array(
            'model'=>$mTransactions,
            'name_relation_user'=>'rUser',
            'field_customer_id'=>'user_id',
            'placeHolder'=>'Type name of saleperson',
            'divClosest'=>'unique_wrap_autocomplete',
//            'ReadonlyFalseForTier'=>1,// remove readonly for input search
            'CallFunctionTier'=>1,
            'NotShowTableInfo'=>1,
            'TriggerReadonlyInput'=>1,
            'FunctionRemoveUid'=> "fnAfterRemoveName",
            'url'=> $url,
        );
        $this->widget('ext.ProAutocompleteUser_v2.ProAutocompleteUserV2',
            array('data'=>$aData));

    ?>
    <?php echo $form->error($mTransactions,'user_id'); ?>
    </div>
</div>

<script>
function fnBuildTrInfoTier(item, idField){
    <?php
        $id = isset($_GET['id'])?$_GET['id']:'';
        $type = ProTransactions::FOR_RENT;
        $add_property = isset($_GET['add_property'])?$_GET['add_property']: ProTransactions::ADD_EXISTING;
    ?>
    var user_id = item.id;
    var url_ = '<?php echo Yii::app()->createAbsoluteUrl($mapControllerAction,array('add_property'=>$add_property,'id'=>$id, 'type'=>$type, 'listing_id'=> $mTransactions->listing_id));?>/user_id/'+user_id;
    
    $.blockUI({ message: null });
    window.location = url_;    
}

function fnAfterRemoveName(){
    $('.need_select_saleperson').remove();
}

</script>