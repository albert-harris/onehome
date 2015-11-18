<?php

/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com
 */
?>
<?php

//status
$status = STATUS_LISTING_ACTIVE;
if(isset($_GET['status'])&& is_numeric($_GET['status'])){
    $status = (int)$_GET['status'];
}

//property type
$listing_type = '';
if(isset($_GET['listing_type']) && is_numeric($_GET['listing_type']) && ($_GET['listing_type']>=1 && $_GET['listing_type']<=2 )){
    $listing_type = (int) $_GET['listing_type'];
}

$this->widget('ext.CMenu.CMenu', array(
    'linkLabelWrapper' => 'span',
    'activeCssClass' => 'active',
    'htmlOptions' => array(
        'class' => 'tabs space-6 clearfix',
    ),
    'items' => array(
        array('label' => 'Active',
              'url' => array('/member/listing','status'=>STATUS_LISTING_ACTIVE) ,
              'active'=>($status==STATUS_LISTING_ACTIVE || $status=='') ? 'active':''),
//        array('label' => 'Pending',
//              'url' => array('/member/listing','status'=>STATUS_LISTING_PENDING) ,
//              'active'=>($status==STATUS_LISTING_PENDING) ? 'active':''),
//        array('label' => 'Rejected',
//              'url' => array('/member/listing','status'=>STATUS_LISTING_REJECTED) ,
//              'active'=>($status==STATUS_LISTING_REJECTED ) ? 'active':''),
        array('label' => 'Draft',
              'url' => array('/member/listing','status'=>STATUS_LISTING_DRAFT) ,
              'active'=>($status==STATUS_LISTING_DRAFT) ? 'active':''),
        array('label' => 'Past',
              'url' => array('/member/listing','status'=>STATUS_LISTING_PAST) ,
              'active'=>($status==STATUS_LISTING_PAST) ? 'active':''),
    ),
));
?> 
<div class="action-group tab-content clearfix">
    <h2>Filter By:</h2>
    <p class="links">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('member/listing',array('status'=>$status)) ?>" <?php if(empty($listing_type)) echo 'class="active"'; ?>>All</a> | 
        <a href="<?php echo Yii::app()->createAbsoluteUrl('member/listing',array('status'=>$status,'listing_type'=>2)) ?>" <?php if(!empty($listing_type) && $listing_type==2 ) echo 'class="active"'; ?> >For Sale</a> | 
        <a href="<?php echo Yii::app()->createAbsoluteUrl('member/listing',array('status'=>$status,'listing_type'=>1)) ?>" <?php if(!empty($listing_type) && $listing_type==1 ) echo 'class="active"'; ?> >For Rent</a>
    </p>
    <label class="lb">Search by Property Type :</label>                    
    <div class="select-3 search-form" style="width: 450px;">
        <?php
            $link = Yii::app()->createAbsoluteUrl('member/listing',array(
                'status'=>  isset($_GET['status']) ? $_GET['status'] : '' ,
                'pro_type'=>  isset($_GET['pro_type']) ? $_GET['pro_type'] : '' ,
                'listing_type'=>  isset($_GET['listing_type']) ? $_GET['listing_type'] : '' 
            ));
            $form=$this->beginWidget('CActiveForm', array(
                'action'=>$link,
                'method'=>'get',
            ));
        ?>
        <?php // echo ProPropertyType::getDropDownSelectGroup('pro_type', 'Listing_pro_type',  isset($_GET['pro_type']) ? (int) $_GET['pro_type'] : '',  '------------All--------'); ?>
        <div class="f-left" style="width: 230px;">
        <?php $aData = array();
            $aData['zonechoosetype'] = 'zone_list_listing';
            $aData['radio_id'] = 'BankRadioId';
            $aData['checkbox_id'] = 'BankCheckboxId';
            $aData['search_var'] = 1;
            $aData['not_hompage'] = 1;
            $aData['select_all'] = 1;
            $aData['model'] = $model;
            $this->widget('ext.ProPropertyTypeExt.ProPropertyTypeExt',
                                array('data'=>$aData));
        ?>        
        </div>
        <input type="submit" value="Search" name="yt0" style="" class="btn-3 f-left margin_0 l_margin_20">
        
        <?php $this->endWidget(); ?>
    </div> 
</div>

<?php
Yii::app()->clientScript->registerScript('loadFiled', "
    $('#Listing_pro_type').live('change', function() {
        $('.search-form form').submit();
    });
");

Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
?>

<script>
$(function(){
    fnBindDateFilter();
});

function fnBindDateFilter(){
    $('.ad_datepicker input').datepicker({
        changeMonth:true,
        changeYear:true,
//        showOn: 'button',
//        buttonImage: '<?php echo Yii::app()->theme->baseUrl.'/img/calendar-ico.png';?>',
//        buttonImageOnly: true,
        dateFormat: '<?php echo ActiveRecord::getDateFormatSearch();?>',
    });
    
    $('select').uniform();
}

</script>