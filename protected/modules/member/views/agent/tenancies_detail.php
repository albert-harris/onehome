<?php $cmsFormater = new CmsFormatter();
$PropertyName = $cmsFormater->formatTransactionPropertyName($transaction);
?>
<div class="breadcrumb" style="margin-top:0px;">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('member/agent/tenancy') ?>">Tenancy Management</a> 
    » 
    <a href="<?php echo Yii::app()->createAbsoluteUrl('member/agent/tenancies_detail', array('transaction_id'=>$transaction->id)) ?>"><?php echo $PropertyName ?></a>    
</div>

<h2 style="color: brown">EDIT/VIEW TENANCY INFORMATION</h2>
<h4 style="margin-left: 20px">PROPERTY NAME: <?php echo $PropertyName;?></h4>

<div class="box-group clearfix">
    <div class="box-saleperson">
        <h4>Tenancy Information</h4>
        <div class="content">
<div class="in-row clearfix">
                <label class="lb">Tenancy Agreement Date:</label>
                <div class="group">
                    <?php
                        $cms = new CmsFormatter();
                        echo $cms->formatLongDate($transaction->tenancy_agreement_date);
                    ?>
                </div>
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
                <label class="lb">Deposit Paid:</label>
                <div class="group">
                    <?php
                        echo $cms->formatPrice($transaction->deposit_payable);
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
                <label class="lb">Tenancy Period:</label>
                <div class="group">
                    <?php
                        echo $transaction->months_rent != NULL ? $transaction->months_rent." months":"";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="box-group clearfix">
    <div class="box-4">
        <h4>Landlord Information</h4>
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
                <label class="lb">NRIC/FIN/PP No:</label>
                <div class="group">
                    <?php
                        if(isset($landlordInformation)){
                            echo $landlordInformation->user->nric_passportno_roc;
                        }
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Email:</label>
                <div class="group">
                    <?php
                        if(isset($landlordInformation)){
                            echo $landlordInformation->user->email_not_login;
                        }
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Contact:</label>
                <div class="group">
                    <?php
                        if(isset($landlordInformation)){
                            echo $landlordInformation->user->contact_no;
                        }
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Residential Address:</label>
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
                <div class="group">
                    <?php
                        if(isset($landlordInformation)){
                            echo $landlordInformation->user->postal_code;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box-4">
        <h4>Tenant Information</h4>
        <div class="content">
            <div class="in-row clearfix">
                <label class="lb">Name:</label>
                <div class="group">
                    <?php
                        if(isset($tenantInformation)){
                            echo $tenantInformation->user->first_name;
                        }
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">NRIC/FIN/PP No:</label>
                <div class="group">
                    <?php
                        if(isset($tenantInformation)){
                            echo $tenantInformation->user->nric_passportno_roc;
                            $res='';
                            $file = ROOT."/".Users::$folderUpload."/"."$tenantInformation->user_id/".$tenantInformation->user->upload_employment_pass_passport;
                            if(file_exists($file) && !empty($tenantInformation->user->upload_employment_pass_passport)){
                                $link = Yii::app()->createAbsoluteUrl(Users::$folderUpload."/$tenantInformation->user_id/".$tenantInformation->user->upload_employment_pass_passport);
//                                $res="<a href='$link' class='show-image'>View</a>";
                            }
//                            echo '  '.$res;
                        }
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">ID Type:</label>
                <div class="group">
                    <?php
                        if(isset($tenantInformation)){
                            if($tenantInformation->user->id_type)
                                echo Users::$aIdType[$tenantInformation->user->id_type];
                        }
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Expired Date:</label>
                <div class="group">
                    <?php
                        if(isset($tenantInformation)){
                            echo $cms->formatLongDate($tenantInformation->user->pass_expiry_date);
                        }
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Email:</label>
                <div class="group">
                    <?php
                        if(isset($tenantInformation)){
                            echo $tenantInformation->user->email_not_login;
                        }
                    ?>
                </div>
            </div>
            <div class="in-row clearfix" >
                <label class="lb">Contact:</label>
                <div class="group">
                    <?php
                        if(isset($tenantInformation)){
                            echo $tenantInformation->user->contact_no;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>


<div>
<h3 class='report' >UPLOAD/DOWNLOADED DOCUMENT(S)</h3>
<a data-fancybox-type="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('ajax/uploadDocument', array('transaction_id'=>$_GET['transaction_id'])); ?>" class="btn-5 upload_item"> Add More </a>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'document-grid',
	'dataProvider'=>$document,
	//'filter'=>$model,
         'enableSorting' => false,
         'summaryText' => "Showing items {start} to {end} of {count}",
         'htmlOptions'=>array(
                            'class'=>'tb-1',
                          ),
          'template'=>'{items} 
                        <div class="action-group clearfix">
                           <div class="pager f-right">{pager}</div> 
                           <div class="lb f-right">{summary}</div>               
                     </div>                
          ',
        'pager' => array(
                           'header' => '',
                           'cssFile' => false,
                           'prevPageLabel' => 'Previous',
                           'nextPageLabel' => 'Next',   
                           'lastPageLabel'  => '',
                           'firstPageLabel'  => '',
                           'htmlOptions'=>array(
                                            'class'=>'listing_manager'
                                       )
                       ),         
          'columns'=>array(
array(
                    'header' => '#',
                    'type' => 'raw',
                    'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                    'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
                array(
                    'name' => 'Title',
                    'value' => '$data->title',
                ),
                array(
                    'header' => 'File name',
//                    'type'=>'Document',
//                    'value' => '$data'
                    'value' => '$data->file_name'
                ),
                array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
                    'template'=> '{download_item} {delete_item}',
                    'buttons'=>array(
                        'download_item' => array
                        (
                            'url'=>'Yii::app()->createAbsoluteUrl("site/download",array("class"=>"ProTransactionsPropertyDocument","file_id"=>$data->id,"field"=>"file_name"))',
                            'options' => array('class'=>'download_item'),
                            'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/download.png'
                        ),
                        'delete_item' => array
                        (
                            'url'=>'Yii::app()->createAbsoluteUrl("member/agent/delete", array("document_id" => $data->id))',
                            'options' => array('class'=>'delete_item'),
                            'imageUrl'=>Yii::app()->theme->baseUrl . '/img/delete.png',
                            'visible' => '$data->user->role_id == ROLE_AGENT'
                        ),                        
                    )
                )
	),
)); ?>


<style> 
    .listing_manager .selected a {color:#333333 !important; }
    #document-grid table.items {width:100% !important;}
    #calllog-grid table.items {width:100% !important;}
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
    .in-row{
        width: 485px;
    }
    
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
        width: 324px;
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
        fnInitFancybox('.upload_item');
        fnInitFancybox('.update_engageus');
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