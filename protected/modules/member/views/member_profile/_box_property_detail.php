<!-- box -->
<div class="box-1 space-3 _box_sale_detail">
    <div class="title"><h3>TRANSACTED PROPERTY DETAILS</h3></div>
    <div class="form-type content"> 
        <div class=" clearfix">
            <div class="col-1">
                    <!-- begin for  from all transaction list -->
                    <?php $add_property = isset($_GET['add_property'])?$_GET['add_property']:ProTransactions::ADD_EXISTING;?>
                    <?php if(isset($_GET['list']) && $_GET['list']=='transaction'):?>
                    <div class="in-row clearfix">
                        <?php 
                            // to do: build link when click to radio button sale, rent FROM  all transaction list
                            $transaction_id = isset($_GET['id'])?$_GET['id']:0;
                            $listing_id = isset($_GET['listing_id'])?$_GET['listing_id']:0;
                            $add_property = isset($_GET['add_property'])?$_GET['add_property']:ProTransactions::ADD_EXISTING;
                            $sale_or_rent = isset($_GET['type'])?$_GET['type']:ProTransactions::FOR_RENT;
                            
                            $urlForSale = Yii::app()->createAbsoluteUrl('member/member_profile/createTransaction',array(
                                'id'=>$mTransactions->id, // id transaction
                                'type'=> ProTransactions::FOR_SALE, // type rent, sale
                                'listing_id'=> $listing_id, // id listing 
                                'add_property'=> $add_property, // id listing 
                                'list'=> 'transaction', // from all transaction list OR from listing
                                
                            ));
                            $urlForRent = Yii::app()->createAbsoluteUrl('member/member_profile/createTransaction',array(
                                'id'=>$mTransactions->id, // id transaction
                                'type'=> ProTransactions::FOR_RENT, // type rent, sale
                                'listing_id'=> $listing_id, // id listing 
                                'add_property'=> $add_property, // id listing 
                                'list'=> 'transaction', // from all transaction list OR from listing
                                
                            ));
                            
                            // Dec 02, 2014
                            $urlForExisting = Yii::app()->createAbsoluteUrl('member/member_profile/createTransaction',array(
                                'id'=>$mTransactions->id, // id transaction
                                'type'=> $sale_or_rent, // type rent, sale
                                'listing_id'=> $listing_id, // id listing 
                                'add_property'=> ProTransactions::ADD_EXISTING, // id listing 
                                'list'=> 'transaction', // from all transaction list OR from listing
                                
                            ));
                            $urlForUnlisted = Yii::app()->createAbsoluteUrl('member/member_profile/createTransaction',array(
                                'id'=>$mTransactions->id, // id transaction
                                'type'=> $sale_or_rent, // type rent, sale
                                'listing_id'=> $listing_id, // id listing 
                                'add_property'=> ProTransactions::ADD_UNLISTED, // id listing 
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
                            ?>
                            var requestUri = '<?php echo Yii::app()->createAbsoluteUrl('member/member_profile/createTransaction',array('id'=>$id, 'type'=>$type,'list'=>$list,'add_property'=>$add_property));?>/listing_id/'+ui.item.id;
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
                    
                    <!-- Lam Huynh: hide add property field, coz now only type Unlisted -->
                    <div class="in-row clearfix display_none">
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
                    <!--ANH DUNG DEC 02, 2014-->
                    
                        <?php if($add_property == ProTransactions::ADD_EXISTING): // DEC 02, 2014 ?>
                        <?php // if(1): // DEC 02, 2014 ?>
                        <div class="in-row clearfix">
                            <?php echo $form->labelEx($mTransactions,'listing_id', array('class'=>'lb')); ?>
                            <div class="group-4">
                                <?php $readonly_auto=''; if(trim($mTransactions->listing_autocompelte!=''))$readonly_auto=1;?>
                                <?php echo $form->hiddenField($mTransactions,'listing_id',array('class'=>'')); ?>
                                <?php echo $form->textField($mTransactions,'listing_autocompelte',array('class'=>'text listing_autocomplete f-left','readonly'=>$readonly_auto, 'placeholder'=>'Search by Property Name or Address', 'style'=>'width:251px;')); ?>
                                <span onclick="fnRemoveListingId()" class="remove_row_item" title="Remove listing selected"></span>
                            </div>
                            <?php echo $form->error($mTransactions,'listing_id'); ?>
                        </div>
                        <?php else:?>
                            <?php include '_box_property_detail_search_address.php';?>
                        <?php endif; // end for if($add_property == ProTransactions::ADD_EXISTING):?>
                
                    <?php endif; // end for if(isset($_GET['list']) && $_GET['list']=='transaction'): ?>
                    <!-- end for  from all transaction list -->
                
                    <?php /* Close at Dec 02, 2014 if(isset($_GET['list']) && $_GET['list']=='transaction'):?>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'category_id', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->dropDownList($mTransactions->mPropertyDetail,'category_id', Categories::getList(), array('empty'=>'Select', 'class'=>'')); ?>                            
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'category_id'); ?>
                    </div>
                    <?php endif; */?>                    
                    
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'property_type_id', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo ProPropertyType::getDropDownSelectGroup('ProTransactionsPropertyDetail[property_type_id]','ProTransactionsPropertyDetail_property_type_id',$mTransactions->mPropertyDetail->property_type_id,  'Select'); ?>
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'property_type_id'); ?>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'house_blk_no', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'house_blk_no',array('class'=>'text ad_blk_no')); ?>
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'house_blk_no'); ?>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'street_name', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'street_name',array('class'=>'text ad_street_name')); ?>
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'street_name'); ?>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'postal_code', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'postal_code',array('class'=>'text ad_postal_code')); ?>
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'postal_code'); ?>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'no_of_bedroom', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'no_of_bedroom',array('class'=>'text')); ?>
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'no_of_bedroom'); ?>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'tenure', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->dropDownList($mTransactions->mPropertyDetail,'tenure', Listing::getDropdownlistWithTableName('ProMasterTenure','id','name'), array('empty'=>'Select', 'class'=>'')); ?>
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'tenure'); ?>
                    </div>
            </div>
            <div class="col-2">
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'unit_no', array('class'=>'lb')); ?>
                        <div class="group-4">
							<?php echo $form->textField($mTransactions->mPropertyDetail,'unit_no',array('class'=>'text w-5')); ?>
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'unit_no'); ?>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'building_name', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php // echo $form->textField($mTransactions->mPropertyDetail,'building_name',array('class'=>'text w-5', 'readonly'=>1 )); ?>
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'building_name',array('class'=>'text w-5 ad_building_name')); ?>
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'building_name'); ?>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'built_in_area', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'built_in_area',array('class'=>'text w-5')); ?>
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'built_in_area'); ?>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'land_area', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'land_area',array('class'=>'text w-5')); ?>
                        </div>
                        <?php echo $form->error($mTransactions->mPropertyDetail,'land_area'); ?>
                    </div>
            </div>
        </div>
    </div>
</div>