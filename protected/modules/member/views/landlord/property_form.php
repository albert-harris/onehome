<style>
    .tb_anhdung1 { width: 150%;}
    .tb_anhdung2 { width: 120%;}
</style>
<h3>Managing Properties</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'list-tenancy-grid',
	'dataProvider'=>$model,
	//'filter'=>$model,
         'enableSorting' => false,
         'summaryText' => "Showing items {start} to {end} of {count}",
         'itemsCssClass'=>'tb-1 tb_anhdung1 margin_0',
//         'htmlOptions'=>array('class'=>'tb-1',),
          'template'=>'<div class="table_scroll">{items}</div> 
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
                        'header' => 'Property name',
                        'type' =>'propertyname',
                        'value' => 'array("name"=>$data->listing->property_name_or_address, "transaction_id"=>$data->id)',//$data->listing->property_name_or_address'
                        'headerHtmlOptions'=>array('class'=>'w-150'),
                    ),
              
                    array(
                        'name' => 'Tenancy Agreement Date',
                        'type' => 'longDate',
                        'value' => '$data->tenancy_agreement_date',
                    ),
                    array(
                        'header' => 'commencement Date',
                        'type' => 'longDate',
                        'value' => '$data->commencement_date'
                    ),
                    array(
                        'header' => 'Expiring Date',
                        'type' => 'expiredDate',
                        'value' => '$data->expiring_date'
                    ),
                    array(
                        'header' => 'Tenancy Amount',
                        'type' => 'price',
                        'value' => '$data->tenancy_amount',                        
                        'htmlOptions' => array('style' => 'text-align:right;'),
                    ),
                    array(
                        'header' => 'Deposit Payable',
                        'type' => 'price',
                        'value' => '$data->deposit_payable',
                        'htmlOptions' => array('style' => 'text-align:right;'),
                    ),
                    array(
                        'header' => 'Tenancy Period',
                        'value' => '$data->months_rent != NULL ? $data->months_rent." months":""'
                    ),
                    array(
                        'header' => 'Engage Us',
                        'type' => 'engageus',
                        'value' => 'array("model"=>$data ,"trans_id"=>$data->id,  "listing_id" =>$data->listing_id, "expired_date"=>$data->expiring_date)',
                        'headerHtmlOptions' => array('style' => 'text-align:center;'),
                        'htmlOptions' => array('style' => 'text-align:center;', 'class'=>'w-180'),
                    )
	),
)); ?>

<h3>Marketing Properties under management of Property Infologic</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'list-engage-grid',
	'dataProvider'=>$engage,
	//'filter'=>$model,
         'enableSorting' => false,
         'summaryText' => "Showing items {start} to {end} of {count}",
//         'htmlOptions'=>array('class'=>'tb-1',),
         'itemsCssClass'=>'tb-1 tb_anhdung2 margin_0',
         'template'=>'<div class="table_scroll">{items}</div> 
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
                    'name' => 'Type',
    //                'type' => 'longDate',
                    'value' => '$data->listing->listing_type=1?"For Sale":"For Rent"',
                    'headerHtmlOptions'=>array('class'=>'w-100'),
                ),
                array(
                    'header' => 'Property name',
                    'type' =>'propertyname',
                    'value' => 'array("name"=>$data->listing->property_name_or_address, "transaction_id"=>$data->transaction_id)',//$data->listing->property_name_or_address'
                    'headerHtmlOptions'=>array('class'=>'w-250'),
                ),
                array(
                    'header' => 'Price',
                    'type' => 'price',
                    'value' => '$data->price',
                    'headerHtmlOptions'=>array('class'=>'w-100 '),
                    'htmlOptions' => array('style' => 'text-align:right;'),
                ),
                array(
                    'header' => 'Status',
                    'value' => '$data->status=0?"Listed":"Sold Out"',
                    'htmlOptions' => array('style' => 'text-align:left;'),
                    'headerHtmlOptions'=>array('class'=>'w-100 '),
                ),
                array(
                    'header' => 'List On',
                    'type' => 'longDate',
                    'value' => '$data->list_on',
                    'htmlOptions' => array('style' => 'text-align:left;'),
                    'headerHtmlOptions'=>array('class'=>'w-100 '),
                ),

                array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
                    'template'=> '{update_item} {delete_item}',
                    'buttons'=>array(
                        'delete_item' => array
                        (
                            'url'=>'Yii::app()->createUrl("member/landlord/deleteengage", array("engage_id"=>$data->id))',
                            'options' => array('class'=>'delete_item'),
                            'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/delete.png',
                        ),
                        'update_item' => array
                        (
                            'url'=>'Yii::app()->createUrl("member/landlord/updateengage", array("engage_id"=>$data->id))',
                            'options' => array('data-fancybox-type' => 'iframe', 'class'=>'update_engageus'),
                            'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/update.png',
                        ),
                    ),
                )
	),
)); ?>

<style> 
    .listing_manager .selected a {color:#333333 !important; }
    #list-tenancy-grid table.items {width:100% !important;}
    #list-engage-grid table.items {width:100% !important;}
    .btn-5 { padding:5px 9px !important; }
</style>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<?php
Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#list-tenancy a.ajaxupdate').on('click', function() {
        $.fn.yiiGridView.update('list-tenancy-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('list-tenancy-grid');
            }
        });
        return false;
    });
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#list-engage a.ajaxupdate').on('click', function() {
        $.fn.yiiGridView.update('list-engage-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('list-engage-grid');
            }
        });
        return false;
    });
");
?>

<script>
    $(document).ready(function() {
        fnInitFancybox('.engageus');
        fnInitFancybox('.update_engageus');
        fnInitFancyboxV1AD('.RequestBankEvaluation', 700);
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