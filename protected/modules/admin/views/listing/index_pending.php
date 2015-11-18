<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
?>

<?php include '_tab_index.php'; ?>

</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'sr-resume-request-grid',
    'dataProvider' => $model->search(),
    'filter'=>$model,
    'enableSorting' => false,
    'columns' => array(
        array(
            'name' => 'listing_type',
            'header' => 'Type',
            'type' => 'PropertyType',
            'headerHtmlOptions' => array('class' => 'first', 'style' => 'width:70px;'),
        ),
        array(
            'name' => 'property_name_or_address',
            'header' => 'Property Name',
            'type' => 'LinkListing',
            'value' => '$data'
        ),
        array(
            'name' => 'price',
            'type' => 'Price',
            'htmlOptions' => array('style' => 'width: 150px;text-align:right;'),
        ),
        array(
            'name' => 'status_approve',
            'header' => 'Pending Type',
            'type' => 'StatusPendingListing',
            'value'=>'$data',  
            'htmlOptions' => array('style' => 'width: 150px;'),
        ),
        array(
            'name' => 'take_off_content',
            'header' => 'Reason take off',
            'type' => 'ReasonTakeOff',
            'value' => '$data',
            'htmlOptions' => array('style' => 'width: 100px;text-align:center;'),
            
        ),
         array(
            'name' => 'listing_type_transaction',
            'header'=>'Type Transaction',
            'value'=>'($data->listing_type_transaction==1) ? "Individual" : "Company" ',
            'headerHtmlOptions' => array('class' => 'first', 'style' => 'width:120px;'),
        ),          
        array(
            'name' => 'status_approve',
            'header' => 'Approve',
            'type' => 'StatusAdminApprove',
            'value' => '$data',
            'htmlOptions' => array('style' => 'width: 80px;'),
        ),
        array(
            'class' => 'ButtonColumn',
            'header' => 'Actions',
            'template' => '{update}{delete}',
            'headerHtmlOptions' => array('class' => 'last', 'style' => 'width:175px;'),
            'buttons' => array(
                'update' => array
                    (
                    'url' => 'Yii::app()->createAbsoluteUrl("admin/listing/create", array("id"=>$data->id))',
                    'options' => array('class' => 'btn-3'),
                    'visible' => '$data->status_approve <2',
                ),
                'delete' => array
                    (
                    'url' => 'Yii::app()->createAbsoluteUrl("admin/listing/deletelisting", array("id"=>$data->id))',
                    'options' => array('class' => 'btn-2'),
//                                                                    'visible'=>'$data->status_approve <2',
                ),
            ),
        ),
    ),
));
?>

<!-- model content -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h3>Reason</h3>
            </div>
            <div class="modal-body">
                <textarea id="request_take_off"  style="width:100%;height: 100px;border:1px solid #E5E5E5;"></textarea>
            </div>
            <div class="modal-footer">
                <!--<button class="btn btn-success btn-send-take-off" id="submit" type="submit">Send</button>-->
            </div>
        </div>

    </div>
</div>


<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/plugin.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/removePhoto.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>

<script>
    $(document).ready(function() {
        fnInitFancybox('.AddVendorDetails',300);
    });

    function fnInitFancybox(class_name,height) {
        $(class_name).fancybox({
            fitToView: true,
            width: 600,
            height:height,
            autoSize: false, scrolling: false,
            title: "",
            helpers: {overlay: {
                    closeClick: false,
                }
            }
        });
    }
    
    $('.view_take_off').live('click',function(){
        var id = '#'+$(this).attr('rel');
        $('#request_take_off').val($(id).val());
        $('#myModal').modal('show');
    });
</script>
<style>
    #uniform-Listing_pro_type,.search-form select {
        width: 208px !important;
    }  
    span.user-actions, td div.btn-group{
        visibility: visible;
    }
    
</style>
