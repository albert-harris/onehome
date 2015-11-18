<?php
$s_location = isset($_GET['location']) ? $_GET['location'] : null;
$aLocation = array();
if (isset($_GET['location']) && is_array($_GET['location'])) {
    $aLocation = $_GET['location'];
}
$model = new ProPropertyType();
?>
<form action="<?php echo Yii::app()->createAbsoluteUrl('site/index'); ?>" id="quick-search-form" method="GET">
    <div class="quick-search">
        <label class="lb">listing</label> 
        <div class="group">
            <input type="radio" value="for_sale" checked name="listing_for" id="sale"  /><label for="for_sale">For Sale</label> 
            <input type="radio" value="for_rent" name="listing_for" id="rent" /><label for="for_rent">For Rent</label>
        </div>
        <label class="lb">Type</label>
        <?php // include 'property_search_type_home.php'; ?>
        <div class="select-wrap">
            <?php $aData = array();
                $aData['zonechoosetype'] = 'zonechoosetype_quick';
                $aData['radio_id'] = 'QuickSearchRadioId';
                $aData['checkbox_id'] = 'QuickSearchCheckboxId';
                $aData['model'] = $model;
                $this->widget('ext.ProPropertyTypeExt.ProPropertyTypeExt',
                                    array('data'=>$aData));
            ?> 
        </div>

        <label class="lb">Location</label>
        <div class="wrap_multiselect_location_quick ">
            <?php
            echo CHtml::dropDownList('location', $aLocation, ProLocation::getListDataLocation(), array('class' => 'multiselect_location_quick', 'multiple' => 'multiple'));
            ?>
        </div>
        <button type="submit" class="btn-8">Quick search</button>
    </div>
</form>
<script>
    $(window).load(function () {
        $('.wrap_multiselect_location_quick').show();
    });
    $('.multiselect_location_quick').multiselect({
        maxHeight: 200,
        buttonWidth: '100px',
        numberDisplayed: 0,
        checkboxName: 'location[]'
    });

</script>