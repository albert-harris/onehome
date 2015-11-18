<?php
$s_property_type       = isset($_GET['property_type']) ? $_GET['property_type'] : null;
$s_location            = isset($_GET['location']) ? $_GET['location'] : null;
$s_minimum_price       = isset($_GET['minimum_price']) ? $_GET['minimum_price'] : null;
$s_maximum_price       = isset($_GET['maximum_price']) ? $_GET['maximum_price'] : null;
$s_minimum_bedroom     = isset($_GET['minimum_bedroom']) ? $_GET['minimum_bedroom'] : null;
$s_maximum_bedroom     = isset($_GET['maximum_bedroom']) ? $_GET['maximum_bedroom'] : null;
$s_minimum_floor       = isset($_GET['minimum_floor']) ? $_GET['minimum_floor'] : null;
$s_maximum_floor       = isset($_GET['maximum_floor']) ? $_GET['maximum_floor'] : null;
$s_minimum_psf         = isset($_GET['minimum_psf']) ? $_GET['minimum_psf'] : null;
$s_maximum_psf         = isset($_GET['maximum_psf']) ? $_GET['maximum_psf'] : null;
$s_minimum_constructed = isset($_GET['minimum_constructed']) ? $_GET['minimum_constructed'] : null;
$s_maximum_constructed = isset($_GET['maximum_constructed']) ? $_GET['maximum_constructed'] : null;
$s_tenure              = isset($_GET['tenure']) ? $_GET['tenure'] : '';
$s_keywords            = isset($_GET['keywords']) ? $_GET['keywords'] : '';
$s_sort                = isset($_GET['s_sort']) ? $_GET['s_sort'] : null;
$s_listed_on           = isset($_GET['listed_on']) ? $_GET['listed_on'] : null;
$s_option              = isset($_GET['option']) ? $_GET['option'] : null;
$s_LeaseTerm           = isset($_GET['LeaseTerm']) ? $_GET['LeaseTerm'] : null;

$PriceType = ProMasterPrice::PRICE_FOR_SALE;
$checkSale = 'checked';
$checkRent = '';
if (isset($_GET['listing_for']) && $_GET['listing_for'] == 'for_sale') {
	$checkSale = 'checked';
	$checkRent = '';
	$PriceType = ProMasterPrice::PRICE_FOR_SALE;
} elseif (isset($_GET['listing_for']) && $_GET['listing_for'] == 'for_rent') {
	$checkSale = '';
	$checkRent = 'checked';
	$PriceType = ProMasterPrice::PRICE_FOR_RENT;
}
$aLocation = array();
if (isset($_GET['location']) && is_array($_GET['location'])) {
	$aLocation = $_GET['location'];
}
$aFurnishingInclude = '';
if (isset($_GET['furnished'])) {
	$aFurnishingInclude = $_GET['furnished'];
}
$sTenure = '';
if (isset($_GET['tenure'])) {
	$sTenure = $_GET['tenure'];
}

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->theme->baseUrl.'/js/bootstrap-multiselect.js');
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->theme->baseUrl.'/js/location-select.js');
?>

<div class="box-1">
    <div class="title"><h3>Property Search</h3></div>
	
    <div class="content box-search">
        <form action="<?php echo Yii::app()->createAbsoluteUrl('site/index');?>" class="search-form" method="GET">
            <div class="form-group">
                <label class="control-label">Listing For</label>
                <div>
                    <label class="radio-inline">
                        <input type="radio" class="select_type" name="listing_for" id="sale" value="for_sale" <?php echo $checkSale;?> /> Sale </label>
                    <label class="radio-inline">
                        <input type="radio" class="select_type" name="listing_for" id="rent" value="for_rent" <?php echo $checkRent;?> /> Rent </label>
                </div>
            </div>

            <div class="form-group sidebar-tab">
                <label class="control-label">Type</label>
                <div class="select-wrap">
                    <?php include 'property_search_type.php';?>
                </div>
            </div>

            <div class="form-group sidebar-tab">
                <label class="control-label">Location</label>
                <div class="wrap_multiselect_location multi-select-wrap hide">
                    <?php  echo CHtml::dropDownList('location', $aLocation,
                        ProLocation::getListDataLocation(), 
                        array('class'=>'multiselect_location','multiple'=>'multiple'
                    )); ?>
                </div>
            </div>

           <div class="form-group sidebar-tab">
               <label class="control-label">Price</label>
               <div class="row">
                   <div class="col-xs-6">
                       <?php echo CHtml::dropDownList('minimum_price', $s_minimum_price, ProMasterPrice::getListOption($PriceType), array('empty'=>'Minimum', 'class'=>'minimum_price form-control')); ?>
                   </div>
                   <div class="col-xs-6">
                       <?php echo CHtml::dropDownList('maximum_price', $s_maximum_price, ProMasterPrice::getListOption($PriceType), array('empty'=>'Maximum', 'class'=>'maximum_price form-control')); ?>
                   </div>
               </div>
           </div>
           
            <div class="form-group sidebar-tab">
               <label class="control-label">Bedrooms</label>
               <div class="row">
                   <div class="col-xs-6">
                       <?php echo CHtml::dropDownList('minimum_bedroom', $s_minimum_bedroom, Listing::getListOptionsBedroom(), 
						   array('empty' => 'Minimum', 'class'=>'form-control')); ?>
                   </div>
                   <div class="col-xs-6">
                       <?php echo CHtml::dropDownList('maximum_bedroom', $s_maximum_bedroom, Listing::getListOptionsBedroom(), 
						   array('empty' => 'Maximum', 'class'=>'form-control')); ?>
                   </div>
               </div>
            </div>

            <div class="form-group sidebar-tab">
                <label class="control-label">Floor Size</label>
                <div class="row">
                    <div class="col-xs-6">
                        <?php echo CHtml::dropDownList('minimum_floor', $s_minimum_floor, ProMasterFloor::getListOption(), array('empty' => 'Minimum', 'class'=>'form-control')); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo CHtml::dropDownList('maximum_floor', $s_maximum_floor, ProMasterFloor::getListOption(), array('empty' => 'Maximum', 'class'=>'form-control')); ?>
                    </div>
                </div>
            </div>

            <div class="form-group sidebar-tab">
                <label class="control-label">Lease Term</label>
                <?php echo CHtml::dropDownList('LeaseTerm', $s_LeaseTerm,
                    Listing::getDropdownlistWithTableName('ProMasterLeaseTerm' ,'id','name'), 
                    array('empty'=>'Select', 'class'=>'form-control'
                )); ?>
            </div>

            <div class="form-group sidebar-tab div_furnished_tenure_for_rent hide div_furnished_tenure">
                <label class="control-label">Furnished</label>
                <?php echo CHtml::dropDownList('furnished', $aFurnishingInclude,
                    Listing::getDropdownlistWithTableName('ProMasterFurnished','id','name'), 
                    array('class'=>'form-control', 'empty'=>'All furnished'
                )); ?>
            </div>

            <div class="form-group sidebar-tab div_furnished_tenure_for_sale hide div_furnished_tenure">
                <label class="control-label">Tenure</label>
                <?php echo CHtml::dropDownList('tenure', $sTenure,
                    Listing::getDropdownlistWithTableName('ProMasterTenure','id','name'),
                    array('class'=>'form-control', 'empty'=>'All tenure'
                )); ?>
            </div>

            <div class="form-group sidebar-tab">
                <label class="control-label">Keywords</label>
                <input type="text" name="keywords" class="form-control" value="<?php echo $s_keywords;?>"  />
            </div>

            <p class="more more_search_options"><a href="javascript:void(0)">+ More search options</a></p>
            
            <div class="more_search_box" style="display: none;">
                <div class="form-group sidebar-tab">
                    <label class="control-label">PSF Range</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo CHtml::textField('minimum_psf', $s_minimum_psf, array('class'=>'form-control number_only')); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo CHtml::textField('maximum_psf', $s_maximum_psf, array('class'=>'form-control number_only')); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group sidebar-tab">
                    <label class="control-label">Listed On</label>
                    <?php echo CHtml::dropDownList('listed_on', $s_listed_on, CmsFormatter::$arrListOn, 
                    array('class'=>'form-control')); ?>
                </div>
            </div>
            
            <div class="form-group sidebar-tab">
                <label class="control-label">Sort By</label>
                <?php echo CHtml::dropDownList('s_sort', $s_sort, Listing::$S_SORT_BY, 
                    array('empty' => '-', 'class'=>'form-control')); ?>
            </div>

            <div class="form-group clearfix">
                <button type="submit" class="btn-3 pull-right">SEARCH</button> 
            </div>
        </form>
    </div>
</div>

<div class="hide">
<?php echo CHtml::dropDownList('price_sale_hide', '', ProMasterPrice::getListOption(ProMasterPrice::PRICE_FOR_SALE), array('empty'=>'Minimum', 'class'=>'price_sale_hide_for_sale')); ?>
<?php echo CHtml::dropDownList('price_rent_hide', '', ProMasterPrice::getListOption(ProMasterPrice::PRICE_FOR_RENT), array('empty'=>'Minimum', 'class'=>'price_sale_hide_for_rent')); ?>
</div>

<?php Yii::app()->clientScript->registerCoreScript('jquery.ui');?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');?>
<script>
    $(function(){
        $('.more_search_options').click(function(){
            $('.more_search_box').slideToggle();            
        });
        
        <?php if(
                ( isset($_GET['s_sort']) && !empty($_GET['s_sort']) ) ||
                ( isset($_GET['minimum_psf']) && !empty($_GET['minimum_psf']) ) ||
                ( isset($_GET['maximum_psf']) && !empty($_GET['maximum_psf']) ) ||
                ( isset($_GET['listed_on']) && !empty($_GET['listed_on']) ) ||
                ( isset($_GET['minimum_constructed']) && !empty($_GET['minimum_constructed']) ) ||
                ( isset($_GET['maximum_constructed']) && !empty($_GET['maximum_constructed']) ) ||
                ( isset($_GET['option']) && !empty($_GET['option']) )
            )
            :?>
            $('.more_search_options').trigger('click');
        <?php endif;?>
            
            $( "#listed_on_date" ).datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                showOn : 'button',
                buttonImageOnly: true,
                buttonImage: '<?php echo Yii::app()->theme->baseUrl;?>/img/calendar-ico.png'
            });

        $('.multiselect_location').multiselect({
              maxHeight:200,
              buttonWidth: '100%',
              numberDisplayed: 0,
              checkboxName: 'location[]'
          });
        $('.multiselect_location_buy').multiselect({
              maxHeight:200,
              buttonWidth: '100%',
              numberDisplayed: 0
          });
        $('.multiselect_location_rent').multiselect({
              maxHeight:200,
              buttonWidth: '100%',
              numberDisplayed: 0
          });
          
          
          fnBindSelectType();
          fnBindChangeMinMax('#minimum_price_engage', '#maximum_price_engage');
          fnBindChangeMinMax('#minimum_price_engage_rent', '#maximum_price_engage_rent');          
          fnBindChangeMinMax('#minimum_bedroom_engage', '#maximum_bedroom_engage');
          fnBindChangeMinMax('#minimum_bedroom_engage_rent', '#maximum_bedroom_engage_rent');
          fnBindChangeMinMax('#minimum_floor_engage', '#maximum_floor_engage');
          fnBindChangeMinMax('#minimum_floor_engage_rent', '#maximum_floor_engage_rent');
          fnCheckBoxClick();
        
    });
    
     $(window).load(function(){
        $('.wrap_multiselect_location').removeClass('hide');
        $('.wrap_multiselect_hide').removeClass('hide');
        fnShowHideTenure();
     });
     
     function fnBindSelectType(){
         $('.select_type').click(function(){
             var selected = $(this).val();
             var new_html_select = $('.price_sale_hide_'+selected).html();
             var form = $(this).closest('form');
             //minimum_price maximum_price
             var minimum_price = form.find('.minimum_price');
             var maximum_price = form.find('.maximum_price');
             minimum_price.html(new_html_select);
             maximum_price.html(new_html_select);
             maximum_price.find('option').eq(0).text('Maximum');
             
             minimum_price.trigger('click');
             maximum_price.trigger('click');
             fnShowHideTenure(); // fix Aug 11, 2014
         });
     }
     
     function fnShowHideTenure(){
         $('.select_type').each(function(){
             var selected = $(this).val();             
             $('.div_furnished_tenure').find('select').val('').trigger('click');
             if($(this).is(':checked')){
                 $('.div_furnished_tenure_'+selected).removeClass('hide');
             }else{
                 $('.div_furnished_tenure_'+selected).addClass('hide');
             }
         });
     }
    
</script>