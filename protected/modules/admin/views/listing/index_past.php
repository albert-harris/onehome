<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
?>
<?php include '_tab_index.php'; ?>

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
            'filter'=> Listing::$aTextSaleRentNormal,
        ),
        array(
            'name' => 'property_name_or_address',
            'header' => 'Property Name',
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
            'type' => 'date',
            'filterHtmlOptions'=> array('class'=>'ad_w1 ad_datepicker', 'style'=>''),
            'htmlOptions' => array('style' => 'width: 110px;text-align:center;'),            
        ),
//          array(
//            'name' => 'listing_type_transaction',
//            'header'=>'Type Transaction',
//            'value'=>'ProTransactionsPropertyDetail::$aListingType[$data->listing_type_transaction]',
//            'headerHtmlOptions' => array('class' => '', 'style' => 'width:120px;'),
//              'htmlOptions' => array('style' => 'text-align:center;'),
//            'filter'=> ProTransactionsPropertyDetail::$aListingType,
//        ),         
//        array(
//            'name' => 'status',
//            'header' => 'Status',
//            'type' => 'StatusListing',
//            'htmlOptions' => array('style' => 'width: 70px;'),
//        ),
        array(
            'header' => 'Transaction',
            'type'=>'ViewtransactionFromListing',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'width: 70px;text-align:center;'),
        ),        
        array(
            'class' => 'ButtonColumn',
            'header' => 'Actions',
            'template' => '{re_post}   {delete}',
            'headerHtmlOptions' => array('class' => 'last', 'style' => 'width:100px;'),
            'buttons' => array(
                'update' => array
                    (
                    'url' => 'Yii::app()->createAbsoluteUrl("admin/listing/deletelisting", array("id"=>$data->id))',
                    'options' => array('class' => 'btn-3'),
                ),
                'delete' => array
                    (
                    'label' => 'Remove',
                    'url' => 'Yii::app()->createAbsoluteUrl("admin/listing/deletelisting", array("id"=>$data->id))',
                    'options' => array('class' => 'btn-2'),
                ),
                're_post' => array
                        (
                            'label'=>'Repost',
                            'imageUrl'=>Yii::app()->theme->baseUrl . '/img/repost_icon.png',
                            // chưa xong
                            'url'=>'Yii::app()->createAbsoluteUrl("admin/listing/repost_listing", array("id"=>$data->id))',
                            'options' => array('class'=>'btn-3 repost_listing ajax_like_delete'),
                        ),
            ),
        ),
    ),
));
?>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/removePhoto.js"></script>
<script>
    // Jul 16, 2014 ANH DUNG - đăng ký cho 1 button click chạy ajax giống delete, sau đó update grid
    fnRegisterAjaxLink('#sr-resume-request-grid', '.ajax_like_delete','Are you sure you want to repost this item?');
    
</script>