<!-- begin for  from all transaction list -->
<div class="in-row clearfix ad_fix_radio_p_detail">
    <?php
        
        // to do: build link when click to radio button sale, rent FROM  all transaction list
        $transaction_id = isset($_GET['id'])?$_GET['id']:0;
        $listing_id = isset($_GET['listing_id'])?$_GET['listing_id']:0;
        $add_property = isset($_GET['add_property'])?$_GET['add_property']:ProTransactions::ADD_EXISTING;
        $sale_or_rent = isset($_GET['type'])?$_GET['type']:ProTransactions::FOR_RENT;

        $urlForSale = Yii::app()->createAbsoluteUrl($mapControllerAction,array(
            'add_property'=> $add_property, // id listing 
            'id'=>$mTransactions->id, // id transaction
            'type'=> ProTransactions::FOR_SALE, // type rent, sale
            'listing_id'=> $listing_id, // id listing 
            'user_id'=> $mTransactions->user_id,
            'list'=> 'transaction', // from all transaction list OR from listing

        ));
        $urlForRent = Yii::app()->createAbsoluteUrl($mapControllerAction,array(
            'add_property'=> $add_property, // id listing 
            'id'=>$mTransactions->id, // id transaction
            'type'=> ProTransactions::FOR_RENT, // type rent, sale
            'listing_id'=> $listing_id, // id listing 
            'user_id'=> $mTransactions->user_id,
            'list'=> 'transaction', // from all transaction list OR from listing

        ));

        // Dec 02, 2014
        $urlForExisting = Yii::app()->createAbsoluteUrl($mapControllerAction,array(
            'add_property'=> ProTransactions::ADD_EXISTING, // id listing 
            'id'=>$mTransactions->id, // id transaction
            'type'=> $sale_or_rent, // type rent, sale
            'listing_id'=> $listing_id, // id listing 
            'user_id'=> $mTransactions->user_id,
            'list'=> 'transaction', // from all transaction list OR from listing

        ));
        $urlForUnlisted = Yii::app()->createAbsoluteUrl($mapControllerAction,array(
            'add_property'=> $add_property, // id listing 
            'id'=>$mTransactions->id, // id transaction
            'type'=> $sale_or_rent, // type rent, sale
            'listing_id'=> $listing_id, // id listing 
            'user_id'=> $mTransactions->user_id,
            'list'=> 'transaction', // from all transaction list OR from listing                                
        ));
        // Dec 02, 2014

    ?>                        

    <?php echo $form->labelEx($mTransactions,'type', array('class'=>'lb')); ?>
    <div class="group-4 list-check-3">
        <?php echo $form->radioButtonList($mTransactions,'type', ProTransactions::$aTypeSaleRentText,
                array(
                    'template'=>"<li>{input}{label}</li>",
                    'separator'=>'',
                    'container'=>'ul',
                    'class'=>'',
                )
                ); ?>
    </div>
    <?php echo $form->error($mTransactions,'type'); ?>
</div>
<script>
    $(function(){

        // for sale or rent type
        $('#ProTransactions_type').find('input:first').attr('next', '<?php echo $urlForRent;?>');
        $('#ProTransactions_type').find('input:last').attr('next', '<?php echo $urlForSale;?>');
        $('#ProTransactions_type input').click(function(){
            if($(this).val() != <?php echo $_GET['type'];?>)
            {
                $.blockUI({ message: null });
                window.location = $(this).attr('next');
            }
        });
        // for sale or rent type

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
            $type = isset($_GET['type'])?$_GET['type']:ProTransactions::FOR_RENT;
            $list = isset($_GET['list'])?$_GET['list']:'listing';
            $user_id = isset($_GET['user_id'])?$_GET['user_id']:0;
        ?>
        var requestUri = '<?php echo Yii::app()->createAbsoluteUrl($mapControllerAction,array('add_property'=>$add_property,'id'=>$id, 'type'=>$type,'list'=>$list,'user_id'=>$user_id));?>/listing_id/'+ui.item.id;
        window.location = requestUri; // ANH DUNG Fix Dec 02, 2014
        $.ajax({
            url:requestUri,
            type:'post',
            dataType:'json',
            data:{listing_id:ui.item.id},
            success:function(data){
                window.location = data['next'];
            }
        });

//                            $('#ProTransactionsPropertyDetail_postal_code').val(ui.item.postal_code);
//                            $('#ProTransactionsPropertyDetail_no_of_bedroom').val(ui.item.of_bedroom);
//                            $('#ProTransactionsPropertyDetail_unit_no').val(ui.item.unit_no);
//                            $('#ProTransactions_listing_id').val(ui.item.id);
//                            $('.listing_autocomplete').attr('readonly',true);
    }

    function fnRemoveListingId(){
        $('#ProTransactions_listing_id').val('');
        $('.listing_autocomplete').val('').attr('readonly',false);
    }                        
</script>