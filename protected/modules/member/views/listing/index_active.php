<?php
Yii::app()->clientScript->registerScript('repost-listing', "
fnRegisterAjaxLink('#sr-resume-request-grid', '.ajax_like_delete','Are you sure you want to repost this item?');
");
?>
<style> 
    .listing_manager .selected a {color:#333333 !important; }
    #sr-resume-request-grid table.items {width:100% !important;}
</style>
<?php
$this->breadcrumbs=array(
//	'Dashboard'=>array('member/listing/index'),
	'Listing Management',
);
?>
<h3><b>ALL LISTINGS</b></h3>
<a href="<?php echo Yii::app()->createAbsoluteUrl('member/listing/create') ?>" class="btn-3 f-right">Create New Advertising</a>

<?php include '_tab_index.php';?>

     <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sr-resume-request-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
         'afterAjaxUpdate'=>'function(id, data){ fnBindDateFilter(); }',
        'enableSorting' => true,
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
                'name'=>'listing_type',
                'header'=>'Type',  
                'type'=>'PropertyType',
                'headerHtmlOptions'=>array('class'=>'first','style'=>'width:70px;'),   
                'filter'=> Listing::$aTextSaleRentNormal,
                'filterHtmlOptions'=> array('class'=>'ad_w1', 'style'=>''),
            ),
            array(
                'name'=>'property_name_or_address',
                'header'=>'Property Name', 
                'type'=>'LinkListing',
                'value'=>'$data'
            ),
            array(
                'name'=>'price',
                 'type'=>'Price',   
                'htmlOptions'=>array('style'=>'width: 150px;text-align:right;'),
            ),
            array(
              'name'=>'date_listed',
              'header'=>'Listed On',
              'type' => 'date',
            'filterHtmlOptions'=> array('class'=>'ad_w1 ad_datepicker', 'style'=>''),
            'htmlOptions' => array('style' => 'width: 110px;text-align:center;'),
            ),

             array(
                'name'=>'status',
                'header'=>'Published',
                'type'=>'StatusListing',
                'value'=>'array("id"=>$data->id, "status"=>$data->status)',
                'htmlOptions'=>array('style'=>'width: 70px;text-align:center;'), 
                 'filter'=> false,
             ),             

//                                array(
//                                  'name'=>'take_off',
//                                  'header'=>'Take Off',
//                                  'type'=>'TakeOff',  
//                                     'htmlOptions'=>array('style'=>'width: 70px;'),
//                                ),
            array(
                'class'=>'ButtonColumn',
                'evaluateID'=>true,
                      'header'=>'Actions',  
//                            'template'=> '{update}{transaction}{transaction_sold}{take_off}',
                        'template'=> '{update}{transaction}{transaction_sold}{re_post}{delete}',
                        'headerHtmlOptions'=>array('class'=>'last','style'=>'width:200px;text-align:center;'),
                        
                        'buttons'=>array(
                                    'update' => array
                                   (
                                           'label'=>'Update',
                                           'imageUrl'=>false,
                                           'url'=>'Yii::app()->createAbsoluteUrl("member/listing/create", array("id"=>$data->id))',
                                           'options' => array('class'=>'btn-3'),
    //                                                                    'visible'=>'$data->status_approve <2 && $data->take_off==0',
                                   ),                                                   
                                   'take_off' => array
                                   (
                                           'label'=>'Request to take off',
                                           'imageUrl'=>false,
                                           'url'=>'',
                                           'options' => array(
                                               'class'=>'btn-3 btn-t-4 btn_take_off',
                                               'id'=>'$data->id',
                                               'rel'=>Yii::app()->createAbsoluteUrl("member/listing/take_off", array("listing"=>''))
                                           ),
                                   ),
                                   'transaction' => array
                                   (
                                           'label'=>"Rented",
                                           'imageUrl'=>false,
                                           'url'=>'Yii::app()->createAbsoluteUrl("member/member_profile/createTransaction", array("listing_id"=>$data->id,"type"=>$data->listing_type, "list"=>"listing"))',
                                           'options' => array('class'=>'btn-3'),
                                           'visible'=>'$data->listing_type ==1'
                                   ),
                                   'transaction_sold' => array
                                   (
                                           'label'=>"Sold",
                                           'imageUrl'=>false,
                                           'url'=>'Yii::app()->createAbsoluteUrl("member/member_profile/createTransaction", array("listing_id"=>$data->id,"type"=>$data->listing_type, "list"=>"listing"))',
                                           'options' => array('class'=>'btn-3'),
                                          'visible'=>'$data->listing_type ==2'
                                   ),
                                   're_post' => array (
										'label'=>'Repost',
										'imageUrl'=>false,
										'url'=>'Yii::app()->createAbsoluteUrl("member/listing/repost_listing", array("id"=>$data->id))',
										'options' => array('class'=>'btn-3 repost_listing ajax_like_delete'),
									),
									'delete' => array
									(
											'label'=>'Delete',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createAbsoluteUrl("member/listing/deletelisting", array("id"=>$data->id))',
											'options' => array('class'=>'btn-2'),
									),

                                ),
            ),
	),
)); ?>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/removePhoto.js"></script>
<?php
Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#sr-resume-request-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('sr-resume-request-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('sr-resume-request-grid');
            }
        });
        return false;
    });
");
?>
<style type="text/css">
    .btn-t-4 {width:150px !important;}
    .btn-t-4:hover {cursor: pointer;}
</style>


<!-- model content -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h3>Reason</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" name="url" id="url" />
                <textarea id="request_take_off"  style="width:100%;height: 100px;border:1px solid #E5E5E5;"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-send-take-off" id="submit" type="submit">Send</button>
            </div>
        </div>

    </div>
    
</div>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>