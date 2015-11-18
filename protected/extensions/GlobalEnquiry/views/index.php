<div class="box-1">
    <div class="title"><h3>Engage Us</h3></div>
    <div class="content">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>Yii::app()->createAbsoluteUrl('/'),
            'method'=>'post',
            'htmlOptions'=>array(
                'class'=>'search-form'
            ),
        )); ?>
            <label class="lb">I want to...</label>
            <ul class="list-check clearfix">
                <?php
                echo $form->radioButtonList($model, 'type_enquiry',
                    ProGlobalEnquiry::$arrType,
                    array(
                        //'labelOptions'=>array('style'=>'display:inline'), // add this code
                        'separator'=>'  ',
                    ) );
                ?>
            </ul>
            <?php echo $form->error($model,'type_enquiry'); ?>

            <div id="engageBuy" class="sub-content" style="display:block">
                <?php echo $form->labelEx($model,'property_type_id',array('label'=>'Type','class'=>'lb')); ?>
                <?php echo $form->dropDownList($model,'property_type_id', ProPropertyType::getListDataPropertyType(), array('empty'=>'All property types'));?>
                <?php echo $form->error($model,'property_type_id'); ?>

                <?php echo $form->labelEx($model,'location_id',array('label'=>'Location','class'=>'lb')); ?>
                <?php echo $form->dropDownList($model,'location_id', ProLocation::getListDataLocation(), array('empty'=>'All locations in Singapore'));?>
                <?php echo $form->error($model,'location_id'); ?>

                <?php echo $form->labelEx($model,'price',array('label'=>'Price','class'=>'lb')); ?>
                <div class="clearfix">
                    <div class="col-1">
                        <?php echo $form->dropDownList($model,'min_price', ProMasterPrice::getListMinimumPrice("enquiry"), array('empty'=>'Minimum'));?>
                    </div>
                    <div class="col-2">
                        <?php echo $form->dropDownList($model,'max_price', ProMasterPrice::getListMaximumPrice("enquiry"), array('empty'=>'Maximum'));?>
                    </div>
                    <?php echo $form->error($model,'min_price'); ?>
                    <?php echo $form->error($model,'max_price'); ?>
                </div>

                <?php echo $form->labelEx($model,'bedrooms',array('label'=>'# of Bedrooms','class'=>'lb')); ?>
                <div class="clearfix">
                    <div class="col-1">
                        <?php echo $form->dropDownList($model,'min_bedroom', ProMasterBedroom::getListMinimumBedroom("enquiry"), array('empty'=>'Minimum'));?>
                    </div>
                    <div class="col-2">
                        <?php echo $form->dropDownList($model,'max_bedroom', ProMasterBedroom::getListMaximumBedroom("enquiry"), array('empty'=>'Maximum'));?>
                    </div>
                    <?php echo $form->error($model,'min_bedroom'); ?>
                    <?php echo $form->error($model,'max_bedroom'); ?>
                </div>

                <?php echo $form->labelEx($model,'floor_size',array('label'=>'Floor Size','class'=>'lb')); ?>
                <div class="clearfix">
                    <div class="col-1">
                        <?php echo $form->dropDownList($model,'min_floor_size', ProMasterFloor::getListMinimumFloor("enquiry"), array('empty'=>'Minimum'));?>
                    </div>
                    <div class="col-2">
                        <?php echo $form->dropDownList($model,'max_floor_size', ProMasterFloor::getListMaximumFloor("enquiry"), array('empty'=>'Maximum'));?>
                    </div>
                    <?php echo $form->error($model,'min_floor_size'); ?>
                    <?php echo $form->error($model,'max_floor_size'); ?>
                </div>

                <?php echo $form->labelEx($model,'tenure',array('label'=>'Tenure','class'=>'lb')); ?>
                <?php echo $form->textField($model,'tenure',array('class'=>'text','placeholder'=>'All tenure types')); ?>
                <?php echo $form->error($model,'tenure'); ?>

                <div class="in-row clearfix">
                    <label class="lb">Enquiry</label>
                    <?php echo $form->textField($model,'name',array('class'=>'text','placeholder'=>'Name')); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->textField($model,'email',array('class'=>'text','placeholder'=>'Email')); ?>
                    <?php echo $form->error($model,'email'); ?>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->textField($model,'phone',array('class'=>'text','placeholder'=>'Phone')); ?>
                    <?php echo $form->error($model,'phone'); ?>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('empty'=>'Country'));?>
                    <?php echo $form->error($model,'country_id'); ?>
                </div>

            </div>
            <div id="engageSell" class="sub-content">
                <?php echo $form->labelEx($model,'address',array('label'=>'Property Name or Address','class'=>'lb')); ?>
                <?php echo $form->textField($model,'address',array('class'=>'text')); ?>
                <?php echo $form->labelEx($model,'postal_code',array('label'=>'Postal code','class'=>'lb')); ?>
                <?php echo $form->dropDownList($model,'postal_code', ProPostalCode::loadArrList());?>
                <?php echo $form->error($model,'postal_code'); ?>

                <?php echo $form->labelEx($model,'HDB_own_estate',array('label'=>'HDB Town/Estate','class'=>'lb')); ?>
                <?php echo $form->dropDownList($model,'HDB_own_estate', ProHdbTown::getListData());?>
                <?php echo $form->error($model,'HDB_own_estate'); ?>

                <?php echo $form->labelEx($model,'property_type_id',array('label'=>'Property Type','class'=>'lb')); ?>
                <?php echo $form->dropDownList($model,'property_type_id', ProPropertyType::getListDataPropertyType(), array('empty'=>'All property types'));?>
                <?php echo $form->error($model,'property_type_id'); ?>

                <?php echo $form->labelEx($model,'unit',array('label'=>'Unit#','class'=>'lb')); ?>
                <div class="clearfix">
                    <div class="col-3">
                        <?php echo $form->textField($model,'min_unit',array('class'=>'text','placeholder'=>'12')); ?>
                    </div>
                    <div class="col-4">-</div>
                    <div class="col-5">
                        <?php echo $form->textField($model,'max_unit',array('class'=>'text','placeholder'=>'58')); ?>
                    </div>
                    <?php echo $form->error($model,'unit'); ?>
                </div>

                <?php echo $form->labelEx($model,'price',array('label'=>'Price $','class'=>'lb')); ?>
                <?php echo $form->textField($model,'price',array('class'=>'text')); ?>
                <?php echo $form->error($model,'price'); ?>

                <?php echo $form->labelEx($model,'official_bank_val',array('label'=>'Official/BankValuation $','class'=>'lb')); ?>
                <?php echo $form->textField($model,'official_bank_val',array('class'=>'text')); ?>
                <?php echo $form->error($model,'official_bank_val'); ?>

                <?php echo $form->labelEx($model,'bedrooms',array('label'=>'# of Bedrooms','class'=>'lb')); ?>
                <?php echo $form->textField($model,'bedrooms',array('class'=>'text')); ?>
                <?php echo $form->error($model,'bedrooms'); ?>

                <?php echo $form->labelEx($model,'floor_area',array('label'=>'Floor Area','class'=>'lb')); ?>
                <?php echo $form->textField($model,'floor_area',array('class'=>'text')); ?>
                <?php echo $form->error($model,'floor_area'); ?>

                <?php echo $form->labelEx($model,'listing_description',array('label'=>'Listing Description','class'=>'lb')); ?>
                <?php echo $form->textArea($model,'listing_description',array('class'=>'text','rows'=>3,'cols'=>30)); ?>
                <?php echo $form->error($model,'listing_description'); ?>

                <?php echo $form->labelEx($model,'furnished',array('label'=>'Furnished','class'=>'lb')); ?>
                <ul class="list-check list-check-2 clearfix">
                    <?php
                    echo $form->radioButtonList($model, 'furnished',
                        ProMasterFurnished::getListData(),
                        array(
                            'separator'=>'  ',
                        ) );
                    ?>
                </ul>
                <?php echo $form->error($model,'furnished'); ?>

                <?php echo $form->labelEx($model,'floor',array('label'=>'Floor','class'=>'lb')); ?>
                <?php echo $form->dropDownList($model,'floor', ProMasterFloorType::getListData("enquiry"));?>
                <?php echo $form->error($model,'floor'); ?>

                <?php echo $form->labelEx($model,'lease_term',array('label'=>'Lease Term','class'=>'lb')); ?>
                <?php echo $form->dropDownList($model,'lease_term', ProMasterLeaseTerm::getListData("enquiry"));?>
                <?php echo $form->error($model,'lease_term'); ?>

                <?php echo $form->labelEx($model,'bathrooms',array('label'=>'# of bathrooms','class'=>'lb')); ?>
                <?php echo $form->textField($model,'bathrooms',array('class'=>'text','placeholder'=>'Enter text')); ?>
                <?php echo $form->error($model,'bathrooms'); ?>

                <?php echo $form->labelEx($model,'special_features',array('label'=>'Special Features','class'=>'lb')); ?>
                <ul class="list-check list-check-2 clearfix">
                    <?php
                    echo $form->radioButtonList($model, 'special_features',
                        ProMasterSpecialFeatures::getListData('enquiry'),
                        array(
                            'separator'=>'  ',
                        ) );
                    ?>
                </ul>

                <div class="in-row clearfix">
                    <label class="lb">Enquiry</label>
                    <?php echo $form->textField($model,'name',array('class'=>'text','placeholder'=>'Name')); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->textField($model,'email',array('class'=>'text','placeholder'=>'Email')); ?>
                    <?php echo $form->error($model,'email'); ?>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->textField($model,'phone',array('class'=>'text','placeholder'=>'Phone')); ?>
                    <?php echo $form->error($model,'phone'); ?>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('empty'=>'Country'));?>
                    <?php echo $form->error($model,'country_id'); ?>
                </div>

            </div>

            <div id="engageRent" class="sub-content">
                <label class="lb">I am a...</label>
                <ul class="list-check list clearfix">
                    <?php
                    echo $form->radioButtonList($model, 'rent_type',
                        ProGlobalEnquiry::$raRentType,
                        array(
                            'separator'=>'  ',
                        ) );
                    ?>
                </ul>
                <div id="renttype1" class="rent-content" style="display:block">
                    <?php echo $form->dropDownList($model,'property_type_id', ProPropertyType::getListDataPropertyType(), array('empty'=>'All property types'));?>
                    <?php echo $form->error($model,'property_type_id'); ?>

                    <?php echo $form->labelEx($model,'location_id',array('label'=>'Location','class'=>'lb')); ?>
                    <?php echo $form->dropDownList($model,'location_id', ProLocation::getListDataLocation(), array('empty'=>'All locations in Singapore'));?>
                    <?php echo $form->error($model,'location_id'); ?>

                    <label class="lb">Price</label>
                    <div class="clearfix">
                        <div class="col-1">
                            <?php echo $form->dropDownList($model,'min_price', ProMasterPrice::getListMinimumPrice("enquiry"), array('empty'=>'Minimum'));?>
                        </div>
                        <div class="col-2">
                            <?php echo $form->dropDownList($model,'max_price', ProMasterPrice::getListMaximumPrice("enquiry"), array('empty'=>'Maximum'));?>
                        </div>
                        <?php echo $form->error($model,'min_price'); ?>
                        <?php echo $form->error($model,'max_price'); ?>
                    </div>

                    <?php echo $form->labelEx($model,'bedrooms',array('label'=>'# of Bedrooms','class'=>'lb')); ?>
                    <div class="clearfix">
                        <div class="col-1">
                            <?php echo $form->dropDownList($model,'min_bedroom', ProMasterBedroom::getListMinimumBedroom("enquiry"), array('empty'=>'Minimum'));?>
                        </div>
                        <div class="col-2">
                            <?php echo $form->dropDownList($model,'max_bedroom', ProMasterBedroom::getListMaximumBedroom("enquiry"), array('empty'=>'Maximum'));?>
                        </div>
                        <?php echo $form->error($model,'min_bedroom'); ?>
                        <?php echo $form->error($model,'max_bedroom'); ?>
                    </div>

                    <?php echo $form->labelEx($model,'bathrooms',array('label'=>'# of Bedrooms','class'=>'lb')); ?>
                    <div class="clearfix">
                        <div class="col-1">
                            <?php echo $form->dropDownList($model,'min_bathroom', ProMasterBathroom::getListBathroom("enquiry"), array('empty'=>'Minimum'));?>
                        </div>
                        <div class="col-2">
                            <?php echo $form->dropDownList($model,'max_bathroom', ProMasterBathroom::getListBathroom("enquiry"), array('empty'=>'Maximum'));?>
                        </div>
                        <?php echo $form->error($model,'min_bathroom'); ?>
                        <?php echo $form->error($model,'max_bathroom'); ?>
                    </div>

                    <?php echo $form->labelEx($model,'furnished',array('label'=>'Furnished','class'=>'lb')); ?>
                    <ul class="list-check list-check-2 clearfix">
                        <?php
                        echo $form->radioButtonList($model, 'furnished',
                            ProMasterFurnished::getListData(),
                            array(
                                'separator'=>'  ',
                            ) );
                        ?>
                    </ul>
                    <?php echo $form->error($model,'furnished'); ?>

                    <?php echo $form->labelEx($model,'floor_size',array('label'=>'Floor Size','class'=>'lb')); ?>
                    <div class="clearfix">
                        <div class="col-1">
                            <?php echo $form->dropDownList($model,'min_floor_size', ProMasterFloor::getListMinimumFloor("enquiry"), array('empty'=>'Minimum'));?>
                        </div>
                        <div class="col-2">
                            <?php echo $form->dropDownList($model,'max_floor_size', ProMasterFloor::getListMaximumFloor("enquiry"), array('empty'=>'Maximum'));?>
                        </div>
                        <?php echo $form->error($model,'min_floor_size'); ?>
                        <?php echo $form->error($model,'max_floor_size'); ?>
                    </div>

                    <div class="rent2">
                        <?php echo $form->labelEx($model,'availability',array('label'=>'Availability','class'=>'lb')); ?>
                        <?php echo $form->textField($model,'availability',array('class'=>'text')); ?>
                        <?php echo $form->error($model,'availability'); ?>
                    </div>

                </div>

                <div class="in-row clearfix">
                    <label class="lb">Enquiry</label>
                    <?php echo $form->textField($model,'name',array('class'=>'text','placeholder'=>'Name')); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->textField($model,'email',array('class'=>'text','placeholder'=>'Email')); ?>
                    <?php echo $form->error($model,'email'); ?>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->textField($model,'phone',array('class'=>'text','placeholder'=>'Phone')); ?>
                    <?php echo $form->error($model,'phone'); ?>
                </div>

                <div class="in-row clearfix">
                    <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('empty'=>'Country'));?>
                    <?php echo $form->error($model,'country_id'); ?>
                </div>
            </div>

            <div class="in-row clearfix">
                <div class="note-box-2">
                    <div class="content">
                        <?php echo $box->content;?>
                    </div>
                </div>
            </div>
            <div class="in-row check-wrap clearfix">
                <input type="checkbox" id="check-update" checked /><label class="lb-3" for="check-update">Please send me updates, monthly newsletter and partner offers</label>
            </div>
            <div class="a-center clearfix">
                <button type="submit" class="btn-3">SEND ENQUIRY</button>
            </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
