<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
?>
<?php include '_tab_index.php'; ?>

<style>

    
</style>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'sr-resume-request-grid',
    'dataProvider' => $model->search(),
    'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank(); fnBindDateFilter(); }',
    'filter'=>$model,
    'enableSorting' => true,
    'columns' => array(
        array(
            'name' => 'listing_type',
            'header' => 'Type',
            'type' => 'PropertyType',
            'headerHtmlOptions' => array('class' => 'first', 'style' => 'width:70px;'),
            'filter'=> Listing::$aTextSaleRentNormal,
        ),                
        array(
            'name' => 'property_name_or_address',
            'header' => 'Property Name',
            'type' => 'LinkListing',
            'value' => '$data',
            'filterHtmlOptions'=> array('class'=>'w-50', 'style'=>''),
//            'htmlOptions' => array('style' => 'width: 150px;'),
        ),
        array(
            'name'=>'property_type_1',
            'value'=>'Listing::getViewDetailPropertyType($data)',
            'filter'=> false,
        ),
        array(
            'header' => 'Agent Name',
            'name'=>'agent_name',
            'type'=>'AgentName',
            'value'=>'$data',
            'filterHtmlOptions'=> array('class'=>'w-50', 'style'=>''),
            'htmlOptions' => array('style' => 'width: 250px;text-align:left;'),
        ),
        array(
            'name' => 'price',
            'type' => 'Price',
            'htmlOptions' => array('style' => 'width: 150px;text-align:right;'),
        ),
        array(
            'name' => 'date_listed',
            'header' => 'Listed On',
            'type' => 'date',
            'filterHtmlOptions'=> array('class'=>'ad_w1 ad_datepicker', 'style'=>''),
            'htmlOptions' => array('style' => 'width: 110px;text-align:center;'),
        ),
//                                array(
//                                  'name'=>'status',
//                                  'header'=>'Published',
//                                  'type'=>'StatusListing',
//                                   'htmlOptions'=>array('style'=>'width: 70px;'), 
//                                ),
        array(
            'name' => 'status',
            'header' => 'Published',
            'type' => 'StatusListing',
            'value' => 'array("id"=>$data->id, "status"=>$data->status)',
            'htmlOptions' => array('style' => 'width: 70px;text-align:center;'),
            'filter'=> false,
//            'filterHtmlOptions'=> array('class'=>'', 'style'=>'text-align:center;'),
        ),
//        array(
//            'header' => 'Transaction',
//            'type'=>'ViewtransactionFromListing',
//            'value'=>'$data',
//            'htmlOptions' => array('style' => 'width: 70px;text-align:center;'),
//        ),
//         array(
//            'name' => 'listing_type_transaction',
//            'header'=>'Type Transaction',
//            'value'=>'ProTransactionsPropertyDetail::$aListingType[$data->listing_type_transaction]',
//            'headerHtmlOptions' => array('class' => 'first', 'style' => 'width:120px;'),
//            'htmlOptions' => array('style' => 'text-align:center;'),
//            'filter'=> ProTransactionsPropertyDetail::$aListingType,
//        ),
		array(
			'name' => 'view_count',
            'filter'=> false,
		),
        array(
            'class' => 'ButtonColumn',
            'evaluateID' => true,
            'header' => 'Actions',
//            'template' => '{update}{delete}',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('update','delete')),
            'headerHtmlOptions' => array('class' => 'last', 'style' => 'width:100px;'),
            'buttons' => array(
                'update123' => array (
                       'label'=>'Update',
//                       'imageUrl'=>false,
                       'url'=>'Yii::app()->createAbsoluteUrl("admin/listing/create", array("id"=>$data->id))',
//                       'options' => array('class'=>'btn-3'),
//                     'visible'=>'$data->status_approve <2 && $data->take_off==0',
               ),                  
                'delete123' => array
                    (
                    'label' => 'Remove',
//                  'imageUrl'=>'',
                    'url' => 'Yii::app()->createAbsoluteUrl("admin/listing/deletelisting", array("id"=>$data->id))',
                    'options' => array('class' => 'btn-2'),
                ),
            ),
        ),
    ),
));
?>

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
