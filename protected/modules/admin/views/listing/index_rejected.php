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
        ),
        array(
            'name' => 'property_name_or_address',
            'header' => 'Property Name',
        ),
        array(
            'name' => 'price',
            'type' => 'Price',
            'htmlOptions' => array('style' => 'width: 150px;text-align:right;'),
        ),
        array(
            'name' => 'rejected_on',
            'header' => 'Rejected On',
            'value' => 'date("d-M-Y",  strtotime($data->rejected_on))',
            'htmlOptions' => array('style' => 'width: 110px;'),
        ),
        array(
            'name' => 'remark',
            'header' => 'Remark by Admin',
            'type' => 'RemarkByAdmin',
            'value' => '$data',
            'htmlOptions' => array('style' => 'width: 150px;text-align:center;'),
        ),
        array(
            'name' => 'remark_rejected',
            'header' => 'Appeal',
            'type' => 'AppealByMember',
            'value' => '$data',
            'htmlOptions' => array('style' => 'width: 150px;text-align:center;'),
        ),
          array(
            'name' => 'listing_type_transaction',
            'header'=>'Type Transaction',
            'value'=>'($data->listing_type_transaction==1) ? "Individual" : "Company" ',
            'headerHtmlOptions' => array('class' => 'first', 'style' => 'width:120px;'),
        ),         
        array(
            'class' => 'ButtonColumn',
            'header' => 'Actions',
            'template' => '{delete}',
            'headerHtmlOptions' => array('class' => 'last', 'style' => 'width:175px;'),
            'buttons' => array(
                'update' => array
                    (
                    'url' => 'Yii::app()->createAbsoluteUrl("admin/listing/deletelisting", array("id"=>$data->id))',
                    'options' => array('class' => 'btn-3'),
                ),
                'delete' => array
                    (
                    'url' => 'Yii::app()->createAbsoluteUrl("admin/listing/deletelisting", array("id"=>$data->id))',
                    'options' => array('class' => 'btn-2'),
                ),
            ),
        ),
    ),
));
?>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/plugin.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/removePhoto.js"></script>
<script>
    $(document).ready(function() {
        fnInitFancybox('.AddVendorDetails',300);
        fnInitFancybox('.appeal',600);
    });

    function fnInitFancybox(class_name,height) {
        $(class_name).fancybox({
            fitToView: true,
            width: 600,
            height:height,
            autoSize: false, scrolling: false,
            fitToView:true,
            title: "",
            helpers: {overlay: {
                    closeClick: false,
                }
            }
        });
    }
</script>
<style>
    #uniform-Listing_pro_type,.search-form select {
        width: 208px !important;
    }  
</style>
