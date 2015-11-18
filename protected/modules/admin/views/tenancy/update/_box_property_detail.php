<!-- box -->
<div class="box-1 space-3 _box_sale_detail">
    <div class="title"><h3>TRANSACTED PROPERTY DETAILS</h3></div>
    <div class="form-type content"> 
        <div class=" clearfix">
            <div class="col-1">
                    <?php include "_box_property_detail_auto.php";?>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'property_type_id', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo ProPropertyType::getDropDownSelectGroup('ProTransactionsPropertyDetail[property_type_id]','ProTransactionsPropertyDetail_property_type_id',$mTransactions->mPropertyDetail->property_type_id,  'Select'); ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'property_type_id'); ?>
                        </div>                        
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'house_blk_no', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'house_blk_no',array('class'=>'text ad_blk_no')); ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'house_blk_no'); ?>
                        </div>                        
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'street_name', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'street_name',array('class'=>'text ad_street_name')); ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'street_name'); ?>
                        </div>                        
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'postal_code', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'postal_code',array('class'=>'text ad_postal_code')); ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'postal_code'); ?>
                        </div>                        
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'no_of_bedroom', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'no_of_bedroom',array('class'=>'text')); ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'no_of_bedroom'); ?>
                        </div>                        
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'tenure', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->dropDownList($mTransactions->mPropertyDetail,'tenure', Listing::getDropdownlistWithTableName('ProMasterTenure','id','name'), array('empty'=>'Select', 'class'=>'')); ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'tenure'); ?>
                        </div>                        
                    </div>
            </div>
            <div class="col-2">
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'unit_no', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'unit_no',array('class'=>'text w-5', )); ?>
                            <?php // echo $form->textField($mTransactions->mPropertyDetail,'unit_no',array('class'=>'text w-5', 'readonly'=>1 )); ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'unit_no'); ?>
                        </div>                        
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'building_name', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php // echo $form->textField($mTransactions->mPropertyDetail,'building_name',array('class'=>'text w-5', 'readonly'=>1 )); ?>
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'building_name',array('class'=>'text w-5 ad_building_name')); ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'building_name'); ?>
                        </div>                        
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'built_in_area', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'built_in_area',array('class'=>'text w-5')); ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'built_in_area'); ?>
                        </div>                        
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'land_area', array('class'=>'lb')); ?>
                        <div class="group-4">
                            <?php echo $form->textField($mTransactions->mPropertyDetail,'land_area',array('class'=>'text w-5')); ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'land_area'); ?>
                        </div>                        
                    </div>

                    <?php if(isset($_GET['add_property']) && $_GET['add_property'] == ProTransactions::ADD_UNLISTED ):?>
                        <div class="in-row clearfix ad_fix_radio_p_detail">
                            <?php echo $form->labelEx($mTransactions->mPropertyDetail,'listing_type_id', array('class'=>'lb')); ?>
                            <div class="group-4 list-check-3">
                            <!--<div class="group top_5">-->
                                <?php 
    //                            echo isset(ProTransactionsPropertyDetail::$aListingType[$mTransactions->mPropertyDetail->listing_type_id])?ProTransactionsPropertyDetail::$aListingType[$mTransactions->mPropertyDetail->listing_type_id]:'';
                                echo $form->radioButtonList($mTransactions->mPropertyDetail,'listing_type_id', ProTransactionsPropertyDetail::$aListingType,
                                        array(
                                            'template'=>"<li>{input}{label}</li>",
                                            'separator'=>'',
                                            'container'=>'ul',
                                            'class'=>'',
                                        )
                                        ); 
                                ?>
                            <?php echo $form->error($mTransactions->mPropertyDetail,'listing_type_id'); ?>
                            </div>                            
                        </div>
                    <?php else:?>
                        <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'listing_type_id', array('class'=>'lb')); ?>
                        <!--<div class="group-4 list-check-3">-->
                        <div class="group top_5">
                            <?php 
                            echo isset(ProTransactionsPropertyDetail::$aListingType[$mTransactions->mPropertyDetail->listing_type_id])?ProTransactionsPropertyDetail::$aListingType[$mTransactions->mPropertyDetail->listing_type_id]:'';
//                            echo $form->radioButtonList($mTransactions->mPropertyDetail,'listing_type_id', ProTransactionsPropertyDetail::$aListingType,
//                                    array(
//                                        'template'=>"<li>{input}{label}</li>",
//                                        'separator'=>'',
//                                        'container'=>'ul',
//                                        'class'=>'',
//                                    )
//                                    );
                            ?>
                        </div>
                        <?php // echo $form->error($mTransactions->mPropertyDetail,'listing_type_id'); ?>
                    </div>
                    <?php endif; // end for if(isset($_GET['add_property ?>
            </div>
        </div>
    </div>
</div>