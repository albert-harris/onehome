
<div class="breadcrumb" style="margin-top:0px;">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('member/agent/tenancy') ?>">Tenancy Management</a> 
    » 
    <a href="<?php echo Yii::app()->createAbsoluteUrl('member/agent/tenancies_detail', array('transaction_id'=>$transaction->id)) ?>"><?php echo $transaction->listing->property_name_or_address ?></a>
    » 
    Calls Log
</div>

<!--<h3>Defect(s) and Calls Log</h3>-->
<h3>Defect(s) and Call Histories</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'defect-grid',
	'dataProvider'=>$report,
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
                    'name' => 'Date/Time',
                    'type' => 'DateTimeReport',
                    'value' => '$data->created_date',
                ),

                array(
                    'name' => 'Description',                    
                    'value' => 'nl2br($data->description)',
                ),
                array(
                    'header' => 'Location',
                    'value' => 'ProReportDefect::GetViewLocation($data)'
                ),
                array(
                    'header' => 'Uploaded Photos',
                    'name'=>'photo',
//                    'type'=>'Photo',
                    'type'=>'PhotoAdmin',
                    'value'=>'$data',
                ),
                array(
                    'header' => 'Status',
                    'value' => 'CmsFormatter::$statusReport[$data->status];'
                ),
	),
)); ?>

 <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'calllog-grid',
	'dataProvider'=>$calllog,
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
                    'name'=>'date',
                    'type'=>'DateTimeTran',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'headerHtmlOptions' => array('class'=>'w-150','style' => 'text-align:center;'),
                ),
                array(
                    'name'=>'received_by',
//                    'htmlOptions' => array('style' => 'text-align:center;'),
                ),
                array(
                    'name'=>'description',
                    'type'=>'html',
                    'value'=>'MyFormat::replaceNewLineTextArea($data->description)',
                ),
                array(
                    'name'=>'person_call_type',
                    'value'=>'isset(ProCallLog::$ARR_PERSON_CALL_TYPE[$data->person_call_type])?ProCallLog::$ARR_PERSON_CALL_TYPE[$data->person_call_type]:""',
                    'htmlOptions' => array('style' => 'text-align:center;', 'class'=>'w-150')
                ),            
                array(
                    'name'=>'person_called',
        //            'type'=>'html',
                ),            
                array(
                    'name'=>'phone',
        //            'type'=>'html',
                ), 
	),
)); ?>


<style> 
    .listing_manager .selected a {color:#333333 !important; }
    #defect-grid table.items {width:100% !important;}
    #calllog-grid table.items {width:100% !important;}
</style>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<?php
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

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<script>
    $(document).ready(function() {
        fnInitFancybox('.engageus');
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
                //                fnInitFancybox(IdGrid);
            }
        });
    }

</script>