<div class="in-row clearfix">
    <?php echo $form->labelEx($mTransactions, 'add_property', array('class'=>'lb')); ?>
    <div class="group-4 list-check-3 ">
    <!--<div class="group top_5">-->
        <?php                             
        echo $form->radioButtonList($mTransactions, 'add_property', ProTransactions::$ARR_ADD_PROPERTY,
                array(
                    'template'=>"<li>{input}{label}</li>",
                    'separator'=>'',
                    'container'=>'ul',
                    'class'=>'ad_select_add_property',
                )
                ); 
        ?>
    </div>
    <?php echo $form->error($mTransactions,'add_property'); ?>
</div>
                
<!-- begin auto complete select listing -->
<?php if(isset($_GET['add_property']) ):?>
    <div class="in-row clearfix">
        <?php 
            // to do: build link when click to radio button sale, rent FROM  all transaction list
            $transaction_id = isset($_GET['id'])?$_GET['id']:0;
            $listing_id = isset($_GET['listing_id'])?$_GET['listing_id']:0;
            $urlForExisting = Yii::app()->createAbsoluteUrl('member/member_profile/record_existing_tenancy',array(
                'id'=>$mTransactions->id, // id transaction
                'type'=> ProTransactions::FOR_RENT, // type rent, sale
                'listing_id'=> $listing_id, // id listing 
                'add_property'=> ProTransactions::ADD_EXISTING, // from all transaction list OR from listing

            ));
            $urlForUnlisted = Yii::app()->createAbsoluteUrl('member/member_profile/record_existing_tenancy',array(
                'id'=>$mTransactions->id, // id transaction
                'type'=> ProTransactions::FOR_RENT, // type rent, sale
                'listing_id'=> 0, // id listing 
                'add_property'=> ProTransactions::ADD_UNLISTED, // 
            ));
        ?>
    </div>
                    
    <?php if( $_GET['add_property'] == ProTransactions::ADD_EXISTING ):?>
    <div class="in-row clearfix">
        <?php echo $form->labelEx($mTransactions,'listing_id', array('class'=>'lb')); ?>
        <div class="group-4">
            <?php $readonly_auto=''; if(trim($mTransactions->listing_autocompelte!=''))$readonly_auto=1;?>
            <?php echo $form->hiddenField($mTransactions,'listing_id',array('class'=>'')); ?>
            <?php echo $form->textField($mTransactions,'listing_autocompelte',array('class'=>'text listing_autocomplete f-left','readonly'=>$readonly_auto, 'placeholder'=>'Type Listing name to search', 'style'=>'width:251px;')); ?>
            <span onclick="fnRemoveListingId()" class="remove_row_item" title="Remove listing selected"></span>
        </div>
        <?php echo $form->error($mTransactions,'listing_id'); ?>
    </div>
    <?php else: ?>
        <?php include "_box_property_detail_search_address.php";?>
    <?php endif; // end if( $_GET['add_property'] == ProTransactions::ADD_EXISTING ) ?>

<?php endif; // end if(isset($_GET['add_property']) ?>
<!-- end for auto complete select listing --> 

<script>
    $(function(){
        // Dec 02, 2014 for select existing or unlisted
        $('.ad_select_add_property:first').attr('next', '<?php echo $urlForExisting;?>');
        $('.ad_select_add_property:last').attr('next', '<?php echo $urlForUnlisted;?>');
        $('.ad_select_add_property').click(function(){
            if($(this).val() != <?php echo $_GET['add_property'];?>)
            {
                $.blockUI({ message: null });
                window.location = $(this).attr('next');
            }
        });// end $('.ad_select_add_property').click
        // Dec 02, 2014 for select existing or unlisted

        $( ".listing_autocomplete" ).autocomplete({
            source: '<?php echo Yii::app()->createAbsoluteUrl('ajax/searchListing');?>',
            close: function( event, ui ) {  },
            select: function( event, ui ) {
                $.blockUI({ message: null });
                fnBuildRowItem(event, ui); 
            }
        });   
    });

    function fnBuildRowItem(event, ui){
        <?php
            $id = isset($_GET['id'])?$_GET['id']:'';
            $type = ProTransactions::FOR_RENT;
            $add_property = isset($_GET['add_property'])?$_GET['add_property']: ProTransactions::ADD_EXISTING;
        ?>
        var requestUri = '<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/record_existing_tenancy',array('id'=>$id, 'type'=>$type,'add_property'=>$add_property));?>/listing_id/'+ui.item.id;
        window.location = requestUri;
        return;// Dec 01, 2014
        $.ajax({
            url:requestUri,
            type:'post',
            dataType:'json',
            data:{listing_id:ui.item.id},
            success:function(data){
                window.location = data['next'];
            }
        });
    }

    function fnRemoveListingId(){
        $('#ProTransactions_listing_id').val('');
        $('.listing_autocomplete').val('').attr('readonly',false);
    }
</script>