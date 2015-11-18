<!-- box -->
<div class="box-1 space-3 _box_sale_detail">
    <div class="title"><h3>TRANSACTED PROPERTY DETAILS</h3></div>
    <div class="form-type content "> 
        <div class="clearfix">
            <div class="col-1">
                    <?php /*
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'category_id', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->rCategory?$mTransactions->mPropertyDetail->rCategory->category_name:''; ?>
                        </div>
                    </div>
                    */?>
                
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'property_name_or_address', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $cmsFormater->formatTransactionPropertyName($mTransactions); ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'property_type_id', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->rPropertyType?$mTransactions->mPropertyDetail->rPropertyType->name:''; ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'house_blk_no', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->house_blk_no; ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'street_name', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->street_name; ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'postal_code', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->postal_code; ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'no_of_bedroom', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->no_of_bedroom; ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'tenure', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->rTenure?$mTransactions->mPropertyDetail->rTenure->name:''; ?>
                        </div>
                    </div>

            </div>
            <div class="col-2">
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'unit_no', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->unit_no; ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'building_name', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->building_name; ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'built_in_area', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->built_in_area; ?>
                        </div>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'land_area', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo $mTransactions->mPropertyDetail->land_area; ?>
                        </div>
                    </div>

                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($mTransactions->mPropertyDetail,'listing_type_id', array('class'=>'lb')); ?>
                        <div class="group top_5">
                            <?php echo isset(ProTransactionsPropertyDetail::$aListingType[$mTransactions->mPropertyDetail->listing_type_id])?ProTransactionsPropertyDetail::$aListingType[$mTransactions->mPropertyDetail->listing_type_id]:""; ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>