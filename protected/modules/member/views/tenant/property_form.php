<style>
    .tb_anhdung1 { width: 150%;}
    .tb_anhdung2 { width: 120%;}
</style>
<?php
/**
 * Created by PhpStorm.
 * User: JasonHai
 * Date: 4/8/14
 * Time: 4:19 PM
 */
?>
    <h3>List of Tenancies</h3>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'users-model-grid',
        'dataProvider'=>$model,
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
                'value' => 'array("name"=>$data->listing?$data->listing->property_name_or_address:"", "transaction_id"=>$data->id)',//$data->listing->property_name_or_address'
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
        )
    ));
    ?>
<style> 
    .listing_manager .selected a {color:#333333 !important; }
    #users-model-grid table.items {width:100% !important;}
</style>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<?php
Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#users-model a.ajaxupdate').on('click', function() {
        $.fn.yiiGridView.update('users-model-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('users-model-grid');
            }
        });
        return false;
    });
");