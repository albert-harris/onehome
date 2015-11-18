<?php
$this->breadcrumbs=array(
	Yii::t('translation','Tenancies Approved')=>array('index'),
	Yii::t('translation','Update Tenancy'),
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Tenancies Approved') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>


<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print-create-tenancy.css" />
<?php
/**
 * @Author: ANH DUNG Mar 27, 2014
 * @Todo: create new and update transaction
 */
?>
<?php 
    $backText = 'Tenancy';
    $backUrl = Yii::app()->createAbsoluteUrl('member/agent/tenancy');
    
    $cmsFormater = new CmsFormatter();
    $type_for_text = 'Record existing tenancy';
    $defaultTitle = 'Record existing tenancy';
?>
        
<!--<div class="breadcrumb">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('/');?>">Home</a> &raquo;
    <a href="<?php echo $backUrl;?>"><?php echo $backText;?></a>
    &raquo; <strong><?php echo $defaultTitle;?></strong>
</div>
<h1 class="title-page"><?php echo $type_for_text;?></h1>-->
    
<div class="form fix_block_submit display_none">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'transaction-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); 
CHtml::$afterRequiredLabel = ' <span class="required">*</span>';
$cAction = Yii::app()->controller->action->id;
$cController = Yii::app()->controller->id;
$mapControllerAction = 'admin/'.Yii::app()->controller->id."/".Yii::app()->controller->action->id;
$sUidGst = 0;
?>

<?php include_once '_auto_saleperson.php'; ?>
<?php if(isset($_GET['user_id'])):  $sUidGst = $_GET['user_id']; ?>
    <div class="need_select_saleperson">
        <?php include_once '_box_consultant.php'; ?>
        <!--<p class="tenancy_alert_existing">This is only recording existing tenancy. To create new tenancy with transaction, go to Transactions</p>-->
        <?php include_once '_box_property_detail.php'; ?>
        
        <?php if(isset($_GET['type']) && $_GET['type']==Listing::FOR_RENT): ?>
            <?php include_once '_box_rent_detail.php'; ?>
        <?php else:?>
            <?php include_once '_box_sale_detail.php'; ?>
        <?php endif;?>

        <?php include_once '_box_upload_property_document.php'; ?>

        <div class="clearfix output">
            <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/tenancy/index');?>" class="btn-3">Cancel</a>            
            <input type="submit" class="btn-3 submit_trans" value="Submit" />
        </div>
    </div>
<?php endif; ?>
<?php $this->endWidget(); ?>

</div>    
    
<style>
.tenancy_alert_existing { margin: 0; font-size: 15px; color: red; font-weight: bold;}
div.selector span { height: 23px !important; }

.ad_fix_radio_p_detail ul { padding-left: 0 !important; }
.ad_fix_radio_p_detail label { float: left !important;}

</style>

<!--fancy box-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/plugin.css" />
<!--fancy box-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/verz.js"></script>

<script>
    $(function(){
        $('#transaction-form').find('input:submit').click(function(){
            $.blockUI({ message: null });
        });
        
        $('.in-row').each(function(){
            var label = $(this).find('label:first');
            if(label.find('span.required').size()>1){
                label.find('span.required:first').remove();
            }
        });
        
        $('.submit_trans').click(function(){
            $('#transaction-form select').attr('disabled',false);
        });
        
        /* for show and hide bill to radio button */
        $('#ProTransactionsBillTo_bill_to_id li').hide();
        $('.client_type_id').click(function(){
            fnShowHideBillTo($(this).val());
        });
        
        <?php if($mTransactions->client_type_id): ?>
                fnShowHideBillTo(<?php echo $mTransactions->client_type_id;?>);
        <?php endif; ?>
        /* for show and hide bill to radio button */
        
        /* for show and hide with_tenancy date */
        $('.with_tenancy').click(function(){            
            $('.with_tenancy_yes').hide();
            if($(this).val()==1){
                $('.with_tenancy_yes').show();
            }
        });
        <?php if($mTransactions->with_tenancy): ?>
            $('.with_tenancy_yes').show();
        <?php endif;?>
        /* for show and hide with_tenancy date */
        
        /* for bind event show and hide bill_to_id */
        $('.paying_to_external_co_broke').click(function(){
            $('.table_external_co_broke').hide();
            if($(this).val()==1){
                $('.table_external_co_broke').show();
            }
        });
        
        $('.bill_to_id').click(function(){
            $('.table_external_co_broke').hide();
            $('.wrap_client_type_info').hide();
            $('.bill_to_company_name').hide();
            if($(this).val()==<?php echo ProTransactions::BILL_TO_EXTERNAL_CO_BROKE;?>){ // External Co-broke details (if yes)
                $('.table_external_co_broke').show();
            }else{
                $('.wrap_client_type_info').show();
                $('.wrap_client_type_info').find('.checked').removeClass('checked');
            }
            if($(this).val()==<?php echo ProTransactions::BILL_TO_SOLICITOR;?>){ // Company name is only if solicitor is selected.
                $('.bill_to_company_name').show();
            }
                
        });        
        /* for bind event show and hide bill_to_id */
        
        /* for commission_amount and commission_amount_gst */
         fnCalcCommissionGst('<?php echo Users::getGst($sUidGst);?>');
        
        /* for trigger click bill_to_id */
        <?php if($mTransactions->mBillTo->bill_to_id): ?>
            $('.bill_to_id').each(function(){
                if($(this).attr('checked')){
                    $(this).trigger('click');
                }
            });
        <?php endif;?>
        /* for trigger click bill_to_id */
        
        /* for trigger click paying_to_external_co_broke */
        <?php if( !is_null($mTransactions->mBillTo->paying_to_external_co_broke) ): ?>
            $('.paying_to_external_co_broke').each(function(){
                if($(this).attr('checked')){
                    $(this).trigger('click');
                }
            });
        <?php endif;?>
        /* for trigger click paying_to_external_co_broke */
        
        /* for hide Client Type by type sale or rent*/
        $('#ProTransactions_client_type_id').find('li').hide();
        <?php if($mTransactions->type==Listing::FOR_RENT):?>
            $('#ProTransactions_client_type_id').find('li').eq(2).show();
            $('#ProTransactions_client_type_id').find('li').eq(3).show();
        <?php elseif($mTransactions->type==Listing::FOR_SALE):?>
            $('#ProTransactions_client_type_id').find('li').eq(0).show();
            $('#ProTransactions_client_type_id').find('li').eq(1).show();
        <?php endif;?>
    
        /* for hide Client Type by type sale or rent*/
    
        /* for table External Co-broke details*/
        <?php if($mTransactions->mBillTo->paying_to_external_co_broke): ?>
            $('.table_external_co_broke').show();
        <?php endif; ?>        
        /* for table External Co-broke details*/
                
    }); // end $(function()
    
    
    // ẩn hiện các radio của Bill to,, dùng cho cả lúc update
    function fnShowHideBillTo(client_type_id){
        $('#ProTransactionsBillTo_bill_to_id li').hide();
        
        if(client_type_id==<?php echo ProTransactions::CLIENT_TYPE_VENDOR;?>){ // Vendor
            $('#ProTransactionsBillTo_bill_to_id').find('li').eq(0).show();
            $('#ProTransactionsBillTo_bill_to_id').find('li').eq(4).show();
        }else if(client_type_id==<?php echo ProTransactions::CLIENT_TYPE_PURCHASER;?>){//Purchaser
            $('#ProTransactionsBillTo_bill_to_id').find('li').eq(1).show();
            $('#ProTransactionsBillTo_bill_to_id').find('li').eq(4).show();
            $('#ProTransactionsBillTo_bill_to_id').find('li').eq(5).show();
        }else if(client_type_id==<?php echo ProTransactions::CLIENT_TYPE_LANLORD;?>){//Landlord
            $('#ProTransactionsBillTo_bill_to_id').find('li').eq(2).show();
            $('#ProTransactionsBillTo_bill_to_id').find('li').eq(4).show();
        }else if(client_type_id==<?php echo ProTransactions::CLIENT_TYPE_TENANT;?>){//Tenant
            $('#ProTransactionsBillTo_bill_to_id').find('li').eq(3).show();
            $('#ProTransactionsBillTo_bill_to_id').find('li').eq(4).show();
            $('#ProTransactionsBillTo_bill_to_id').find('li').eq(5).show();
        }
        
        <?php if($mTransactions->mBillTo && !$mTransactions->mBillTo->bill_to_id): ?>
        // nếu submit form lên và trả về thì không removeClass('checked');
        $('#ProTransactionsBillTo_bill_to_id').find('.checked').removeClass('checked');
        <?php endif;?>
            
    }
    
    // update order of table
    function fnRefreshOrderRow(){
        $('.tb-1 tbody').each(function(){
            var index = 1;
            $(this).find('tr').each(function(){                
                $(this).find('td:first').text(index++);
            });            
        });
    }
    
    $(window).load(function(){
        fnBindSaveDraft();
        $('.fix_block_submit').show();
    });
    
    function fnBindSaveDraft(){
        $('.submit_draft').click(function(){
            $('.SaveAsDraft').val(1);
            $(this).closest('form').submit();
        });
    }
    
</script>
            