<?php

/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com
 */
?>

<h1 style="font-size: 20px;line-height: normal !important;"> Listings Management</h1>
<?php
$breadcrumbs[] = 'Listings Management';
if(!empty($agent)){
    $breadcrumbs[] = "Agent [ " .$agent->nric_passportno_roc ." ]";
}
$this->breadcrumbs=$breadcrumbs;

$menus=array(
	array('label'=>'Create New Listing', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>
<div class="search-form" >

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

$currentStatus ='';
if(isset($_GET['status'])){
    $currentStatus = $_GET['status'];
}
?> 

<div class="wide form">
     <div class="row">
        <label>List:</label>
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
            'buttons'=>array(
                array('label'=>'Active', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing',array('status'=>STATUS_LISTING_ACTIVE,'user_id'=>(!empty($agent)) ? $agent->id : '')),'active'=>($currentStatus=='' || $currentStatus ==STATUS_LISTING_ACTIVE ) ? true : false),
//                array('label'=>'Pending', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing',array('status'=>STATUS_LISTING_PENDING,'user_id'=>(!empty($agent)) ? $agent->id : '' )),'active'=>($currentStatus ==STATUS_LISTING_PENDING ) ? true : false),
//                array('label'=>'Rejected', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing',array('status'=>STATUS_LISTING_REJECTED,'user_id'=>(!empty($agent)) ? $agent->id : '')),'active'=>($currentStatus ==STATUS_LISTING_REJECTED) ? true : false),
                array('label'=>'Draft', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing',array('status'=>STATUS_LISTING_DRAFT,'user_id'=>(!empty($agent)) ? $agent->id : '')),'active'=>($currentStatus ==STATUS_LISTING_DRAFT) ? true : false),
                array('label'=>'Past', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing',array('status'=>STATUS_LISTING_PAST,'user_id'=>(!empty($agent)) ? $agent->id : '')),'active'=>($currentStatus ==STATUS_LISTING_PAST) ? true : false),
            ),
        )); 
    ?>       
    </div>   
    <div class="row">
        <label>Filter By:</label>
      <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
//          'type' => 'primary',
            'toggle' => 'radio', // 'checkbox' or 'radio'
            'buttons'=>array(
                array('label'=>'All', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing',array('status'=>$status)),'active'=>(empty($listing_type) ) ? true : false),
                array('label'=>'For Sale', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing',array('status'=>$status,'listing_type'=>2,'user_id'=>(!empty($agent)) ? $agent->id : '' )),'active'=>(!empty($listing_type) && $listing_type==2 ) ? true : false),
                array('label'=>'For Rent', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing',array('status'=>$status,'listing_type'=>1,'user_id'=>(!empty($agent)) ? $agent->id : '')),'active'=>(!empty($listing_type) && $listing_type==1) ? true : false),
            ),
        )); 
    ?>          
    </div>
    <div class="row">
        <label>Search by Property Type:</label>
        <?php
            $arrLink =array();
            if(isset($_GET['status'])) $arrLink['status'] = $_GET['status'];
            if(isset($_GET['pro_type'])) $arrLink['pro_type'] = $_GET['pro_type'];
            if(isset($_GET['listing_type'])) $arrLink['listing_type'] = $_GET['listing_type'];
            if(!empty($agent)) $arrLink['user_id'] = $agent->id;
        
            $link = Yii::app()->createAbsoluteUrl('admin/listing',$arrLink);
            $form=$this->beginWidget('CActiveForm', array(
                'action'=>$link,
                'method'=>'get',
            ));
        ?>
        <?php // echo ProPropertyType::getDropDownSelectGroup('pro_type', 'Listing_pro_type',  isset($_GET['pro_type']) ? (int) $_GET['pro_type'] : '',  '------------All--------'); ?>
        <div class="f-left" style="width: 250px;">
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
        <div style="padding-left: 159px;" class="row buttons">
            <br>
            <button name="yt0" type="submit" id="yw1" class="btn btn-small">Search</button>	
        </div>
        
        <?php $this->endWidget(); ?>      
    </div>
    
    
    </div>
</div> <!-- end search form-->

<?php
Yii::app()->clientScript->registerScript('addfile', "
    $('#Listing_pro_type').live('change', function() {
        $('.search-form form').submit();
    });
");
Yii::app()->clientScript->registerCoreScript('jquery.ui');
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
    
}

</script>

<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/verz_custom.css" />
<style>
/*for search index*/
/*.choose-list { position: relative; z-index: 10; }
.choose-list ul { font-weight: bold; list-style: none; margin: 0; padding: 0; }
.choose-list ul li { float: left; padding: 5px 0; width: 100%; }
.choose-list ul li input { float: left; }
.choose-list ul li label { display: block; margin-left: 18px; }
.choose-list ul ul { display: none; font-weight: normal; margin-left: 15px; margin-top: 5px; }
.choose-list .choosed-text { background: url(../img/bg-select.png) no-repeat right 0; border: #ddd solid 1px; color: #666; height: 25px; line-height: 25px; padding-left: 5px; width: 243px; }
.choose-list .choosed-text { background: url(../img/bg-select.png) no-repeat right 0; border: #ddd solid 1px; color: #666; height: 25px; line-height: 25px; padding-left: 5px;  }
.choose-list .sub-list { background: #fff; border: #ddd solid 1px; display: none; left: 0; padding: 5px; position: absolute; top: 24px; width: 100%; }    */
/*for search index*/
    
</style>