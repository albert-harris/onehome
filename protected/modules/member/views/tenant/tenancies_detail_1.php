<?php $cmsFormater = new CmsFormatter();?>
<h2 style="color: brown">TENANCY INFORMATION</h2>
<!--<h2 style="color: brown">EDIT/VIEW TENANCY INFORMATION</h2>-->

<h1 class="title-page" style="font-size: 1.17em">TRANSACTED PROPERTY DETAILS</h1>
<div class="box-group clearfix">
    <div class="box-saleperson">
        <h4>Consultant Information</h4>
        <div class="content">
            <div class="in-row clearfix">
                <label class="lb">Name:</label>
                <div class="group">
                    <?php
                        $name = $transaction->user->first_name." ".$transaction->user->last_name;
                        echo $name;
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" style="float: right">
                <label class="lb">Contact:</label>
                <div class="group"><?php echo $transaction->user->phone; ?></div>
            </div>
        </div>
    </div>
</div>

<h4 style="margin-left: 20px">PROPERTY NAME: <?php echo $transaction->listing->property_name_or_address ?></h4>
<div class="box-group clearfix">
    <div class="box-4">
        <h4>Tenancy Details</h4>
        <div class="content">
            <div class="in-row clearfix">
                <label class="lb">Tenancy Agreement Date:</label>
                <?php
                $cms = new CmsFormatter();
                echo $cms->formatLongDate($transaction->tenancy_agreement_date);
                ?>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Commoncement Date:</label>
                <div class="group">
                    <?php
                        echo $cms->formatLongDate($transaction->commencement_date);
                    ?>
                </div>
            </div>

            <div class="in-row clearfix" >
                <label class="lb">Tenancy Amount:</label>
                <div class="group">
                    <?php
                    echo $cms->formatPrice($transaction->tenancy_amount);
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Expiring Date:</label>
                <div class="group">
                    <?php
                    echo $cms->formatExpiredDate($transaction->expiring_date);
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Deposit Paid:</label>
                <div class="group">
                    <?php
                    echo $cms->formatPrice($transaction->deposit_payable);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box-4">
                <h4>Landlord Details (This landlord who company billed)</h4>
        <div class="content">
            <div class="in-row clearfix">
                <label class="lb">Name:</label>
                <div class="group">
                    <?php
                        if(isset($landlordInformation)){
                            echo $landlordInformation->user->first_name;
                        }                    
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Correspondence Address:</label>
                <div class="group">
                    <?php
                        if(isset($landlordInformation)){
                            echo $landlordInformation->user->address;
                        }                    
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Postal Code:</label>
                    <?php
                        if(isset($landlordInformation)){
                            echo $landlordInformation->user->postal_code;
                        }                    
                    ?>                
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Email:</label>
                    <?php
                        if(isset($landlordInformation)){
                            echo $landlordInformation->user->email_not_login;
                        }                    
                    ?>                
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Contact No:</label>
                    <?php
                        if(isset($landlordInformation)){
                            echo $landlordInformation->user->contact_no;
                        }                    
                    ?>                
            </div>
        </div>
    </div>

</div>

<?php include '_upload_document.php';?>
<?php include '_report_defect.php';?>
<?php include '_view_call_log.php';?>
<?php include '_aircon_service.php';?>
<?php include '_inventory_photo.php';?>

<style> 
</style>

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
    $('#defect a.ajaxupdate').on('click', function() {
        $.fn.yiiGridView.update('defect-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('defect-grid');
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

<div class="clearfix output">
    <a href="javascript:history.back();" class="btn-2">Back</a>
</div>

<style>
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

    .box-4{
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
    }

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

<script>
    $(document).ready(function() {
        fnInitFancybox('.engageus');
        fnInitFancybox('.add_report_item');
        fnInitFancybox('.upload_item');
        fnInitFancybox('.update_engageus');
        fnInitFancybox('.update_item');
        fnBindDelete();
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