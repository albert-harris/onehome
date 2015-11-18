<?php 
$cmsFormater = new CmsFormatter();

$tenantInformationName = '';
$tenantInformationNric = '';
$tenantInformationIdType = '';
$tenantInformationPassExp = '';
$LinkRequestBankEvalution = Yii::app()->createAbsoluteUrl('member/landlord/requestBankEvaluation', array('transaction_id'=>$transaction->id));

$LinkToSale = '';
if(isset($tenantInformation)){
    $mUser = $tenantInformation->user;
    $tenantInformationName = $mUser->first_name;
    $tenantInformationNric = $mUser->nric_passportno_roc;
    $tenantInformationIdType = $mUser->id_type?Users::$aIdType[$mUser->id_type]:'';
    $tenantInformationPassExp = $cmsFormater->formatLongDate($mUser->pass_expiry_date);


    $currentDate = date('Y-m-d');
    $expiredDate=date('Y-m-d', strtotime($mUser->expiration_date));
//    $expiredDate=date('Y-m-d', strtotime($value['expired_date'])); // Oct 22, 2014 khong hieu bien $value['expired_date'] o dau ra nua => dong lai
    if($expiredDate > $currentDate){
        $LinkToSale = Yii::app()->createAbsoluteUrl('member/landlord/engageus', array('tenancies_detail'=>1, 'transaction_id'=>$transaction->id, 'listing_id' => $transaction->listing_id));
    }
}


/* ANH DUNG Add Aug 17, 2015
 * tách hàm AdFixNameListing, vì hàm formatpropertyname nó rối quá
 */
$data = $transaction;
$title[] = $data->listing?$data->listing->property_name_or_address:"";
$pName = MyFormat::AdFixNameListing($transaction, $title);

?>
    <h1 class="title-3">Tenancy detail information</h1>
    <div class="tab-wrap">
        <ul class="tabs tabs-auto clearfix">
            <li class="active"><a href="#tab-1">Property <strong>Details</strong></a></li>
            <li><a href="#tab-2">Documents</a></li>
            <li><a href="#tab-3">Report <strong>Defect</strong></a></li>
            <li><a href="#tab-4">Aircon <strong>Services</strong></a></li>
            <li><a href="#tab-5">Call <strong>History</strong></a></li>
            <li><a href="#tab-6">Inventory <strong>Photo</strong></a></li>
            <!--<li><a href="#tab-7">Show all <strong>Tabs</strong></a></li>-->
        </ul>
        <div id="tab-1" class="tab-content-2 clearfix">
            <div class="clearfix">
                <?php if($LinkToSale!=''):?>
                    <a href="<?php echo $LinkToSale;?>" class="btn-7 engageusToSale" data-fancybox-type="iframe">To Sale</a>
                <?php endif;?>
                <a data-fancybox-type="iframe" href="<?php echo $LinkRequestBankEvalution;?>" class="btn-7 RequestBankEvaluation" title="Request Bank Evaluation">Request Bank Evaluation</a>
<!--                <a href="#" class="btn-7">
                    Request Bank Evaluation
                </a>-->
            </div>
            <div class="wrap-1 clearfix">
                <h4>Salesperson Information</h4>
                <div class="clearfix">
                    <div class="col-1">
                        <label class="lb-1 padding_0">Name:</label>
                        <span>
                            <?php echo $transaction->user->first_name." ".$transaction->user->last_name;?>
                        </span>
                    </div>
                    <?php /*
                    <div class="col-2">
                        <label class="lb-1 padding_0">Contact:</label>
                        <span>
                            <?php echo $transaction->user->phone;?>
                        </span>
                    </div>
                    */?>
                </div>
            </div>
            <div class="wrap-1 clearfix">
                <div class="property-name clearfix">
                    <div class="text-1">PROPERTY NAME:</div>
                    <div class="text-2">
                        <?php // echo $cmsFormater->formatTransactionPropertyName($transaction);?>
                        <?php echo $pName;?>
                    </div>
                </div>
                <div class="box-4 box-6">
                    <h4>Tenancy information</h4>
                    <div class="in-row clearfix">
                        <label class="lb">Tenancy agreement date:</label>
                        <div class="group"><?php echo $cmsFormater->formatLongDate($transaction->tenancy_agreement_date);?></div>
                    </div>
                    <div class="in-row clearfix">
                        <label class="lb">commencement date:</label>
                        <div class="group"><?php echo $cmsFormater->formatLongDate($transaction->commencement_date);?></div>
                    </div>
                    <div class="in-row clearfix">
                        <label class="lb">deposit paid:</label>
                        <div class="group"><?php echo $cmsFormater->formatPrice($transaction->deposit_payable);?></div>
                    </div>
                    <div class="in-row clearfix">
                        <label class="lb">tenancy amount:</label>
                        <div class="group"><?php echo $cmsFormater->formatPrice($transaction->tenancy_amount);?></div>
                    </div>
                    <div class="in-row clearfix">
                        <label class="lb">expiring date:</label>
                        <div class="group"><?php echo $cmsFormater->formatLongDate($transaction->expiring_date);?></div>
                    </div>
                </div>
                
                
                <div class="box-4 box-6">
                    <!--<h4>Tenancy detail information</h4>-->
                    <h4>Tenant's details</h4>
                    <div class="in-row clearfix">
                        <label class="lb">name:</label>
                        <div class="group"><?php echo $tenantInformationName;?></div>
                    </div>
                    <?php /*
                    <div class="in-row clearfix">
                        <label class="lb">NRIC/FIN/PP .No:</label>
                        <div class="group"><?php echo $tenantInformationNric;?></div>
                    </div>
                    <div class="in-row clearfix">
                        <label class="lb">ID type:</label>
                        <div class="group"><?php echo $tenantInformationIdType;?></div>
                    </div>
                    */?>
                    <div class="in-row clearfix">
                        <label class="lb">Pass expiry date:</label>
                        <div class="group"><?php echo $tenantInformationPassExp;?></div>
                    </div>
                     
                    <div class="in-row clearfix">
                        <label class="lb">upload scanned EPass:</label>
                        <div class="group">
                            <?php
                                if(isset($tenantInformation)){
//                                    $res='';
//                                    $file = ROOT."/".Users::$folderUpload."/"."$tenantInformation->user_id/".$tenantInformation->user->upload_employment_pass_passport;
//                                    if(file_exists($file) && !empty($tenantInformation->user->upload_employment_pass_passport)){
//                                        $link = Yii::app()->createAbsoluteUrl(Users::$folderUpload."/$tenantInformation->user_id/".$tenantInformation->user->upload_employment_pass_passport);
//                                        $res="<a href='$link' class='show-image'>".$tenantInformation->user->upload_employment_pass_passport."</a>";
//                                    }
//                                    echo $res;
                                    //add
                                    $aData = array('model'=>$tenantInformation, 'fieldName'=>'scanned_employment_pass');
                                    echo $cmsFormater->formatViewUploadFile($aData); 
                                }
                            ?>     
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <div id="tab-2" class="tab-content-2 clearfix">
            <!--Content Documents-->
            <?php include '_upload_document.php';?>
        </div>
        <div id="tab-3" class="tab-content-2 clearfix">
            <?php include '_report_defect.php';?>
        </div>
        <div id="tab-4" class="tab-content-2 clearfix">
            <!--Content Aircon Services-->
            <?php include '_aircon_service.php';?>
        </div>
        <div id="tab-5" class="tab-content-2 clearfix">
            <!--Content Call History-->
            <?php include '_view_call_log.php';?>
        </div>
        <div id="tab-6" class="tab-content-2 clearfix">
            <!--Content Photo Gallery-->
            <?php include '_inventory_photo.php';?>
        </div>
        <div id="tab-7" class="tab-content-2 clearfix">
            Content 7
        </div>
    </div><!-- //tab -->

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<?php
Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#document a.ajaxupdate').on('click', function() {
        $.fn.yiiGridView.update('document-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('document-grid');
            }
        });
        return false;
    });
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#calllog a.ajaxupdate').on('click', function() {
        $.fn.yiiGridView.update('calllog-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('calllog-grid');
            }
        });
        return false;
    });
");
?>

<!--<div class="clearfix output">
    <a href="javascript:history.back();" class="btn-2">Back</a>
</div>-->

<style>
    .listing_manager .selected a {color:#333333 !important; }
    #document-grid table.items {width:100% !important;}
    #calllog-grid table.items {width:100% !important;}
    
    .report{
        float: left;
        width: 263px;
    }
    
    .add_report_item, .upload_item{
        float: right;
    }
    
    .tb-1 {
        clear: both;
    }

    
/*    .box-4{
        height: 190px;
    }

    .box-4 {
        width: 468px;
    }

    .box-4 .lb {
        width: 148px;
    }

    .box-4 .group {
        width: 286px;
    }*/

    .box-saleperson .in-row {
        padding: 8px 72px;
    }

    .box-saleperson h4 {
        background: none repeat scroll 0 0 #F1F1F1;
        border-radius: 5px 5px 0 0;
        font-size: 12px;
        margin: 0;
        padding: 10px 15px;
    }

    .box-saleperson {
        background: none repeat scroll 0 0 #FFFFFF;
        border: 1px solid #DBDBDB;
        border-radius: 5px;
        display: inline-block;
        margin: 0 !important;
        vertical-align: top;
        width: 100%;
    }

    .box-saleperson .group {
        float: left;
        width: 180px;
    }

    .box-saleperson .content .in-row{
        float: left;
    }

    .box-saleperson .content .in-row .lb{
        float: left;
        margin-right: 10px;
    }
</style>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<script>
    $(document).ready(function() {
        fnInitFancybox('.engageus');
        fnInitFancybox('.engageusToSale');
        fnInitFancybox('.upload_item');
        fnInitFancybox('.update_engageus');
        fnInitFancybox('.add_report_item');
//        fnInitFancybox('.update_item');
        fnInitFancyboxLandLord('.UpdateDefectStatus');
        fnInitFancyboxLandLord('.update_item');
        fnBindDelete();
        fnInitFancyboxV1AD('.RequestBankEvaluation', 700);
    });

    function fnInitFancybox(class_name){
        //http://fancyapps.com/fancybox/
        $(class_name).fancybox({
            fitToView:true,
            width: 600,
            autoSize:false,autoHeight:true,scrolling : false,
            title:"",
            helpers: { overlay : {
                closeClick : false,  // if true, fancyBox will be closed when user clicks on the overlay
            }
            }
        });
    }

    function fnInitFancyboxLandLord(class_name){
        //http://fancyapps.com/fancybox/
        $(class_name).fancybox({
            fitToView:true,
            width: 600,
            autoSize:false,autoHeight:true,scrolling : false,
            title:"",
            minHeight: 600,
            helpers: { overlay : {
                    closeClick : false,  // if true, fancyBox will be closed when user clicks on the overlay
                }
            }
        });    
    }
    
    function fnInitFancyboxV1AD(class_name, cWidth){
        //http://fancyapps.com/fancybox/
        $(class_name).fancybox({
            fitToView:false,
//            autoResize:false,
            width: cWidth,
            height: 900,
            autoSize:false,
//            autoHeight:true,
//            scrolling : false,
            title:"",
            beforeShow: function(){
//               this.width = $('.fancybox-iframe').contents().find('html').width();
//               this.height = $('.fancybox-iframe').contents().find('.wrap_commission').height();
//               this.height = $('.wrap_commission').height();
            },            
            helpers: { overlay : {
                closeClick : false,  // if true, fancyBox will be closed when user clicks on the overlay
            }            
            }
        });
    }    

    function fnBindDelete(){
        $('.delete_item').on('click', function (){
            if(!confirm('Are you sure you want to delete this item?')) return false;
            var th = $(this);

            $.ajax({
                type: 'POST',
                url: jQuery(this).attr('href'),
                success: function(data) {
                    th.closest('tr').remove();
                }
            });
            return false;
        });
    }

    // sau khi add new hay update thì cập nhật lại grid view
    function fnUpdateGridView(IdGrid){
        var url_ = '<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->getRequest()->getUrl();?>';
        $.ajax({
            type: 'POST',
            url: url_,
            beforeSend: function( xhr ) {
                $.blockUI({ message: null });
            },
            success: function(data) {
                $(IdGrid).html($(data).find(IdGrid).html());
                $.unblockUI();
                fnBindDelete();
                //                fnInitFancybox(IdGrid);
            }
        });
    }

</script>