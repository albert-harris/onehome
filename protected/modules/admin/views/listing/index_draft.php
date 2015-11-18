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
            'filterHtmlOptions'=> array('class'=>'', 'style'=>''),
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
//        array(
//            'name' => 'listing_type_transaction',
//            'header' => 'Type Transaction',
//            'value'=>'ProTransactionsPropertyDetail::$aListingType[$data->listing_type_transaction]',
//            'headerHtmlOptions' => array('class' => '', 'style' => 'width:120px;'),
//            'filter'=> ProTransactionsPropertyDetail::$aListingType,
//            'htmlOptions' => array('style' => 'text-align:center;'),
//        ),
        array(
            'class' => 'ButtonColumn',
            'header' => 'Actions',
            'template' => '{update}{delete}',
            'headerHtmlOptions' => array('class' => 'last', 'style' => 'width:100px;'),
            'buttons' => array(
                'update' => array
                    (
                    'label' => 'Update',
//                   'imageUrl'=>'',
                    'url' => 'Yii::app()->createAbsoluteUrl("admin/listing/create", array("id"=>$data->id))',
                    'options' => array('class' => 'btn-3'),
                ),
                'delete' => array
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