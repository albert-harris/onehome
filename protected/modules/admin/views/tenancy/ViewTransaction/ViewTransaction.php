<?php
/**
 * @Author: ANH DUNG Mar 27, 2014
 * @Todo: create new and update transaction
 */
?>
<?php
$type_for_text = 'FOR SALE';
if($mTransactions->type==Listing::FOR_RENT){
    $type_for_text = 'FOR RENT';
}
?>

<!--<div class="sprint">
    <a class="button_print" href="javascript:void(0);" title="print transaction">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/print.png">
    </a>
</div>-->

<script  src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.printElement.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print-transaction.css" />
<script type="text/javascript">
    $(document).ready(function(){
        $(".button_print").click(function(){
            $('#printElement').printElement({ overrideElementCSS: ['<?php echo Yii::app()->theme->baseUrl;?>/css/print-transaction_print.css'] });
//            location.reload(); 
        });
       
    });
</script>
<div id="printElement">

<h1 class="title-page">VIEW TENANCY APPROVED : <?php echo $name_property;?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'transaction-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); 
$cmsFormater = new CmsFormatter();
?>

<?php include_once '_box_consultant.php'; ?>        
<?php include_once '_box_property_detail.php'; ?>
<?php if($mTransactions->type==Listing::FOR_RENT): ?>
    <?php include_once '_box_rent_detail.php'; ?>
<?php else:?>
    <?php include_once '_box_sale_detail.php'; ?>
<?php endif;?>

<?php include_once '_box_upload_property_document.php'; ?>

<?php $this->endWidget(); ?>

</div>
<style>
.box-4 .group { width: 165px;}
.box-4 .lb { width: 90px;}
</style>

<script>
    $(function(){
        $('.in-row').each(function(){
            var label = $(this).find('label:first');
            if(label.find('span').size()<1){
//                label.append(' :');
            }            
        });
        
        $('.tb-1').attr('cellspacing',0);
        $('.tb-1').attr('cellpadding',0);
        
        
        /* for show and hide bill to radio button */
        $('#ProTransactionsBillTo_bill_to_id li').hide();
//        $('.client_type_id').click(function(){
//            fnShowHideBillTo($(this).val());
//        });
        
        
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
                        
//        $('.bill_to_id').click(function(){
            $('.table_external_co_broke').hide();
            $('.wrap_client_type_info').hide();
            $('.bill_to_company_name').hide();
            var bill_to_id = <?php echo $mTransactions->mBillTo->bill_to_id;?>;
            if(bill_to_id==<?php echo ProTransactions::BILL_TO_EXTERNAL_CO_BROKE;?>){ // External Co-broke details (if yes)
                $('.table_external_co_broke').show();
            }else{
                $('.wrap_client_type_info').show();
                $('.wrap_client_type_info').find('.checked').removeClass('checked');
            }
            if(bill_to_id==<?php echo ProTransactions::BILL_TO_SOLICITOR;?>){ // Company name is only if solicitor is selected.
                $('.bill_to_company_name').show();
            }
//        });        
        /* for bind event show and hide bill_to_id */
        
        /* for trigger click bill_to_id */
        <?php if($mTransactions->mBillTo->bill_to_id): ?>
            $('.bill_to_id').each(function(){
                if($(this).attr('checked')){
                    $(this).trigger('click');
                }
            });
        <?php endif;?>
        /* for trigger click bill_to_id */
        
        
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
        
        <?php if(isset($_GET['print_transaction'])):?>
            $(".button_print").trigger('click');
        <?php endif;?>
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
        
        <?php if(!$mTransactions->mBillTo->bill_to_id): ?>
        // nếu submit form lên và trả về thì không removeClass('checked');
        $('#ProTransactionsBillTo_bill_to_id').find('.checked').removeClass('checked');
        <?php endif;?>
            
    }
    
</script>
            