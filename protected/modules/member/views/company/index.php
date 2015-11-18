<?php
/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
Yii::app()->clientScript->registerCssFile(
	Yii::app()->baseUrl.'/themes/onehome/css/bootstrap.css');
?>
<?php $this->widget('TcFormWidget', array(
	'userId' => Yii::app()->user->id
)) ?>

<style> 
    .listing_manager .selected a {color:#333333 !important; }
    /*#sr-resume-request-grid table.tb-1 {width:110%;}*/
</style>
<?php
$this->breadcrumbs = array(
    'Company Listing',
);
?>
<h3>ALL COMPANY LISTING</h3>
<?php  include '_search.php'; ?>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'sr-resume-request-grid',
    'dataProvider' => $model->searchCompanyListing(),
    //'filter'=>$model,fnBuildTr();
    'afterAjaxUpdate'=>'function(id, data){ fnBuildTr(); }',
    'enableSorting' => false,
    'summaryText' => "Showing items {start} to {end} of {count}",
    'htmlOptions' => array(
//        'class' => 'tb-1',
    ),
    'itemsCssClass'=>'tb-1 margin_0',
    'template' => '<div class="table_scroll">{items}</div>  
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
        'lastPageLabel' => '',
        'firstPageLabel' => '',
        'htmlOptions' => array(
            'class' => 'listing_manager'
        )
    ),
    'columns' => array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('class' => 'first', 'width' => '10px', 'style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;width:10px;')
        ),
   
        array(
            'name' => 'listing_type',
            'header' => 'Type',
            'type' => 'PropertyTypeCompany',
            'headerHtmlOptions' => array('style' => 'width:20px;'),
        ),
        array(
            'name' => 'location_id',
//            'header' => 'District – location',
            'header' => 'District',
            'type' => 'CompanyListingDistrict',
            'value' => '$data',
//            'headerHtmlOptions' => array('style' => 'width:250px;'),
            'headerHtmlOptions' => array('style' => 'width:30px;'),
        ),
        array(
            'name' => 'property_name_or_address',
            'header' => 'Property Name',
//            'type' => 'LinkListing',
//            'value' => '$data',
//            'htmlOptions' => array('style' => 'width: 80px;'),
        ),
        array(
            'name'=>'unit_from',
            'value'=>'$data->unit_from." - $data->unit_to"',
            'htmlOptions' => array('style' => 'width: 70px;'),
        ),
        
        array(
            'name' => 'floor_area',
//            'type' => 'Price',
            'type' => 'ListingFloorArea',
            'value' => '$data',
            'htmlOptions' => array('style' => 'width: 30px;text-align:right;'),
        ),
        array(
            'name' => 'of_bedroom',
            'type' => 'Price',
//            'type' => 'ListingBedroom',
//            'value' => '$data',
            'htmlOptions' => array('style' => 'width: 30px;text-align:center;'),
//            'htmlOptions' => array('style' => 'width: 150px;text-align:left;'),
        ),
        array(
            'name' => 'price',
            'type' => 'Price',
            'htmlOptions' => array('style' => 'text-align:right;'),
        ),
        array(
//            'name' => 'company_owner_name',
            'name' => 'company_availability',
            'header' => 'Availability',
//            'type' => 'FullNameRegisteredUsers',
//            'value' => '$data->rUser?$data->rUser:null',
            'htmlOptions' => array('style' => ''),
//            'htmlOptions' => array('style' => 'width: 150px;text-align:left;'),
        ),
//        array(
//            'name' => 'contact_name_no',
////            'type' => 'CompanyContactNameNo',
////            'value' => '$data',
//        ),
//        array(
//            'name' => 'dnc_expiry_date',
//            'header' => 'DNC Expiry Date',
//            'type' => 'CompanyDncExpiryDate',
//            'value' => '$data',
//            'htmlOptions' => array('style' => 'width: 80px;text-align:center;'),
//        ),
        
        array(
            'header' => 'Telemarketer\'s Name',
            'name' => 'user_id_admin',
            'type' => 'FullNameUsers',
            'value' => '$data->rUser?$data->rUser:null',
            'htmlOptions' => array('style' => 'width: 70px;'),
        ),
        
        array(
            'name' => 'date_listed',
            'header' => 'Listed On',
            'value' => 'date("d-M-Y",  strtotime($data->created_date))',
            'htmlOptions' => array('style' => 'width: 50px;'),
        ),
//                                array(
//                                  'name'=>'status',
//                                  'header'=>'Published',
//                                  'type'=>'StatusListing',
//                                   'htmlOptions'=>array('style'=>'width: 70px;'), 
//                                ),
//        array(
//            'name' => 'status',
//            'header' => 'Published',
//            'type' => 'StatusListing',
//            'value' => 'array("id"=>$data->id, "status"=>$data->status)',
//            'htmlOptions' => array('style' => 'width: 70px;text-align:center;'),
//        ),
        

        array(
            'class' => 'ButtonColumn',
            'header' => 'Actions',
//            'template' => '{transaction}{transaction_sold}{view}',
          /*  'template' => '{user_post}{view}{adv}',*/
            'template' => '{adv}',

            'headerHtmlOptions' => array('class' => 'last', 'style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'width: 150px; white-space: nowrap;'),
            'buttons' => array(
/*                'view' => array (
                    'label' => 'View listing',
                    'imageUrl' => false,
                    'url'=>'Yii::app()->createAbsoluteUrl("site/listingdetail", array("slug"=>$data->slug))',
                    'options' => array('class' => 'btn-3'),
                ),
                'user_post' => array (
                    'label' => 'Post Listing',
                    'imageUrl' => false,
                    'url'=>'Yii::app()->createAbsoluteUrl("member/listing/user_post", array("id"=>$data->id))',
                    'options' => array('class' => 'btn-3 ajax_like_delete'),
                ),*/
                
                'adv' => array
                (
                        'label'=>"Create Advertisement",
                        'imageUrl'=>false,
                        'url'=>'Yii::app()->createAbsoluteUrl("member/listing/create", array("company"=>$data->id))',
                        'options' => array('class'=>'btn-3 btn-adv-custome'),
                ),
/*                'transaction' => array
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
                ), */               
            ),
        ),
    ),
));
?>

<style>
    .hidden_detail{
        display:none;
    }
    
    .listing_detail{
        display: table-cell;
        padding-right: 30px;
		vertical-align: top;
    }
    
    .label_detail{
        display: inline-block;
        width: 150px;
    }
	
    .remark{
        display: inline-block;
        width: 60px;
		vertical-align: top;
    }	
    .btn-adv-custome {width:100% !important;}
</style>
<script>
    // Jul 16, 2014 ANH DUNG - đăng ký cho 1 button click chạy ajax giống delete, sau đó update grid
    fnRegisterAjaxLink('#sr-resume-request-grid', '.ajax_like_delete','Are you sure you want to post this listing?');
    
	$(document).ready(function(){
        
        fnBindClickTrShowMore();
        fnBuildTr();
        
	});
        
        function fnBuildTr(){
            $('.ad_nb_tr').each(function(){
                var tr = $(this).closest('tr');
                var content = $(this).html();
                var tr_new = "<tr class='display_none'><td colspan='13'>"+content+"</td></tr>";
                tr.after(tr_new);
                tr.click(function(){
                    $(this).next().slideToggle();
                });
            });
            fnBindClickTrShowMore();
        }
        
        function fnBindClickTrShowMore(){
            $('tbody tr').each(function() {
                var $this = $(this);
                $this.css("cursor","pointer")
                .attr("title","Click to expand/collapse");
            });
        }
	
</script>