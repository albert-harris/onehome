<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
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
            ),
            array(
                'name'=>'price',
                 'type'=>'Price',   
                'htmlOptions'=>array('style'=>'width: 150px;text-align:right;'),
            ),

            array(
                'class'=>'ButtonColumn',
                      'header'=>'Actions',  
                            'template'=> '{update}{delete}',
                            'headerHtmlOptions'=>array('class'=>'last','style'=>'width:175px;'),   
                            'buttons'=>array(
                                        'update' => array
                                        (
                                                'label'=>'Update',
                                                'imageUrl'=>false,
                                                'url'=>'Yii::app()->createAbsoluteUrl("member/listing/create", array("id"=>$data->id))',
                                                'options' => array('class'=>'btn-3'),
                                        ),
                                        'delete' => array
                                        (
                                                'label'=>'Remove',
                                                'imageUrl'=>false,
                                                'url'=>'Yii::app()->createAbsoluteUrl("member/listing/deletelisting", array("id"=>$data->id))',
                                                'options' => array('class'=>'btn-2'),
                                        ),
                                ),
            ),
	),
)); ?>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/removePhoto.js"></script>